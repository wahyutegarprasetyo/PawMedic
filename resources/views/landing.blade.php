<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>PawMedic - Sistem Pakar Kucing</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700;800&family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
<link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">

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
    overflow-x:hidden;
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
.navbar-custom{
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
    color:#fff;
}
.paw-inline{
    width:20px;
    height:20px;
    display:inline-block;
    fill:currentColor;
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
    background:#f1f5f9;
}

/* ===== BUTTON (Modern Elegant) ===== */
.btn{
    border-radius:12px;
    font-weight:600;
    transition:all .25s ease;
    letter-spacing:.01em;
}
.btn-nav-cta{
    background:linear-gradient(135deg,#66cf94,#42b777) !important;
    color:#fff !important;
    border:1px solid #46b97a;
    box-shadow:0 8px 18px rgba(66,183,119,.22);
    font-size:14px;
}
.btn-nav-cta:hover{
    transform:translateY(-1px) scale(1.01);
    box-shadow:0 10px 20px rgba(66,183,119,.3);
    color:rgb(75, 75, 75) !important;
    background:rgb(255, 255, 255) !important;
}
.btn-hero-primary{
    background:linear-gradient(135deg,#69d29a 0%,#40b674 100%);
    color:#fff !important;
    border:1px solid #49bb7d;
    box-shadow:0 10px 24px rgba(64,182,116,.25);
    padding:12px 24px;
    font-size:17px;
    border-radius:13px;
}
.btn-hero-primary:hover{
    transform:translateY(-2px);
    box-shadow:0 14px 28px rgba(64,182,116,.31);
    color:#fff !important;
}
.btn-hero-secondary{
    background:rgba(255,255,255,.7);
    color:#1d7a4f !important;
    border:1.5px solid rgba(73,187,125,.55);
    backdrop-filter:blur(4px);
    box-shadow:0 6px 16px rgba(17,77,58,.08);
    padding:12px 24px;
    font-size:17px;
    border-radius:13px;
}
.btn-hero-secondary:hover{
    background:#fff;
    border-color:#46b97a;
    transform:translateY(-1px);
    box-shadow:0 10px 20px rgba(17,77,58,.11);
}
.btn-mobile-cta{
    background:linear-gradient(135deg,#67d098,#41b775);
    color:#fff !important;
    border:1px solid #49bb7d;
    box-shadow:0 10px 24px rgba(17,77,58,.25);
    font-size:16px;
    font-weight:700;
}
.btn-mobile-cta:hover{
    color:#fff !important;
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
    display:flex;
    align-items:center;
    justify-content:center;
    gap:8px;
}
.card.feature h3 i{
    color:#4bb66f;
}
.card.feature p{
    font-size:15px;
    line-height:1.7;
    color:#64748b;
    margin:0;
    word-break:break-word;
}

.hero-image{
    display:flex;
    align-items:center;
    justify-content:center;
    flex-shrink:0;
    margin:0 auto;
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

.mobile-cta{
    display:none;
}

/* Scroll reveal fallback (tanpa library eksternal) */
[data-aos]{
    opacity:0;
    transform:translateY(20px);
    transition:opacity .7s ease, transform .7s ease;
}
[data-aos].aos-show{
    opacity:1;
    transform:translateY(0);
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
    .navbar-custom{
        flex-direction:column;
        align-items:flex-start;
        gap:14px;
        margin-bottom:28px;
    }
    .nav-menu{width:100%;}
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
        padding:34px 24px;
        min-height:auto;
        gap:22px;
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
    .hero-image img{
        max-width:360px;
        width:100%;
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
        padding:12px;
    }
    .logo-text{
        font-size:18px;
    }
    .navbar-custom{
        padding:12px 0;
        align-items:stretch;
        margin-bottom:20px;
    }
    .navbar-toggler{
        border-radius:10px;
        border:1px solid #d1d5db;
        padding:6px 10px;
    }
    .nav-menu{
        width:100%;
        padding:10px 0;
    }
    .nav-menu a{
        display:block;
        text-align:left;
        padding:10px 8px;
        border-radius:8px;
        background:#fff;
        border:1px solid #eef5f3;
        font-size:14px;
        margin-bottom:8px;
    }
    .nav-menu .btn{
        width:100%;
        margin-left:0;
    }
    .hero{
        padding:20px 12px 18px;
        gap:14px;
        border-radius:14px;
    }
    .features{
        grid-template-columns:1fr;
    }
    .hero-content h2{
        font-size:20px;
        line-height:1.3;
        margin-bottom:10px;
    }
    .hero-content p{
        font-size:14px;
        line-height:1.65;
        margin-bottom:16px;
    }
    .hero-image img{
        max-width:220px;
        width:100%;
    }
    .hero-actions{
        width:100%;
        flex-direction:column;
    }
    .hero-actions .btn{
        width:100%;
        min-width:unset;
        padding-top:10px;
        padding-bottom:10px;
        font-size:15px;
    }
    section{
        margin-top:34px;
    }
    section > p{
        font-size:15px;
        margin-bottom:18px;
        line-height:1.6;
    }
    section h2{
        font-size:24px;
        margin-bottom:10px;
    }
    .card.feature{
        padding:18px 14px;
        min-height:unset;
        border-radius:12px;
    }
    .card.feature h3{
        font-size:17px;
        line-height:1.35;
    }
    .card.feature p{
        font-size:14px;
    }
    #diagnosa{
        padding:16px 12px;
        margin-top:28px;
        border-radius:10px;
    }
    .testimonials{
        gap:12px;
    }
    .card.testimonial{
        padding:14px;
    }
    .quote{
        font-size:14px;
    }
    footer{
        margin-top:30px;
        padding-bottom:86px;
        font-size:13px;
    }
    .admin-login-link{
        bottom:2px;
        right:2px;
    }
    .mobile-cta{
        display:none !important;
    }
    .mobile-cta .btn{
        width:100%;
        border-radius:12px;
        font-size:15px;
        padding:12px 14px;
    }
}
</style>
</head>

<body>
<div class="container">

<!-- NAVBAR -->
<div class="navbar-custom navbar navbar-expand-md">
    <div class="logo">
        <div class="logo-icon" aria-hidden="true">
            <svg class="paw-inline" viewBox="0 0 24 24">
                <circle cx="6" cy="8" r="2.2"></circle>
                <circle cx="10.8" cy="5.6" r="2.1"></circle>
                <circle cx="15.8" cy="8" r="2.2"></circle>
                <path d="M12 10.6c-3.4 0-5.9 2.4-5.9 4.9 0 2.2 1.8 3.9 4 3.9 1.4 0 1.9-.7 2-.7s.6.7 2 .7c2.2 0 4-1.7 4-3.9 0-2.6-2.6-4.9-6.1-4.9z"></path>
            </svg>
        </div>
        <div class="logo-text">PawMedic</div>
    </div>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu" aria-controls="navMenu" aria-expanded="false" aria-label="Buka menu">
        ☰
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navMenu">
        <div class="nav-menu d-md-flex align-items-center gap-2">
            <a href="#fitur">Fitur</a>
            <a href="#cara">Cara Kerja</a>
            <a href="{{ route('ulasan') }}">Ulasan</a>
            <a href="{{ route('faq') }}">FAQ</a>
            <a href="{{ route('biodata') }}" class="btn btn-nav-cta px-3">Mulai Diagnosis</a>
        </div>
    </div>
</div>

<!-- HERO -->
<section class="hero" data-aos="fade-up">
    <div class="hero-content">
        <h2>Bantu Jaga Kesehatan Kucing Anda</h2>
        <p>
            PawMedic adalah aplikasi sistem pakar yang membantu pemilik kucing
            memahami gejala dan mendapatkan rekomendasi perawatan awal dengan mudah dan cepat.
        </p>
        <div class="hero-actions">
            <a href="{{ route('biodata') }}" class="btn btn-hero-primary btn-lg">
                <span>Mulai Diagnosis</span>
                <span>
                    <svg class="paw-inline" viewBox="0 0 24 24">
                        <circle cx="6" cy="8" r="2.2"></circle>
                        <circle cx="10.8" cy="5.6" r="2.1"></circle>
                        <circle cx="15.8" cy="8" r="2.2"></circle>
                        <path d="M12 10.6c-3.4 0-5.9 2.4-5.9 4.9 0 2.2 1.8 3.9 4 3.9 1.4 0 1.9-.7 2-.7s.6.7 2 .7c2.2 0 4-1.7 4-3.9 0-2.6-2.6-4.9-6.1-4.9z"></path>
                    </svg>
                </span>
            </a>
            <button class="btn btn-hero-secondary btn-lg" onclick="scrollToSection('fitur')">Pelajari Lebih Lanjut</button>
        </div>
    </div>
    <div class="hero-image">
        <img src="{{ asset('img/ucing.png') }}" alt="Ilustrasi Kucing">
    </div>
</section>
    

<!-- FITUR -->
<section id="fitur" data-aos="fade-up">
    <h2>Fitur Utama</h2>
    <p>Alat yang dirancang untuk membantu pemilik kucing memahami kondisi hewan peliharaan mereka</p>
    <div class="features">
        <div class="card feature" data-aos="zoom-in" data-aos-delay="100">
            <h3><i class="bi bi-heart-pulse"></i> Konsultasi Cepat</h3>
            <p>Memberikan gambaran awal kondisi kesehatan kucing secara cepat dan mudah</p>
        </div>
        <div class="card feature" data-aos="zoom-in" data-aos-delay="200">
            <h3><i class="bi bi-search"></i> Diagnosis Gejala</h3>
            <p>Menganalisis gejala menggunakan basis pengetahuan sistem pakar</p>
        </div>
        <div class="card feature" data-aos="zoom-in" data-aos-delay="300">
            <h3><i class="bi bi-shield-check"></i> Penanganan Awal</h3>
            <p>Panduan langkah awal sebelum konsultasi ke dokter hewan</p>
        </div>
        <div class="card feature" data-aos="zoom-in" data-aos-delay="400">
            <h3><i class="bi bi-stars"></i> Tips Perawatan</h3>
            <p>Menyediakan saran perawatan dasar untuk kucing sehari-hari</p>
        </div>
    </div>
</section>

<!-- CARA KERJA -->
<section id="cara" data-aos="fade-up">
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
<section id="diagnosa" data-aos="fade-up">
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
    <p>Email: wahyutegar506041@gmail.com</p>
    <a href="{{ route('admin.login') }}" class="admin-login-link" title="Admin Login"><i class="bi bi-lock-fill"></i></a>
</footer>

</div>

<div class="mobile-cta">
    <a href="{{ route('biodata') }}" class="btn btn-mobile-cta btn-lg">
        <svg class="paw-inline" viewBox="0 0 24 24">
            <circle cx="6" cy="8" r="2.2"></circle>
            <circle cx="10.8" cy="5.6" r="2.1"></circle>
            <circle cx="15.8" cy="8" r="2.2"></circle>
            <path d="M12 10.6c-3.4 0-5.9 2.4-5.9 4.9 0 2.2 1.8 3.9 4 3.9 1.4 0 1.9-.7 2-.7s.6.7 2 .7c2.2 0 4-1.7 4-3.9 0-2.6-2.6-4.9-6.1-4.9z"></path>
        </svg>
        Mulai Diagnosis
    </a>
</div>

<script>
function scrollToSection(id){
    document.getElementById(id).scrollIntoView({
        behavior:'smooth'
    });
}
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
const reveals = document.querySelectorAll('[data-aos]');
if ('IntersectionObserver' in window) {
    const observer = new IntersectionObserver((entries, obs) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('aos-show');
                obs.unobserve(entry.target);
            }
        });
    }, { threshold: 0.12 });
    reveals.forEach(el => observer.observe(el));
} else {
    reveals.forEach(el => el.classList.add('aos-show'));
}
</script>

</body>
</html>
