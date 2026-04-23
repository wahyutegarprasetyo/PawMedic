<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard Admin - PawMedic</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700;800&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">

<style>
:root{
    --ff-heading: 'Poppins', system-ui, -apple-system, 'Segoe UI', Roboto, 'Helvetica Neue', Arial;
    --ff-body: 'Inter', system-ui, -apple-system, 'Segoe UI', Roboto, 'Helvetica Neue', Arial;
    --primary: #6fcf97;
    --primary-dark: #4bb66f;
    --primary-light: #e8f7ef;
    --text-dark: #114d3a;
    --text-muted: #64748b;
    --danger: #ef4444;
    --warning: #f59e0b;
    --info: #3b82f6;
}

* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
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
}

/* ===== HEADER ===== */
.admin-header{
    background:rgba(255,255,255,0.95);
    backdrop-filter:blur(20px);
    border-bottom:1px solid rgba(111,207,151,0.2);
    padding:16px 0;
    position:sticky;
    top:0;
    z-index:100;
    box-shadow:0 2px 12px rgba(17,77,58,0.08);
}

.header-content{
    max-width:1400px;
    margin:0 auto;
    padding:0 32px;
    display:flex;
    justify-content:space-between;
    align-items:center;
}

.logo-section{
    display:flex;
    align-items:center;
    gap:12px;
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
    font-size:20px;
    font-weight:700;
    font-family:var(--ff-heading);
    color:var(--text-dark);
}

.user-menu{
    display:flex;
    align-items:center;
    gap:16px;
}

.user-info{
    display:flex;
    align-items:center;
    gap:12px;
}

.avatar{
    width:40px;
    height:40px;
    border-radius:50%;
    background:linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
    display:flex;
    align-items:center;
    justify-content:center;
    color:white;
    font-weight:700;
    font-size:16px;
}

.logout-btn{
    padding:10px 20px;
    background:white;
    border:2px solid var(--primary);
    border-radius:10px;
    color:var(--primary-dark);
    text-decoration:none;
    font-weight:600;
    font-size:14px;
    transition:all 0.3s ease;
}

.logout-btn:hover{
    background:var(--primary-light);
    transform:translateY(-2px);
}

/* ===== MAIN CONTENT ===== */
.container{
    max-width:1400px;
    margin:0 auto;
    padding:40px 32px;
}

.page-title{
    font-family:var(--ff-heading);
    font-size:32px;
    font-weight:800;
    color:var(--text-dark);
    margin-bottom:32px;
    letter-spacing:-0.02em;
}

.admin-shortcuts{
    display:flex;
    gap:10px;
    flex-wrap:wrap;
    margin-bottom:22px;
}

.admin-shortcut{
    text-decoration:none;
    padding:9px 14px;
    border-radius:999px;
    border:1px solid rgba(111,207,151,0.35);
    background:#fff;
    color:var(--text-dark);
    font-weight:600;
    font-size:13px;
}

/* ===== STATS GRID ===== */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
    margin-bottom: 30px;
}

.stat-card{
    background:rgba(255,255,255,0.95);
    backdrop-filter:blur(20px);
    border-radius:20px;
    padding:28px;
    box-shadow:0 8px 24px rgba(17,77,58,0.1);
    border:1px solid rgba(111,207,151,0.15);
    transition:all 0.3s ease;
    position:relative;
    overflow:hidden;
}

.stat-card::before{
    content:'';
    position:absolute;
    top:0;
    left:0;
    right:0;
    height:4px;
    background:linear-gradient(90deg, var(--primary) 0%, var(--primary-dark) 100%);
}

.stat-card:hover{
    transform:translateY(-4px);
    box-shadow:0 12px 32px rgba(17,77,58,0.15);
}

.stat-header{
    display:flex;
    justify-content:space-between;
    align-items:flex-start;
    margin-bottom:16px;
}

.stat-icon{
    width:56px;
    height:56px;
    border-radius:14px;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:28px;
    background:var(--primary-light);
}

