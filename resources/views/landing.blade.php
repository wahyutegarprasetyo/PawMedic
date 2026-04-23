<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<title>PawMedic - Sistem Pakar Kucing</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700;800&family=Inter:wght@300;400;600&display=swap" rel="stylesheet">

<style>
/* ===== GLOBAL ===== */
:root{
    --ff-heading: 'Poppins', system-ui, -apple-system, 'Segoe UI', Roboto, 'Helvetica Neue', Arial;
    --ff-body: 'Inter', system-ui, -apple-system, 'Segoe UI', Roboto, 'Helvetica Neue', Arial;
    --space:28px;
    --muted: #6b7280;
}
body{
    margin:0;
    font-family:var(--ff-body);
    background:#f8fbff;
    color:#333;
    -webkit-font-smoothing:antialiased;
    line-height:1.6;
} 

.container{
    max-width:1200px;
    margin:auto;
    padding:36px;
} 

h1,h2,h3{
    margin-top:0;
    font-family:var(--ff-heading);
    letter-spacing:-0.01em;
    color:#114d3a;
} 

/* ===== NAVBAR ===== */
.navbar{
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:18px 0;
    border-bottom:1px solid #eef5f3;
    margin-bottom:40px;
}

/* ===== LOGO ===== */
.logo{
    display:flex;
    align-items:center;
    gap:10px;
    cursor:pointer;
    animation:fadeDown 0.8s ease;
}

.logo-icon{
    width:44px;
    height:44px;
    background:#6fcf97;
    border-radius:12px;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:22px;
    transition:0.4s;
}

.logo-text{
    font-size:20px;
    font-weight:700;
    transition:0.4s;
}

.logo:hover .logo-icon{
    transform:rotate(-10deg) scale(1.05);
    background:#4bb66f;
}

/* ===== NAV MENU ===== */
.nav-menu{
    display:flex;
    gap:18px;
    align-items:center;
}
.menu-toggle{
    display:none;
    border:1px solid #d1d5db;
    background:#fff;
    border-radius:10px;
    padding:8px 10px;
    font-size:20px;
    cursor:pointer;
    color:#114d3a;
}
.nav-menu a{
    text-decoration:none;
    color:#555;
    font-weight:600;
    transition:0.2s;
}
.nav-menu a:hover{
    color:#000;
}

