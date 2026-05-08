<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Biodata;
class DiagnosisController extends Controller
{
    public function prosesDiagnosis(Request $request)
    {
        $rawInput = $request->input('gejala', []);
        $input = $rawInput;
        if (is_string($rawInput)) {
            $decoded = json_decode($rawInput, true);
            if (is_array($decoded)) {
                $input = $decoded;
            } else {
                $input = array_filter(array_map('trim', explode(',', $rawInput)));
            }
        }
        if (!is_array($input)) {
            $input = [];
        }

        // validasi minimal 3 gejala
        if (count($input) < 3) {
            return redirect()->route('gejala')
                ->with('error', 'Pilih minimal 3 gejala!');
        }

        $inputNama = $input;

        // ambil fitur dari Python
        $response = Http::get(env('API_MODEL') . '/gejala');

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
        $response = Http::post(env('API_MODEL') . '/predict', $fiturAssoc);

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
        'jenis' => $diagnosis['kategori'],
        'gejala_dipilih' => json_encode(array_values($inputNama), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),
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
        $diagnosis = session('diagnosis', []);
        $diseaseName = trim((string)($diagnosis['nama'] ?? ''));
        $description = $this->getDiseaseDescription($diseaseName);
        $history = collect();

        $biodataId = session('biodata_id');
        if ($biodataId) {
            $current = Biodata::find($biodataId);
            $phone = trim((string)($current->no_telepon ?? ''));
            if ($phone !== '') {
                $history = Biodata::query()
                    ->where('no_telepon', $phone)
                    ->whereNotNull('hasil_diagnosis')
                    ->orderByDesc('created_at')
                    ->take(10)
                    ->get(['nama_kucing', 'hasil_diagnosis', 'created_at']);
            }
        }

        return view('hasil-diagnosis', [
            'diseaseDescription' => $description,
            'diagnosisHistory' => $history,
        ]);
    }

    public function downloadPdf()
    {
        $diagnosis = session('diagnosis', []);
        $gejala = session('gejala', []);
        $diseaseName = trim((string)($diagnosis['nama'] ?? ''));
        $description = $this->getDiseaseDescription($diseaseName);
        $generatedAt = now()->format('d M Y H:i');

        $pdf = Pdf::loadView('pdf.hasil-diagnosis-pdf', [
            'diagnosis' => $diagnosis,
            'gejala' => is_array($gejala) ? $gejala : [],
            'diseaseDescription' => $description,
            'generatedAt' => $generatedAt,
        ])->setPaper('a4', 'portrait');

        $filename = 'hasil-diagnosis-pawmedic-' . now()->format('Ymd-His') . '.pdf';
        return $pdf->download($filename);
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

    private function getDiseaseDescription(string $diseaseName): string
    {
        if ($diseaseName === '') {
            return '';
        }

        $path = storage_path('app/disease_explanations.json');
        if (!file_exists($path)) {
            return '';
        }

        $decoded = json_decode((string)file_get_contents($path), true);
        if (!is_array($decoded)) {
            return '';
        }

        foreach ($decoded as $name => $description) {
            if (trim((string)$name) === $diseaseName) {
                return trim((string)$description);
            }
        }

        return '';
    }
}