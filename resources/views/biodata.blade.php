<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Input Biodata - PawMedic</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700;800&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">

<style>
/* ===== GLOBAL ===== */
:root{
    --ff-heading: 'Poppins', system-ui, -apple-system, 'Segoe UI', Roboto, 'Helvetica Neue', Arial;
    --ff-body: 'Inter', system-ui, -apple-system, 'Segoe UI', Roboto, 'Helvetica Neue', Arial;
    --primary: #6fcf97;
    --primary-dark: #4bb66f;
    --primary-light: #e8f7ef;
    --text-dark: #114d3a;
    --text-muted: #64748b;
    --border: #e2e8f0;
}

* {
    box-sizing: border-box;
}

body{
    margin:0;
    font-family:var(--ff-body);
    background:linear-gradient(135deg, #f0fdf4 0%, #eaf7f0 100%);
    color:#333;
    -webkit-font-smoothing:antialiased;
    line-height:1.6;
    min-height:100vh;
    padding:20px;
}

.container{
    max-width:800px;
    margin:0 auto;
    padding:40px 0;
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

.header p{
    color:var(--text-muted);
    font-size:16px;
    margin:0;
}

/* ===== CARD FORM ===== */
.form-card{
    background:white;
    border-radius:24px;
    padding:48px;
    box-shadow:0 20px 60px rgba(17,77,58,0.1);
    animation:fadeUp 0.8s ease;
    border:1px solid rgba(111,207,151,0.1);
}

/* ===== FORM ===== */
.form-group{
    margin-bottom:28px;
}

.form-group label{
    display:block;
    font-weight:600;
    color:var(--text-dark);
    margin-bottom:10px;
    font-size:15px;
    font-family:var(--ff-heading);
}

.form-group label .required{
    color:#ef4444;
    margin-left:4px;
}

.form-group input,
.form-group textarea,
.form-group select{
    width:100%;
    padding:14px 18px;
    border:2px solid var(--border);
    border-radius:12px;
    font-size:15px;
    font-family:var(--ff-body);
    transition:all 0.3s ease;
    background:#fafafa;
    color:#333;
}

.form-group input:focus,
.form-group textarea:focus,
.form-group select:focus{
    outline:none;
    border-color:var(--primary);
    background:white;
    box-shadow:0 0 0 4px rgba(111,207,151,0.1);
}

.form-group textarea{
    resize:vertical;
    min-height:100px;
    font-family:var(--ff-body);
}

.form-group small{
    display:block;
    margin-top:6px;
    color:var(--text-muted);
    font-size:13px;
}

.form-row{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:20px;
}

/* ===== BUTTON ===== */
.btn-group{
    display:flex;
    gap:16px;
    margin-top:40px;
    padding-top:32px;
    border-top:1px solid var(--border);
}

.btn{
    flex:1;
    padding:16px 32px;
    border:none;
    border-radius:14px;
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
    letter-spacing:0.3px;
}

.btn-primary{
    background:linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
    color:white;
    box-shadow:0 4px 16px rgba(111,207,151,0.3);
    position:relative;
    overflow:hidden;
}

.btn-primary::before{
    content:'';
    position:absolute;
    top:0;
    left:-100%;
    width:100%;
    height:100%;
    background:linear-gradient(90deg, transparent, rgba(255,255,255,0.25), transparent);
    transition:left 0.6s;
}

.btn-primary:hover::before{
    left:100%;
}

.btn-primary:hover{
    transform:translateY(-3px) scale(1.02);
    box-shadow:0 12px 32px rgba(17,77,58,0.25);
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
    box-shadow:0 8px 20px rgba(17,77,58,0.15);
}

/* ===== ANIMATIONS ===== */
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

/* ===== RESPONSIVE ===== */
@media(max-width:768px){
    body{
        padding:16px;
    }
    
    .container{
        padding:20px 0;
    }
    
    .form-card{
        padding:32px 24px;
        border-radius:20px;
    }
    
    .form-row{
        grid-template-columns:1fr;
        gap:0;
    }
    
    .btn-group{
        flex-direction:column;
    }
    
    .btn{
        width:100%;
    }
    
    .header h1{
        font-size:1.8rem;
    }
}

@media(max-width:480px){
    .form-card{
        padding:24px 20px;
    }
    
    .header h1{
        font-size:1.6rem;
    }
    
    .form-group{
        margin-bottom:24px;
    }
}
</style>
</head>

<body>
<div class="container">
    <!-- HEADER -->
    <div class="header">
        <a href="/" class="logo-link">
            <div class="logo-icon">🐾</div>
            <div class="logo-text">PawMedic</div>
        </a>
        @php
            $breadcrumbItems = [
                ['label' => 'Beranda', 'url' => '/'],
                ['label' => 'Biodata', 'url' => '#']
            ];
        @endphp
        @include('components.breadcrumb', ['items' => $breadcrumbItems])
        <h1>Input Biodata Kucing</h1>
        <p>Lengkapi informasi kucing Anda untuk memulai diagnosis</p>
    </div>

    <!-- FORM CARD -->
    <div class="form-card">
        <form action="#" method="POST" id="biodataForm">
            @csrf
            
            <!-- Nama Pemilik -->
            <div class="form-group">
                <label for="nama_pemilik">
                    Nama Pemilik <span class="required">*</span>
                </label>
                <input 
                    type="text" 
                    id="nama_pemilik" 
                    name="nama_pemilik" 
                    placeholder="Masukkan nama Anda"
                    required
                    autocomplete="name"
                >
            </div>

            <!-- Nama Kucing -->
            <div class="form-group">
                <label for="nama_kucing">
                    Nama Kucing <span class="required">*</span>
                </label>
                <input 
                    type="text" 
                    id="nama_kucing" 
                    name="nama_kucing" 
                    placeholder="Masukkan nama kucing"
                    required
                >
            </div>

            <!-- Umur Kucing -->
            <div class="form-row">
                <div class="form-group">
                    <label for="umur_kucing">
                        Umur Kucing <span class="required">*</span>
                    </label>
                    <input 
                        type="number" 
                        id="umur_kucing" 
                        name="umur_kucing" 
                        placeholder="Dalam bulan"
                        min="0"
                        max="240"
                        required
                    >
                    <small>Contoh: 12 (untuk 1 tahun)</small>
                </div>

                <!-- Jenis Kelamin -->
                <div class="form-group">
                    <label for="jenis_kelamin">
                        Jenis Kelamin <span class="required">*</span>
                    </label>
                    <select id="jenis_kelamin" name="jenis_kelamin" required>
                        <option value="">Pilih jenis kelamin</option>
                        <option value="jantan">Jantan</option>
                        <option value="betina">Betina</option>
                    </select>
                </div>
            </div>

            <!-- Ras Kucing -->
            <div class="form-group">
                <label for="ras_kucing">
                    Ras Kucing
                </label>
                <input 
                    type="text" 
                    id="ras_kucing" 
                    name="ras_kucing" 
                    placeholder="Contoh: Persia, Angora, atau Campuran"
                >
                <small>Opsional - Kosongkan jika tidak tahu</small>
            </div>

            <!-- Berat Badan -->
            <div class="form-group">
                <label for="berat_badan">
                    Berat Badan (kg) <span class="required">*</span>
                </label>
                <input 
                    type="number" 
                    id="berat_badan" 
                    name="berat_badan" 
                    placeholder="Contoh: 3.5"
                    step="0.1"
                    min="0.5"
                    max="15"
                    required
                >
                <small>Berat badan kucing dalam kilogram</small>
            </div>

            <!-- Alamat -->
            <div class="form-group">
                <label for="alamat">
                    Alamat
                </label>
                <textarea 
                    id="alamat" 
                    name="alamat" 
                    placeholder="Masukkan alamat (opsional)"
                    rows="3"
                ></textarea>
                <small>Opsional - Untuk keperluan dokumentasi</small>
            </div>

            <!-- Nomor Telepon -->
            <div class="form-group">
                <label for="no_telepon">
                    Nomor Telepon
                </label>
                <input 
                    type="tel" 
                    id="no_telepon" 
                    name="no_telepon" 
                    placeholder="Contoh: 081234567890"
                    pattern="[0-9]{10,13}"
                >
                <small>Opsional - Untuk keperluan dokumentasi</small>
            </div>

            <!-- Button Group -->
            <div class="btn-group">
                <a href="/" class="btn btn-secondary">
                    Kembali
                </a>
                <button type="submit" class="btn btn-primary">
                    <span>Lanjutkan Diagnosis</span>
                    <span>→</span>
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.getElementById('biodataForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    // Validasi sederhana
    const namaPemilik = document.getElementById('nama_pemilik').value.trim();
    const namaKucing = document.getElementById('nama_kucing').value.trim();
    const umurKucing = document.getElementById('umur_kucing').value;
    const jenisKelamin = document.getElementById('jenis_kelamin').value;
    const beratBadan = document.getElementById('berat_badan').value;
    
    if (!namaPemilik || !namaKucing || !umurKucing || !jenisKelamin || !beratBadan) {
        alert('Mohon lengkapi semua field yang wajib diisi!');
        return;
    }
    
    // Simpan data ke sessionStorage untuk sementara
    const formData = {
        nama_pemilik: namaPemilik,
        nama_kucing: namaKucing,
        umur_kucing: umurKucing,
        jenis_kelamin: jenisKelamin,
        ras_kucing: document.getElementById('ras_kucing').value.trim(),
        berat_badan: beratBadan,
        alamat: document.getElementById('alamat').value.trim(),
        no_telepon: document.getElementById('no_telepon').value.trim()
    };
    
    sessionStorage.setItem('biodata_kucing', JSON.stringify(formData));
    
    // Simpan data ke sessionStorage
    sessionStorage.setItem('biodata_kucing', JSON.stringify(formData));
    
    // Show success message
    if (window.showToast) {
        showToast('Biodata berhasil disimpan!', 'success', 'Berhasil');
    }
    
    // Redirect ke halaman pilih gejala
    setTimeout(() => {
        window.location.href = '{{ route("gejala") }}';
    }, 500);
});
</script>

@include('components.toast')
@include('components.scroll-top')

</body>
</html>
