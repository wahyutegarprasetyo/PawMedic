<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Ulasan Pengguna - PawMedic</title>
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
    --warning: #f59e0b;
    --border: #e2e8f0;
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
    max-width:1200px;
    margin:0 auto;
    padding:40px 0;
    position:relative;
    z-index:1;
}

/* ===== HEADER ===== */
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

/* ===== STATS CARD ===== */
.stats-card{
    background:rgba(255,255,255,0.95);
    backdrop-filter:blur(20px);
    border-radius:24px;
    padding:32px;
    box-shadow:0 20px 60px rgba(17,77,58,0.12);
    border:1px solid rgba(111,207,151,0.15);
    margin-bottom:40px;
    display:grid;
    grid-template-columns:repeat(auto-fit, minmax(200px, 1fr));
    gap:24px;
    animation:fadeUp 0.8s ease;
}

.stat-item{
    text-align:center;
}

.stat-value{
    font-family:var(--ff-heading);
    font-size:36px;
    font-weight:800;
    color:var(--primary-dark);
    margin-bottom:8px;
}

.stat-label{
    font-size:14px;
    color:var(--text-muted);
    font-weight:600;
    text-transform:uppercase;
    letter-spacing:0.5px;
}

/* ===== FORM CARD ===== */
.form-card{
    background:rgba(255,255,255,0.95);
    backdrop-filter:blur(20px);
    border-radius:28px;
    padding:40px;
    box-shadow:0 20px 60px rgba(17,77,58,0.12);
    border:1px solid rgba(111,207,151,0.15);
    margin-bottom:40px;
    animation:fadeUp 0.8s ease 0.2s backwards;
}

.form-title{
    font-family:var(--ff-heading);
    font-size:24px;
    font-weight:700;
    color:var(--text-dark);
    margin-bottom:24px;
    display:flex;
    align-items:center;
    gap:12px;
}

.form-group{
    margin-bottom:24px;
}

.form-group label{
    display:block;
    font-weight:600;
    color:var(--text-dark);
    margin-bottom:10px;
    font-size:15px;
}

.form-group input,
.form-group textarea{
    width:100%;
    padding:14px 18px;
    border:2px solid var(--border);
    border-radius:12px;
    font-size:15px;
    font-family:var(--ff-body);
    transition:all 0.3s ease;
    background:#fafafa;
}

.form-group input:focus,
.form-group textarea:focus{
    outline:none;
    border-color:var(--primary);
    background:white;
    box-shadow:0 0 0 4px rgba(111,207,151,0.1);
}

.form-group textarea{
    resize:vertical;
    min-height:120px;
}

.rating-input{
    display:flex;
    gap:8px;
    align-items:center;
    flex-wrap:wrap;
}

.star{
    font-size:32px;
    color:#ddd;
    cursor:pointer;
    transition:all 0.2s ease;
    user-select:none;
}

.star:hover,
.star.active{
    color:var(--warning);
    transform:scale(1.1);
}

/* ===== REVIEWS GRID ===== */
.reviews-section{
    margin-bottom:40px;
}

.section-header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:24px;
    flex-wrap:wrap;
    gap:16px;
}

.section-title{
    font-family:var(--ff-heading);
    font-size:24px;
    font-weight:700;
    color:var(--text-dark);
}

.filter-buttons{
    display:flex;
    gap:8px;
    flex-wrap:wrap;
}

.filter-btn{
    padding:8px 16px;
    border:2px solid var(--border);
    background:white;
    border-radius:20px;
    font-size:14px;
    font-weight:600;
    color:var(--text-muted);
    cursor:pointer;
    transition:all 0.3s ease;
}

.filter-btn:hover,
.filter-btn.active{
    border-color:var(--primary);
    background:var(--primary-light);
    color:var(--primary-dark);
}

.reviews-grid{
    display:grid;
    grid-template-columns:repeat(auto-fill, minmax(320px, 1fr));
    gap:24px;
}

