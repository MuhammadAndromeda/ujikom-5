# CV. Sumber Pasir Jaya — Sales Admin Dashboard

Sistem manajemen penjualan berbasis web untuk CV. Sumber Pasir Jaya, dibangun menggunakan Laravel 12 + Filament v3.

---

## 📋 Daftar Isi

- [Fitur](#fitur)
- [Tech Stack](#tech-stack)
- [Persyaratan Sistem](#persyaratan-sistem)
- [Instalasi](#instalasi)
- [Konfigurasi](#konfigurasi)
- [Struktur Proyek](#struktur-proyek)
- [Panduan Penggunaan](#panduan-penggunaan)
- [Panduan Developer](#panduan-developer)
- [Akun Default](#akun-default)

---

## ✨ Fitur

### Dashboard
- Stats card (total penjualan hari ini, total transaksi, produk terlaris)
- Grafik penjualan 7 hari terakhir

### Data Master
- **Kategori** — Kelola kategori material
- **Material** — Kelola data material beserta stok
- **Customer** — Kelola data pelanggan
- **User & Kasir** — Kelola akun pengguna beserta hak akses

### Transaksi Sales
- CRUD transaksi penjualan
- Auto-generate nomor invoice (format: INV-YYYYMMDD-XXX)
- Dropdown material dinamis dari database
- Auto-kurang stok material setiap transaksi

### Laporan
- **Sales Data** — Summary total terjual & pendapatan per produk
- **Sales Report** — Read-only list transaksi + filter tanggal
- **Report Page** — Search, filter tanggal, export Excel, pagination

### Struk/Receipt
- Detail transaksi lengkap (invoice, customer, material, total, kembalian)
- Download PDF

---

## 🛠 Tech Stack

| Layer | Teknologi |
|-------|-----------|
| Backend | Laravel 12 |
| Admin Panel | Filament v3 |
| Database | MySQL |
| Frontend | Blade + Tailwind CSS |
| PDF Export | barryvdh/laravel-dompdf |
| Excel Export | maatwebsite/excel |
| Permission | spatie/laravel-permission |

---

## ⚙️ Persyaratan Sistem

- PHP >= 8.2
- Composer
- MySQL >= 5.7
- Node.js >= 18 (untuk asset compilation)
- SSH Access (untuk deployment)

---

## 🚀 Instalasi

### 1. Clone repository

```bash
git clone https://github.com/MuhammadAndromeda/ujikom-5.git
cd ujikom-5
```

### 2. Install dependencies

```bash
composer install
npm install
```

### 3. Copy file environment

```bash
cp .env.example .env
php artisan key:generate
```

### 4. Konfigurasi database

Edit file `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ujikom-5
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Jalankan migration & seeder

```bash
php artisan migrate
php artisan db:seed --class=PermissionSeeder
```

### 6. Buat akun admin pertama

```bash
php artisan make:filament-user
```

> **Penting:** Gunakan email `sumberpasirjaya09@gmail.com` untuk akun master yang bisa akses semua menu.

### 7. Jalankan server

```bash
composer run dev
```

Akses di `http://127.0.0.1:8000`

---

## 🔧 Konfigurasi

### Akun Master

Email akun master dikonfigurasi di `config/master.php`:

```php
return [
    'email' => 'sumberpasirjaya09@gmail.com',
];
```

Akun dengan email ini akan bypass semua permission check dan bisa akses semua menu.

### Permission

Permission dikelola menggunakan Spatie Laravel Permission. Untuk menambah permission baru:

1. Tambahkan permission di `database/seeders/PermissionSeeder.php`
2. Jalankan: `php artisan db:seed --class=PermissionSeeder`
3. Tambahkan `canAccess()` di Resource yang sesuai

---

## 📁 Struktur Proyek

```
app/
├── Exports/
│   └── SalesExport.php              # Export Excel
├── Filament/
│   ├── Resources/
│   │   ├── Categories/              # Resource Kategori
│   │   ├── Customers/               # Resource Customer
│   │   ├── Materials/               # Resource Material
│   │   ├── Products/                # Resource Products (Sales Summary)
│   │   ├── Sales/                   # Resource Sales (CRUD Transaksi)
│   │   ├── SalesReports/            # Resource Sales Report (Read-only)
│   │   └── Users/                   # Resource User & Kasir
│   └── Widgets/
│       ├── SalesSummaryWidget.php   # Widget tabel summary produk
│       ├── SalesChartWidget.php     # Widget grafik penjualan
│       └── StatsOverviewWidget.php  # Widget stats card dashboard
├── Models/
│   ├── Category.php
│   ├── Customer.php
│   ├── Material.php
│   ├── Sales.php                    # Model utama transaksi
│   └── User.php
database/
├── migrations/                      # Semua file migration
└── seeders/
    └── PermissionSeeder.php         # Seeder permission Spatie
resources/
└── views/
    ├── layouts/
    │   └── main.blade.php           # Layout utama halaman publik
    ├── report.blade.php             # Halaman laporan publik
    ├── receipt.blade.php            # Halaman struk
    └── receipt-pdf.blade.php        # Template PDF struk
routes/
└── web.php                          # Route publik (report, receipt, export)
```

---

## 📖 Panduan Penggunaan

### Login
- Akses dashboard di `/dashboard`
- Login menggunakan email dan password

### Alur Penggunaan Normal

1. **Setup awal** — Tambah Kategori dan Material terlebih dahulu di menu Data Master
2. **Tambah Customer** — Daftarkan customer di menu Data Master → Customer
3. **Input Transaksi** — Masuk ke menu Sales → klik "New Sales" → isi form transaksi
4. **Cek Struk** — Setelah transaksi, buka `/report` → klik tombol Receipt di row transaksi
5. **Lihat Laporan** — Buka `/report` untuk filter, search, dan export data penjualan

### Manajemen User

- Hanya akun master (`sumberpasirjaya09@gmail.com`) yang bisa bikin user baru
- User baru perlu di-toggle `can_access = 1` agar bisa login ke dashboard
- Centang permission yang sesuai untuk mengatur menu apa yang bisa diakses

---

## 👨‍💻 Panduan Developer

### Menambah Menu/Resource Baru

1. Buat model & migration:
```bash
php artisan make:model NamaModel -m
```

2. Buat Filament Resource:
```bash
php artisan make:filament-resource NamaModel
```

3. Tambahkan navigation group di Resource:
```php
public static function getNavigationGroup(): ?string
{
    return 'Nama Group';
}
```

4. Tambahkan permission baru di `PermissionSeeder.php` dan jalankan seeder

5. Tambahkan `canAccess()` di Resource:
```php
public static function canAccess(): bool
{
    $user = auth()->user();
    if ($user->is_admin == 1 || $user->email === config('master.email')) {
        return true;
    }
    return $user->can('view nama-permission');
}
```

### Menambah Kolom Baru di Tabel Sales

1. Buat migration:
```bash
php artisan make:migration add_kolom_baru_to_sales_table
```

2. Update `SalesForm.php` untuk form input
3. Update `SalesTable.php` untuk tampilan tabel
4. Update `SalesExport.php` jika ingin kolom baru masuk ke export Excel
5. Update `receipt.blade.php` dan `receipt-pdf.blade.php` jika perlu ditampilkan di struk

### Mengganti Email Akun Master

Edit file `config/master.php`:
```php
return [
    'email' => 'email_baru@domain.com',
];
```

Lalu jalankan:
```bash
php artisan config:clear
```

### Menambah Jenis Laporan

Tambahkan route baru di `web.php` dan buat blade file baru di `resources/views/`.

---

## 🔑 Akun Default

| Role | Email | Password | Akses |
|------|-------|----------|-------|
| Master Admin | sumberpasirjaya09@gmail.com | *(set saat instalasi)* | Semua menu |

> **Catatan:** Setelah instalasi, segera ganti password akun master dan jangan share kredensial ini ke pihak yang tidak berwenang.

---

## 📞 Kontak

Untuk pertanyaan atau bug report, hubungi developer:

- **Developer:** Andromeda Harahap
- **Email:** 2009.andromeda@gmail.com
- **GitHub:** github.com/MuhammadAndromeda

---

*Last updated: Maret 2026*
