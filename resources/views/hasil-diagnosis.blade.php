<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Hasil Diagnosis - PawMedic</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700;800&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
<link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
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
    overflow-wrap:anywhere;
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
    overflow-wrap:anywhere;
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

@media (max-width:576px) and (orientation:portrait){
    body{padding:10px;}
    .container{padding:10px 0;}
    .header h1{font-size:1.35rem;}
    .logo-icon{width:38px;height:38px;}
    .result-card{padding:16px 12px;border-radius:16px;}
    .result-title{font-size:1.1rem;}
    .result-subtitle,.diagnosis-description,.diagnosis-list li{font-size:13px;}
    .diagnosis-result,.recommendation,.warning-box{padding:14px 12px;border-radius:12px;margin-bottom:16px;}
    .diagnosis-name{font-size:20px;line-height:1.35;}
    .diagnosis-category{font-size:14px;}
    .disease-explanation{font-size:13px;line-height:1.65;padding:10px 12px;}
    .section-title{font-size:18px;margin-bottom:12px;}
    .gejala-list{gap:8px;}
    .gejala-badge{font-size:12px;padding:8px 10px;border-radius:12px;}
    .gejala-badge::before{width:16px;height:16px;font-size:10px;}
    .action-buttons{gap:10px;margin-top:20px;}
    .btn{font-size:14px;padding:10px 12px;min-width:unset;}
    .history-table th,.history-table td{font-size:12px;padding:8px 6px;}
}
</style>
</head>

<body>
<div class="container">
    <div class="header">
        <a href="/" class="logo-link">
            <div class="logo-icon" aria-hidden="true">
                <svg viewBox="0 0 24 24" width="20" height="20" fill="currentColor">
                    <circle cx="6" cy="8" r="2.2"></circle>
                    <circle cx="10.8" cy="5.6" r="2.1"></circle>
                    <circle cx="15.8" cy="8" r="2.2"></circle>
                    <path d="M12 10.6c-3.4 0-5.9 2.4-5.9 4.9 0 2.2 1.8 3.9 4 3.9 1.4 0 1.9-.7 2-.7s.6.7 2 .7c2.2 0 4-1.7 4-3.9 0-2.6-2.6-4.9-6.1-4.9z"></path>
                </svg>
            </div>
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
            <div class="result-icon"><i class="bi bi-clipboard2-pulse"></i></div>
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
                <span><i class="bi bi-search"></i> Gejala yang Dipilih</span>
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
                <span><i class="bi bi-lightbulb"></i> Rekomendasi Perawatan</span>
            </div>
            <ul class="recommendation-list">
            @foreach($diagnosis['pertolongan'] ?? [] as $item)
    <li>{{ $item }}</li>
@endforeach
</ul>
        </div>

        <div class="recommendation">
    <div class="recommendation-title">
        <span><i class="bi bi-shield-check"></i> Pencegahan</span>
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
                <span><i class="bi bi-exclamation-triangle"></i> Peringatan Penting</span>
            </div>
            <div class="warning-text">
                Hasil diagnosis ini hanya sebagai panduan awal. Untuk diagnosis yang akurat dan penanganan yang tepat, 
                sangat disarankan untuk berkonsultasi langsung dengan dokter hewan profesional.
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="action-buttons">
            <a href="{{ route('gejala') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Diagnosis Lagi
            </a>
            <a href="{{ route('hasil-diagnosis.pdf') }}" class="btn btn-secondary">
                <i class="bi bi-download"></i> Download Hasil
            </a>
            <a href="/" class="btn btn-primary">
                <i class="bi bi-house-door"></i> Kembali ke Beranda
            </a>
        </div>
    </div>
</div>

@if(isset($diagnosisHistory) && $diagnosisHistory->count() > 0)
<div class="result-card history-section">
    <div class="section-title">
        <span><i class="bi bi-clock-history"></i> Riwayat Diagnosis (Nomor yang sama)</span>
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
                <td>
                    <span class="rt-time" data-ts="{{ \Carbon\Carbon::parse($row->created_at)->toIso8601String() }}">
                        {{ \Carbon\Carbon::parse($row->created_at)->format('d M Y H:i') }}
                    </span>
                </td>
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
function pad2(n){ return String(n).padStart(2,'0'); }
function formatAbsolute(d){
    const months = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];
    return `${pad2(d.getDate())} ${months[d.getMonth()]} ${d.getFullYear()} ${pad2(d.getHours())}:${pad2(d.getMinutes())}`;
}
function formatRelative(d){
    const now = new Date();
    const diffMs = now - d;
    const diffSec = Math.floor(diffMs / 1000);
    if (diffSec < 5) return 'baru saja';
    if (diffSec < 60) return `${diffSec} detik lalu`;
    const diffMin = Math.floor(diffSec / 60);
    if (diffMin < 60) return `${diffMin} menit lalu`;
    const diffHour = Math.floor(diffMin / 60);
    if (diffHour < 24) return `${diffHour} jam lalu`;
    const diffDay = Math.floor(diffHour / 24);
    if (diffDay < 7) return `${diffDay} hari lalu`;
    return formatAbsolute(d);
}
function updateRealtimeTimes(){
    document.querySelectorAll('.rt-time').forEach((el) => {
        const ts = el.getAttribute('data-ts');
        if (!ts) return;
        const d = new Date(ts);
        if (isNaN(d.getTime())) return;
        el.textContent = formatRelative(d);
        el.title = formatAbsolute(d);
    });
}
updateRealtimeTimes();
setInterval(updateRealtimeTimes, 15000);
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
