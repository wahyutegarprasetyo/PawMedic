<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Memproses Diagnosis - PawMedic</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700;800&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
<link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">

<style>
:root{
    --ff-heading: 'Poppins', system-ui, -apple-system, 'Segoe UI', Roboto, 'Helvetica Neue', Arial;
    --ff-body: 'Inter', system-ui, -apple-system, 'Segoe UI', Roboto, 'Helvetica Neue', Arial;
    --primary: #6fcf97;
    --primary-dark: #4bb66f;
    --primary-light: #e8f7ef;
    --text-dark: #114d3a;
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
    display:flex;
    align-items:center;
    justify-content:center;
    padding:20px;
    overflow:hidden;
}

.container{
    text-align:center;
    position:relative;
    z-index:1;
}

.logo{
    display:inline-flex;
    align-items:center;
    gap:12px;
    margin-bottom:40px;
    animation:fadeDown 0.6s ease;
}

.logo-icon{
    width:60px;
    height:60px;
    background:linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
    border-radius:16px;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:28px;
    color:#fff;
    box-shadow:0 8px 24px rgba(111,207,151,0.3);
    animation:logoFloat 3s ease-in-out infinite;
}

@keyframes logoFloat{
    0%, 100%{transform:translateY(0px) rotate(0deg);}
    50%{transform:translateY(-10px) rotate(5deg);}
}

.logo-text{
    font-size:28px;
    font-weight:700;
    font-family:var(--ff-heading);
    color:var(--text-dark);
}

.loading-card{
    background:rgba(255,255,255,0.95);
    backdrop-filter:blur(20px);
    border-radius:32px;
    padding:60px 50px;
    box-shadow:
        0 25px 80px rgba(17,77,58,0.15),
        0 0 0 1px rgba(111,207,151,0.1);
    border:1px solid rgba(111,207,151,0.2);
    max-width:500px;
    margin:0 auto;
    animation:fadeUp 0.8s ease;
}

.loading-card::before{
    content:'';
    position:absolute;
    inset:0;
    background:linear-gradient(120deg, transparent 25%, rgba(255,255,255,0.38) 50%, transparent 75%);
    transform:translateX(-120%);
    animation:cardShine 2.2s ease-in-out infinite;
    pointer-events:none;
}

@keyframes cardShine{
    0%{transform:translateX(-120%);}
    100%{transform:translateX(120%);}
}

.bootstrap-loader{
    width:80px;
    height:80px;
    margin:0 auto 22px;
    display:flex;
    align-items:center;
    justify-content:center;
}

.bootstrap-loader .spinner-border{
    width:3.5rem;
    height:3.5rem;
    border:0.35em solid #d1fae5;
    border-right-color:#4bb66f;
    border-top-color:#6fcf97;
    border-radius:50%;
    animation:spin 0.8s linear infinite;
}

.progress-wrap{
    margin-top:18px;
    margin-bottom:10px;
}

.progress-track{
    width:100%;
    height:8px;
    background:#e2f6ea;
    border-radius:999px;
    overflow:hidden;
}

