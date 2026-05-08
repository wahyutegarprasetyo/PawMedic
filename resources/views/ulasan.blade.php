<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Ulasan Pengguna - PawMedic</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700;800&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
<link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">

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
    font-size:34px;
    color:#d1d5db;
    cursor:pointer;
    transition:all 0.2s ease, text-shadow 0.2s ease;
    user-select:none;
    padding:2px;
}

.star:hover,
.star.active{
    color:var(--warning);
    transform:scale(1.1);
    text-shadow:0 4px 10px rgba(245,158,11,.35);
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

@media (max-width:576px) and (orientation:portrait){
    .container{padding:14px;}
    .header h1{font-size:1.35rem;}
    .header p{font-size:14px;}
    .logo-icon{width:38px;height:38px;}
    .stats-card{grid-template-columns:1fr 1fr;gap:10px;}
    .stat-value{font-size:1.05rem;}
    .form-card{padding:18px 14px;border-radius:16px;}
    .btn{font-size:14px;padding:10px 12px;}
    .review-card{padding:14px;}
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
            <span><i class="bi bi-pencil-square"></i></span>
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
                <button class="filter-btn active" data-filter-rating="all">Semua Bintang</button>
                <button class="filter-btn" data-filter-rating="5">5 Bintang</button>
                <button class="filter-btn" data-filter-rating="4">4 Bintang</button>
                <button class="filter-btn" data-filter-rating="3">3 Bintang</button>
                <button class="filter-btn" data-filter-rating="2">2 Bintang</button>
                <button class="filter-btn" data-filter-rating="1">1 Bintang</button>
                @auth
                @if(Auth::user()->email === 'admin@pawmedic.app')
                    <button class="filter-btn" data-filter-visibility="all">Semua Status</button>
                    <button class="filter-btn" data-filter-visibility="visible">Tampil</button>
                    <button class="filter-btn" data-filter-visibility="hidden">Hidden</button>
                @endif
                @endauth
            </div>
        </div>
        <div class="reviews-grid">

        @foreach($ulasan as $review)
<div class="review-card" data-rating="{{ $review->rating }}" data-hidden="{{ ($review->is_hidden ?? false) ? '1' : '0' }}">
    <div class="review-header">
        <div class="avatar">{{ substr($review->nama,0,1) }}</div>
        <div class="review-info">
            <div class="review-name">{{ $review->nama }}</div>
            <div class="review-cat">
                {{ $review->hasil_diagnosis ?? 'Pengguna' }}
            </div>
            <div class="review-rating">
                {{ str_repeat('★', $review->rating) }}
                @if(($review->is_hidden ?? false))
                    <span style="margin-left:8px;font-size:12px;color:#b45309;background:#fef3c7;padding:2px 8px;border-radius:999px;">Hidden</span>
                @endif
            </div>
        </div>
    </div>

    <!-- ✅ KOMENTAR UNTUK SEMUA -->
    <p class="review-text">{{ $review->komentar }}</p>

    <!-- ✅ HANYA ADMIN -->
    @auth
    @if(Auth::user()->email === 'admin@pawmedic.app')
        <div style="margin-top:10px;display:flex;gap:8px;flex-wrap:wrap;">
        <form action="{{ route('ulasan.toggleHide', $review->id) }}" method="POST" style="display:inline;">
            @csrf
            <button type="submit"
                    style="background:#f59e0b; color:white; border:none; padding:6px 12px; border-radius:6px;">
                @if(($review->is_hidden ?? false))
                    <i class="bi bi-eye"></i> Tampilkan
                @else
                    <i class="bi bi-eye-slash"></i> Hide
                @endif
            </button>
        </form>
        <form action="{{ route('ulasan.delete', $review->id) }}" 
              method="POST"
              class="delete-review-form"
              data-name="{{ $review->nama }}"
              style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" 
                    style="background:#ef4444; color:white; border:none; padding:6px 12px; border-radius:6px;">
                <i class="bi bi-trash"></i> Hapus
            </button>
        </form>
        </div>
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
<div class="modal fade" id="deleteReviewModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="border-radius:14px;">
      <div class="modal-header">
        <h5 class="modal-title">Konfirmasi Hapus Ulasan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">Yakin hapus ulasan ini?</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="width:auto;">Batal</button>
        <button type="button" class="btn btn-danger" id="confirmDeleteReview" style="width:auto;">Ya, Hapus</button>
      </div>
    </div>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
const buttons = document.querySelectorAll('.filter-btn');
const cards = document.querySelectorAll('.review-card');
let activeRatingFilter = 'all';
let activeVisibilityFilter = 'all';

buttons.forEach(btn => {
    btn.addEventListener('click', () => {
        const ratingFilter = btn.getAttribute('data-filter-rating');
        const visibilityFilter = btn.getAttribute('data-filter-visibility');
        if (ratingFilter !== null) {
            activeRatingFilter = ratingFilter;
            document.querySelectorAll('[data-filter-rating]').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
        }
        if (visibilityFilter !== null) {
            activeVisibilityFilter = visibilityFilter;
            document.querySelectorAll('[data-filter-visibility]').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
        }
        applyReviewFilters();
    });
});
function applyReviewFilters() {
    cards.forEach(card => {
        const rating = card.getAttribute('data-rating');
        const isHidden = card.getAttribute('data-hidden') === '1';
        const passRating = activeRatingFilter === 'all' || rating === activeRatingFilter;
        let passVisibility = true;
        if (activeVisibilityFilter === 'visible') passVisibility = !isHidden;
        if (activeVisibilityFilter === 'hidden') passVisibility = isHidden;
        card.style.display = (passRating && passVisibility) ? 'block' : 'none';
    });
}
applyReviewFilters();
</script>
<script>
let pendingDeleteForm = null;
const deleteModalEl = document.getElementById('deleteReviewModal');
const deleteModal = deleteModalEl && window.bootstrap ? new bootstrap.Modal(deleteModalEl) : null;
document.querySelectorAll('.delete-review-form').forEach((form) => {
    form.addEventListener('submit', (e) => {
        e.preventDefault();
        pendingDeleteForm = form;
        if (deleteModal) {
            deleteModal.show();
        } else if (confirm('Yakin hapus ulasan ini?')) {
            form.submit();
        }
    });
});
document.getElementById('confirmDeleteReview')?.addEventListener('click', () => {
    if (pendingDeleteForm) pendingDeleteForm.submit();
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
