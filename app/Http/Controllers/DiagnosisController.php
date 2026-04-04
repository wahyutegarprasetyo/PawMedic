<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Biodata;
class DiagnosisController extends Controller
{
    public function prosesDiagnosis(Request $request)
    {
        $input = $request->input('gejala', []);

        // validasi minimal 3 gejala
        if (count($input) < 3) {
            return redirect()->route('gejala')
                ->with('error', 'Pilih minimal 5 dan maksimal 7 gejala!');
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

$biodataId = session('biodata_id');
if ($biodataId) {
    \App\Models\Biodata::where('id', $biodataId)->update([
        'hasil_diagnosis' => $diagnosis['nama'],
        'jenis' => $diagnosis['kategori']
    ]);
}

return redirect()->route('hasil-diagnosis')
->with('diagnosis', $diagnosis)
->with('gejala', $inputNama);
$biodataId = session('biodata_id');
    }

    // 🔥 halaman hasil
    public function hasil()
    {
        return view('hasil-diagnosis');
    }

    public function simpanBiodata(Request $request)
    {
        $request->validate([
            'nama_pemilik' => 'required',
            'nama_kucing' => 'required',
            'umur_kucing' => 'required|numeric',
            'jenis_kelamin' => 'required',
            'berat_badan' => 'required|numeric',
        ]);
    
        $data = \App\Models\Biodata::create([
            'nama_pemilik' => $request->nama_pemilik,
            'nama_kucing' => $request->nama_kucing,
            'umur_kucing' => $request->umur_kucing,
            'jenis_kelamin' => $request->jenis_kelamin,
            'berat_badan' => $request->berat_badan,
            'ras_kucing' => $request->ras_kucing,
            'alamat' => $request->alamat,
            'no_telepon' => $request->no_telepon,
        ]);
    
        session(['biodata_id' => $data->id]);
    
        return redirect()->route('gejala');
    }
}