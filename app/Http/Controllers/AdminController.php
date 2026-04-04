<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Biodata;
use Carbon\Carbon;

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

    // total user
    $totalUsers = Biodata::count();

    // penyakit paling umum
    $mostCommon = Biodata::select('hasil_diagnosis')
        ->whereNotNull('hasil_diagnosis')
        ->groupBy('hasil_diagnosis')
        ->orderByRaw('COUNT(*) DESC')
        ->value('hasil_diagnosis');

    // diagnosis terbaru
    $recent = Biodata::select('hasil_diagnosis', 'created_at')
        ->latest()
        ->take(5)
        ->get();

    // format tabel
    $recentFormatted = $recent->map(function ($item) {
        return [
            'date' => $item->created_at,
            'disease' => $item->hasil_diagnosis,
            'count' => 1
        ];
    });

    // 🔥 CHART (HARUS DI LUAR MAP)
    $diseaseStats = Biodata::select('hasil_diagnosis')
        ->whereNotNull('hasil_diagnosis')
        ->get()
        ->groupBy('hasil_diagnosis')
        ->map(function ($item) {
            return count($item);
        });

    $chartLabels = $diseaseStats->keys()->values();
    $chartData = $diseaseStats->values();

    // kirim ke blade
    $stats = [
        'total_diagnosis' => $totalDiagnosis,
        'today_diagnosis' => $todayDiagnosis,
        'total_users' => $totalUsers,
        'most_common_disease' => $mostCommon,
        'recent_diagnosis' => $recentFormatted,
        'chart_labels' => $chartLabels,
        'chart_data' => $chartData
    ];

    return view('admin.dashboard', compact('stats'));
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
}
