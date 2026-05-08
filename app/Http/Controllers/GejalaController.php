<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
class GejalaController extends Controller
{
    public function index()
    {
        $response = Http::get(env('API_MODEL') . '/gejala');
        if (!$response->successful()) {
            return back()->with('error', 'Tidak bisa mengambil data gejala dari API');
        }
        $gejala = $response->json();
        return view('gejala', compact('gejala'));
    }
}
