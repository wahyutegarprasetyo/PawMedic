<?php

namespace App\Http\Controllers;

use App\Models\Ulasan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UlasanController extends Controller
{
    public function index()
    {
        $query = Ulasan::query()->latest();
        $isAdmin = Auth::check() && Auth::user()->email === 'admin@pawmedic.app';
        if (!$isAdmin) {
            $query->where('is_hidden', false);
        }
        $ulasan = $query->get();
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

    public function toggleHide($id)
    {
        if (!Auth::check() || Auth::user()->email !== 'admin@pawmedic.app') {
            abort(403);
        }

        $ulasan = Ulasan::findOrFail($id);
        $ulasan->is_hidden = !$ulasan->is_hidden;
        $ulasan->save();

        return redirect()->back()->with(
            'success',
            $ulasan->is_hidden ? 'Ulasan disembunyikan.' : 'Ulasan ditampilkan kembali.'
        );
    }
}