.review-card{
    background:rgba(255,255,255,0.95);
    backdrop-filter:blur(20px);
    border-radius:20px;
    padding:24px;
    box-shadow:0 8px 24px rgba(17,77,58,0.08);
    border:1px solid rgba(111,207,151,0.1);
    transition:all 0.3s ease;
    animation:fadeUp 0.6s ease backwards;
}

.review-card:nth-child(1){animation-delay:0.1s;}
.review-card:nth-child(2){animation-delay:0.2s;}
.review-card:nth-child(3){animation-delay:0.3s;}
.review-card:nth-child(4){animation-delay:0.4s;}
.review-card:nth-child(5){animation-delay:0.5s;}
.review-card:nth-child(n+6){animation-delay:0.6s;}

.review-card:hover{
    transform:translateY(-4px);
    box-shadow:0 12px 32px rgba(17,77,58,0.15);
    border-color:var(--primary);
}

.review-header{
    display:flex;
    align-items:flex-start;
    gap:16px;
    margin-bottom:16px;
}

.avatar{
    width:56px;
    height:56px;
    border-radius:50%;
    background:linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:24px;
    flex-shrink:0;
    box-shadow:0 4px 12px rgba(111,207,151,0.3);
}

.review-info{
    flex:1;
}

.review-name{
    font-weight:700;
    color:var(--text-dark);
    font-size:16px;
    margin-bottom:4px;
}

.review-cat{
    font-size:14px;
    color:var(--text-muted);
    font-style:italic;
}

.review-rating{
    color:var(--warning);
    font-size:16px;
    margin-top:8px;
}

.review-text{
    color:var(--text-dark);
    line-height:1.7;
    font-size:15px;
    margin:0;
    position:relative;
    padding-left:20px;
}

.review-text::before{
    content:'"';
    position:absolute;
    left:0;
    top:-8px;
    font-size:48px;
    color:var(--primary-light);
    font-weight:700;
    line-height:1;
}

.review-date{
    font-size:13px;
    color:var(--text-muted);
    margin-top:16px;
    padding-top:16px;
    border-top:1px solid var(--border);
}

/* ===== BUTTONS ===== */
.btn{
    padding:14px 28px;
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
}

