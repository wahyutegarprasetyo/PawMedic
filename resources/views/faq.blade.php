<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>FAQ - PawMedic</title>
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
    max-width:900px;
    margin:0 auto;
    padding:40px 0;
    position:relative;
    z-index:1;
}

.header{
    text-align:center;
    margin-bottom:50px;
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
    font-size:clamp(1.8rem, 4vw, 2.6rem);
    font-weight:800;
    color:var(--text-dark);
    margin:20px 0 12px;
    letter-spacing:-0.02em;
}

.header p{
    color:var(--text-muted);
    font-size:17px;
    margin:0;
}

.faq-card{
    background:rgba(255,255,255,0.95);
    backdrop-filter:blur(20px);
    border-radius:24px;
    padding:40px;
    box-shadow:0 20px 60px rgba(17,77,58,0.12);
    border:1px solid rgba(111,207,151,0.15);
    margin-bottom:24px;
    animation:fadeUp 0.6s ease backwards;
}

.faq-card:nth-child(1){animation-delay:0.1s;}
.faq-card:nth-child(2){animation-delay:0.2s;}
.faq-card:nth-child(3){animation-delay:0.3s;}
.faq-card:nth-child(4){animation-delay:0.4s;}
.faq-card:nth-child(5){animation-delay:0.5s;}
.faq-card:nth-child(n+6){animation-delay:0.6s;}

.faq-question{
    font-family:var(--ff-heading);
    font-size:18px;
    font-weight:700;
    color:var(--text-dark);
    margin-bottom:12px;
    display:flex;
    align-items:center;
    gap:12px;
    cursor:pointer;
    user-select:none;
}

.faq-question::before{
    content:'❓';
    font-size:24px;
    flex-shrink:0;
}

.faq-answer{
    color:var(--text-muted);
    line-height:1.8;
    font-size:15px;
    max-height:0;
    overflow:hidden;
    transition:max-height 0.3s ease, padding 0.3s ease;
    padding:0;
}

.faq-card.active .faq-answer{
    max-height:500px;
    padding-top:12px;
}

.faq-card.active .faq-question::before{
    content:'✅';
}

.back-btn{
    margin-bottom:30px;
    display:inline-flex;
    align-items:center;
    gap:8px;
    color:var(--text-muted);
    text-decoration:none;
    font-weight:600;
    transition:all 0.3s ease;
}

.back-btn:hover{
    color:var(--primary-dark);
    transform:translateX(-4px);
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
    .faq-card{
        padding:28px 24px;
    }
}
</style>
</head>

<body>
<div class="container">
    <a href="/" class="back-btn">
        ← Kembali ke Beranda
    </a>

    <div class="header">
        <a href="/" class="logo-link">
            <div class="logo-icon">🐾</div>
            <div class="logo-text">PawMedic</div>
        </a>
        <h1>Pertanyaan Umum</h1>
        <p>Temukan jawaban untuk pertanyaan yang sering diajukan</p>
    </div>

    <div class="faq-list">
        <div class="faq-card">
            <div class="faq-question">Apa itu PawMedic?</div>
            <div class="faq-answer">
                PawMedic adalah aplikasi sistem pakar yang membantu pemilik kucing memahami gejala dan mendapatkan rekomendasi perawatan awal. Aplikasi ini menggunakan metode sistem pakar untuk menganalisis gejala yang dipilih dan memberikan diagnosis kemungkinan penyakit.
            </div>
        </div>

        <div class="faq-card">
            <div class="faq-question">Bagaimana cara menggunakan PawMedic?</div>
            <div class="faq-answer">
                Cara menggunakan PawMedic sangat mudah:
                <ol style="margin:12px 0; padding-left:20px;">
                    <li>Isi biodata kucing Anda</li>
                    <li>Pilih gejala yang Anda amati pada kucing</li>
                    <li>Sistem akan menganalisis dan memberikan hasil diagnosis</li>
                    <li>Baca rekomendasi perawatan yang diberikan</li>
                </ol>
            </div>
        </div>

        <div class="faq-card">
            <div class="faq-question">Apakah hasil diagnosis akurat?</div>
            <div class="faq-answer">
                Hasil diagnosis dari PawMedic adalah sebagai panduan awal berdasarkan gejala yang Anda pilih. Untuk diagnosis yang akurat dan penanganan yang tepat, sangat disarankan untuk berkonsultasi langsung dengan dokter hewan profesional. PawMedic tidak menggantikan konsultasi medis profesional.
            </div>
        </div>

        <div class="faq-card">
            <div class="faq-question">Apakah data saya aman?</div>
            <div class="faq-answer">
                Ya, data yang Anda masukkan hanya digunakan untuk keperluan diagnosis dan tidak dibagikan kepada pihak ketiga. Semua data disimpan secara lokal di browser Anda (sessionStorage) dan tidak dikirim ke server kecuali untuk keperluan analisis diagnosis.
            </div>
        </div>

        <div class="faq-card">
            <div class="faq-question">Berapa banyak gejala yang harus dipilih?</div>
            <div class="faq-answer">
                Anda dapat memilih sebanyak mungkin gejala yang sesuai dengan kondisi kucing Anda. Semakin banyak gejala yang dipilih, semakin akurat diagnosis yang akan diberikan. Namun, pastikan gejala yang dipilih benar-benar Anda amati pada kucing.
            </div>
        </div>

        <div class="faq-card">
            <div class="faq-question">Apakah aplikasi ini gratis?</div>
            <div class="faq-answer">
                Ya, PawMedic sepenuhnya gratis untuk digunakan. Anda dapat melakukan diagnosis tanpa batas dan mengakses semua fitur yang tersedia tanpa biaya apapun.
            </div>
        </div>

        <div class="faq-card">
            <div class="faq-question">Bagaimana jika kucing saya dalam kondisi darurat?</div>
            <div class="faq-answer">
                Jika kucing Anda menunjukkan tanda-tanda darurat seperti kesulitan bernapas, kejang, tidak sadar, atau luka parah, segera bawa ke dokter hewan terdekat atau klinik hewan darurat. Jangan menunggu diagnosis dari aplikasi ini.
            </div>
        </div>
    </div>
</div>

@include('components.scroll-top')

<script>
document.querySelectorAll('.faq-question').forEach(question => {
    question.addEventListener('click', function() {
        const card = this.parentElement;
        const isActive = card.classList.contains('active');
        
        // Close all other cards
        document.querySelectorAll('.faq-card').forEach(c => {
            c.classList.remove('active');
        });
        
        // Toggle current card
        if (!isActive) {
            card.classList.add('active');
        }
    });
});
</script>

</body>
</html>
