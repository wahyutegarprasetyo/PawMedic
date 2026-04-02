<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
        if (!Auth::check()) {
            return redirect()->route('admin.login');
        }

        // Get statistics
        $stats = $this->getStatistics();
        
        return view('admin.dashboard', [
            'stats' => $stats
        ]);
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
