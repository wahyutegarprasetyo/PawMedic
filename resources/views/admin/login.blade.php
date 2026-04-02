<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login Admin - PawMedic</title>
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
    display:flex;
    align-items:center;
    justify-content:center;
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

.login-container{
    width:100%;
    max-width:450px;
    position:relative;
    z-index:1;
}

.login-card{
    background:rgba(255,255,255,0.95);
    backdrop-filter:blur(20px);
    border-radius:28px;
    padding:48px;
    box-shadow:
        0 25px 80px rgba(17,77,58,0.15),
        0 0 0 1px rgba(111,207,151,0.1);
    border:1px solid rgba(111,207,151,0.2);
    animation:fadeUp 0.8s ease;
    position:relative;
    overflow:hidden;
}

.login-card::before{
    content:'';
    position:absolute;
    top:0;
    left:0;
    right:0;
    height:5px;
    background:linear-gradient(90deg, var(--primary) 0%, var(--primary-dark) 100%);
}

.logo-section{
    text-align:center;
    margin-bottom:40px;
}

.logo{
    display:inline-flex;
    align-items:center;
    gap:12px;
    margin-bottom:24px;
}

.logo-icon{
    width:56px;
    height:56px;
    background:linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
    border-radius:14px;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:28px;
    box-shadow:0 8px 24px rgba(111,207,151,0.3);
}

.logo-text{
    font-size:26px;
    font-weight:700;
    font-family:var(--ff-heading);
    color:var(--text-dark);
}

.login-title{
    font-family:var(--ff-heading);
    font-size:28px;
    font-weight:800;
    color:var(--text-dark);
    margin-bottom:8px;
    letter-spacing:-0.02em;
}

.login-subtitle{
    color:var(--text-muted);
    font-size:15px;
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

.form-group input{
    width:100%;
    padding:14px 18px;
    border:2px solid var(--border, #e2e8f0);
    border-radius:12px;
    font-size:15px;
    font-family:var(--ff-body);
    transition:all 0.3s ease;
    background:#fafafa;
}

.form-group input:focus{
    outline:none;
    border-color:var(--primary);
    background:white;
    box-shadow:0 0 0 4px rgba(111,207,151,0.1);
}

.remember-forgot{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:28px;
    font-size:14px;
}

.remember{
    display:flex;
    align-items:center;
    gap:8px;
}

.remember input[type="checkbox"]{
    width:18px;
    height:18px;
    cursor:pointer;
}

.forgot-link{
    color:var(--primary-dark);
    text-decoration:none;
    font-weight:600;
    transition:color 0.2s ease;
}

.forgot-link:hover{
    color:var(--primary);
}

.btn{
    width:100%;
    padding:16px;
    border:none;
    border-radius:14px;
    font-weight:600;
    font-size:16px;
    cursor:pointer;
    transition:all 0.3s ease;
    font-family:var(--ff-body);
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
    transform:translateY(-2px);
    box-shadow:0 8px 24px rgba(111,207,151,0.4);
}

.error-message{
    background:#fee2e2;
    border-left:4px solid var(--danger);
    padding:12px 16px;
    border-radius:8px;
    color:#991b1b;
    font-size:14px;
    margin-bottom:24px;
    display:flex;
    align-items:center;
    gap:8px;
}

.back-link{
    display:inline-flex;
    align-items:center;
    gap:8px;
    color:var(--text-muted);
    text-decoration:none;
    font-weight:600;
    margin-top:24px;
    transition:all 0.3s ease;
    font-size:14px;
}

.back-link:hover{
    color:var(--primary-dark);
    transform:translateX(-4px);
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
</style>
</head>

<body>
<div class="login-container">
    <div class="login-card">
        <div class="logo-section">
            <div class="logo">
                <div class="logo-icon">🐾</div>
                <div class="logo-text">PawMedic</div>
            </div>
            <h1 class="login-title">Admin Login</h1>
            <p class="login-subtitle">Masuk ke dashboard admin</p>
        </div>

        @if($errors->any())
            <div class="error-message">
                <span>⚠️</span>
                <span>{{ $errors->first() }}</span>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.authenticate') }}">
            @csrf
            
            <div class="form-group">
                <label for="email">Email</label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    value="{{ old('email') }}"
                    placeholder="admin@pawmedic.app"
                    required
                    autofocus
                >
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input 
                    type="password" 
                    id="password" 
                    name="password" 
                    placeholder="Masukkan password"
                    required
                >
            </div>

            <div class="remember-forgot">
                <label class="remember">
                    <input type="checkbox" name="remember">
                    <span>Ingat saya</span>
                </label>
                <a href="#" class="forgot-link">Lupa password?</a>
            </div>

            <button type="submit" class="btn btn-primary">
                Masuk
            </button>
        </form>

        <a href="/" class="back-link">
            ← Kembali ke Beranda
        </a>
    </div>
</div>

</body>
</html>
