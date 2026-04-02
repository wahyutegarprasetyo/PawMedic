# Kredensial Login Admin PawMedic

## Default Admin Credentials

**Email:** `admin@pawmedic.app`  
**Password:** `admin123`

## Cara Setup Admin

1. **Jalankan migration dan seeder:**
   ```bash
   php artisan migrate
   php artisan db:seed
   ```

2. **Atau buat user admin manual:**
   ```bash
   php artisan tinker
   ```
   Kemudian jalankan:
   ```php
   App\Models\User::create([
       'name' => 'Admin PawMedic',
       'email' => 'admin@pawmedic.app',
       'password' => Hash::make('admin123'),
       'email_verified_at' => now(),
   ]);
   ```

## Akses Login Admin

1. Buka halaman landing page
2. Scroll ke footer
3. Klik icon kunci (🔐) di pojok kanan bawah footer
4. Atau langsung akses: `/admin/login`

## Keamanan

⚠️ **PENTING:** Setelah pertama kali login, segera ubah password admin untuk keamanan!

## Mengubah Password Admin

Anda dapat mengubah password melalui:
1. Tinker: `php artisan tinker`
2. Atau buat fitur change password di dashboard admin