.stat-value{
    font-family:var(--ff-heading);
    font-size:36px;
    font-weight:800;
    color:var(--text-dark);
    margin-bottom:4px;
}

.stat-label{
    font-size:14px;
    color:var(--text-muted);
    font-weight:600;
    text-transform:uppercase;
    letter-spacing:0.5px;
}

.stat-change{
    font-size:13px;
    color:var(--primary-dark);
    font-weight:600;
    margin-top:8px;
}

/* ===== DATA TABLE ===== */
.data-section{
    background:rgba(255,255,255,0.95);
    backdrop-filter:blur(20px);
    border-radius:24px;
    padding:32px;
    box-shadow:0 8px 24px rgba(17,77,58,0.1);
    border:1px solid rgba(111,207,151,0.15);
    margin-bottom:32px;
}

.section-title{
    font-family:var(--ff-heading);
    font-size:22px;
    font-weight:700;
    color:var(--text-dark);
    margin-bottom:24px;
    display:flex;
    align-items:center;
    gap:12px;
}

.table-wrap{
    width:100%;
    max-height:420px;
    overflow:auto;
    border:1px solid #e2e8f0;
    border-radius:14px;
}

.table-controls{
    display:flex;
    gap:10px;
    margin-bottom:12px;
    flex-wrap:wrap;
}

.form-control{
    padding:10px 12px;
    border:1px solid #cbd5e1;
    border-radius:10px;
    background:#fff;
    font-size:14px;
    min-width:180px;
}

.btn-export{
    padding:10px 14px;
    border-radius:10px;
    border:1px solid var(--primary);
    background:var(--primary-light);
    color:var(--text-dark);
    text-decoration:none;
    font-weight:600;
    font-size:14px;
}

.table{
    width:100%;
    border-collapse:collapse;
}

.table th{
    text-align:left;
    padding:16px;
    background:var(--primary-light);
    color:var(--text-dark);
    font-weight:700;
    font-size:14px;
    text-transform:uppercase;
    letter-spacing:0.5px;
    border-bottom:2px solid var(--primary);
}

.table td{
    padding:16px;
    border-bottom:1px solid var(--border, #e2e8f0);
    color:var(--text-dark);
}

.table tr:hover{
    background:var(--primary-light);
}

.badge{
    padding:6px 12px;
    border-radius:20px;
    font-size:12px;
    font-weight:600;
    display:inline-block;
}

.badge-success{
    background:var(--primary-light);
    color:var(--primary-dark);
}

.badge-warning{
    background:#fef3c7;
    color:#92400e;
}

@media(max-width:768px){
    .header-content{
        padding:0 20px;
        flex-direction:column;
        gap:16px;
    }
    
    .stats-grid{
        grid-template-columns:1fr;
    }
    
    .container{
        padding:24px 20px;
    }
    
    .table{
        font-size:14px;
    }
    
    .table th,
    .table td{
        padding:12px 8px;
    }
}
#chartBox {
    transition: all 0.3s ease;
}
</style>
</head>

<body>
<!-- HEADER -->
<div class="admin-header">
    <div class="header-content">
        <div class="logo-section">
            <div class="logo-icon">🐾</div>
            <div class="logo-text">PawMedic Admin</div>
        </div>
        <div class="user-menu">
            <div class="user-info">
                <div class="avatar">{{ substr(Auth::user()->name ?? 'A', 0, 1) }}</div>
                <div>
                    <div style="font-weight:600; color:var(--text-dark);">{{ Auth::user()->name ?? 'Admin' }}</div>
                    <div style="font-size:12px; color:var(--text-muted);">{{ Auth::user()->email ?? 'admin@pawmedic.app' }}</div>
                </div>
            </div>
            <form method="POST" action="{{ route('admin.logout') }}" style="display:inline;">
                @csrf
                <button type="submit" class="logout-btn" style="border:none; background:transparent; cursor:pointer; padding:10px 20px; background:white; border:2px solid var(--primary); border-radius:10px; color:var(--primary-dark); font-weight:600; font-size:14px;">
                    Keluar
                </button>
            </form>
        </div>
    </div>
