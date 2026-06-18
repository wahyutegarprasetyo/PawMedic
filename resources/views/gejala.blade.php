<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Pilih Gejala - PawMedic</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700;800&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
<link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">

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
    --success: #10b981;
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
        radial-gradient(circle at 80% 80%, rgba(111,207,151,0.08) 0%, transparent 60%),
        radial-gradient(circle at 40% 20%, rgba(79,172,254,0.08) 0%, transparent 60%),
        radial-gradient(circle at 60% 60%, rgba(139,92,246,0.05) 0%, transparent 50%);
    pointer-events:none;
    z-index:0;
    animation:backgroundShift 20s ease infinite;
}

body::after{
    content:'';
    position:fixed;
    top:0;
    left:0;
    right:0;
    bottom:0;
    background-image:
        url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%236fcf97' fill-opacity='0.03'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    pointer-events:none;
    z-index:0;
    opacity:0.4;
}

@keyframes backgroundShift{
    0%, 100%{transform:translate(0, 0) scale(1);}
    33%{transform:translate(20px, -20px) scale(1.05);}
    66%{transform:translate(-20px, 20px) scale(0.95);}
}

.container{
    max-width:1100px;
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

.header p{
    color:var(--text-muted);
    font-size:16px;
    margin:0;
}

.progress-container{
    max-width:400px;
    margin:24px auto 0;
    background:white;
    padding:20px 24px;
    border-radius:16px;
    box-shadow:0 4px 20px rgba(17,77,58,0.08);
}

.progress-bar{
    width:100%;
    height:8px;
    background:#e8f7ef;
    border-radius:10px;
    margin:12px 0 0;
    overflow:hidden;
    position:relative;
}

.progress-fill{
    height:100%;
    background:linear-gradient(90deg, var(--primary) 0%, var(--primary-dark) 100%);
    border-radius:10px;
    transition:width 0.5s cubic-bezier(0.4, 0, 0.2, 1);
    width:66%;
    position:relative;
    overflow:hidden;
}

.progress-fill::after{
    content:'';
    position:absolute;
    top:0;
    left:0;
    right:0;
    bottom:0;
    background:linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
    animation:shimmer 2s infinite;
}

@keyframes shimmer{
    0%{transform:translateX(-100%);}
    100%{transform:translateX(100%);}
}

.progress-text{
    font-size:13px;
    color:var(--text-muted);
    font-weight:600;
    text-align:center;
    margin-bottom:8px;
}

/* ===== CARD FORM ===== */
.form-card{
    background:rgba(255,255,255,0.92);
    backdrop-filter:blur(20px) saturate(180%);
    -webkit-backdrop-filter:blur(20px) saturate(180%);
    border-radius:32px;
    padding:56px;
    box-shadow:
        0 25px 80px rgba(17,77,58,0.15),
        0 0 0 1px rgba(111,207,151,0.1),
        inset 0 1px 0 rgba(255,255,255,0.95),
        inset 0 -1px 0 rgba(111,207,151,0.05);
    animation:fadeUp 0.8s cubic-bezier(0.16, 1, 0.3, 1);
    border:1px solid rgba(111,207,151,0.2);
    position:relative;
    overflow:visible;
    transform-style:preserve-3d;
    transition:transform 0.3s ease, box-shadow 0.3s ease;
}

.form-card:hover{
    transform:translateY(-2px);
    box-shadow:
        0 30px 100px rgba(17,77,58,0.18),
        0 0 0 1px rgba(111,207,151,0.15),
        inset 0 1px 0 rgba(255,255,255,0.95);
}

.form-card::before{
    content:'';
    position:absolute;
    top:0;
    left:0;
    right:0;
    height:5px;
    background:linear-gradient(90deg, 
        var(--primary) 0%, 
        var(--primary-dark) 25%,
        #7dd9a8 50%,
        var(--primary-dark) 75%,
        var(--primary) 100%);
    background-size:300% 100%;
    animation:gradientShift 4s ease infinite;
    box-shadow:0 2px 10px rgba(111,207,151,0.3);
}

.form-card::after{
    display:none;
    content:'';
    position:absolute;
    top:-50%;
    right:-50%;
    width:200%;
    height:200%;
    background:radial-gradient(circle, rgba(111,207,151,0.05) 0%, transparent 70%);
    animation:rotate 20s linear infinite;
    pointer-events:none;
}

@keyframes gradientShift{
    0%, 100%{background-position:0% 50%;}
    50%{background-position:100% 50%;}
}

@keyframes rotate{
    from{transform:rotate(0deg);}
    to{transform:rotate(360deg);}
}

.info-box{
    background:linear-gradient(135deg, var(--primary-light) 0%, #d4f4e3 100%);
    border-left:4px solid var(--primary);
    padding:20px 24px;
    border-radius:16px;
    margin-bottom:36px;
    display:flex;
    align-items:flex-start;
    gap:16px;
    box-shadow:0 4px 12px rgba(111,207,151,0.1);
    position:relative;
    overflow:hidden;
}

.info-box::before{
    content:'';
    position:absolute;
    top:-50%;
    right:-20%;
    width:200px;
    height:200px;
    background:radial-gradient(circle, rgba(111,207,151,0.1) 0%, transparent 70%);
    border-radius:50%;
}

.info-box .icon{
    font-size:28px;
    flex-shrink:0;
    filter:drop-shadow(0 2px 4px rgba(17,77,58,0.1));
    position:relative;
    z-index:1;
}

.info-box p{
    margin:0;
    color:var(--text-dark);
    font-size:15px;
    line-height:1.7;
    position:relative;
    z-index:1;
    font-weight:500;
}

/* ===== GEJALA GRID ===== */
.gejala-section{
    margin-bottom:40px;
}

.section-title{
    font-family:var(--ff-heading);
    font-size:22px;
    font-weight:700;
    color:var(--text-dark);
    margin-bottom:20px;
    display:flex;
    align-items:center;
    gap:12px;
    padding-bottom:16px;
    border-bottom:2px solid var(--primary-light);
}

/* ===== SEARCH ===== */
.search-container{
    position:relative;
    margin-bottom:24px;
}

.search-input{
    width:100%;
    padding:16px 50px 16px 20px;
    border:2px solid var(--border);
    border-radius:14px;
    font-size:15px;
    font-family:var(--ff-body);
    background:white;
    transition:all 0.3s ease;
    box-shadow:0 2px 8px rgba(0,0,0,0.04);
}

.search-input:focus{
    outline:none;
    border-color:var(--primary);
    box-shadow:0 4px 16px rgba(111,207,151,0.15);
}

.clear-search{
    position:absolute;
    right:16px;
    top:50%;
    transform:translateY(-50%);
    background:var(--text-muted);
    color:white;
    border:none;
    width:28px;
    height:28px;
    border-radius:50%;
    cursor:pointer;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:14px;
    transition:all 0.3s ease;
}

.clear-search:hover{
    background:var(--primary-dark);
    transform:translateY(-50%) scale(1.1);
}

.gejala-grid{
    display:grid;
    grid-template-columns:repeat(auto-fill, minmax(220px, 1fr));
    gap:18px;
    margin-bottom:36px;
}

.gejala-item{
    position:relative;
    animation:fadeInUp 0.5s ease backwards;
}
.gejala-item:hover{
    z-index:5;
}

.gejala-item:nth-child(1){animation-delay:0.05s;}
.gejala-item:nth-child(2){animation-delay:0.1s;}
.gejala-item:nth-child(3){animation-delay:0.15s;}
.gejala-item:nth-child(4){animation-delay:0.2s;}
.gejala-item:nth-child(5){animation-delay:0.25s;}
.gejala-item:nth-child(6){animation-delay:0.3s;}
.gejala-item:nth-child(7){animation-delay:0.35s;}
.gejala-item:nth-child(8){animation-delay:0.4s;}
.gejala-item:nth-child(9){animation-delay:0.45s;}
.gejala-item:nth-child(10){animation-delay:0.5s;}
.gejala-item:nth-child(n+11){animation-delay:0.55s;}

@keyframes fadeInUp{
    from{
        opacity:0;
        transform:translateY(20px);
    }
    to{
        opacity:1;
        transform:translateY(0);
    }
}

.gejala-checkbox{
    display:none;
}

.gejala-label{
    display:flex;
    align-items:center;
    flex-wrap:wrap;
    gap:14px;
    padding:20px 24px;
    background:linear-gradient(135deg, #ffffff 0%, #fafafa 100%);
    border:2.5px solid var(--border);
    border-radius:18px;
    cursor:pointer;
    transition:all 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
    font-size:15px;
    font-weight:600;
    color:var(--text-dark);
    user-select:none;
    position:relative;
    overflow:visible;
    box-shadow:
        0 4px 12px rgba(0,0,0,0.06),
        0 0 0 0 rgba(111,207,151,0);
    transform:perspective(1000px) rotateX(0deg);
}

.gejala-label:hover{
    background:linear-gradient(135deg, var(--primary-light) 0%, #ffffff 100%);
    border-color:var(--primary);
    transform:translateY(-3px);
    box-shadow:
        0 10px 24px rgba(111,207,151,0.18),
        0 0 0 4px rgba(111,207,151,0.08);
}

.gejala-checkbox:checked + .gejala-label{
    background:linear-gradient(135deg, var(--primary-light) 0%, #d4f4e3 100%);
    border-color:var(--primary);
    border-width:3px;
    color:var(--text-dark);
    box-shadow:
        0 12px 36px rgba(111,207,151,0.3),
        0 0 0 5px rgba(111,207,151,0.15),
        inset 0 2px 4px rgba(111,207,151,0.1);
    transform:translateY(-2px);
}

.gejala-checkbox:checked + .gejala-label::before{
    content:'✓';
    display:flex;
    align-items:center;
    justify-content:center;
    width:28px;
    height:28px;
    background:linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
    color:white;
    border-radius:50%;
    font-size:16px;
    font-weight:bold;
    flex-shrink:0;
    box-shadow:0 4px 12px rgba(111,207,151,0.3);
    animation:checkmarkPop 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
}

@keyframes checkmarkPop{
    0%{
        transform:scale(0);
    }
    50%{
        transform:scale(1.2);
    }
    100%{
        transform:scale(1);
    }
}

.gejala-label::before{
    content:'';
    width:28px;
    height:28px;
    border:2.5px solid var(--border);
    border-radius:50%;
    flex-shrink:0;
    transition:all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    background:white;
    position:relative;
    z-index:1;
}

.gejala-name{
    position:relative;
    z-index:2;
    flex:1;
    min-width:0;
}

.gejala-help{
    position:relative;
    z-index:3;
    width:28px;
    height:28px;
    border-radius:999px;
    display:inline-flex;
    align-items:center;
    justify-content:center;
    color:var(--primary-dark);
    background:#ecfdf5;
    border:1px solid #bbf7d0;
    flex-shrink:0;
}

.gejala-help i{
    transition:transform 0.2s ease;
}

.gejala-item.show-info .gejala-help i{
    transform:rotate(180deg);
}

.gejala-description{
    display:none;
    width:100%;
    margin-top:2px;
    margin-left:42px;
    padding:12px 14px;
    border-radius:12px;
    background:#f0fdf4;
    border:1px solid #bbf7d0;
    color:#14532d;
    font-size:13px;
    line-height:1.55;
    font-weight:500;
}
.gejala-item.show-info .gejala-description{
    display:block;
}

.diagnosis-alert{
    display:none;
    position:fixed;
    left:50%;
    top:50%;
    z-index:9999;
    width:min(420px, calc(100vw - 28px));
    margin:0;
    padding:16px 44px 16px 16px;
    border:1px solid #fde68a;
    border-radius:14px;
    background:#ffffff;
    color:#1f2937;
    box-shadow:0 22px 55px rgba(15,23,42,0.26);
    transform:translate(-50%, -46%) scale(.96);
    opacity:0;
    transition:opacity .2s ease, transform .2s ease;
}

.diagnosis-alert.show{
    display:flex;
    align-items:flex-start;
    gap:12px;
    opacity:1;
    transform:translate(-50%, -50%) scale(1);
}

.diagnosis-alert-icon{
    flex:0 0 auto;
    width:36px;
    height:36px;
    border-radius:50%;
    display:inline-flex;
    align-items:center;
    justify-content:center;
    color:#b45309;
    background:#fef3c7;
    font-size:18px;
}

.diagnosis-alert-content{
    min-width:0;
}

.diagnosis-alert-heading{
    display:block;
    margin:0 0 2px;
    color:#114d3a;
    font-size:14px;
    font-weight:800;
    line-height:1.35;
}

.diagnosis-alert-message{
    margin:0;
    color:#475569;
    font-size:14px;
    font-weight:600;
    line-height:1.45;
}

.diagnosis-alert-close{
    position:absolute;
    top:12px;
    right:10px;
    width:28px;
    height:28px;
    border:0;
    border-radius:50%;
    display:inline-flex;
    align-items:center;
    justify-content:center;
    color:#64748b;
    background:transparent;
    cursor:pointer;
    transition:background .2s ease, color .2s ease;
}

.diagnosis-alert-close:hover{
    color:#0f172a;
    background:#f1f5f9;
}

@media (max-width:480px){
    .diagnosis-alert{
        width:calc(100vw - 24px);
        padding:14px 40px 14px 14px;
        border-radius:12px;
    }

    .diagnosis-alert-icon{
        width:32px;
        height:32px;
        font-size:16px;
    }

    .diagnosis-alert-heading,
    .diagnosis-alert-message{
        font-size:13px;
    }
}

.selected-count{
    background:linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
    color:white;
    padding:10px 20px;
    border-radius:24px;
    font-size:14px;
    font-weight:700;
    margin-left:auto;
    box-shadow:0 4px 12px rgba(111,207,151,0.3);
    position:relative;
    overflow:hidden;
    min-width:100px;
    text-align:center;
    transition:all 0.3s ease;
}

.selected-count::before{
    content:'';
    position:absolute;
    top:0;
    left:-100%;
    width:100%;
    height:100%;
    background:linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
    transition:left 0.5s;
}

.selected-count:hover::before{
    left:100%;
}

.selected-count.animate{
    animation:pulse 0.5s ease;
}

@keyframes pulse{
    0%, 100%{transform:scale(1);}
    50%{transform:scale(1.1);}
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


.btn-primary:disabled{
    opacity:0.5;
    cursor:not-allowed;
    transform:none;
    box-shadow:0 2px 8px rgba(111,207,151,0.15);
}

.btn-primary:not(:disabled):hover{
    transform:translateY(-4px) scale(1.02);
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
    
    body::before{
        background-image:
            radial-gradient(circle at 50% 50%, rgba(111,207,151,0.08) 0%, transparent 70%);
    }
    
    .container{
        padding:20px 0;
    }
    
    .form-card{
        padding:32px 24px;
        border-radius:24px;
    }
    
    .gejala-grid{
        grid-template-columns:1fr;
        gap:14px;
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
    
    .progress-container{
        max-width:100%;
        padding:16px 20px;
    }
}

@media(max-width:480px){
    .form-card{
        padding:24px 20px;
        border-radius:20px;
    }
    
    .header h1{
        font-size:1.6rem;
    }
    
    .gejala-label{
        padding:16px 18px;
        font-size:14px;
        gap:12px;
    }
    
    .gejala-label::before,
    .gejala-checkbox:checked + .gejala-label::before{
        width:24px;
        height:24px;
        font-size:14px;
    }
    
    .info-box{
        padding:16px 20px;
        gap:12px;
    }
    
    .info-box .icon{
        font-size:24px;
    }
    
    .section-title{
        font-size:20px;
        flex-wrap:wrap;
    }
    
    .selected-count{
        margin-left:0;
        margin-top:12px;
        width:100%;
    }
}

@media (max-width:576px) and (orientation:portrait){
    .header h1{font-size:1.35rem;line-height:1.35;}
    .header p{font-size:14px;}
    .logo-icon{width:38px;height:38px;}
    .form-card{padding:18px 14px;border-radius:16px;}
    .gejala-label{font-size:13.5px;padding:14px 14px;}
    .btn{font-size:14px;padding:10px 12px;}
    .progress-container{padding:12px 14px;}
}
</style>
</head>

<body>
<div class="container">
    <!-- HEADER -->
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
                ['label' => 'Pilih Gejala', 'url' => '#']
            ];
        @endphp
        @include('components.breadcrumb', ['items' => $breadcrumbItems])
        <h1>Pilih Gejala Kucing</h1>
        <p>Pilih gejala yang sesuai dengan kondisi kucing Anda</p>
        <div class="progress-container">
            <div class="progress-text">Langkah 2 dari 3</div>
            <div class="progress-bar">
                <div class="progress-fill"></div>
            </div>
        </div>
    </div>

    <!-- FORM CARD -->
    <div class="form-card">
    <form id="gejalaForm" method="POST">
            @csrf
            
            <!-- Info Box -->
            <div class="info-box">
                <div class="icon"><i class="bi bi-lightbulb"></i></div>
                <p >Pilih minimal 4 dan maksimal 7 gejala yang terjadi pada kucing anda</p>
            </div>

            <!-- Gejala Section -->
            <div class="gejala-section">
                <div class="section-title">
                    <span><i class="bi bi-search"></i> Gejala yang Ditemukan</span>
                    <span class="selected-count" id="selectedCount">0 dipilih</span>
                </div>
                
                <!-- Search Bar -->
                <div class="search-container">
                    <input 
                        type="text" 
                        id="searchGejala" 
                        placeholder="Cari gejala..." 
                        class="search-input"
                    >
                    <button type="button" id="clearSearch" class="clear-search" style="display:none;">✕</button>
                </div>
                
                @php
                    $explainGejala = function ($name) {
                        $text = trim((string) $name);
                        $lower = \Illuminate\Support\Str::lower($text);
                        $rules = [
                            'demam tinggi' => 'Telinga, telapak kaki, atau tubuh kucing terasa lebih panas dari biasanya dan kucing tampak kurang aktif.',
                            'sulit kencing' => 'Cek litterbox/kotak pasir kucing, lihat apakah kencingnya sedikit atau normal ke banyak.',
                            'kencing' => 'Amati frekuensi, jumlah, warna, dan apakah kucing tampak mengejan saat menggunakan kotak pasir.',
                            'diare berdarah' => 'Periksa apakah feses encer bercampur darah. Jika terlihat darah, kondisi ini perlu lebih diwaspadai.',
                            'diare' => 'Periksa apakah feses lebih encer dari biasanya, lebih sering keluar, atau baunya lebih menyengat.',
                            'muntah' => 'Catat seberapa sering kucing muntah, isi muntahan, dan apakah terjadi setelah makan atau minum.',
                            'nafsu makan' => 'Bandingkan porsi makan hari ini dengan kebiasaan normalnya dan perhatikan apakah kucing menolak makanan favorit.',
                            'kelemahan' => 'Perhatikan apakah kucing tampak lemas, lebih banyak diam, sulit berdiri, atau tidak mau bermain.',
                            'lemas' => 'Perhatikan apakah kucing lebih banyak tidur, kurang responsif, atau enggan bermain dan bergerak.',
                            'bersin' => 'Amati apakah bersin disertai lendir hidung, mata berair, atau napas berbunyi.',
                            'flu' => 'Perhatikan apakah hidung berair, bersin, atau kucing terlihat sulit mencium makanan.',
                            'pilek' => 'Cek apakah ada cairan dari hidung, hidung tersumbat, atau suara napas menjadi berbeda.',
                            'sesak napas' => 'Lihat apakah napas kucing cepat, berat, mulut terbuka, atau dada terlihat naik turun kuat.',
                            'batuk' => 'Dengarkan apakah batuk kering atau berdahak, serta apakah muncul setelah aktivitas atau saat istirahat.',
                            'radang telinga' => 'Cek apakah telinga kemerahan, kotor, berbau, atau kucing sering menggaruk telinga.',
                            'otitis' => 'Perhatikan apakah kucing sering menggelengkan kepala, telinga berbau, atau ada kotoran berlebih.',
                            'gatal' => 'Cek area kulit yang sering digaruk, dijilat, atau digigit, terutama telinga, leher, punggung, dan ekor.',
                            'kutu' => 'Sisir atau buka bulu kucing dan lihat apakah ada kutu kecil bergerak atau bintik hitam seperti kotoran.',
                            'pinjal' => 'Periksa pangkal ekor, leher, dan perut untuk melihat kutu kecil atau bekas gigitan.',
                            'kebotakan' => 'Lihat apakah ada area bulu yang menipis atau botak, terutama jika sering digaruk atau dijilat.',
                            'rontok' => 'Perhatikan apakah bulu rontok lebih banyak dari biasanya atau menyisakan area kulit terlihat.',
                            'bulu' => 'Lihat apakah bulu rontok berlebihan, kusam, menggumpal, atau ada area botak.',
                            'gangguan mata' => 'Periksa apakah mata merah, berair, belekan, bengkak, atau kucing sering menyipitkan mata.',
                            'mata' => 'Perhatikan apakah mata terlihat keruh, merah, berair, atau ada kotoran yang tidak biasa.',
                            'telinga' => 'Cek apakah telinga kotor, berbau, sering digaruk, atau kepala sering digelengkan.',
                            'demam' => 'Rasakan telinga/telapak kaki yang lebih hangat dari biasa dan perhatikan apakah kucing tampak lesu.',
                            'luka pada mulut' => 'Lihat area gusi, lidah, atau bibir. Perhatikan apakah ada sariawan, luka, bau mulut, atau sulit makan.',
                            'luka garukan' => 'Cek bekas garukan, kemerahan, atau kerak di kulit akibat kucing sering menggaruk.',
                            'luka' => 'Periksa lokasi luka, kemerahan, bengkak, nanah, atau apakah kucing kesakitan saat disentuh.',
                            'pincang' => 'Amati cara berjalan kucing, apakah salah satu kaki diangkat, diseret, atau tidak kuat menapak.',
                            'selaput lendir kuning' => 'Cek gusi, bagian putih mata, atau telinga bagian dalam. Warna kuning bisa menandakan masalah serius.',
                            'jaundice' => 'Perhatikan warna kuning pada gusi, mata, atau kulit tipis seperti telinga.',
                            'perut membesar' => 'Lihat apakah perut tampak membesar tidak biasa, terasa tegang, atau kucing tidak nyaman saat disentuh.',
                            'buncit' => 'Bandingkan bentuk perut dengan biasanya, terutama jika disertai lemas atau nafsu makan turun.',
                            'anemia' => 'Cek warna gusi. Gusi yang tampak pucat bisa menjadi tanda darah atau stamina kucing sedang bermasalah.',
                            'infeksi kulit' => 'Periksa kulit yang merah, basah, berkerak, bernanah, atau berbau tidak biasa.',
                            'overgrooming' => 'Perhatikan apakah kucing menjilat satu area terus-menerus sampai bulu menipis atau kulit iritasi.',
                            'perut bawah keras' => 'Raba pelan area perut bawah. Jika terasa keras dan kucing kesakitan, catat sebagai gejala penting.',
                            'sakit perut' => 'Perhatikan apakah kucing menghindar saat perut disentuh, meringkuk, atau tampak tidak nyaman.',
                            'nyeri abdomen' => 'Amati tanda nyeri di perut seperti mengeong saat disentuh, gelisah, atau posisi tubuh membungkuk.',
                            'penurunan berat badan cepat' => 'Bandingkan berat atau bentuk tubuh dalam beberapa hari/minggu terakhir, terutama jika makan tetap normal.',
                            'berat' => 'Bandingkan berat badan dengan kondisi sebelumnya dan amati apakah tubuh tampak lebih kurus atau membesar.',
                        ];

                        foreach ($rules as $keyword => $description) {
                            if (\Illuminate\Support\Str::contains($lower, $keyword)) {
                                return $description;
                            }
                        }

                        return 'Perhatikan gejala ' . $text . ' dengan melihat kapan mulai muncul, seberapa sering terjadi, dan apakah membuat kucing berubah perilaku.';
                    };
                @endphp

                <div class="gejala-grid" id="gejalaGrid">
    @foreach($gejala as $item)
        <div class="gejala-item">
            <input 
                type="checkbox" 
                class="gejala-checkbox"
                name="gejala[]" 
                value="{{ $item }}"
                id="gejala_{{ $loop->index }}"
            >
            <label for="gejala_{{ $loop->index }}" class="gejala-label">
                <span class="gejala-name">{{ $item }}</span>
                <span class="gejala-help" role="button" tabindex="0" aria-label="Tampilkan penjelasan gejala {{ $item }}" aria-expanded="false">
                    <i class="bi bi-chevron-down"></i>
                </span>
                <span class="gejala-description">{{ $explainGejala($item) }}</span>
            </label>
        </div>
    @endforeach
</div>
            </div>

            <!-- Button Group -->
            <div class="btn-group">
                <a href="{{ route('biodata') }}" class="btn btn-secondary">
                    ← Kembali
                </a>
                <button type="submit" class="btn btn-primary" id="submitBtn">
                    <span>Lanjutkan Diagnosis</span>
                    <span>→</span>
                </button>
            </div>
        </form>
    </div>
</div>

<div class="alert alert-warning diagnosis-alert" id="diagnosisAlert" role="alert" aria-live="assertive">
    <span class="diagnosis-alert-icon" aria-hidden="true">
        <i class="bi bi-exclamation-triangle-fill"></i>
    </span>
    <div class="diagnosis-alert-content">
        <strong class="diagnosis-alert-heading">Perhatian</strong>
        <p class="diagnosis-alert-message" id="diagnosisAlertText">Pilih minimal 4 gejala terlebih dahulu.</p>
    </div>
    <button type="button" class="diagnosis-alert-close" aria-label="Tutup alert" id="closeDiagnosisAlert">
        <i class="bi bi-x-lg"></i>
    </button>
</div>

@include('components.toast')
@include('components.scroll-top')

<script>
const checkboxes = document.querySelectorAll('.gejala-checkbox');
const submitBtn = document.getElementById('submitBtn');
const selectedCount = document.getElementById('selectedCount');
const form = document.getElementById('gejalaForm');
const diagnosisAlert = document.getElementById('diagnosisAlert');
const diagnosisAlertText = document.getElementById('diagnosisAlertText');
const closeDiagnosisAlert = document.getElementById('closeDiagnosisAlert');
let diagnosisAlertTimer = null;

function showDiagnosisAlert(message) {
    diagnosisAlertText.textContent = message;
    diagnosisAlert.classList.add('show');
    clearTimeout(diagnosisAlertTimer);
    diagnosisAlertTimer = setTimeout(hideDiagnosisAlert, 3000);
}

function hideDiagnosisAlert() {
    clearTimeout(diagnosisAlertTimer);
    diagnosisAlert.classList.remove('show');
}

closeDiagnosisAlert.addEventListener('click', hideDiagnosisAlert);

function updateSelectedCount() {
    const checked = document.querySelectorAll('.gejala-checkbox:checked').length;
    selectedCount.textContent = checked + ' dipilih';
    
    // Add animation to counter
    selectedCount.classList.add('animate');
    setTimeout(() => selectedCount.classList.remove('animate'), 500);
    
    // Tombol tetap bisa diklik agar validasi menampilkan alert yang jelas.
    if (checked >= 4 && checked <= 7) {
        submitBtn.style.opacity = '1';
        submitBtn.setAttribute('aria-disabled', 'false');
    } else {
        submitBtn.style.opacity = '0.6';
        submitBtn.setAttribute('aria-disabled', 'true');
    }
}

// Add event listeners
checkboxes.forEach(checkbox => {
    checkbox.addEventListener('change', updateSelectedCount);
});

document.querySelectorAll('.gejala-help').forEach((help) => {
    const item = help.closest('.gejala-item');
    const toggleInfo = (event) => {
        event.preventDefault();
        event.stopPropagation();
        const isOpen = item.classList.toggle('show-info');
        help.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
    };

    help.addEventListener('click', toggleInfo);
    help.addEventListener('keydown', (event) => {
        if (event.key === 'Enter' || event.key === ' ') {
            toggleInfo(event);
        }
    });
});

// Form submission

form.addEventListener('submit', function(e) {
    e.preventDefault();

    const checked = document.querySelectorAll('.gejala-checkbox:checked');

    if (checked.length < 4) {
        showDiagnosisAlert("Minimal pilih 4 gejala sebelum melanjutkan diagnosis.");
        return;
    }

    if (checked.length > 7) {
        showDiagnosisAlert("Maksimal hanya 7 gejala yang dapat dipilih.");
        return;
    }

    hideDiagnosisAlert();

     // ambil gejala
     let gejala = [];
    checked.forEach(c => gejala.push(c.value));

    // simpan ke localStorage (AMAN 🔥)
    localStorage.setItem('gejala', JSON.stringify(gejala));

    // pindah ke loading
    window.location.href = "/loading-diagnosis";
});

// Search functionality
const searchInput = document.getElementById('searchGejala');
const clearSearchBtn = document.getElementById('clearSearch');
const gejalaItems = document.querySelectorAll('.gejala-item');

searchInput.addEventListener('input', function(e) {
    const searchTerm = e.target.value.toLowerCase().trim();
    
    if (searchTerm) {
        clearSearchBtn.style.display = 'flex';
    } else {
        clearSearchBtn.style.display = 'none';
    }
    
    gejalaItems.forEach(item => {
        const label = item.querySelector('.gejala-label');
        const text = label.textContent.toLowerCase();
        
        if (text.includes(searchTerm)) {
            item.style.display = 'block';
            item.style.animation = 'fadeInUp 0.3s ease';
        } else {
            item.style.display = 'none';
        }
    });
    
    // Show no results message
    const visibleItems = Array.from(gejalaItems).filter(item => item.style.display !== 'none');
    const grid = document.getElementById('gejalaGrid');
    
    let noResults = document.getElementById('noResults');
    if (visibleItems.length === 0 && searchTerm) {
        if (!noResults) {
            noResults = document.createElement('div');
            noResults.id = 'noResults';
            noResults.className = 'no-results';
            noResults.innerHTML = '<p>😿 Tidak ada gejala yang ditemukan</p>';
            grid.appendChild(noResults);
        }
    } else if (noResults) {
        noResults.remove();
    }
});

clearSearchBtn.addEventListener('click', function() {
    searchInput.value = '';
    clearSearchBtn.style.display = 'none';
    gejalaItems.forEach(item => {
        item.style.display = 'block';
    });
    const noResults = document.getElementById('noResults');
    if (noResults) noResults.remove();
});

// Initialize count
updateSelectedCount();
</script>

<style>
.no-results{
    grid-column:1/-1;
    text-align:center;
    padding:60px 20px;
    color:var(--text-muted);
}

.no-results p{
    font-size:18px;
    margin:0;
}
</style>

</body>
</html>
