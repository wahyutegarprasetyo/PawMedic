<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Biodata;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use App\Models\Ulasan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
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

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            
            return redirect()->intended(route('admin.dashboard'));
        }

        return back()->withErrors([
            'email' => 'Email atau password tidak valid.',
        ])->onlyInput('email');
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

    // 🔥 7 hari terakhir
    $period = CarbonPeriod::create(Carbon::now()->subDays(6), Carbon::now());

    $dailyLabels = [];
    $dailyData = [];

    foreach ($period as $date) {
        $count = Biodata::whereDate('created_at', $date)->count();

        $dailyLabels[] = $date->format('d M');
        $dailyData[] = $count;
    }

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
        'daily_labels' => $dailyLabels,
        'daily_data' => $dailyData
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