/* ===== BUTTON ===== */
.btn{
    background:linear-gradient(135deg, #6fcf97 0%, #4bb66f 100%);
    color:white;
    border:none;
    padding:16px 32px;
    border-radius:14px;
    cursor:pointer;
    font-weight:600;
    font-size:16px;
    transition:all 0.3s ease;
    box-shadow:0 4px 16px rgba(111,207,151,0.3);
    position:relative;
    overflow:hidden;
    text-decoration:none;
    display:inline-flex;
    align-items:center;
    justify-content:center;
    gap:8px;
    letter-spacing:0.3px;
}
.btn::before{
    content:'';
    position:absolute;
    top:0;
    left:-100%;
    width:100%;
    height:100%;
    background:linear-gradient(90deg, transparent, rgba(255,255,255,0.25), transparent);
    transition:left 0.6s;
}
.btn:hover::before{
    left:100%;
}
.btn:hover{
    transform:translateY(-4px) scale(1.02);
    box-shadow:0 12px 32px rgba(17,77,58,0.25);
    background:linear-gradient(135deg, #7dd9a8 0%, #5ac77f 100%);
}
.btn:active{
    transform:translateY(-2px) scale(1);
}
.btn:focus{
    outline:3px solid rgba(111,207,151,0.4);
    outline-offset:3px;
}

.btn.secondary{
    background:#ffffff;
    color:#2f855a;
    border:2px solid #6fcf97;
    box-shadow:0 2px 10px rgba(17,77,58,0.1);
}
.btn.secondary:hover{
    background:#e8f7ef;
    border-color:#4bb66f;
    transform:translateY(-3px) scale(1.02);
    box-shadow:0 8px 20px rgba(17,77,58,0.15);
}

/* ===== HERO ===== */
.hero{
    background:linear-gradient(135deg, #eaf7f0 0%, #f0fdf4 100%);
    padding:25px 50px 60px 50px;
    border-radius:24px;
    display:flex;
    gap:50px;
    align-items:flex-start;
    animation:fadeUp 0.8s ease;
    box-shadow:0 10px 40px rgba(17,77,58,0.08);
    position:relative;
    overflow:hidden;
    min-height:500px;
}
.hero::before{
    content:'';
    position:absolute;
    top:-50%;
    right:-10%;
    width:300px;
    height:300px;
    background:radial-gradient(circle, rgba(111,207,151,0.1) 0%, transparent 70%);
    border-radius:50%;
}
.hero::after{
    content:'';
    position:absolute;
    bottom:-30%;
    left:-5%;
    width:250px;
    height:250px;
    background:radial-gradient(circle, rgba(111,207,151,0.08) 0%, transparent 70%);
    border-radius:50%;
}

.hero > div{
    flex:1;
    position:relative;
    z-index:1;
}

.hero-content{
    max-width:640px;
    display:flex;
    flex-direction:column;
    justify-content:flex-start;
    text-align:left;
    padding-top:5px;
}

.hero-content h2{
    font-size:clamp(1.8rem, 3.5vw, 2.6rem);
    font-weight:800;
    line-height:1.3;
    color:#114d3a;
    margin-bottom:16px;
    margin-top:0;
    text-align:left;
} 

.hero-content p{
    font-size:17px;
    line-height:1.75;
    color:#4a5568;
    margin-bottom:32px;
    text-align:left;
    max-width:580px;
}

.hero-actions{
    display:flex;
    gap:16px;
    margin-top:12px;
    align-items:center;
}

/* ===== SECTION ===== */
section{
    margin-top:100px;
    padding-top:10px;
}
section h2{
    margin-bottom:16px;
    text-align:center;
    font-size:clamp(1.8rem, 3vw, 2.4rem);
    font-weight:800;
    letter-spacing:-0.02em;
}
section > p{
    text-align:center;
    color:#64748b;
    font-size:17px;
    margin-bottom:40px;
    max-width:650px;
    margin-left:auto;
    margin-right:auto;
    line-height:1.7;
}


/* ===== CARD ===== */
.card{
    background:white;
    padding:20px;
    border-radius:10px;
    box-shadow:0 5px 12px rgba(0,0,0,0.06);
    transition:0.3s;
}

.card:hover{
    transform:translateY(-6px);
}

/* ===== FEATURES ===== */
.features{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
    gap:20px;
    margin-top:20px;
}

.card.feature{
    min-height:200px;
    display:flex;
    flex-direction:column;
    justify-content:flex-start;
    text-align:center;
    padding:32px 28px;
    gap:14px;
    border:1px solid rgba(111,207,151,0.1);
}
.card.feature h3{
    font-size:21px;
    margin-bottom:10px;
    color:#114d3a;
    font-weight:700;
}
.card.feature p{
    font-size:15px;
    line-height:1.7;
    color:#64748b;
    margin:0;
}

.hero-image{
    display:flex;
    align-items:center;
    justify-content:center;
    flex-shrink:0;
}
.hero-image img{
    width:100%;
    max-width:550px;
    height:auto;
    display:block;
    margin:0 auto;
    object-fit:contain;
    filter:drop-shadow(0 10px 30px rgba(17,77,58,0.15));
}

/* ===== TESTIMONIALS ===== */
#diagnosa{
    background:linear-gradient(180deg, #f6fffb 0%, #ffffff 100%);
    padding:32px;
    border-radius:12px;
    margin-top:40px;
}

#diagnosa h2{
    margin-bottom:6px;
}

.testimonials{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(260px,1fr));
    gap:20px;
    margin-top:20px;
    align-items:start;
}

.card.testimonial{
    padding:20px;
    border-radius:12px;
    background:linear-gradient(180deg,#ffffff,#f7fffb);
    box-shadow:0 8px 20px rgba(17,77,58,0.06);
    transition:transform .18s ease,box-shadow .18s ease;
    display:flex;
    flex-direction:column;
    gap:12px;
}
.card.testimonial:hover{
    transform:translateY(-6px);
    box-shadow:0 18px 36px rgba(17,77,58,0.12);
}

.testimonial-head{
    display:flex;
    align-items:center;
    gap:12px;
}

.avatar{
    width:48px;
    height:48px;
    border-radius:50%;
    background:linear-gradient(135deg,#6fcf97,#2f855a);
    color:#fff;
    display:flex;
    align-items:center;
    justify-content:center;
    font-weight:700;
    font-size:16px;
    flex-shrink:0;
}
.avatar svg{width:24px;height:24px;display:block;}
.avatar svg path, .avatar svg circle{stroke:#fff;fill:transparent}
.avatar svg circle{fill:#fff} 

.meta .rating{
    color:#f6b042;
    font-size:14px;
    margin-bottom:4px;
}

.quote{
    font-size:16px;
    color:#0f3f33;
    position:relative;
    padding-left:14px;
    margin:0;
}

.quote::before{
    content:'“';
    font-size:40px;
    position:absolute;
    left:0;
    top:-6px;
    color:#e6f6ed;
    font-weight:700;
}

.author{
    font-weight:700;
    color:#2f855a;
    font-size:14px;
}

@media(max-width:900px){
    .testimonials{
        grid-template-columns:repeat(2,1fr);
    }
}

@media(max-width:520px){
    .testimonials{
        grid-template-columns:1fr;
    }
}

/* ===== FOOTER ===== */
footer{
    text-align:center;
    margin-top:70px;
    color:#777;
    padding-top:18px;
    border-top:1px solid #eef5f3;
    position:relative;
}

.admin-login-link{
    position:absolute;
    bottom:10px;
    right:10px;
    width:32px;
    height:32px;
    display:flex;
    align-items:center;
    justify-content:center;
    text-decoration:none;
    font-size:16px;
    opacity:0.3;
    transition:all 0.3s ease;
    border-radius:8px;
    background:rgba(111,207,151,0.1);
}

.admin-login-link:hover{
    opacity:0.7;
    background:rgba(111,207,151,0.2);
    transform:scale(1.1);
}

/* ===== ANIMATIONS ===== */
@keyframes fadeUp{
    from{
        opacity:0;
        transform:translateY(20px);
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
@media(max-width:900px){
    .container{
        padding:24px;
    }
    .navbar{
        flex-direction:column;
        align-items:flex-start;
        gap:14px;
        margin-bottom:28px;
    }
    .nav-menu{
        width:100%;
        flex-wrap:wrap;
        gap:10px;
    }
    .nav-menu a{
        font-size:14px;
    }
    .nav-menu .btn{
        margin-left:auto;
    }
    .hero{
        flex-direction:column;
        text-align:center;
        justify-content:center;
        padding:48px 32px;
        min-height:auto;
    }
    .hero-content{
        margin-bottom:30px;
        text-align:center;
        max-width:100%;
    }
    .hero-content h2{
        font-size:28px;
        text-align:center;
    }
    .hero-content p{
        text-align:center;
        max-width:100%;
    }
    .hero-actions{
        justify-content:center;
        flex-wrap:wrap;
        width:100%;
    }
    .hero-actions .btn{
        flex:1;
        min-width:200px;
    }
    .features{
        grid-template-columns:repeat(2,1fr);
    }
    section{
        margin-top:72px;
    }
    #diagnosa{
        padding:24px;
    }
}

@media(max-width:500px){
    .container{
        padding:16px;
    }
    .logo-text{
        font-size:18px;
    }
    .navbar{
        padding:12px 0;
        align-items:stretch;
    }
    .menu-toggle{
        display:inline-flex;
        align-items:center;
        justify-content:center;
        align-self:flex-end;
    }
    .nav-menu{
        display:none;
        grid-template-columns:1fr 1fr;
        width:100%;
    }
    .nav-menu.open{
        display:grid;
    }
    .nav-menu a{
        text-align:center;
        padding:8px 6px;
        border-radius:8px;
        background:#fff;
        border:1px solid #eef5f3;
    }
    .nav-menu .btn{
        grid-column:1 / -1;
        width:100%;
        margin-left:0;
    }
    .hero{
        padding:28px 18px 32px;
        gap:20px;
        border-radius:18px;
    }
    .features{
        grid-template-columns:1fr;
    }
    .hero-content h2{
        font-size:22px;
    }
    .hero-image img{
        max-width:320px;
        width:100%;
    }
    .hero-actions{
        width:100%;
        flex-direction:column;
    }
    .hero-actions .btn{
        width:100%;
        min-width:unset;
    }
    section{
        margin-top:56px;
    }
    section > p{
        font-size:15px;
        margin-bottom:24px;
    }
    .card.feature{
        padding:22px 18px;
        min-height:unset;
    }
    footer{
        margin-top:44px;
        padding-bottom:42px;
    }
    .admin-login-link{
        bottom:2px;
        right:2px;
    }
}
</style>
</head>

<body>
<div class="container">

<!-- NAVBAR -->
<div class="navbar">
    <div class="logo">
        <div class="logo-icon">🐾</div>
        <div class="logo-text">PawMedic</div>
    </div>
    <button class="menu-toggle" id="menuToggle" aria-label="Buka menu">☰</button>
    <div class="nav-menu" id="navMenu">
        <a href="#fitur">Fitur</a>
        <a href="#cara">Cara Kerja</a>
        <a href="{{ route('ulasan') }}">Ulasan</a>
        <a href="{{ route('faq') }}">FAQ</a>
        <a href="{{ route('biodata') }}" class="btn" style="padding:10px 20px; font-size:14px;">Mulai Diagnosis</a>
    </div>
</div>

<!-- HERO -->
<section class="hero">
    <div class="hero-content">
        <h2>Bantu Jaga Kesehatan Kucing Anda</h2>
        <p>
            PawMedic adalah aplikasi sistem pakar yang membantu pemilik kucing
            memahami gejala dan mendapatkan rekomendasi perawatan awal dengan mudah dan cepat.
        </p>
        <div class="hero-actions">
            <a href="{{ route('biodata') }}" class="btn">
                <span>Mulai Diagnosis</span>
                <span>🐾</span>
            </a>
            <button class="btn secondary" onclick="scrollToSection('fitur')">Pelajari Lebih Lanjut</button>
        </div>
    </div>
    <div class="hero-image">
        <img src="{{ asset('img/ucing.png') }}" alt="Ilustrasi Kucing">
    </div>
</section>
    

<!-- FITUR -->
<section id="fitur">
    <h2>Fitur Utama</h2>
    <p>Alat yang dirancang untuk membantu pemilik kucing memahami kondisi hewan peliharaan mereka</p>
    <div class="features">
        <div class="card feature">
            <h3>🩺 Konsultasi Cepat</h3>
            <p>Memberikan gambaran awal kondisi kesehatan kucing secara cepat dan mudah</p>
        </div>
        <div class="card feature">
            <h3>🔍 Diagnosis Gejala</h3>
            <p>Menganalisis gejala menggunakan basis pengetahuan sistem pakar</p>
        </div>
        <div class="card feature">
            <h3>🚑 Penanganan Awal</h3>
            <p>Panduan langkah awal sebelum konsultasi ke dokter hewan</p>
        </div>
        <div class="card feature">
            <h3>🐾 Tips Perawatan</h3>
            <p>Menyediakan saran perawatan dasar untuk kucing sehari-hari</p>
        </div>
    </div>
</section>

<!-- CARA KERJA -->
<section id="cara">
    <h2>Cara Kerja</h2>
    <div class="features">
        <div class="card feature">
            <h3>Pilih Gejala</h3>
            <p>Pemilik kucing memilih gejala yang sesuai dengan kondisi kucing berdasarkan pengamatan sehari-hari.</p>
        </div>
        <div class="card feature">
            <h3>Analisis Sistem</h3>
            <p>Sistem memproses data gejala yang dipilih menggunakan metode sistem pakar untuk menghasilkan diagnosis.</p>
        </div>
        <div class="card feature">
            <h3>Hasil Diagnosa</h3>
            <p>Sistem menampilkan hasil diagnosis beserta saran perawatan dan penanganan awal yang sesuai.</p>
        </div>
    </div>
</section>

<!-- DIAGNOSA / TESTIMONIALS -->
<section id="diagnosa">
    <h2>Ulasan Pengguna</h2>
    <p>Pengalaman para pemilik kucing yang telah menggunakan PawMedic.</p>
    <p style="margin-top:12px;">
        <a href="{{ route('ulasan') }}" style="color:var(--primary-dark); font-weight:600; text-decoration:none; border-bottom:2px solid var(--primary); padding-bottom:2px;">
            Lihat Semua Ulasan →
        </a>
    </p>
    <div class="testimonials">
    @foreach($ulasan as $item)
    <div class="card testimonial">
        <div class="testimonial-head">
            <div class="avatar">
                {{ strtoupper(substr($item->nama, 0, 1)) }}
            </div>
            <div class="meta">
                <div class="rating">
                    {{ str_repeat('★', $item->rating) }}
                </div>
                <div class="author">
                    {{ $item->nama }} — pemilik dari <em>{{ $item->nama_kucing }}</em>
                </div>
            </div>
        </div>
        <p class="quote">{{ $item->komentar }}</p>
    </div>
    @endforeach
</div>
</section>

<!-- FOOTER -->
<footer>
    <p>© 2026 PawMedic</p>
    <p>Email: support@pawmedic.app</p>
    <a href="{{ route('admin.login') }}" class="admin-login-link" title="Admin Login">🔐</a>
</footer>

</div>

<script>
function scrollToSection(id){
    document.getElementById(id).scrollIntoView({
        behavior:'smooth'
    });
}

const menuToggle = document.getElementById('menuToggle');
const navMenu = document.getElementById('navMenu');
if (menuToggle && navMenu) {
    menuToggle.addEventListener('click', () => {
        navMenu.classList.toggle('open');
        menuToggle.textContent = navMenu.classList.contains('open') ? '✕' : '☰';
    });
}
</script>

</body>
</html>
