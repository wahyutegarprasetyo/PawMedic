# Cara Membaca Data dari Excel DatasetTraining.xlsx

Untuk membaca data gejala dari file Excel, Anda perlu menginstall library PhpSpreadsheet:

```bash
composer require phpoffice/phpspreadsheet
```

Setelah library terinstall, controller `DiagnosisController` akan otomatis membaca data dari file `public/data/DatasetTraining.xlsx`.

Jika library belum terinstall, sistem akan menggunakan data gejala default yang sudah tersedia.

## Struktur Excel yang Diharapkan

File Excel sebaiknya memiliki struktur:
- Baris pertama: Header (akan di-skip)
- Kolom-kolom: Berisi nama gejala
- Kolom terakhir: Biasanya berisi nama penyakit/diagnosis

Controller akan membaca semua kolom kecuali kolom terakhir sebagai data gejala.
