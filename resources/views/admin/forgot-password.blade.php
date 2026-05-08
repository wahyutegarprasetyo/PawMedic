<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Lupa Password Admin - PawMedic</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-4" style="max-width:560px;">
    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body p-4">
            <h3 class="mb-3">Lupa Password Admin</h3>
            <p class="text-muted mb-3">Masukkan email aktif untuk menerima OTP, lalu verifikasi kode.</p>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            @if($errors->any())
                <div class="alert alert-danger">{{ $errors->first() }}</div>
            @endif

            <form method="POST" action="{{ route('admin.forgot.sendOtp') }}" class="mb-4">
                @csrf
                <label class="form-label">Email aktif (penerima OTP)</label>
                <input type="email" class="form-control mb-3" name="otp_email" value="{{ old('otp_email', session('otp_email')) }}" placeholder="contoh@email.com" required>
                <button type="submit" class="btn btn-success">Kirim kode sekarang</button>
            </form>

            <form method="POST" action="{{ route('admin.forgot.verifyOtp') }}">
                @csrf
                <label class="form-label">Email aktif (yang tadi dipakai)</label>
                <input type="email" class="form-control mb-3" name="otp_email" value="{{ old('otp_email', session('otp_email')) }}" required>
                <label class="form-label">Masukkan kode OTP</label>
                <input type="text" class="form-control mb-3" name="otp" maxlength="6" placeholder="6 digit OTP" required>
                <button type="submit" class="btn btn-primary">Verifikasi Kode</button>
            </form>

            <a href="{{ route('admin.login') }}" class="btn btn-link ps-0 mt-2">Kembali ke login</a>
        </div>
    </div>
</div>
</body>
</html>