.btn-secondary:hover{
    background:var(--primary-light);
    transform:translateY(-2px);
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
    .stats-card{
        grid-template-columns:repeat(2, 1fr);
    }
    
    .reviews-grid{
        grid-template-columns:1fr;
    }
    
    .form-card{
        padding:28px 24px;
    }
    
    .section-header{
        flex-direction:column;
        align-items:flex-start;
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
        <h1>Ulasan Pengguna</h1>
        <p>Bagikan pengalaman Anda menggunakan PawMedic</p>
    </div>

    <!-- Stats -->
    <div class="stats-card">
        <div class="stat-item">
            <div class="stat-value">{{ $total }}</div>
            <div class="stat-label">Total Ulasan</div>
        </div>
        <div class="stat-item">
            <div class="stat-value">{{ number_format($avg, 1) }}</div>
            <div class="stat-label">Rating Rata-rata</div>
        </div>
        <div class="stat-item">
            <div class="stat-value">{{ $fivePercent }}%</div>
            <div class="stat-label">5 Bintang</div>
        </div>
    </div>

    <!-- Form Submit Ulasan -->
    <div class="form-card">
        <div class="form-title">
            <span>✍️</span>
            <span>Tulis Ulasan Anda</span>
        </div>
        <form method="POST" action="{{ route('ulasan.store') }}">
    @csrf
            <div class="form-group">
                <label>Nama Anda</label>
                <input type="text" name="nama" placeholder="Masukkan nama Anda" required>
            </div>
            <div class="form-group">
                <label>Nama Kucing</label>
                <input type="text" name="nama_kucing" placeholder="Nama kucing Anda">
            </div>
            <div class="form-group">
                <label>Rating</label>
                <div id="rating-stars" style="font-size: 28px; cursor: pointer;">
                <span data-value="1">☆</span>
                <span data-value="2">☆</span>
                <span data-value="3">☆</span>
                <span data-value="4">☆</span>
                <span data-value="5">☆</span>
            </div>

            <input type="hidden" name="rating" id="rating-value">
            </div>
            <div class="form-group">
                <label>Ulasan</label>
                <textarea name="komentar" placeholder="Bagikan pengalaman Anda menggunakan PawMedic..." required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">
                <span>Kirim Ulasan</span>
                <span>→</span>
            </button>
        </form>
    </div>

    <!-- Reviews List -->
    <div class="reviews-section">
        <div class="section-header">
            <div class="section-title">Ulasan Pengguna</div>
            <div class="filter-buttons">
                <button class="filter-btn active" data-filter="all">Semua</button>
                <button class="filter-btn" data-filter="5">5 Bintang</button>
                <button class="filter-btn" data-filter="4">4 Bintang</button>
                <button class="filter-btn" data-filter="3">3 Bintang</button>
            </div>
        </div>
        <div class="reviews-grid">

        @foreach($ulasan as $review)
<div class="review-card" data-rating="{{ $review->rating }}">
    <div class="review-header">
        <div class="avatar">{{ substr($review->nama,0,1) }}</div>
        <div class="review-info">
            <div class="review-name">{{ $review->nama }}</div>
            <div class="review-cat">
                {{ $review->hasil_diagnosis ?? 'Pengguna' }}
            </div>
            <div class="review-rating">
                {{ str_repeat('★', $review->rating) }}
            </div>
        </div>
    </div>

    <!-- ✅ KOMENTAR UNTUK SEMUA -->
    <p class="review-text">{{ $review->komentar }}</p>

    <!-- ✅ HANYA ADMIN -->
    @auth
    @if(Auth::user()->email === 'admin@pawmedic.app')
        <form action="{{ route('ulasan.delete', $review->id) }}" 
              method="POST" 
              onsubmit="return confirm('Yakin hapus ulasan ini?')"
              style="margin-top:10px;">
            @csrf
            @method('DELETE')
            <button type="submit" 
                    style="background:#ef4444; color:white; border:none; padding:6px 12px; border-radius:6px;">
                🗑 Hapus
            </button>
        </form>
    @endif
    @endauth

    <div class="review-date">
        {{ $review->created_at->diffForHumans() }}
    </div>
</div>

@endforeach
            <!-- Reviews will be populated by JavaScript -->
        </div>
    </div>
</div>

@include('components.toast')
@include('components.scroll-top')
<script>
const buttons = document.querySelectorAll('.filter-btn');
const cards = document.querySelectorAll('.review-card');

buttons.forEach(btn => {
    btn.addEventListener('click', () => {

        // hapus active semua
        buttons.forEach(b => b.classList.remove('active'));
        btn.classList.add('active');

        const filter = btn.getAttribute('data-filter');

        cards.forEach(card => {
            const rating = card.getAttribute('data-rating');

            if (filter === 'all' || rating === filter) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    });
});
</script>
<script>
const stars = document.querySelectorAll('#rating-stars span');
const ratingInput = document.getElementById('rating-value');

stars.forEach((star, index) => {

    // ✅ CLICK (INI YANG KAMU KURANG)
    star.addEventListener('click', () => {
        const value = star.getAttribute('data-value');
        ratingInput.value = value;

        stars.forEach((s, i) => {
            s.textContent = i < value ? '★' : '☆';
        });
    });

    // hover (punya kamu)
    star.addEventListener('mouseover', () => {
        stars.forEach((s, i) => {
            s.textContent = i <= index ? '★' : '☆';
        });
    });

    // keluar hover
    star.addEventListener('mouseout', () => {
        let value = ratingInput.value;
        stars.forEach((s, i) => {
            s.textContent = i < value ? '★' : '☆';
        });
    });

});
</script>
</body>
</html>
