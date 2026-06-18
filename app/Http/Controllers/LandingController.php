<?php

namespace App\Http\Controllers;

use App\Models\Biodata;
use App\Models\Ulasan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use ZipArchive;

class LandingController extends Controller
{
    public function index(Request $request)
    {
        $ulasan = Schema::hasTable('ulasans')
            ? Ulasan::where('is_hidden', false)->latest()->take(3)->get()
            : collect();
        $range = $request->query('range') === 'week' ? 'week' : 'month';

        return view('landing', [
            'ulasan' => $ulasan,
            'diseaseNews' => $this->buildDiseaseNews($range),
        ]);
    }

    private function buildDiseaseNews(string $range): array
    {
        $startDate = $range === 'week'
            ? Carbon::now()->subDays(6)->startOfDay()
            : Carbon::now()->subDays(29)->startOfDay();

        $periodLabel = $range === 'week' ? '7 hari terakhir' : '30 hari terakhir';

        if (!Schema::hasTable('biodata')) {
            return $this->emptyDiseaseNews($range, $periodLabel, $startDate);
        }

        $diseaseStats = Biodata::query()
            ->select('hasil_diagnosis', DB::raw('COUNT(*) as total'))
            ->whereNotNull('hasil_diagnosis')
            ->where('hasil_diagnosis', '!=', '')
            ->where('created_at', '>=', $startDate)
            ->groupBy('hasil_diagnosis')
            ->orderByDesc('total')
            ->limit(3)
            ->get();

        $topDisease = trim((string) ($diseaseStats->first()->hasil_diagnosis ?? ''));

        $areaStats = collect();
        $areaStatsByDisease = [];
        if ($topDisease !== '') {
            $areaStats = Biodata::query()
                ->where('hasil_diagnosis', $topDisease)
                ->where('created_at', '>=', $startDate)
                ->get(['alamat'])
                ->map(fn ($item) => $this->extractArea((string) ($item->alamat ?? '')))
                ->filter()
                ->countBy()
                ->sortDesc()
                ->take(6);
        }

        foreach ($diseaseStats as $row) {
            $disease = trim((string) $row->hasil_diagnosis);
            if ($disease === '') {
                continue;
            }

            $areas = Biodata::query()
                ->where('hasil_diagnosis', $disease)
                ->where('created_at', '>=', $startDate)
                ->get(['alamat'])
                ->map(fn ($item) => $this->extractArea((string) ($item->alamat ?? '')))
                ->filter()
                ->countBy()
                ->sortDesc()
                ->take(6);

            $areaStatsByDisease[$disease] = [
                'labels' => $areas->keys()->values(),
                'data' => $areas->values()->map(fn ($n) => (int) $n)->values(),
            ];
        }

        $knowledge = $this->getDiseaseKnowledge($topDisease);

        return [
            'range' => $range,
            'period_label' => $periodLabel,
            'start_label' => $this->formatDateLabel($startDate),
            'end_label' => $this->formatDateLabel(Carbon::now()),
            'top_disease' => $topDisease,
            'total_cases' => (int) ($diseaseStats->first()->total ?? 0),
            'disease_labels' => $diseaseStats->pluck('hasil_diagnosis')->map(fn ($name) => trim((string) $name))->values(),
            'disease_data' => $diseaseStats->pluck('total')->map(fn ($n) => (int) $n)->values(),
            'area_labels' => $areaStats->keys()->values(),
            'area_data' => $areaStats->values()->map(fn ($n) => (int) $n)->values(),
            'area_by_disease' => $areaStatsByDisease,
            'handling' => $knowledge['pertolongan'] ?? [],
            'prevention' => $knowledge['pencegahan'] ?? [],
        ];
    }

