<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Kelola FAQ - PawMedic Admin</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700;800&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
body{margin:0;font-family:'Inter',sans-serif;background:#f4faf7;color:#1f2937}
.container{max-width:1100px;margin:0 auto;padding:28px 16px}
.head{display:flex;justify-content:space-between;align-items:center;gap:12px;margin-bottom:18px}
.title-wrap{display:flex;align-items:center;gap:10px}
.logo-icon{width:40px;height:40px;border-radius:10px;background:linear-gradient(135deg,#6fcf97,#4bb66f);display:flex;align-items:center;justify-content:center;color:#fff;font-size:18px}
.title{font-family:'Poppins',sans-serif;font-size:30px;margin:0;color:#114d3a}
.card{background:#fff;border:1px solid #d1fae5;border-radius:16px;padding:16px;box-shadow:0 8px 20px rgba(17,77,58,.08)}
table{width:100%;border-collapse:collapse}
th,td{padding:10px;border-bottom:1px solid #e2e8f0;vertical-align:top}
th{background:#e8f7ef;text-align:left}
input,textarea{width:100%;padding:10px;border:1px solid #cbd5e1;border-radius:10px;font:inherit}
textarea{min-height:92px;resize:vertical}
.btn{padding:10px 14px;border-radius:10px;border:1px solid #6fcf97;background:#6fcf97;color:#fff;font-weight:700;cursor:pointer}
.btn.secondary{background:#fff;color:#114d3a}
.btn.danger{background:#fff;border-color:#fca5a5;color:#b91c1c}
.actions{display:flex;justify-content:space-between;align-items:center;margin-top:12px;gap:10px}
.notice{background:#e8f7ef;border:1px solid #b7ebcf;padding:10px;border-radius:10px;color:#114d3a;margin-bottom:10px}
@media(max-width:768px){.title{font-size:24px}}
</style>
</head>
<body>
<div class="container">
    <div class="head">
        <div class="title-wrap">
            <div class="logo-icon" aria-hidden="true">
                <svg viewBox="0 0 24 24" width="20" height="20" fill="currentColor">
                    <circle cx="6" cy="8" r="2.2"></circle>
                    <circle cx="10.8" cy="5.6" r="2.1"></circle>
                    <circle cx="15.8" cy="8" r="2.2"></circle>
                    <path d="M12 10.6c-3.4 0-5.9 2.4-5.9 4.9 0 2.2 1.8 3.9 4 3.9 1.4 0 1.9-.7 2-.7s.6.7 2 .7c2.2 0 4-1.7 4-3.9 0-2.6-2.6-4.9-6.1-4.9z"></path>
                </svg>
            </div>
            <h1 class="title">Kelola FAQ</h1>
        </div>
        <a class="btn secondary" href="{{ route('admin.dashboard') }}">← Dashboard</a>
    </div>

    <div class="card">
        @if(session('success'))
            <div class="notice">{{ session('success') }}</div>
        @endif
        <form method="POST" action="{{ route('admin.faq.settings.save') }}">
            @csrf
            <div style="overflow:auto;border:1px solid #e2e8f0;border-radius:10px;">
                <table>
                    <thead>
                    <tr>
                        <th style="min-width:60px;">No</th>
                        <th style="min-width:260px;">Pertanyaan</th>
                        <th style="min-width:420px;">Jawaban</th>
                        <th style="min-width:120px;">Aksi</th>
                    </tr>
                    </thead>
                    <tbody id="faqRows">
                    @forelse($faqs as $faq)
                        <tr class="faq-row">
                            <td class="faq-no"></td>
                            <td><input type="text" name="questions[]" value="{{ $faq['question'] }}" placeholder="Pertanyaan"></td>
                            <td><textarea name="answers[]" placeholder="Jawaban">{{ $faq['answer'] }}</textarea></td>
                            <td><button type="button" class="btn danger" onclick="askDelete(this)">Hapus</button></td>
                        </tr>
                    @empty
                        <tr class="faq-row">
                            <td class="faq-no"></td>
                            <td><input type="text" name="questions[]" placeholder="Pertanyaan"></td>
                            <td><textarea name="answers[]" placeholder="Jawaban"></textarea></td>
                            <td><button type="button" class="btn danger" onclick="askDelete(this)">Hapus</button></td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
            <div class="actions">
                <button type="button" class="btn secondary" onclick="addFaqRow()">+ Tambah FAQ</button>
                <button type="submit" class="btn">Simpan FAQ</button>
            </div>
        </form>
    </div>
</div>
<div class="modal fade" id="deleteFaqModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">Apakah yakin untuk dihapus?</div>
            <div class="modal-footer">
                <button type="button" class="btn secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn danger" id="confirmDeleteBtn">Ya, Hapus</button>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
let pendingDeleteRow = null;
function addFaqRow() {
    const wrap = document.getElementById('faqRows');
    const row = document.createElement('tr');
    row.className = 'faq-row';
    row.innerHTML = `
        <td class="faq-no"></td>
        <td><input type="text" name="questions[]" placeholder="Pertanyaan"></td>
        <td><textarea name="answers[]" placeholder="Jawaban"></textarea></td>
        <td><button type="button" class="btn danger" onclick="askDelete(this)">Hapus</button></td>
    `;
    wrap.appendChild(row);
    renumberRows();
}
function askDelete(btn) {
    const row = btn.closest('.faq-row');
    if (!row) return;
    const wrap = document.getElementById('faqRows');
    if (wrap.querySelectorAll('.faq-row').length <= 1) {
        alert('Minimal harus ada 1 baris FAQ.');
        return;
    }
    pendingDeleteRow = row;
    const modalEl = document.getElementById('deleteFaqModal');
    if (window.bootstrap && modalEl) {
        const modal = new bootstrap.Modal(modalEl);
        modal.show();
    } else if (confirm('Apakah yakin untuk dihapus?')) {
        row.remove();
        renumberRows();
    }
}
document.getElementById('confirmDeleteBtn')?.addEventListener('click', () => {
    if (pendingDeleteRow) {
        pendingDeleteRow.remove();
        renumberRows();
        pendingDeleteRow = null;
    }
    const modalEl = document.getElementById('deleteFaqModal');
    if (window.bootstrap && modalEl) {
        bootstrap.Modal.getInstance(modalEl)?.hide();
    }
});
function renumberRows() {
    document.querySelectorAll('#faqRows .faq-row').forEach((row, idx) => {
        const cell = row.querySelector('.faq-no');
        if (cell) cell.textContent = idx + 1;
    });
}
renumberRows();
</script>
</body>
</html>