</div>

<!-- MAIN CONTENT -->
<div class="container">
    <h1 class="page-title">Dashboard Admin</h1>
    <div class="admin-shortcuts">
        <a href="#" class="admin-shortcut" onclick="toggleDiagnosis(); return false;">📋 Data Diagnosis</a>
        <a href="#" class="admin-shortcut" onclick="toggleUsers(); return false;">👥 Data Pengguna</a>
        <a href="#" class="admin-shortcut" onclick="toggleChart(); return false;">📊 Statistik</a>
        <a href="{{ route('admin.disease.settings') }}" class="admin-shortcut">🧾 Pengaturan Penyakit</a>
    </div>

    <!-- Statistics -->
    <div class="stats-grid">

    <div class="stat-card">
            <div class="stat-header">
                <div>
                    <div class="stat-value">{{ $stats['total_diagnosis'] }}</div>
                    <div class="stat-label">Total Diagnosis</div>
                </div>
                <div class="stat-icon">📊</div>
            </div>
            <div class="stat-change">+{{ $stats['today_diagnosis'] }} hari ini</div>
            <a href="#" onclick="toggleDiagnosis(); return false;"
   style="margin-top:10px; display:inline-block; font-size:13px; color:#4bb66f; font-weight:600;">
    Lihat Data →
</a>
        </div>

        <div class="stat-card">
            <div class="stat-header">
                <div>
                    <div class="stat-value">{{ $stats['today_diagnosis'] }}</div>
                    <div class="stat-label">Diagnosis Hari Ini</div>
                </div>
                <div class="stat-icon">📈</div>
            </div>
            <div class="stat-change">Aktif hari ini</div>
            <div class="stat-change">
    @if($stats['diagnosis_diff'] > 0)
        ↑ +{{ $stats['diagnosis_diff'] }} dari kemarin
    @elseif($stats['diagnosis_diff'] < 0)
        ↓ {{ $stats['diagnosis_diff'] }} dari kemarin
    @else
        Sama dengan kemarin
    @endif
</div>

<div style="font-size:12px; color:#64748b; margin-top:4px;">
    Terbanyak: {{ $stats['today_top_disease'] ?? '-' }}
</div>
        </div>

        <div class="stat-card">
            <div class="stat-header">
                <div>
                    <div class="stat-value">{{ $stats['total_users'] }}</div>
                    <div class="stat-label">Total Pengguna</div>
                </div>
                <div class="stat-icon">👥</div>
            </div>
            <div class="stat-change">Pengguna aktif</div>
            <a href="#" onclick="toggleUsers(); return false;"
       style="margin-top:10px; display:inline-block; font-size:13px; color:#4bb66f; font-weight:600;">
        Lihat Data →
    </a>
        </div>

        <div class="stat-card">
            <div class="stat-header">
                <div>
                    <div class="stat-value" style="font-size:24px;">{{ $stats['most_common_disease'] }}</div>
                    <div class="stat-label">Penyakit Paling Umum</div>
                </div>
                <div class="stat-icon">🩺</div>
            </div>
            <div class="stat-change">Paling sering didiagnosis</div>
        
            <a href="#" onclick="toggleChart(); return false;"
   style="margin-top:10px; display:inline-block; font-size:13px; color:#4bb66f; font-weight:600;">
    Lihat Data →
</a>
</div>
    </div>
    
<div id="chartBox" style="display:none; margin-top:20px;">

<div style="display:grid; grid-template-columns:1fr 1fr; gap: 20px;">
<div class="data-section">
        <div class="section-title">📊 Statistik Penyakit</div>
        <div style="max-width:600px; margin:auto;">
        <canvas id="chartPenyakit"></canvas></div>
        </div>

<div class="data-section">
    <div class="section-title">⭐ Distribusi Rating Ulasan</div>
    <div style="max-width:400px; margin:auto;">
    <canvas id="chartRating" height="250"></canvas></div>