.progress-bar{
    width:0%;
    height:100%;
    background:linear-gradient(90deg,#6fcf97,#4bb66f);
    border-radius:999px;
    transition:width 0.45s ease;
}

h1{
    font-family:var(--ff-heading);
    font-size:32px;
    font-weight:800;
    color:var(--text-dark);
    margin-bottom:16px;
    letter-spacing:-0.02em;
}

p{
    color:#64748b;
    font-size:17px;
    margin-bottom:40px;
}

.loader{
    width:80px;
    height:80px;
    margin:0 auto 30px;
    position:relative;
}

.loader-circle{
    width:100%;
    height:100%;
    border:6px solid var(--primary-light);
    border-top-color:var(--primary);
    border-right-color:var(--primary-dark);
    border-radius:50%;
    animation:spin 1s linear infinite;
    position:relative;
}

.loader-circle::before{
    content:'';
    position:absolute;
    top:50%;
    left:50%;
    width:50%;
    height:50%;
    border:4px solid transparent;
    border-top-color:var(--primary-dark);
    border-radius:50%;
    transform:translate(-50%, -50%);
    animation:spin 0.5s linear infinite reverse;
}

@keyframes spin{
    to{transform:rotate(360deg);}
}

.loading-dots{
    display:flex;
    gap:8px;
    justify-content:center;
    margin-top:20px;
}

.dot{
    width:12px;
    height:12px;
    background:var(--primary);
    border-radius:50%;
    animation:dotBounce 1.4s ease-in-out infinite;
}

.dot:nth-child(1){animation-delay:0s;}
.dot:nth-child(2){animation-delay:0.2s;}
.dot:nth-child(3){animation-delay:0.4s;}

@keyframes dotBounce{
    0%, 80%, 100%{transform:translateY(0) scale(1); opacity:0.7;}
    40%{transform:translateY(-20px) scale(1.2); opacity:1;}
}

.status-text{
    font-size:15px;
    color:var(--text-dark);
    font-weight:600;
    margin-top:20px;
    animation:pulse 2s ease infinite;
}

.progress-label{
    margin-top:8px;
    font-size:13px;
    color:#4b5563;
    font-weight:600;
}

@keyframes pulse{
    0%, 100%{opacity:1;}
    50%{opacity:0.6;}
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

.particles{
    position:fixed;
    top:0;
    left:0;
    width:100%;
    height:100%;
    pointer-events:none;
    z-index:0;
}

.particle{
    position:absolute;
    width:4px;
    height:4px;
    background:var(--primary);
    border-radius:50%;
    opacity:0.3;
    animation:float 15s infinite;
}

.particle:nth-child(1){left:10%; animation-delay:0s; animation-duration:12s;}
.particle:nth-child(2){left:20%; animation-delay:2s; animation-duration:15s;}
.particle:nth-child(3){left:30%; animation-delay:4s; animation-duration:18s;}
.particle:nth-child(4){left:40%; animation-delay:1s; animation-duration:14s;}
.particle:nth-child(5){left:50%; animation-delay:3s; animation-duration:16s;}
.particle:nth-child(6){left:60%; animation-delay:5s; animation-duration:13s;}
.particle:nth-child(7){left:70%; animation-delay:2.5s; animation-duration:17s;}
.particle:nth-child(8){left:80%; animation-delay:4.5s; animation-duration:15s;}
.particle:nth-child(9){left:90%; animation-delay:1.5s; animation-duration:19s;}

@keyframes float{
    0%{
        transform:translateY(100vh) translateX(0);
        opacity:0;
    }
    10%{
        opacity:0.3;
    }
    90%{
        opacity:0.3;
    }
    100%{
        transform:translateY(-100px) translateX(50px);
        opacity:0;
    }
}

@media (max-width:576px) and (orientation:portrait){
    .container{padding:14px 10px;}
    .logo{margin-bottom:14px;}
    .logo-icon{width:38px;height:38px;}
    .logo-text{font-size:18px;}
    .loading-card{padding:18px 14px;border-radius:14px;}
    h1{font-size:1.35rem;margin-bottom:10px;}
    p{font-size:14px;margin-bottom:16px;}
    .bootstrap-loader .spinner-border{width:2.6rem;height:2.6rem;}
    .status-text,.progress-label{font-size:13px;}
}
</style>
</head>

<body>
<div class="particles">
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>
</div>

<div class="container">
    <div class="logo">
        <div class="logo-icon" aria-hidden="true">
            <svg viewBox="0 0 24 24" width="22" height="22" fill="currentColor">
                <circle cx="6" cy="8" r="2.2"></circle>
                <circle cx="10.8" cy="5.6" r="2.1"></circle>
                <circle cx="15.8" cy="8" r="2.2"></circle>
                <path d="M12 10.6c-3.4 0-5.9 2.4-5.9 4.9 0 2.2 1.8 3.9 4 3.9 1.4 0 1.9-.7 2-.7s.6.7 2 .7c2.2 0 4-1.7 4-3.9 0-2.6-2.6-4.9-6.1-4.9z"></path>
            </svg>
        </div>
        <div class="logo-text">PawMedic</div>
    </div>
    
    <div class="loading-card">
        <h1>Memproses Diagnosis</h1>
        <p>Sedang menganalisis gejala yang Anda pilih...</p>
        
        <div class="bootstrap-loader">
            <div class="spinner-border" role="status" aria-label="Loading"></div>
        </div>
        
        <div class="loading-dots">
            <div class="dot"></div>
            <div class="dot"></div>
            <div class="dot"></div>
        </div>
        
        <div class="progress-wrap">
            <div class="progress-track">
                <div class="progress-bar" id="progressBar"></div>
            </div>
        </div>
        <div class="progress-label" id="progressLabel">0%</div>
        <div class="status-text" id="statusText">Menganalisis data gejala...</div>
    </div>
</div>

<script>
const statusMessages = [
    'Menganalisis data gejala...',
    'Memproses dengan sistem pakar...',
    'Menghitung probabilitas penyakit...',
    'Menyusun rekomendasi perawatan...',
    'Hampir selesai...'
];

let currentStatus = 0;
const statusText = document.getElementById('statusText');
const progressBar = document.getElementById('progressBar');
const progressLabel = document.getElementById('progressLabel');
let progress = 0;

// status text
setInterval(() => {
    currentStatus = (currentStatus + 1) % statusMessages.length;
    statusText.textContent = statusMessages[currentStatus];
}, 2000);

// progress animation
const progressTimer = setInterval(() => {
    if (progress < 92) {
        progress += Math.random() * 4;
    } else if (progress < 97) {
        progress += Math.random() * 1.2;
    }

    progress = Math.min(progress, 97);
    const rounded = Math.floor(progress);
    progressBar.style.width = rounded + '%';
    progressLabel.textContent = rounded + '%';
}, 220);

// 🔥 AMBIL DATA DARI LOCAL STORAGE
const gejala = JSON.parse(localStorage.getItem('gejala'));

// VALIDASI
if (!gejala || gejala.length === 0) {
    window.location.href = '/cek-penyakit';
}

// KIRIM KE LARAVEL
const form = document.createElement('form');
form.method = 'POST';
form.action = '/diagnosis/proses';

// CSRF
let csrf = document.createElement('input');
csrf.type = 'hidden';
csrf.name = '_token';
csrf.value = '{{ csrf_token() }}';
form.appendChild(csrf);

// DATA GEJALA
gejala.forEach(g => {
    let input = document.createElement('input');
    input.type = 'hidden';
    input.name = 'gejala[]';
    input.value = g;
    form.appendChild(input);
});

document.body.appendChild(form);

// SUBMIT SETELAH LOADING
setTimeout(() => {
    progressBar.style.width = '100%';
    progressLabel.textContent = '100%';
    clearInterval(progressTimer);
    form.submit();
}, 4600);
</script>

</body>
</html>
