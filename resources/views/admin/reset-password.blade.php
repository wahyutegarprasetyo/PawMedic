<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Ganti Password Admin - PawMedic</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-4" style="max-width:560px;">
    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body p-4">
            <h3 class="mb-3">Ganti Password Baru</h3>
            <p class="text-muted mb-3">OTP valid. Silakan set password admin baru.</p>

            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            @if($errors->any())
                <div class="alert alert-danger">{{ $errors->first() }}</div>
            @endif

            <form method="POST" action="{{ route('admin.forgot.reset.submit') }}">
                @csrf
                <label class="form-label">Password baru</label>
                <input type="password" class="form-control mb-3" name="new_password" minlength="6" required>
                <label class="form-label">Konfirmasi password baru</label>
                <input type="password" class="form-control mb-3" name="new_password_confirmation" minlength="6" required>
                <button type="submit" class="btn btn-success">Simpan Password Baru</button>
            </form>

            <a href="{{ route('admin.login') }}" class="btn btn-link ps-0 mt-2">Kembali ke login</a>
        </div>
    </div>
</div>
</body>
</html>