</div>
</div>

    <div class="data-section">
    <div class="section-title">📈 Tren Diagnosis (7 Hari Terakhir)</div>
    <canvas id="chartHarian"></canvas>
</div>
</div>

<div id="diagnosisBox" style="display:none; margin-top:20px;">
    <div class="data-section">
        <div class="section-title">📋 Data Diagnosis</div>

        <div class="table-controls">
            <input type="text" id="searchDiagnosis" class="form-control" placeholder="🔍 Cari data diagnosis...">
            <select id="filterDiagnosis" class="form-control">
                <option value="">Semua Penyakit</option>
                @foreach($data->pluck('hasil_diagnosis')->unique() as $penyakit)
                    <option value="{{ strtolower($penyakit) }}">{{ $penyakit }}</option>
                @endforeach
            </select>
            <select id="sortDiagnosis" class="form-control">
                <option value="latest">Terbaru</option>
                <option value="oldest">Terlama</option>
                <option value="name_asc">Nama Pemilik A-Z</option>
                <option value="name_desc">Nama Pemilik Z-A</option>
            </select>
            <a href="{{ route('admin.export.diagnosis') }}" class="btn-export">⬇ Export Excel</a>
        </div>

            <div class="table-wrap">
            <table class="table">
            <thead>
                <tr>
                    <th>Nama Pemilik</th>
                    <th>Nama Kucing</th>
                    <th>Umur Kucing</th>
                    <th>Jenis Kelamin</th>
                    <th>Penyakit</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody id="diagnosisTable">
                @foreach($data as $item)
                <tr data-date="{{ $item->created_at }}" data-name="{{ strtolower($item->nama_pemilik ?? '') }}" data-disease="{{ strtolower($item->hasil_diagnosis ?? '') }}">
                    <td>{{ $item->nama_pemilik }}</td>
                    <td>{{ $item->nama_kucing }}</td>
                    <td>{{ $item->umur_kucing ?? '-' }}</td>
                    <td>{{ $item->jenis_kelamin ?? '-' }}</td>
                    <td>{{ $item->hasil_diagnosis ?? '-' }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
</div>

<div id="userBox" style="display:none; margin-top:20px;">
    <div class="data-section">
        <div class="section-title">👥 Data Pengguna</div>
        <div class="table-controls">
            <input type="text" id="searchUser" class="form-control" placeholder="🔍 Cari pengguna...">
            <select id="sortUser" class="form-control">
                <option value="latest">Terbaru</option>
                <option value="oldest">Terlama</option>
                <option value="name_asc">Nama Pemilik A-Z</option>
                <option value="name_desc">Nama Pemilik Z-A</option>
            </select>
        </div>
        <div class="table-wrap">
        <table class="table">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Nama Pemilik</th>
                    <th>No Telepon</th>
                    <th>Alamat</th>
                    <th>Nama Kucing</th>
                </tr>
            </thead>
            <tbody id="userTable">
                @foreach(($userData ?? collect()) as $item)
                <tr data-date="{{ $item->created_at }}" data-name="{{ strtolower($item->nama_pemilik ?? '') }}">
                    <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}</td>
                    <td>{{ $item->nama_pemilik }}</td>
                    <td>{{ $item->no_telepon }}</td>
                    <td>{{ $item->alamat ?? 'Tidak tersedia'}}</td>
                    <td>{{ $item->nama_kucing }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        </div>
    </div>
</div>

    <!-- Recent Diagnosis -->
    <div class="data-section">
        <div class="section-title">
            <span>📋</span>
            <span>Diagnosis Terbaru</span>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Penyakit</th>
                    <th>Jumlah</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($stats['recent_diagnosis'] as $diagnosis)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($diagnosis['date'])->format('d M Y') }}</td>
                    <td>{{ $diagnosis['disease'] }}</td>
                    <td>{{ $diagnosis['count'] }} kasus</td>
                    <td><span class="badge badge-success">Aktif</span></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Quick Actions -->
    <div class="data-section">
        <div class="section-title">
            <span>⚡</span>
            <span>Aksi Cepat</span>
        </div>
        <div style="display:flex; gap:16px; flex-wrap:wrap;">
            <a href="/" style="padding:12px 24px; background:linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%); color:white; text-decoration:none; border-radius:12px; font-weight:600; transition:all 0.3s ease;">
                🏠 Lihat Website
            </a>
            <a href="{{ route('ulasan') }}" style="padding:12px 24px; background:white; border:2px solid var(--primary); color:var(--primary-dark); text-decoration:none; border-radius:12px; font-weight:600; transition:all 0.3s ease;">
                💬 Lihat Ulasan
            </a>
            <a href="{{ route('faq') }}" style="padding:12px 24px; background:white; border:2px solid var(--primary); color:var(--primary-dark); text-decoration:none; border-radius:12px; font-weight:600; transition:all 0.3s ease;">
                ❓ Lihat FAQ
            </a>
            <a href="{{ route('admin.faq.settings') }}" style="padding:12px 24px; background:white; border:2px solid var(--primary); color:var(--primary-dark); text-decoration:none; border-radius:12px; font-weight:600; transition:all 0.3s ease;">
                🛠️ Kelola FAQ
            </a>
            <a href="{{ route('admin.disease.settings') }}" style="padding:12px 24px; background:white; border:2px solid var(--primary); color:var(--primary-dark); text-decoration:none; border-radius:12px; font-weight:600; transition:all 0.3s ease;">
                🧾 Atur Penjelasan Penyakit
            </a>
        </div>
    </div>
