<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Calon Data Training - PawMedic Admin</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700;800&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
body{margin:0;font-family:'Inter',sans-serif;background:#f4faf7;color:#1f2937}
.container{max-width:1180px;margin:0 auto;padding:28px 16px}
.head{display:flex;justify-content:space-between;align-items:center;gap:12px;margin-bottom:18px}
.title-wrap{display:flex;align-items:center;gap:10px}
.logo-icon{width:40px;height:40px;border-radius:10px;background:linear-gradient(135deg,#6fcf97,#4bb66f);display:flex;align-items:center;justify-content:center;color:#fff;font-size:18px}
.title{font-family:'Poppins',sans-serif;font-size:30px;margin:0;color:#114d3a}
.subtitle{color:#64748b;margin-top:6px}
.card{background:#fff;border:1px solid #d1fae5;border-radius:16px;padding:16px;box-shadow:0 8px 20px rgba(17,77,58,.08)}
.notice{background:#e8f7ef;border:1px solid #b7ebcf;padding:10px;border-radius:10px;color:#114d3a;margin-bottom:10px}
.btn{padding:10px 14px;border-radius:10px;border:1px solid #6fcf97;background:#6fcf97;color:#fff;font-weight:700;cursor:pointer;text-decoration:none}
.btn.secondary{background:#fff;color:#114d3a}
.btn.danger{background:#fff;border-color:#fca5a5;color:#b91c1c}
.table-wrap{overflow:auto;border:1px solid #e2e8f0;border-radius:10px}
table{width:100%;border-collapse:collapse}
th,td{padding:10px;border-bottom:1px solid #e2e8f0;vertical-align:middle}
th{background:#e8f7ef;text-align:left}
input{width:100%;padding:8px;border:1px solid #cbd5e1;border-radius:8px;font:inherit}
.actions{display:flex;justify-content:space-between;align-items:center;margin-top:12px;gap:10px;flex-wrap:wrap}
.tag{display:inline-block;padding:4px 8px;border-radius:999px;font-size:12px;font-weight:700}
.tag.ready{background:#dcfce7;color:#166534}
.tag.need{background:#fee2e2;color:#991b1b}
.row-no{width:54px;text-align:center}
</style>
</head>
<body>
<div class="container">
    <div class="head">
        <div>
            <div class="title-wrap">
                <div class="logo-icon" aria-hidden="true">
                    <svg viewBox="0 0 24 24" width="20" height="20" fill="currentColor">
                        <circle cx="6" cy="8" r="2.2"></circle>
                        <circle cx="10.8" cy="5.6" r="2.1"></circle>
                        <circle cx="15.8" cy="8" r="2.2"></circle>
                        <path d="M12 10.6c-3.4 0-5.9 2.4-5.9 4.9 0 2.2 1.8 3.9 4 3.9 1.4 0 1.9-.7 2-.7s.6.7 2 .7c2.2 0 4-1.7 4-3.9 0-2.6-2.6-4.9-6.1-4.9z"></path>
                    </svg>
                </div>
                <h1 class="title">Calon Data Training Penyakit</h1>
            </div>
            <div class="subtitle">Tahap awal hanya isi nama penyakit dan kategori.</div>
        </div>
        <a class="btn secondary" href="{{ route('admin.dashboard') }}">← Dashboard</a>
    </div>

    <div class="card">
        @if(session('success'))
            <div class="notice">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="notice" style="background:#fee2e2;border-color:#fca5a5;color:#991b1b">{{ session('error') }}</div>
        @endif
        <div class="notice">
            Isi data penyakit dulu, lalu klik <strong>Atur Gejala</strong>. Status <strong>Belum Siap</strong> jika sample terisi belum 10, dan <strong>Siap</strong> jika sudah 10/10.
        </div>

        <form method="POST" action="{{ route('admin.training.settings.save') }}">
            @csrf
            <div class="table-wrap">
                <table id="trainingTable">
                    <thead>
                        <tr>
                            <th class="row-no">No</th>
                            <th style="min-width:220px;">Penyakit</th>
                            <th style="min-width:180px;">Kategori</th>
                            <th style="min-width:130px;">Sample Terisi</th>
                            <th style="min-width:120px;">Status</th>
                            <th style="min-width:240px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="rows">
                    @forelse($items as $it)
                        <tr class="training-row">
                            <td class="row-no row-counter"></td>
                            <td style="display:none;"><input type="hidden" name="id[]" value="{{ $it['id'] ?? '' }}"></td>
                            <td><input type="text" name="disease[]" value="{{ $it['disease'] ?? '' }}"></td>
                            <td><input type="text" name="category[]" value="{{ $it['category'] ?? '' }}"></td>
                            <td>{{ (int)($it['samples'] ?? 0) }}/10</td>
                            <td>
                                @if(($it['status'] ?? '') === 'ready-train')
                                    <span class="tag ready">Siap</span>
                                @else
                                    <span class="tag need">Belum Siap</span>
                                @endif
                            </td>
                            <td style="display:flex;gap:8px;flex-wrap:wrap;">
                                <a class="btn secondary" href="{{ route('admin.training.symptoms.edit', $it['id']) }}">Atur Gejala</a>
                                <button type="button" class="btn danger btn-delete-row" onclick="askDeleteTrainingRow(this)">Hapus</button>
                            </td>
                        </tr>
                    @empty
                        <tr class="training-row">
                            <td class="row-no row-counter"></td>
                            <td style="display:none;"><input type="hidden" name="id[]" value=""></td>
                            <td><input type="text" name="disease[]" placeholder="Contoh: Feline Diabetes"></td>
                            <td><input type="text" name="category[]" placeholder="Contoh: Metabolik"></td>
                            <td>0/10</td>
                            <td><span class="tag need">Belum Siap</span></td>
                            <td><span class="btn secondary" style="opacity:.6;pointer-events:none;">Simpan dulu</span></td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
            <div class="actions">
                <button type="button" class="btn secondary" onclick="addRow()">+ Tambah Baris</button>
                <a href="{{ route('admin.training.export') }}" class="btn secondary">Export Data Kandidat</a>
                <button type="submit" class="btn">Simpan Tahap Awal</button>
            </div>
        </form>
    </div>
</div>
<script>
function addRow() {
    const tbody = document.getElementById('rows');
    const tr = document.createElement('tr');
    tr.className = 'training-row';
    tr.innerHTML = `
        <td class="row-no row-counter"></td>
        <td style="display:none;"><input type="hidden" name="id[]" value=""></td>
        <td><input type="text" name="disease[]" placeholder="Nama penyakit"></td>
        <td><input type="text" name="category[]" placeholder="Kategori"></td>
        <td>0/10</td>
        <td><span class="tag need">Belum Siap</span></td>
        <td><span class="btn secondary" style="opacity:.6;pointer-events:none;">Simpan dulu</span></td>
    `;
    tbody.appendChild(tr);
    reindexRows();
}
let pendingDeleteRow = null;
function askDeleteTrainingRow(btn) {
    pendingDeleteRow = btn.closest('.training-row');
    const modalEl = document.getElementById('confirmDeleteTrainingModal');
    if (window.bootstrap && modalEl) {
        const modal = new bootstrap.Modal(modalEl);
        modal.show();
        return;
    }
    deleteTrainingRow();
}
function deleteTrainingRow() {
    const row = pendingDeleteRow;
    const modalEl = document.getElementById('confirmDeleteTrainingModal');
    if (modalEl && window.bootstrap) {
        const instance = bootstrap.Modal.getInstance(modalEl);
        if (instance) instance.hide();
    }
    const rows = document.querySelectorAll('.training-row');
    if (!row || rows.length <= 1) {
        const minRowAlert = document.getElementById('minRowAlert');
        if (minRowAlert) minRowAlert.classList.remove('d-none');
        return;
    }
    row.remove();
    pendingDeleteRow = null;
    reindexRows();
}
function reindexRows() {
    const rows = document.querySelectorAll('#rows .training-row');
    rows.forEach((row, idx) => {
        const no = row.querySelector('.row-counter');
        if (no) no.textContent = idx + 1;
    });
}
reindexRows();
</script>
<div id="minRowAlert" class="alert alert-warning d-none" style="position:fixed;right:16px;bottom:16px;z-index:1080;">
    Minimal harus ada 1 baris data.
</div>
<div class="modal fade" id="confirmDeleteTrainingModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Konfirmasi Hapus</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">Yakin ingin menghapus baris data ini?</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="width:auto;">Batal</button>
        <button type="button" class="btn btn-danger" style="width:auto;" onclick="deleteTrainingRow()">Ya, Hapus</button>
      </div>
    </div>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
