<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Models\Biodata;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use App\Models\Ulasan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use App\Models\User;
use Symfony\Component\HttpFoundation\StreamedResponse;

class AdminController extends Controller
{
    public function login()
    {
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }
        
        return view('admin.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (!str_ends_with(strtolower($credentials['email']), '@pawmedic.app')) {
            return back()->withErrors([
                'email' => 'Login admin hanya untuk email @pawmedic.app.',
            ])->onlyInput('email');
        }

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            
            return redirect()->intended(route('admin.dashboard'));
        }

        return back()->withErrors([
            'email' => 'Email atau password tidak valid.',
        ])->onlyInput('email');
    }

    public function forgotPasswordPage()
    {
        return view('admin.forgot-password');
    }

    public function sendForgotOtp(Request $request)
    {
        $data = $request->validate([
            'otp_email' => 'required|email',
        ]);

        $otpEmail = strtolower((string)$data['otp_email']);
        $otp = str_pad((string) random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        $cacheKey = 'admin_password_recovery_otp_' . sha1($otpEmail);

        Cache::put($cacheKey, [
            'otp_hash' => Hash::make($otp),
            'otp_email' => $otpEmail,
        ], now()->addMinutes(10));

        Mail::raw(
            "Kode OTP reset password PawMedic Anda adalah: {$otp}\n\nKode berlaku 10 menit. Jangan bagikan kode ini kepada siapa pun.",
            function ($message) use ($otpEmail) {
                $message->to($otpEmail)->subject('OTP Reset Password PawMedic');
            }
        );

        return back()
            ->with('success', 'Kode OTP berhasil dikirim. Cek email Anda.')
            ->with('otp_email', $otpEmail);
    }

    public function verifyForgotOtp(Request $request)
    {
        $data = $request->validate([
            'otp_email' => 'required|email',
            'otp' => 'required|string|size:6',
        ]);

        $otpEmail = strtolower((string)$data['otp_email']);
        $cacheKey = 'admin_password_recovery_otp_' . sha1($otpEmail);
        $cached = Cache::get($cacheKey);

        if (!is_array($cached) || empty($cached['otp_hash'])) {
            return back()->with('error', 'Kode OTP tidak ditemukan atau sudah kedaluwarsa.')->with('otp_email', $otpEmail);
        }

        if (!Hash::check((string)$data['otp'], (string)$cached['otp_hash'])) {
            return back()->with('error', 'Kode tidak valid.')->with('otp_email', $otpEmail);
        }

        session([
            'forgot_otp_verified' => true,
            'forgot_otp_email' => $otpEmail,
        ]);

        return redirect()->route('admin.forgot.reset.form');
    }

    public function resetPasswordPage()
    {
        if (!session('forgot_otp_verified')) {
            return redirect()->route('admin.forgot.password')->with('error', 'Silakan verifikasi OTP terlebih dahulu.');
        }

        return view('admin.reset-password');
    }

    public function resetPasswordSubmit(Request $request)
    {
        if (!session('forgot_otp_verified')) {
            return redirect()->route('admin.forgot.password')->with('error', 'Silakan verifikasi OTP terlebih dahulu.');
        }

        $data = $request->validate([
            'new_password' => 'required|string|min:6|confirmed',
        ]);

        $admin = User::query()
            ->where('email', 'like', '%@pawmedic.app')
            ->orderBy('id')
            ->first();

        if (!$admin) {
            return redirect()->route('admin.forgot.password')->with('error', 'Akun admin @pawmedic.app tidak ditemukan.');
        }

        $admin->password = Hash::make((string)$data['new_password']);
        $admin->save();

        $otpEmail = (string)session('forgot_otp_email', '');
        if ($otpEmail !== '') {
            Cache::forget('admin_password_recovery_otp_' . sha1($otpEmail));
        }

        $request->session()->forget(['forgot_otp_verified', 'forgot_otp_email']);

        return redirect()->route('admin.login')->with('success', 'Password admin berhasil diganti. Silakan login.');
    }

    public function sendRecoveryOtp(Request $request)
    {
        $data = $request->validate([
            'otp_email' => 'required|email',
        ]);

        $otp = str_pad((string) random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        $otpEmail = strtolower($data['otp_email']);
        $cacheKey = 'admin_password_recovery_otp_' . sha1($otpEmail);
        Cache::put($cacheKey, [
            'otp_hash' => Hash::make($otp),
            'otp_email' => $otpEmail,
        ], now()->addMinutes(10));

        Mail::raw(
            "Kode OTP reset password PawMedic Anda adalah: {$otp}\n\nKode berlaku 10 menit. Jangan berikan kode ini ke siapa pun.",
            function ($message) use ($otpEmail) {
                $message->to($otpEmail)->subject('OTP Reset Password PawMedic');
            }
        );

        return back()->with('success', 'OTP berhasil dikirim ke email aplikasi. Cek inbox (atau log mail jika mode lokal).');
    }

    public function recoverPassword(Request $request)
    {
        $data = $request->validate([
            'otp_email' => 'required|email',
            'email' => 'required|email',
            'otp' => 'required|string|size:6',
            'new_password' => 'required|string|min:6|confirmed',
        ]);

        $otpEmail = strtolower($data['otp_email']);
        $email = strtolower($data['email']);
        if (!str_ends_with($email, '@pawmedic.app')) {
            return back()->with('error', 'Reset password admin hanya untuk email @pawmedic.app.');
        }

        $cacheKey = 'admin_password_recovery_otp_' . sha1($otpEmail);
        $cached = Cache::get($cacheKey);
        if (!is_array($cached) || empty($cached['otp_hash'])) {
            return back()->with('error', 'OTP tidak ditemukan atau sudah kedaluwarsa. Silakan kirim OTP ulang.');
        }

        if (!hash_equals((string)($cached['otp_email'] ?? ''), $otpEmail)) {
            return back()->with('error', 'Email aplikasi tidak sesuai dengan OTP.');
        }

        if (!Hash::check((string) $data['otp'], (string) $cached['otp_hash'])) {
            return back()->with('error', 'Kode OTP tidak valid.');
        }

        $admin = User::where('email', $data['email'])->first();
        if (!$admin) {
            return back()->with('error', 'Email admin tidak ditemukan.');
        }

        $admin->password = Hash::make($data['new_password']);
        $admin->save();
        Cache::forget($cacheKey);

        return redirect()->route('admin.login')->with('success', 'Password berhasil direset. Silakan login dengan password baru.');
    }

    public function dashboard()
{

    // total diagnosis
    $totalDiagnosis = Biodata::count();

    // hari ini
    $todayDiagnosis = Biodata::whereDate('created_at', Carbon::today())->count();

    // kemarin
    $yesterday = Biodata::whereDate('created_at', Carbon::yesterday())->count();
    $diff = $todayDiagnosis - $yesterday;

    // user list + diagnosis list
    $sort = request('sort');
    if ($sort == 'oldest') {
        $data = Biodata::orderBy('created_at', 'asc')->get();
    } else {
        $data = Biodata::orderBy('created_at', 'desc')->get();
    }

    // Data pengguna unik (hindari duplikasi input yang sama)
    $userData = $data->unique(function ($item) {
        $phone = trim((string)($item->no_telepon ?? ''));
        if ($phone !== '') {
            return 'phone:' . $phone;
        }

        return 'fallback:' . Str::lower(trim((string)($item->nama_pemilik ?? ''))) . '|' .
            Str::lower(trim((string)($item->nama_kucing ?? ''))) . '|' .
            Str::lower(trim((string)($item->alamat ?? '')));
    })->values();

    // total user = jumlah data unik
    $totalUsers = $userData->count();

    // penyakit paling umum
    $mostCommon = Biodata::select('hasil_diagnosis')
        ->whereNotNull('hasil_diagnosis')
        ->groupBy('hasil_diagnosis')
        ->orderByRaw('COUNT(*) DESC')
        ->value('hasil_diagnosis');

    // penyakit terbanyak hari ini
    $todayDisease = Biodata::whereDate('created_at', Carbon::today())
        ->select('hasil_diagnosis')
        ->whereNotNull('hasil_diagnosis')
        ->groupBy('hasil_diagnosis')
        ->orderByRaw('COUNT(*) DESC')
        ->value('hasil_diagnosis');

    // diagnosis terbaru
    $recent = Biodata::select('hasil_diagnosis', 'created_at')
        ->latest()
        ->take(5)
        ->get();

    $recentFormatted = $recent->map(function ($item) {
        return [
            'date' => $item->created_at,
            'disease' => $item->hasil_diagnosis,
            'count' => 1
        ];
    });

    // chart penyakit
    $diseaseStats = Biodata::select('hasil_diagnosis')
        ->whereNotNull('hasil_diagnosis')
        ->get()
        ->groupBy('hasil_diagnosis')
        ->map(function ($item) {
            return count($item);
        });

    $chartLabels = $diseaseStats->keys()->values();
    $chartData = $diseaseStats->values();

    // Data tren: 7 hari terakhir
    $period = CarbonPeriod::create(Carbon::now()->subDays(6), Carbon::now());
    $trend7Labels = [];
    $trend7Data = [];

    foreach ($period as $date) {
        $count = Biodata::whereDate('created_at', $date)->count();
        $trend7Labels[] = $date->format('d M');
        $trend7Data[] = $count;
    }

    // Data tren: per bulan (tahun berjalan)
    $monthNames = [
        1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr', 5 => 'Mei', 6 => 'Jun',
        7 => 'Jul', 8 => 'Agu', 9 => 'Sep', 10 => 'Okt', 11 => 'Nov', 12 => 'Des',
    ];
    $monthlyRaw = Biodata::query()
        ->selectRaw('MONTH(created_at) as m, COUNT(*) as total')
        ->whereYear('created_at', Carbon::now()->year)
        ->groupBy('m')
        ->orderBy('m')
        ->get()
        ->keyBy('m');

    $trendMonthLabels = [];
    $trendMonthData = [];
    for ($m = 1; $m <= 12; $m++) {
        $trendMonthLabels[] = $monthNames[$m];
        $trendMonthData[] = (int)($monthlyRaw[$m]->total ?? 0);
    }

    // Data tren: seluruh periode (agregasi per bulan-tahun)
    $allRaw = Biodata::query()
        ->selectRaw("DATE_FORMAT(created_at, '%Y-%m') as ym, COUNT(*) as total")
        ->groupBy('ym')
        ->orderBy('ym')
        ->get();

    $trendAllLabels = $allRaw->map(function ($row) use ($monthNames) {
        [$y, $m] = explode('-', (string)$row->ym);
        $month = (int)$m;
        return ($monthNames[$month] ?? $m) . ' ' . $y;
    })->values()->all();
    $trendAllData = $allRaw->pluck('total')->map(fn ($n) => (int)$n)->values()->all();

    // kirim ke blade
    $stats = [
        'total_diagnosis' => $totalDiagnosis,
        'today_diagnosis' => $todayDiagnosis,
        'total_users' => $totalUsers,
        'most_common_disease' => $mostCommon,
        'recent_diagnosis' => $recentFormatted,
        'chart_labels' => $chartLabels,
        'chart_data' => $chartData,
        'diagnosis_diff' => $diff,
        'today_top_disease' => $todayDisease,
        'trend_7_labels' => $trend7Labels,
        'trend_7_data' => $trend7Data,
        'trend_month_labels' => $trendMonthLabels,
        'trend_month_data' => $trendMonthData,
        'trend_all_labels' => $trendAllLabels,
        'trend_all_data' => $trendAllData,
    ];
    // 🔥 STAT
    $ratingChart = Ulasan::select('rating', DB::raw('count(*) as total'))
    ->groupBy('rating')
    ->orderBy('rating')
    ->get();

$stats['rating_labels'] = $ratingChart->pluck('rating');
$stats['rating_data'] = $ratingChart->pluck('total');

    return view('admin.dashboard', compact('stats', 'data', 'userData'));
}

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('admin.login');
    }

    private function getStatistics()
    {
        // Simulated statistics - bisa diganti dengan data real dari database
        return [
            'total_diagnosis' => 156,
            'today_diagnosis' => 12,
            'total_users' => 89,
            'most_common_disease' => 'Feline Panleukopenia',
            'recent_diagnosis' => [
                ['date' => '2026-01-15', 'disease' => 'Feline Panleukopenia', 'count' => 5],
                ['date' => '2026-01-14', 'disease' => 'Feline Calicivirus', 'count' => 3],
                ['date' => '2026-01-13', 'disease' => 'Scabies', 'count' => 4],
            ]
        ];
    }
    public function statistik()
{
    $diseaseStats = Biodata::select('hasil_diagnosis')
        ->whereNotNull('hasil_diagnosis')
        ->get()
        ->groupBy('hasil_diagnosis')
        ->map(function ($item) {
            return count($item);
        });

    $chartLabels = $diseaseStats->keys()->values();
    $chartData = $diseaseStats->values();

    return view('admin.statistik', compact('chartLabels', 'chartData'));
}
public function sortDiagnosis(Request $request)
{
    $sort = $request->sort;

    if ($sort == 'oldest') {
        $data = Biodata::orderBy('created_at', 'asc')->get();
    } else {
        $data = Biodata::orderBy('created_at', 'desc')->get();
    }

    return response()->json($data);
}

public function exportDiagnosisExcel(): StreamedResponse
{
    $rows = Biodata::orderBy('created_at', 'desc')->get();
    $filename = 'diagnosis-pawmedic-' . now()->format('Ymd-His') . '.xls';

    $headers = [
        'Content-Type' => 'application/vnd.ms-excel; charset=UTF-8',
        'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        'Cache-Control' => 'max-age=0',
    ];

    return response()->streamDownload(function () use ($rows) {
        echo '<html><head><meta charset="UTF-8"></head><body>';
        echo '<table border="1" cellpadding="6" cellspacing="0">';
        echo '<tr style="background:#e8f7ef;font-weight:bold;">';
        echo '<th>Tanggal</th>';
        echo '<th>Nama Pemilik</th>';
        echo '<th>Nama Kucing</th>';
        echo '<th>Umur Kucing</th>';
        echo '<th>Jenis Kelamin</th>';
        echo '<th>Berat Badan</th>';
        echo '<th>Ras Kucing</th>';
        echo '<th>Alamat</th>';
        echo '<th>No Telepon</th>';
        echo '<th>Hasil Diagnosis</th>';
        echo '<th>Jenis</th>';
        echo '</tr>';

        foreach ($rows as $row) {
            echo '<tr>';
            echo '<td>' . e(optional($row->created_at)->format('d-m-Y H:i')) . '</td>';
            echo '<td>' . e($row->nama_pemilik ?? '-') . '</td>';
            echo '<td>' . e($row->nama_kucing ?? '-') . '</td>';
            echo '<td>' . e($row->umur_kucing ?? '-') . '</td>';
            echo '<td>' . e($row->jenis_kelamin ?? '-') . '</td>';
            echo '<td>' . e($row->berat_badan ?? '-') . '</td>';
            echo '<td>' . e($row->ras_kucing ?? '-') . '</td>';
            echo '<td>' . e($row->alamat ?? '-') . '</td>';
            echo '<td style="mso-number-format:\'\\@\';">' . e($row->no_telepon ?? '-') . '</td>';
            echo '<td>' . e($row->hasil_diagnosis ?? '-') . '</td>';
            echo '<td>' . e($row->jenis ?? '-') . '</td>';
            echo '</tr>';
        }

        echo '</table></body></html>';
    }, $filename, $headers);
}

public function diseaseSettings()
{
    $existing = $this->loadDiseaseExplanations();
    $diseasesFromData = Biodata::query()
        ->whereNotNull('hasil_diagnosis')
        ->where('hasil_diagnosis', '!=', '')
        ->pluck('hasil_diagnosis')
        ->map(fn ($d) => trim((string) $d))
        ->filter()
        ->unique()
        ->values()
        ->all();

    $diseases = collect(array_merge($diseasesFromData, array_keys($existing)))
        ->map(fn ($d) => trim((string) $d))
        ->filter()
        ->unique()
        ->sort()
        ->values()
        ->all();

    return view('admin.disease-settings', [
        'diseases' => $diseases,
        'descriptions' => $existing,
    ]);
}

public function saveDiseaseSettings(Request $request)
{
    $items = $request->input('descriptions', []);
    $normalized = [];

    if (is_array($items)) {
        foreach ($items as $name => $description) {
            $diseaseName = trim((string) $name);
            if ($diseaseName === '') {
                continue;
            }

            $desc = trim((string) $description);
            if ($desc === '') {
                continue;
            }

            $normalized[$diseaseName] = $desc;
        }
    }

    $path = $this->diseaseExplanationPath();
    $dir = dirname($path);
    if (!is_dir($dir)) {
        File::makeDirectory($dir, 0755, true);
    }

    file_put_contents(
        $path,
        json_encode($normalized, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)
    );

    return redirect()
        ->route('admin.disease.settings')
        ->with('success', 'Penjelasan penyakit berhasil disimpan.');
}

private function diseaseExplanationPath(): string
{
    return storage_path('app/disease_explanations.json');
}

private function loadDiseaseExplanations(): array
{
    $path = $this->diseaseExplanationPath();
    if (!file_exists($path)) {
        return [];
    }

    $decoded = json_decode((string) file_get_contents($path), true);
    return is_array($decoded) ? $decoded : [];
}

public function faqSettings()
{
    return view('admin.faq-settings', [
        'faqs' => $this->loadFaqItems(),
    ]);
}

public function saveFaqSettings(Request $request)
{
    $questions = $request->input('questions', []);
    $answers = $request->input('answers', []);

    $faqs = [];
    if (is_array($questions) && is_array($answers)) {
        $count = max(count($questions), count($answers));
        for ($i = 0; $i < $count; $i++) {
            $q = trim((string)($questions[$i] ?? ''));
            $a = trim((string)($answers[$i] ?? ''));
            if ($q === '' || $a === '') {
                continue;
            }
            $faqs[] = [
                'question' => $q,
                'answer' => $a,
            ];
        }
    }

    $path = $this->faqPath();
    $dir = dirname($path);
    if (!is_dir($dir)) {
        File::makeDirectory($dir, 0755, true);
    }

    file_put_contents(
        $path,
        json_encode($faqs, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)
    );

    return redirect()->route('admin.faq.settings')->with('success', 'FAQ berhasil disimpan.');
}

public function faqPage()
{
    return view('faq', [
        'faqs' => $this->loadFaqItems(),
    ]);
}

public function trainingDataSettings()
{
    $featureCols = $this->loadFeatureCols();
    $items = collect($this->loadTrainingItems())
        ->map(fn ($item) => $this->normalizeTrainingItem($item, $featureCols))
        ->values()
        ->all();

    return view('admin.training-data-settings', [
        'items' => $items,
        'featureCols' => $featureCols,
        'featureCount' => count($featureCols),
    ]);
}

public function saveTrainingDataSettings(Request $request)
{
    $ids = $request->input('id', []);
    $diseases = $request->input('disease', []);
    $categories = $request->input('category', []);
    $featureCols = $this->loadFeatureCols();
    $existingById = collect($this->loadTrainingItems())
        ->keyBy(fn ($it) => (string)($it['id'] ?? ''));

    $items = [];
    $count = max(count($ids), count($diseases), count($categories));
    for ($i = 0; $i < $count; $i++) {
        $id = trim((string)($ids[$i] ?? ''));
        $disease = trim((string)($diseases[$i] ?? ''));
        $category = trim((string)($categories[$i] ?? ''));

        if ($disease === '' && $category === '') {
            continue;
        }

        $existing = $id !== '' ? ($existingById->get($id) ?? []) : [];
        if ($id === '') {
            $id = (string) Str::uuid();
        }
        $samples = is_array($existing['symptom_samples'] ?? null) ? $existing['symptom_samples'] : [];
        $samples = $this->normalizeSymptomSamples($samples, $featureCols);
        $filledSamples = $this->countFilledSamples($samples, $featureCols);

        $items[] = [
            'id' => $id,
            'disease' => $disease,
            'category' => $category,
            'symptom_samples' => $samples,
            'samples' => $filledSamples,
            'status' => $filledSamples >= 10 ? 'ready-train' : 'need-samples',
            'updated_at' => now()->toDateTimeString(),
        ];
    }

    $path = $this->trainingItemsPath();
    $dir = dirname($path);
    if (!is_dir($dir)) {
        File::makeDirectory($dir, 0755, true);
    }
    file_put_contents(
        $path,
        json_encode($items, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)
    );

    return redirect()->route('admin.training.settings')->with('success', 'Data calon training berhasil disimpan.');
}

public function editTrainingSymptoms(string $id)
{
    $featureCols = $this->loadFeatureCols();
    $items = collect($this->loadTrainingItems())
        ->map(fn ($item) => $this->normalizeTrainingItem($item, $featureCols));
    $item = $items->first(fn ($it) => (string)($it['id'] ?? '') === $id);

    if (!$item) {
        return redirect()->route('admin.training.settings')->with('error', 'Data penyakit tidak ditemukan.');
    }

    return view('admin.training-symptoms-settings', [
        'item' => $item,
        'featureCols' => $featureCols,
    ]);
}

public function saveTrainingSymptoms(Request $request, string $id)
{
    $featureCols = $this->loadFeatureCols();
    $all = collect($this->loadTrainingItems())
        ->map(fn ($item) => $this->normalizeTrainingItem($item, $featureCols))
        ->values();

    $idx = $all->search(fn ($it) => (string)($it['id'] ?? '') === $id);
    if ($idx === false) {
        return redirect()->route('admin.training.settings')->with('error', 'Data penyakit tidak ditemukan.');
    }

    $rowsInput = $request->input('sample_rows', []);
    $samples = [];
    for ($r = 0; $r < 10; $r++) {
        $row = (isset($rowsInput[$r]) && is_array($rowsInput[$r])) ? $rowsInput[$r] : [];
        $sample = [];
        foreach ($featureCols as $col) {
            $sample[$col] = isset($row[$col]) && (string)$row[$col] === '1' ? 'Ya' : 'Tidak';
        }
        $samples[] = $sample;
    }

    $item = $all[$idx];
    $filled = $this->countFilledSamples($samples, $featureCols);
    $item['symptom_samples'] = $samples;
    $item['samples'] = $filled;
    $item['status'] = $filled >= 10 ? 'ready-train' : 'need-samples';
    $item['updated_at'] = now()->toDateTimeString();
    $all[$idx] = $item;

    $this->storeTrainingItems($all->all());

    return redirect()->route('admin.training.settings')->with('success', 'Data gejala per sample berhasil disimpan.');
}

public function downloadTrainingData()
{
    $featureCols = $this->loadFeatureCols();
    $items = collect($this->loadTrainingItems())
        ->map(fn ($item) => $this->normalizeTrainingItem($item, $featureCols))
        ->values()
        ->all();

    $filename = 'data-calon-training-pawmedic-' . now()->format('Ymd-His') . '.xls';
    $headers = [
        'Content-Type' => 'application/vnd.ms-excel; charset=UTF-8',
        'Content-Disposition' => 'attachment; filename="' . $filename . '"',
    ];

    return response()->streamDownload(function () use ($items, $featureCols) {
        echo '<html><head><meta charset="UTF-8"></head><body>';
        echo '<table border="1" cellpadding="6" cellspacing="0">';
        echo '<tr style="background:#e8f7ef;font-weight:bold;">';
        echo '<th>No</th><th>Penyakit</th><th>Golongan</th><th>Sample Ke</th>';
        foreach ($featureCols as $col) {
            echo '<th>' . e($col) . '</th>';
        }
        echo '</tr>';

        $no = 1;
        foreach ($items as $item) {
            $sampleRows = $this->normalizeSymptomSamples($item['symptom_samples'] ?? [], $featureCols);
            foreach ($sampleRows as $sampleIndex => $flags) {
                echo '<tr>';
                echo '<td>' . $no++ . '</td>';
                echo '<td>' . e((string)($item['disease'] ?? '')) . '</td>';
                echo '<td>' . e((string)($item['category'] ?? '')) . '</td>';
                echo '<td>' . e((string)($sampleIndex + 1)) . '</td>';
                foreach ($featureCols as $col) {
                    $v = (string)($flags[$col] ?? 'Tidak');
                    echo '<td>' . e(strcasecmp($v, 'Ya') === 0 ? 'Ya' : 'Tidak') . '</td>';
                }
                echo '</tr>';
            }
        }
        echo '</table></body></html>';
    }, $filename, $headers);
}

private function trainingItemsPath(): string
{
    return storage_path('app/training_items.json');
}

private function loadTrainingItems(): array
{
    $path = $this->trainingItemsPath();
    if (!file_exists($path)) {
        return [];
    }
    $decoded = json_decode((string) file_get_contents($path), true);
    return is_array($decoded) ? $decoded : [];
}

private function storeTrainingItems(array $items): void
{
    $path = $this->trainingItemsPath();
    $dir = dirname($path);
    if (!is_dir($dir)) {
        File::makeDirectory($dir, 0755, true);
    }
    file_put_contents(
        $path,
        json_encode($items, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)
    );
}

private function normalizeTrainingItem($item, array $featureCols): array
{
    $base = is_array($item) ? $item : [];
    $id = trim((string)($base['id'] ?? ''));
    if ($id === '') {
        $id = (string) Str::uuid();
    }

    $samples = $this->normalizeSymptomSamples($base['symptom_samples'] ?? [], $featureCols);
    $filled = $this->countFilledSamples($samples, $featureCols);
    $status = $filled >= 10 ? 'ready-train' : 'need-samples';

    // Migrasi data lama (symptom_flags tunggal) ke baris sample pertama.
    $legacyFlags = is_array($base['symptom_flags'] ?? null) ? $base['symptom_flags'] : [];
    if (!empty($legacyFlags) && $filled === 0) {
        $first = [];
        foreach ($featureCols as $col) {
            $v = (string)($legacyFlags[$col] ?? 'Tidak');
            $first[$col] = strcasecmp($v, 'Ya') === 0 ? 'Ya' : 'Tidak';
        }
        $samples[0] = $first;
        $filled = $this->countFilledSamples($samples, $featureCols);
        $status = $filled >= 10 ? 'ready-train' : 'need-samples';
    }

    return array_merge($base, [
        'id' => $id,
        'symptom_samples' => $samples,
        'samples' => $filled,
        'status' => $status,
    ]);
}

private function normalizeSymptomSamples($rows, array $featureCols): array
{
    $list = is_array($rows) ? array_values($rows) : [];
    $normalized = [];

    for ($r = 0; $r < 10; $r++) {
        $row = (isset($list[$r]) && is_array($list[$r])) ? $list[$r] : [];
        $sample = [];
        foreach ($featureCols as $col) {
            $v = (string)($row[$col] ?? 'Tidak');
            $sample[$col] = strcasecmp($v, 'Ya') === 0 ? 'Ya' : 'Tidak';
        }
        $normalized[] = $sample;
    }

    return $normalized;
}

private function countFilledSamples(array $samples, array $featureCols): int
{
    $count = 0;
    foreach ($samples as $row) {
        $hasYes = false;
        foreach ($featureCols as $col) {
            if (strcasecmp((string)($row[$col] ?? 'Tidak'), 'Ya') === 0) {
                $hasYes = true;
                break;
            }
        }
        if ($hasYes) {
            $count++;
        }
    }
    return $count;
}

public function downloadTrainingTemplate()
{
    $featureCols = $this->loadFeatureCols();
    $filename = 'template-training-pawmedic-' . now()->format('Ymd-His') . '.csv';

    $headers = [
        'Content-Type' => 'text/csv; charset=UTF-8',
        'Content-Disposition' => 'attachment; filename="' . $filename . '"',
    ];

    return response()->streamDownload(function () use ($featureCols) {
        $handle = fopen('php://output', 'w');
        fwrite($handle, chr(0xEF) . chr(0xBB) . chr(0xBF));

        $cols = array_values(array_filter($featureCols, fn($c) => trim((string)$c) !== ''));
        $header = array_merge($cols, ['Golongan', 'Penyakit']);
        fputcsv($handle, $header, ';');

        // Dua baris contoh isi sebagai panduan format ya/tidak.
        $rowYa = array_fill(0, count($cols), 'Ya');
        $rowTidak = array_fill(0, count($cols), 'Tidak');
        fputcsv($handle, array_merge($rowYa, ['ContohKategori', 'Contoh Penyakit A']), ';');
        fputcsv($handle, array_merge($rowTidak, ['ContohKategori', 'Contoh Penyakit B']), ';');

        fclose($handle);
    }, $filename, $headers);
}

private function loadFeatureCols(): array
{
    $path = base_path('python_artifacts/feature_cols.json');
    if (!file_exists($path)) {
        return [];
    }

    $decoded = json_decode((string) file_get_contents($path), true);
    if (!is_array($decoded)) {
        return [];
    }

    return array_values(array_filter($decoded, function ($col) {
        $name = trim((string)$col);
        if ($name === '') return false;
        if (stripos($name, 'Unnamed:') === 0) return false;
        return true;
    }));
}

private function faqPath(): string
{
    return storage_path('app/faqs.json');
}

private function defaultFaqItems(): array
{
    return [
        [
            'question' => 'Apa itu PawMedic?',
            'answer' => 'PawMedic adalah aplikasi sistem pakar yang membantu pemilik kucing memahami gejala dan mendapatkan rekomendasi perawatan awal. Aplikasi ini menggunakan metode sistem pakar untuk menganalisis gejala yang dipilih dan memberikan diagnosis kemungkinan penyakit.',
        ],
        [
            'question' => 'Bagaimana cara menggunakan PawMedic?',
            'answer' => "Cara menggunakan PawMedic sangat mudah:\n1. Isi biodata kucing Anda\n2. Pilih gejala yang Anda amati pada kucing\n3. Sistem akan menganalisis dan memberikan hasil diagnosis\n4. Baca rekomendasi perawatan yang diberikan",
        ],
        [
            'question' => 'Apakah hasil diagnosis akurat?',
            'answer' => 'Hasil diagnosis dari PawMedic adalah sebagai panduan awal berdasarkan gejala yang Anda pilih. Untuk diagnosis yang akurat dan penanganan yang tepat, sangat disarankan untuk berkonsultasi langsung dengan dokter hewan profesional. PawMedic tidak menggantikan konsultasi medis profesional.',
        ],
        [
            'question' => 'Apakah data saya aman?',
            'answer' => 'Ya, data yang Anda masukkan hanya digunakan untuk keperluan diagnosis dan tidak dibagikan kepada pihak ketiga.',
        ],
        [
            'question' => 'Berapa banyak gejala yang harus dipilih?',
            'answer' => 'Pilih gejala yang benar-benar Anda amati. Semakin relevan gejala yang dipilih, semakin baik hasil analisis.',
        ],
    ];
}

private function loadFaqItems(): array
{
    $path = $this->faqPath();
    if (!file_exists($path)) {
        return $this->defaultFaqItems();
    }

    $decoded = json_decode((string) file_get_contents($path), true);
    if (!is_array($decoded) || empty($decoded)) {
        return $this->defaultFaqItems();
    }

    $faqs = [];
    foreach ($decoded as $item) {
        $q = trim((string)($item['question'] ?? ''));
        $a = trim((string)($item['answer'] ?? ''));
        if ($q === '' || $a === '') {
            continue;
        }
        $faqs[] = ['question' => $q, 'answer' => $a];
    }

    return !empty($faqs) ? $faqs : $this->defaultFaqItems();
}
}