</div>

@include('components.scroll-top')

<script>
const diagnosisBox = document.getElementById('diagnosisBox');
const userBox = document.getElementById('userBox');
const chartBox = document.getElementById('chartBox');

const diagnosisTableBody = document.getElementById('diagnosisTable');
const diagnosisRows = Array.from(diagnosisTableBody.querySelectorAll('tr'));

const userTableBody = document.getElementById('userTable');
const userRows = Array.from(userTableBody.querySelectorAll('tr'));

function sortRows(rows, sortType, nameAttr = 'data-name') {
    const cloned = [...rows];
    cloned.sort((a, b) => {
        if (sortType === 'oldest') {
            return new Date(a.getAttribute('data-date')) - new Date(b.getAttribute('data-date'));
        }
        if (sortType === 'name_asc') {
            return (a.getAttribute(nameAttr) || '').localeCompare((b.getAttribute(nameAttr) || ''));
        }
        if (sortType === 'name_desc') {
            return (b.getAttribute(nameAttr) || '').localeCompare((a.getAttribute(nameAttr) || ''));
        }
        return new Date(b.getAttribute('data-date')) - new Date(a.getAttribute('data-date'));
    });
    return cloned;
}

function applyDiagnosisFilters() {
    const search = (document.getElementById('searchDiagnosis').value || '').toLowerCase();
    const diseaseFilter = document.getElementById('filterDiagnosis').value;
    const sort = document.getElementById('sortDiagnosis').value;

    const filtered = diagnosisRows.filter((row) => {
        const text = row.innerText.toLowerCase();
        const disease = row.getAttribute('data-disease') || '';
        return text.includes(search) && (diseaseFilter === '' || disease === diseaseFilter);
    });

    const sorted = sortRows(filtered, sort);
    diagnosisTableBody.innerHTML = '';
    sorted.forEach((row) => diagnosisTableBody.appendChild(row));
}

function applyUserFilters() {
    const search = (document.getElementById('searchUser').value || '').toLowerCase();
    const sort = document.getElementById('sortUser').value;

    const filtered = userRows.filter((row) => row.innerText.toLowerCase().includes(search));
    const sorted = sortRows(filtered, sort);

    userTableBody.innerHTML = '';
    sorted.forEach((row) => userTableBody.appendChild(row));
}

