<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Hasil Diagnosis - PawMedic</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700;800&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
@php
$diagnosis = session('diagnosis')?? [];
@endphp
<style>
:root{
    --ff-heading: 'Poppins', system-ui, -apple-system, 'Segoe UI', Roboto, 'Helvetica Neue', Arial;
    --ff-body: 'Inter', system-ui, -apple-system, 'Segoe UI', Roboto, 'Helvetica Neue', Arial;
    --primary: #6fcf97;
    --primary-dark: #4bb66f;
    --primary-light: #e8f7ef;
    --text-dark: #114d3a;
    --text-muted: #64748b;
    --warning: #f59e0b;
    --danger: #ef4444;
    --info: #3b82f6;
}

* {
    box-sizing: border-box;
}

body{
    margin:0;
    font-family:var(--ff-body);
    background:linear-gradient(135deg, #f0fdf4 0%, #eaf7f0 50%, #f0f9ff 100%);
    background-attachment:fixed;
    color:#333;
    -webkit-font-smoothing:antialiased;
    line-height:1.6;
    min-height:100vh;
    padding:20px;
    position:relative;
}

body::before{
    content:'';
    position:fixed;
    top:0;
    left:0;
    right:0;
    bottom:0;
    background-image:
        radial-gradient(circle at 20% 50%, rgba(111,207,151,0.12) 0%, transparent 60%),
        radial-gradient(circle at 80% 80%, rgba(111,207,151,0.08) 0%, transparent 60%);
    pointer-events:none;
    z-index:0;
}

.container{
    max-width:1000px;
    margin:0 auto;
    padding:40px 0;
    position:relative;
    z-index:1;
}

/* ===== HEADER ===== */
.header{
    text-align:center;
    margin-bottom:40px;
    animation:fadeDown 0.6s ease;
}

.logo-link{
    display:inline-flex;
    align-items:center;
    gap:10px;
    text-decoration:none;
    color:var(--text-dark);
    margin-bottom:20px;
    transition:transform 0.3s ease;
}

.logo-link:hover{
    transform:translateY(-2px);
}

.logo-icon{
    width:44px;
    height:44px;
    background:linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
    border-radius:12px;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:22px;
}

.logo-text{
    font-size:22px;
    font-weight:700;
    font-family:var(--ff-heading);
}

.header h1{
    font-family:var(--ff-heading);
    font-size:clamp(1.8rem, 4vw, 2.4rem);
    font-weight:800;
    color:var(--text-dark);
    margin:20px 0 12px;
    letter-spacing:-0.02em;
}

/* ===== RESULT CARD ===== */
.result-card{
    background:rgba(255,255,255,0.95);
    backdrop-filter:blur(20px);
    border-radius:32px;
    padding:48px;
    box-shadow:
        0 25px 80px rgba(17,77,58,0.15),
        0 0 0 1px rgba(111,207,151,0.1);
    border:1px solid rgba(111,207,151,0.2);
    margin-bottom:32px;
    animation:fadeUp 0.8s ease;
    position:relative;
    overflow:hidden;
}

.result-card::before{
    content:'';
    position:absolute;
    top:0;
    left:0;
    right:0;
    height:5px;
    background:linear-gradient(90deg, var(--primary) 0%, var(--primary-dark) 100%);
}

.result-header{
    text-align:center;
    margin-bottom:40px;
}

.result-icon{
    width:100px;
    height:100px;
    background:linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
    border-radius:50%;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:48px;
    margin:0 auto 24px;
    box-shadow:0 12px 40px rgba(111,207,151,0.3);
    animation:iconBounce 2s ease infinite;
}

@keyframes iconBounce{
    0%, 100%{transform:translateY(0) scale(1);}
    50%{transform:translateY(-10px) scale(1.05);}
}

.result-title{
    font-family:var(--ff-heading);
    font-size:28px;
    font-weight:800;
    color:var(--text-dark);
    margin-bottom:12px;
}

.result-subtitle{
    color:var(--text-muted);
    font-size:16px;
}

/* ===== DIAGNOSIS RESULT ===== */
.diagnosis-result{
    background:var(--primary-light);
    border-left:5px solid var(--primary);
    padding:24px;
    border-radius:16px;
    margin-bottom:32px;
}

.diagnosis-label{
    font-size:14px;
    font-weight:600;
    color:var(--text-muted);
    text-transform:uppercase;
    letter-spacing:0.5px;
    margin-bottom:8px;
}

.diagnosis-name{
    font-family:var(--ff-heading);
    font-size:24px;
    font-weight:700;
    color:var(--text-dark);
    margin-bottom:4px;
}

.diagnosis-category{
    font-size:15px;
    color:var(--primary-dark);
    font-weight:600;
}

.disease-explanation{
    margin-top:14px;
    background:#fff;
    border:1px solid #d1fae5;
    border-radius:12px;
    padding:14px 16px;
    color:#0f5132;
    font-size:14px;
    line-height:1.7;
}

/* ===== GEJALA LIST ===== */
.gejala-list-section{
    margin-bottom:32px;
}

.section-title{
    font-family:var(--ff-heading);
    font-size:20px;
    font-weight:700;
    color:var(--text-dark);
    margin-bottom:20px;
    display:flex;
    align-items:center;
    gap:10px;
}

.gejala-list{
    display:flex;
    flex-wrap:wrap;
    gap:12px;
}

.gejala-badge{
    background:white;
    border:2px solid var(--primary-light);
    padding:10px 18px;
    border-radius:20px;
    font-size:14px;
    font-weight:600;
    color:var(--text-dark);
    display:inline-flex;
    align-items:center;
    gap:8px;
    transition:all 0.3s ease;
}

.gejala-badge::before{
    content:'✓';
    width:20px;
    height:20px;
    background:var(--primary);
    color:white;
    border-radius:50%;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:12px;
    font-weight:bold;
}

.gejala-badge:hover{
    border-color:var(--primary);
    transform:translateY(-2px);
    box-shadow:0 4px 12px rgba(111,207,151,0.2);
}

/* ===== RECOMMENDATION ===== */
.recommendation{
    background:linear-gradient(135deg, #fff7ed 0%, #fffbeb 100%);
    border-left:5px solid var(--warning);
    padding:24px;
    border-radius:16px;
    margin-bottom:32px;
}

.recommendation-title{
    font-family:var(--ff-heading);
    font-size:18px;
    font-weight:700;
    color:var(--text-dark);
    margin-bottom:16px;
    display:flex;
    align-items:center;
    gap:10px;
}

.recommendation-list{
    list-style:none;
    padding:0;
    margin:0;
}

.recommendation-list li{
    padding:12px 0;
    padding-left:32px;
    position:relative;
    color:var(--text-dark);
    line-height:1.7;
}

.recommendation-list li::before{
    content:'→';
    position:absolute;
    left:0;
    color:var(--warning);
    font-weight:bold;
    font-size:18px;
}

/* ===== WARNING BOX ===== */
.warning-box{
    background:linear-gradient(135deg, #fef2f2 0%, #fee2e2 100%);
    border-left:5px solid var(--danger);
    padding:24px;
    border-radius:16px;
    margin-bottom:32px;
}

.warning-title{
    font-family:var(--ff-heading);
    font-size:18px;
    font-weight:700;
    color:var(--danger);
    margin-bottom:12px;
    display:flex;
    align-items:center;
    gap:10px;
}

.warning-text{
    color:var(--text-dark);
    line-height:1.7;
}

.history-section{
    margin-bottom:32px;
}

.history-table{
    width:100%;
    border-collapse:collapse;
    background:#fff;
    border:1px solid #d1fae5;
    border-radius:12px;
    overflow:hidden;
}

.history-table th,
.history-table td{
    padding:10px 12px;
    border-bottom:1px solid #e2e8f0;
    text-align:left;
    font-size:14px;
}

.history-table th{
    background:#f0fdf4;
    color:#0f5132;
}

/* ===== BUTTONS ===== */
.action-buttons{
    display:flex;
    gap:16px;
    margin-top:40px;
    flex-wrap:wrap;
}

.btn{
    flex:1;
    min-width:200px;
    padding:16px 32px;
    border:none;
    border-radius:16px;
    font-weight:600;
    font-size:16px;
    cursor:pointer;
    transition:all 0.3s ease;
    text-decoration:none;
    display:inline-flex;
    align-items:center;
    justify-content:center;
    gap:8px;
    font-family:var(--ff-body);
}

.btn-primary{
    background:linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
    color:white;
    box-shadow:0 4px 16px rgba(111,207,151,0.3);
}

.btn-primary:hover{
    transform:translateY(-3px);
    box-shadow:0 8px 24px rgba(111,207,151,0.4);
}

.btn-secondary{
    background:white;
    color:var(--primary-dark);
    border:2px solid var(--primary);
    box-shadow:0 2px 8px rgba(17,77,58,0.1);
}

.btn-secondary:hover{
    background:var(--primary-light);
    transform:translateY(-2px);
}

@keyframes fadeDown{
    from{
        opacity:0;
        transform:translateY(-20px);
    }
    to{
        opacity:1;
        transform:translateY(0);
    }
}

@keyframes fadeUp{
    from{
        opacity:0;
        transform:translateY(30px);
    }
    to{
        opacity:1;
        transform:translateY(0);
    }
}

@media(max-width:768px){
    .result-card{
        padding:32px 24px;
    }
    
    .action-buttons{
        flex-direction:column;
    }
    
    .btn{
        width:100%;
    }
}
</style>
</head>

<body>
<div class="container">
    <div class="header">
        <a href="/" class="logo-link">
            <div class="logo-icon">🐾</div>
            <div class="logo-text">PawMedic</div>
        </a>
        @php
            $breadcrumbItems = [
                ['label' => 'Beranda', 'url' => '/'],
                ['label' => 'Biodata', 'url' => route('biodata')],
                ['label' => 'Gejala', 'url' => route('gejala')],
                ['label' => 'Hasil Diagnosis', 'url' => '#']
            ];
        @endphp
        @include('components.breadcrumb', ['items' => $breadcrumbItems])
        <h1>Hasil Diagnosis</h1>
    </div>

    <div class="result-card">
        <div class="result-header">
            <div class="result-icon">🩺</div>
            <div class="result-title">Diagnosis Selesai</div>
            <div class="result-subtitle">Berikut adalah hasil analisis gejala kucing Anda</div>
        </div>

        <!-- Diagnosis Result -->
        <div class="diagnosis-result">
            <div class="diagnosis-label">Kemungkinan Penyakit</div>
            <div class="diagnosis-name">
            {{ $diagnosis['nama'] ?? 'Tidak diketahui' }}
</div>

<div class="diagnosis-category">
Jenis: {{ $diagnosis['kategori'] ?? '-' }}
</div>
@if(!empty($diseaseDescription))
<div class="disease-explanation">
    <strong>Penjelasan penyakit:</strong><br>
    {{ $diseaseDescription }}
</div>
@endif


        <!-- Gejala yang Dipilih -->
        <div class="gejala-list-section">
            <div class="section-title">
                <span>🔍 Gejala yang Dipilih</span>
            </div>
            <div class="gejala-list">
@foreach(session('gejala', []) as $g)
    <div class="gejala-badge">{{ $g }}</div>
@endforeach
</div>
        </div>

        <!-- Recommendation -->
        <div class="recommendation">
            <div class="recommendation-title">
                <span>💡 Rekomendasi Perawatan</span>
            </div>
            <ul class="recommendation-list">
            @foreach($diagnosis['pertolongan'] ?? [] as $item)
    <li>{{ $item }}</li>
@endforeach
</ul>
        </div>

        <div class="recommendation">
    <div class="recommendation-title">
        <span>🛡️ Pencegahan</span>
    </div>
    <ul class="recommendation-list">
    @foreach($diagnosis['pencegahan'] ?? [] as $item)
        <li>{{ $item }}</li>
    @endforeach
    </ul>
</div>

        <!-- Warning -->
        <div class="warning-box">
            <div class="warning-title">
                <span>⚠️ Peringatan Penting</span>
            </div>
            <div class="warning-text">
                Hasil diagnosis ini hanya sebagai panduan awal. Untuk diagnosis yang akurat dan penanganan yang tepat, 
                sangat disarankan untuk berkonsultasi langsung dengan dokter hewan profesional.
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="action-buttons">
            <a href="{{ route('gejala') }}" class="btn btn-secondary">
                ← Diagnosis Lagi
            </a>
            <button onclick="printDiagnosis()" class="btn btn-secondary">
                🖨️ Cetak Hasil
            </button>
            <button onclick="shareDiagnosis()" class="btn btn-secondary">
                📤 Bagikan
            </button>
            <a href="/" class="btn btn-primary">
                🏠 Kembali ke Beranda
            </a>
        </div>
    </div>
</div>

@if(isset($diagnosisHistory) && $diagnosisHistory->count() > 0)
<div class="result-card history-section">
    <div class="section-title">
        <span>🕘 Riwayat Diagnosis (Nomor yang sama)</span>
    </div>
    <table class="history-table">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Nama Kucing</th>
                <th>Hasil Diagnosis</th>
            </tr>
        </thead>
        <tbody>
        @foreach($diagnosisHistory as $row)
            <tr>
                <td>{{ \Carbon\Carbon::parse($row->created_at)->format('d M Y H:i') }}</td>
                <td>{{ $row->nama_kucing ?? '-' }}</td>
                <td>{{ $row->hasil_diagnosis ?? '-' }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endif

@include('components.scroll-top')

<script>

// Print function
function printDiagnosis() {
    const diagnosis = @json($diagnosis);
    const gejala = @json(session('gejala', []));
    const penjelasan = @json($diseaseDescription ?? '');
    const html = `
    <html>
    <head>
        <meta charset="utf-8">
        <title>Cetak Hasil Diagnosis</title>
        <style>
            body{font-family:Arial,sans-serif;padding:24px;color:#111;line-height:1.5}
            h1{font-size:22px;margin-bottom:6px}
            .muted{color:#666;font-size:13px;margin-bottom:18px}
            .box{border:1px solid #ddd;border-radius:8px;padding:12px;margin-bottom:12px}
            ul{margin:8px 0 0 18px}
        </style>
    </head>
    <body>
        <h1>Hasil Diagnosis PawMedic</h1>
        <div class="muted">Dicetak pada: ${new Date().toLocaleString('id-ID')}</div>
        <div class="box">
            <strong>Penyakit:</strong> ${diagnosis.nama || '-'}<br>
            <strong>Jenis:</strong> ${diagnosis.kategori || '-'}
            ${penjelasan ? `<br><strong>Penjelasan:</strong> ${penjelasan}` : ''}
        </div>
        <div class="box">
            <strong>Gejala Dipilih:</strong>
            <ul>${(gejala || []).map(g => `<li>${g}</li>`).join('') || '<li>-</li>'}</ul>
        </div>
        <div class="box">
            <strong>Pertolongan:</strong>
            <ul>${(diagnosis.pertolongan || []).map(p => `<li>${p}</li>`).join('') || '<li>-</li>'}</ul>
        </div>
        <div class="box">
            <strong>Pencegahan:</strong>
            <ul>${(diagnosis.pencegahan || []).map(p => `<li>${p}</li>`).join('') || '<li>-</li>'}</ul>
        </div>
    </body>
    </html>`;

    const w = window.open('', '_blank');
    if (!w) return;
    w.document.open();
    w.document.write(html);
    w.document.close();
    w.focus();
    w.print();
    w.close();
}

// Share function
function shareDiagnosis() {
    const diagnosis = "{{ $diagnosis['nama'] ?? '-' }}";
    const gejala = @json(session('gejala', []));

    const text = `Hasil Diagnosis PawMedic:\n\nPenyakit: ${diagnosis}\nGejala: ${gejala.join(', ')}\n\nDapatkan diagnosis di: ${window.location.origin}`;
    
    if (navigator.share) {
        navigator.share({
            title: 'Hasil Diagnosis PawMedic',
            text: text,
            url: window.location.href
        });
    } else {
        navigator.clipboard.writeText(text);
        alert('Hasil diagnosis disalin!');
    }
}
</script>

<style>
@media print{
    body::before,
    .action-buttons,
    .back-btn{
        display:none;
    }
    
    .result-card{
        box-shadow:none;
        border:1px solid #ddd;
    }
}
</style>
</script>

</body>
</html>
