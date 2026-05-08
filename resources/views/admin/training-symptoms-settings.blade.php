<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Atur Gejala Sample - PawMedic Admin</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700;800&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
<style>
body{margin:0;font-family:'Inter',sans-serif;background:#f4faf7;color:#1f2937}
.container{max-width:98vw;margin:0 auto;padding:24px 14px}
.head{display:flex;justify-content:space-between;align-items:center;gap:12px;margin-bottom:14px}
.title{font-family:'Poppins',sans-serif;font-size:28px;margin:0;color:#114d3a}
.sub{color:#64748b;margin-top:4px}
.card{background:#fff;border:1px solid #d1fae5;border-radius:16px;padding:14px;box-shadow:0 8px 20px rgba(17,77,58,.08)}
.notice{background:#e8f7ef;border:1px solid #b7ebcf;padding:10px;border-radius:10px;color:#114d3a;margin-bottom:10px}
.btn{padding:10px 14px;border-radius:10px;border:1px solid #6fcf97;background:#6fcf97;color:#fff;font-weight:700;cursor:pointer;text-decoration:none}
.btn.secondary{background:#fff;color:#114d3a}
.table-wrap{overflow:auto;border:1px solid #e2e8f0;border-radius:10px}
table{width:100%;border-collapse:collapse}
th,td{padding:8px;border-bottom:1px solid #e2e8f0;vertical-align:middle}
th{background:#e8f7ef;text-align:center;font-size:12px}
td{text-align:center}
.sample-col{min-width:86px;font-weight:700;color:#14532d}
.gejala-col{min-width:115px}
.actions{display:flex;justify-content:space-between;align-items:center;gap:10px;margin-top:12px}
</style>
</head>
<body>
<div class="container">
    <div class="head">
        <div>
            <h1 class="title">Atur Gejala: {{ $item['disease'] ?? '-' }}</h1>
            <div class="sub">Kategori: {{ $item['category'] ?? '-' }} | Isi 10 baris sample</div>
        </div>
        <a href="{{ route('admin.training.settings') }}" class="btn secondary">← Kembali</a>
    </div>

    <div class="card">
        <div class="notice">Centang gejala yang bernilai <strong>Ya</strong>. Tidak dicentang berarti <strong>Tidak</strong>.</div>
        <form method="POST" action="{{ route('admin.training.symptoms.save', $item['id']) }}">
            @csrf
            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th class="sample-col">Sample</th>
                            @foreach($featureCols as $col)
                                <th class="gejala-col">{{ $col }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                    @for($r = 0; $r < 10; $r++)
                        <tr>
                            <td class="sample-col">{{ $r + 1 }}</td>
                            @foreach($featureCols as $col)
                                @php
                                    $isYes = strcasecmp((string)($item['symptom_samples'][$r][$col] ?? 'Tidak'), 'Ya') === 0;
                                @endphp
                                <td>
                                    <input type="checkbox" name="sample_rows[{{ $r }}][{{ $col }}]" value="1" {{ $isYes ? 'checked' : '' }}>
                                </td>
                            @endforeach
                        </tr>
                    @endfor
                    </tbody>
                </table>
            </div>
            <div class="actions">
                <a href="{{ route('admin.training.settings') }}" class="btn secondary">Kembali</a>
                <button type="submit" class="btn">Simpan Data</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>
