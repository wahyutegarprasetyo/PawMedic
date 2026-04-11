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

    // total user
    $totalUsers = Biodata::count();

    // user list
  $sort = request('sort');

if ($sort == 'oldest') {
    $data = Biodata::orderBy('created_at', 'asc')->get();
} else {
    $data = Biodata::orderBy('created_at', 'desc')->get();
}

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

    return view('admin.dashboard', compact('stats', 'data'));
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
}
