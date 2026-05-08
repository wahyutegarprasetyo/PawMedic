<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Hasil Diagnosis PawMedic</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; color: #1f2937; line-height: 1.5; }
        .header { margin-bottom: 16px; border-bottom: 2px solid #16a34a; padding-bottom: 8px; }
        .title { font-size: 22px; font-weight: 700; color: #065f46; margin: 0; }
        .muted { color: #4b5563; font-size: 11px; margin-top: 4px; }
        .box { border: 1px solid #d1d5db; border-radius: 6px; padding: 10px; margin-bottom: 10px; }
        .box h3 { margin: 0 0 8px 0; font-size: 14px; color: #065f46; }
        ul { margin: 0; padding-left: 18px; }
        li { margin: 3px 0; }
    </style>
</head>
<body>
    <div class="header">
        <h1 class="title">Hasil Diagnosis PawMedic</h1>
        <div class="muted">Dibuat pada: {{ $generatedAt }}</div>
    </div>

    <div class="box">
        <h3>Ringkasan Diagnosis</h3>
        <div><strong>Penyakit:</strong> {{ $diagnosis['nama'] ?? '-' }}</div>
        <div><strong>Jenis:</strong> {{ $diagnosis['kategori'] ?? '-' }}</div>
        @if(!empty($diseaseDescription))
            <div style="margin-top:6px;"><strong>Penjelasan:</strong> {{ $diseaseDescription }}</div>
        @endif
    </div>

    <div class="box">
        <h3>Gejala Dipilih</h3>
        @if(!empty($gejala))
            <ul>
                @foreach($gejala as $item)
                    <li>{{ $item }}</li>
                @endforeach
            </ul>
        @else
            <div>-</div>
        @endif
    </div>

    <div class="box">
        <h3>Rekomendasi Perawatan</h3>
        @if(!empty($diagnosis['pertolongan']) && is_array($diagnosis['pertolongan']))
            <ul>
                @foreach($diagnosis['pertolongan'] as $item)
                    <li>{{ $item }}</li>
                @endforeach
            </ul>
        @else
            <div>-</div>
        @endif
    </div>

    <div class="box">
        <h3>Pencegahan</h3>
        @if(!empty($diagnosis['pencegahan']) && is_array($diagnosis['pencegahan']))
            <ul>
                @foreach($diagnosis['pencegahan'] as $item)
                    <li>{{ $item }}</li>
                @endforeach
            </ul>
        @else
            <div>-</div>
        @endif
    </div>
</body>
</html>
