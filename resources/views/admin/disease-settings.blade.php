<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Pengaturan Penjelasan Penyakit - PawMedic</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700;800&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
<style>
:root{
    --ff-heading:'Poppins',system-ui,-apple-system,'Segoe UI',Roboto,'Helvetica Neue',Arial;
    --ff-body:'Inter',system-ui,-apple-system,'Segoe UI',Roboto,'Helvetica Neue',Arial;
    --primary:#6fcf97;
    --primary-dark:#4bb66f;
    --primary-light:#e8f7ef;
    --text-dark:#114d3a;
    --text-muted:#64748b;
}
*{box-sizing:border-box;}
body{
    margin:0;
    font-family:var(--ff-body);
    background:linear-gradient(135deg,#f0fdf4 0%,#eaf7f0 50%,#f0f9ff 100%);
    color:#333;
}
.container{max-width:1200px;margin:0 auto;padding:32px 20px;}
.topbar{
    display:flex;justify-content:space-between;align-items:center;gap:12px;
    margin-bottom:18px;
}
.title{font-family:var(--ff-heading);color:var(--text-dark);font-size:30px;font-weight:800;margin:0;}
.muted{color:var(--text-muted);margin:6px 0 0;}
.back{
    text-decoration:none;padding:10px 14px;border-radius:10px;border:1px solid var(--primary);
    background:#fff;color:var(--text-dark);font-weight:600;
}
.card{
    background:rgba(255,255,255,.95);border:1px solid rgba(111,207,151,.2);border-radius:18px;
    box-shadow:0 8px 24px rgba(17,77,58,.1);padding:20px;
}
.notice{
    padding:10px 14px;border-radius:10px;background:var(--primary-light);color:var(--text-dark);
    border:1px solid rgba(111,207,151,.3);margin-bottom:14px;font-weight:600;
}
.table-wrap{max-height:70vh;overflow:auto;border:1px solid #e2e8f0;border-radius:12px;}
table{width:100%;border-collapse:collapse;background:#fff;}
th,td{padding:12px 10px;border-bottom:1px solid #e2e8f0;vertical-align:top;}
th{background:var(--primary-light);text-align:left;color:var(--text-dark);}
textarea{
    width:100%;min-height:90px;resize:vertical;padding:10px;border:1px solid #cbd5e1;border-radius:10px;
    font-family:var(--ff-body);font-size:14px;line-height:1.5;
}
.actions{margin-top:16px;display:flex;justify-content:flex-end;}
.btn{
    border:none;border-radius:12px;padding:12px 18px;font-weight:700;cursor:pointer;
    background:linear-gradient(135deg,var(--primary),var(--primary-dark));color:#fff;
}
</style>
</head>
<body>
<div class="container">
    <div class="topbar">
        <div>
            <h1 class="title">Pengaturan Penjelasan Penyakit</h1>
            <p class="muted">Atur deskripsi penyakit yang tampil di halaman hasil diagnosis.</p>
        </div>
        <a href="{{ route('admin.dashboard') }}" class="back">← Kembali ke Dashboard</a>
    </div>

    <div class="card">
        @if(session('success'))
            <div class="notice">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('admin.disease.settings.save') }}">
            @csrf
            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th style="width:32%;">Nama Penyakit</th>
                            <th>Penjelasan</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse($diseases as $disease)
                        <tr>
                            <td><strong>{{ $disease }}</strong></td>
                            <td>
                                <textarea name="descriptions[{{ $disease }}]" placeholder="Tulis penjelasan singkat penyakit...">{{ $descriptions[$disease] ?? '' }}</textarea>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="2">Belum ada data penyakit.</td></tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
            <div class="actions">
                <button type="submit" class="btn">Simpan Penjelasan</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>

