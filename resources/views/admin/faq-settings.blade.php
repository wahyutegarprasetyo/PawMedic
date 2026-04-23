<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Kelola FAQ - PawMedic Admin</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700;800&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
<style>
body{margin:0;font-family:'Inter',sans-serif;background:#f4faf7;color:#1f2937}
.container{max-width:1100px;margin:0 auto;padding:28px 16px}
.head{display:flex;justify-content:space-between;align-items:center;gap:12px;margin-bottom:18px}
.title{font-family:'Poppins',sans-serif;font-size:30px;margin:0;color:#114d3a}
.card{background:#fff;border:1px solid #d1fae5;border-radius:16px;padding:16px;box-shadow:0 8px 20px rgba(17,77,58,.08)}
.row{display:grid;grid-template-columns:1fr 2fr;gap:10px;margin-bottom:10px}
input,textarea{width:100%;padding:10px;border:1px solid #cbd5e1;border-radius:10px;font:inherit}
textarea{min-height:92px;resize:vertical}
.btn{padding:10px 14px;border-radius:10px;border:1px solid #6fcf97;background:#6fcf97;color:#fff;font-weight:700;cursor:pointer}
.btn.secondary{background:#fff;color:#114d3a}
.actions{display:flex;justify-content:space-between;align-items:center;margin-top:12px;gap:10px}
.notice{background:#e8f7ef;border:1px solid #b7ebcf;padding:10px;border-radius:10px;color:#114d3a;margin-bottom:10px}
@media(max-width:768px){.row{grid-template-columns:1fr}.title{font-size:24px}}
</style>
</head>
<body>
<div class="container">
    <div class="head">
        <h1 class="title">Kelola FAQ</h1>
        <a class="btn secondary" href="{{ route('admin.dashboard') }}">← Dashboard</a>
    </div>

    <div class="card">
        @if(session('success'))
            <div class="notice">{{ session('success') }}</div>
        @endif
        <form method="POST" action="{{ route('admin.faq.settings.save') }}">
            @csrf
            <div id="faqRows">
                @forelse($faqs as $faq)
                    <div class="row">
                        <input type="text" name="questions[]" value="{{ $faq['question'] }}" placeholder="Pertanyaan">
                        <textarea name="answers[]" placeholder="Jawaban">{{ $faq['answer'] }}</textarea>
                    </div>
                @empty
                    <div class="row">
                        <input type="text" name="questions[]" placeholder="Pertanyaan">
                        <textarea name="answers[]" placeholder="Jawaban"></textarea>
                    </div>
                @endforelse
            </div>
            <div class="actions">
                <button type="button" class="btn secondary" onclick="addFaqRow()">+ Tambah FAQ</button>
                <button type="submit" class="btn">Simpan FAQ</button>
            </div>
        </form>
    </div>
</div>
<script>
function addFaqRow() {
    const wrap = document.getElementById('faqRows');
    const row = document.createElement('div');
    row.className = 'row';
    row.innerHTML = `
        <input type="text" name="questions[]" placeholder="Pertanyaan">
        <textarea name="answers[]" placeholder="Jawaban"></textarea>
    `;
    wrap.appendChild(row);
}
</script>
</body>
</html>

