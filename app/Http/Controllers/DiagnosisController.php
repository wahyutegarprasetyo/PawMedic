<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DiagnosisController extends Controller
{
    public function prosesDiagnosis(Request $request)
{
    $input = $request->input('gejala', []);

    if (count($input) < 3) {
        return redirect()->route('gejala')
            ->with('error', 'Pilih minimal 3 gejala!');
    }

    // 🔥 LANGSUNG PAKAI INPUT
    $inputNama = $input;

    // ambil feature dari Python
    $response = Http::get('http://127.0.0.1:5000/gejala');
    if (!$response->successful()) {
        return redirect()->route('gejala')
            ->with('error', 'Tidak bisa mengambil data gejala dari API');
    }

    $featureCols = $response->json();

    // bikin vector
    $fiturAssoc = [];

    foreach ($featureCols as $col) {
        $fiturAssoc[$col] = in_array(trim($col), array_map('trim', $inputNama)) ? 1 : 0;
    }

    // kirim ke Flask
    $response = Http::post('http://127.0.0.1:5000/predict', $fiturAssoc);

    if (!$response->successful()) {
        return redirect()->route('gejala')
            ->with('error', 'Server AI tidak merespon!');
    }

    $data = $response->json();

    $hasil = isset($data['hasil']) ? trim($data['hasil']) : 'Tidak diketahui';

    return redirect()->route('hasil-diagnosis')
        ->with('hasil', $hasil)
        ->with('gejala', $inputNama);
}}