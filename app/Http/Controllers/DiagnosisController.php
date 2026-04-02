<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DiagnosisController extends Controller
{
    public function prosesDiagnosis(Request $request)
    {
        $input = $request->input('gejala', []);

        // validasi minimal 3 gejala
        if (count($input) < 3) {
            return redirect()->route('gejala')
                ->with('error', 'Pilih minimal 3 gejala!');
        }

        $inputNama = $input;

        // ambil fitur dari Python
        $response = Http::get('http://127.0.0.1:5000/gejala');

        if (!$response->successful()) {
            return redirect()->route('gejala')
                ->with('error', 'Tidak bisa mengambil data gejala dari API');
        }

        $featureCols = $response->json();

        // ubah ke format 1/0
        $fiturAssoc = [];

        foreach ($featureCols as $col) {
            $fiturAssoc[$col] = in_array(trim($col), array_map('trim', $inputNama)) ? 1 : 0;
        }

        // kirim ke Python API
        $response = Http::post('http://127.0.0.1:5000/predict', $fiturAssoc);

        if (!$response->successful()) {
            return redirect()->route('gejala')
                ->with('error', 'Server AI tidak merespon!');
        }

        $data = $response->json();

        // 🔥 ambil semua hasil dari Python
        $diagnosis = [
            'nama' => $data['penyakit'] ?? '-',
            'kategori' => $data['jenis'] ?? '-',
            'pertolongan' => $data['pertolongan'] ?? [],
            'pencegahan' => $data['pencegahan'] ?? [],
        ];

        return redirect()->route('hasil-diagnosis')
            ->with('diagnosis', $diagnosis)
            ->with('gejala', $inputNama);
    }

    // 🔥 halaman hasil
    public function hasil()
    {
        return view('hasil-diagnosis');
    }
}