    private function emptyDiseaseNews(string $range, string $periodLabel, Carbon $startDate): array
    {
        return [
            'range' => $range,
            'period_label' => $periodLabel,
            'start_label' => $this->formatDateLabel($startDate),
            'end_label' => $this->formatDateLabel(Carbon::now()),
            'top_disease' => '',
            'total_cases' => 0,
            'disease_labels' => collect(),
            'disease_data' => collect(),
            'area_labels' => collect(),
            'area_data' => collect(),
            'area_by_disease' => [],
            'handling' => [],
            'prevention' => [],
        ];
    }

    private function extractArea(string $address): string
    {
        $address = trim($address);
        if ($address === '') {
            return 'Tidak diketahui';
        }

        $parts = array_values(array_filter(array_map('trim', preg_split('/[,;-]+/', $address))));
        $selected = $parts[0] ?? $address;

        foreach ($parts as $part) {
            if (preg_match('/\b(kota|kabupaten|kec\.?|kecamatan|kel\.?|kelurahan|desa)\b/i', $part)) {
                $selected = $part;
                break;
            }
        }

        $selected = preg_replace('/\s+/', ' ', $selected);

        return mb_convert_case($selected, MB_CASE_TITLE, 'UTF-8');
    }

    private function formatDateLabel(Carbon $date): string
    {
        $months = [
            1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr', 5 => 'Mei', 6 => 'Jun',
            7 => 'Jul', 8 => 'Agu', 9 => 'Sep', 10 => 'Okt', 11 => 'Nov', 12 => 'Des',
        ];

        return $date->format('d') . ' ' . $months[(int) $date->format('n')] . ' ' . $date->format('Y');
    }

    private function getDiseaseKnowledge(string $diseaseName): array
    {
        if ($diseaseName === '') {
            return ['pertolongan' => [], 'pencegahan' => []];
        }

        $rows = $this->readXlsxRows(public_path('data/Bissmilah lagi.xlsx'));
        foreach ($rows as $row) {
            $name = trim((string) ($row['Penyakit'] ?? ''));
            if (mb_strtolower($name) !== mb_strtolower($diseaseName)) {
                continue;
            }

            return [
                'pertolongan' => $this->splitRecommendation((string) ($row['Pertolongan'] ?? '')),
                'pencegahan' => $this->splitRecommendation((string) ($row['Pencegahan'] ?? '')),
            ];
        }

        return ['pertolongan' => [], 'pencegahan' => []];
    }

    private function splitRecommendation(string $value): array
    {
        return array_values(array_filter(array_map('trim', explode(';', $value))));
    }

    private function readXlsxRows(string $path): array
    {
        if (!is_file($path) || !class_exists(ZipArchive::class)) {
            return [];
        }

        $zip = new ZipArchive();
        if ($zip->open($path) !== true) {
            return [];
        }

        $sharedStrings = [];
        $sharedXml = $zip->getFromName('xl/sharedStrings.xml');
        if ($sharedXml !== false) {
            $shared = simplexml_load_string($sharedXml);
            foreach ($shared->si ?? [] as $item) {
                $sharedStrings[] = trim((string) ($item->t ?? ''));
            }
        }

        $sheetXml = $zip->getFromName('xl/worksheets/sheet1.xml');
        $zip->close();

        if ($sheetXml === false) {
            return [];
        }

        $sheet = simplexml_load_string($sheetXml);
        $rows = [];
        foreach ($sheet->sheetData->row ?? [] as $xmlRow) {
            $cells = [];
            foreach ($xmlRow->c as $cell) {
                $ref = (string) $cell['r'];
                $column = preg_replace('/\d+/', '', $ref);
                $value = (string) ($cell->v ?? '');
                if ((string) $cell['t'] === 's') {
                    $value = $sharedStrings[(int) $value] ?? '';
                }
                $cells[$column] = trim($value);
            }
            $rows[] = $cells;
        }

        $headers = array_shift($rows) ?? [];
        return array_values(array_filter(array_map(function ($row) use ($headers) {
            $mapped = [];
            foreach ($headers as $column => $header) {
                if ($header !== '') {
                    $mapped[$header] = $row[$column] ?? '';
                }
            }
            return $mapped;
        }, $rows)));
    }
}
