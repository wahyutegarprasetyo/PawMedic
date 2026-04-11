<?php

namespace App\Http\Controllers;

use App\Models\Ulasan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UlasanController extends Controller
{
    public function index()
    {
        $ulasan = Ulasan::latest()->get();
        // 🔥 TOTAL ULASAN
    $total = $ulasan->count();
    // 🔥 RATING RATA-RATA
    $avg = $ulasan->avg('rating') ?? 0;
    // 🔥 5 BINTANG %
    $fiveStar = $ulasan->where('rating', 5)->count();
    $fivePercent = $total > 0 ? round(($fiveStar / $total) * 100) : 0;

    return view('ulasan', compact('ulasan', 'total', 'avg', 'fivePercent'));
    }

    public function store(Request $request)
    {
        Ulasan::create($request->all());

        return redirect()->back()->with('success', 'Ulasan berhasil dikirim!');
    }
    public function destroy($id)
    {
        if (!Auth::check() || Auth::user()->email !== 'admin@pawmedic.app') {
            abort(403);
        }
    
        $ulasan = Ulasan::findOrFail($id);
        $ulasan->delete();
    
        return redirect()->back()->with('success', 'Ulasan berhasil dihapus');
    }
}