function toggleChart() {
    const isHidden = window.getComputedStyle(chartBox).display === 'none';
    if (isHidden) {
        chartBox.style.display = 'block';
        chartBox.scrollIntoView({ behavior: 'smooth' });
        loadMainChart();
        loadRatingChart();
    } else {
        chartBox.style.display = 'none';
    }
}

function toggleUsers() {
    chartBox.style.display = 'none';
    const hidden = window.getComputedStyle(userBox).display === 'none';
    userBox.style.display = hidden ? 'block' : 'none';
    if (hidden) userBox.scrollIntoView({ behavior: 'smooth' });
}

function toggleDiagnosis() {
    chartBox.style.display = 'none';
    userBox.style.display = 'none';
    const hidden = window.getComputedStyle(diagnosisBox).display === 'none';
    diagnosisBox.style.display = hidden ? 'block' : 'none';
    if (hidden) diagnosisBox.scrollIntoView({ behavior: 'smooth' });
}
</script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
<script>
let diseaseChart = null;
let ratingChart = null;

function loadMainChart() {
    if (diseaseChart) return;
    const ctx = document.getElementById('chartPenyakit');
    diseaseChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($stats['chart_labels']) !!},
            datasets: [{
                label: 'Jumlah Kasus',
                data: {!! json_encode($stats['chart_data']) !!},
                backgroundColor: '#6fcf97',
                borderColor: '#4bb66f',
                borderWidth: 1.5,
                borderRadius: 8
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false },
                tooltip: { mode: 'index', intersect: false }
            },
            scales: {
                y: { beginAtZero: true, ticks: { precision: 0 }, grid: { color: '#e5e7eb' } },
                x: { grid: { display: false } }
            }
        }
    });
}

new Chart(document.getElementById('chartHarian'), {
    type: 'line',
    data: {
        labels: {!! json_encode($stats['daily_labels']) !!},
        datasets: [{
            label: 'Jumlah Diagnosis',
            data: {!! json_encode($stats['daily_data']) !!},
            tension: 0.35,
            fill: true,
            backgroundColor: 'rgba(111, 207, 151, 0.2)',
            borderColor: '#4bb66f',
            borderWidth: 3,
            pointRadius: 4,
            pointBackgroundColor: '#4bb66f'
        }]
    },
    options: {
        responsive: true,
        plugins: { legend: { display: true } },
        scales: {
            y: { beginAtZero: true, ticks: { precision: 0 }, grid: { color: '#e5e7eb' } },
            x: { grid: { display: false } }
        }
    }
});

function loadRatingChart() {
    if (ratingChart) return;
    ratingChart = new Chart(document.getElementById('chartRating'), {
        type: 'pie',
        data: {
            labels: {!! json_encode($stats['rating_labels']) !!}.map(r => 'Bintang ' + r),
            datasets: [{
                data: {!! json_encode($stats['rating_data']) !!},
                backgroundColor: ['#22c55e', '#84cc16', '#f59e0b', '#f97316', '#ef4444']
            }]
        },
        options: {
            plugins: {
                datalabels: {
                    color: '#fff',
                    formatter: (value, context) => {
                        const total = context.dataset.data.reduce((a, b) => a + b, 0);
                        if (!total) return '0%';
                        return ((value / total) * 100).toFixed(1) + '%';
                    },
                    font: { weight: 'bold' }
                },
                legend: { position: 'bottom' }
            }
        },
        plugins: [ChartDataLabels]
    });
}

document.getElementById('searchDiagnosis').addEventListener('input', applyDiagnosisFilters);
document.getElementById('filterDiagnosis').addEventListener('change', applyDiagnosisFilters);
document.getElementById('sortDiagnosis').addEventListener('change', applyDiagnosisFilters);
document.getElementById('searchUser').addEventListener('input', applyUserFilters);
document.getElementById('sortUser').addEventListener('change', applyUserFilters);

applyDiagnosisFilters();
applyUserFilters();
</script>
</body>
</html>
