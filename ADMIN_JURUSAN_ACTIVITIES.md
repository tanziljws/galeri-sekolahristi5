# Sistem Admin Kegiatan Jurusan

## Overview
Sistem ini memungkinkan admin untuk mengelola foto dan dokumentasi kegiatan untuk semua jurusan di SMKN 4 Bogor (PPLG, TJKT, TPFL, dan TO).

## Fitur Utama

### 1. **Manajemen Kegiatan Jurusan**
- ✅ Tambah kegiatan baru dengan foto
- ✅ Edit kegiatan yang sudah ada
- ✅ Hapus kegiatan
- ✅ Aktifkan/nonaktifkan kegiatan
- ✅ Lihat detail kegiatan

### 2. **Kategori Jurusan**
- **PPLG** - Pengembangan Perangkat Lunak dan Gim
- **TJKT** - Teknik Jaringan Komputer dan Telekomunikasi
- **TPFL** - Teknik Pengolahan Hasil Laut
- **TO** - Teknik Otomotif

### 3. **Tipe Kegiatan**
- **Lab** - Kegiatan laboratorium
- **Workshop** - Pelatihan dan workshop
- **Competition** - Kompetisi dan lomba
- **Project** - Proyek kelompok
- **Field Trip** - Kunjungan lapangan
- **Seminar** - Seminar dan presentasi
- **Other** - Kegiatan lainnya

## Struktur Database

### Tabel: `jurusan_activities`
```sql
- id (Primary Key)
- jurusan (PPLG, TJKT, TPFL, TO)
- title (Judul kegiatan)
- description (Deskripsi kegiatan)
- image_path (Path gambar)
- activity_type (Tipe kegiatan)
- activity_date (Tanggal kegiatan)
- is_active (Status aktif/nonaktif)
- created_at, updated_at (Timestamps)
```

## Cara Penggunaan

### 1. **Akses Admin Panel**
```
URL: /admin/jurusan-activities
Method: GET
Route: admin.jurusan-activities.index
```

### 2. **Tambah Kegiatan Baru**
```
URL: /admin/jurusan-activities/create
Method: GET
Route: admin.jurusan-activities.create
```

**Form Fields:**
- Jurusan (Required)
- Judul Kegiatan (Required)
- Tipe Kegiatan (Required)
- Tanggal Kegiatan (Required)
- Deskripsi (Required)
- Gambar (Required, max 2MB)

### 3. **Edit Kegiatan**
```
URL: /admin/jurusan-activities/{id}/edit
Method: GET
Route: admin.jurusan-activities.edit
```

### 4. **Lihat Detail**
```
URL: /admin/jurusan-activities/{id}
Method: GET
Route: admin.jurusan-activities.show
```

### 5. **Hapus Kegiatan**
```
URL: /admin/jurusan-activities/{id}
Method: DELETE
Route: admin.jurusan-activities.destroy
```

### 6. **Toggle Status**
```
URL: /admin/jurusan-activities/{id}/toggle-status
Method: PATCH
Route: admin.jurusan-activities.toggle-status
```

## Tampilan di Halaman Jurusan

### 1. **PPLG Page**
- URL: `/jurusan/pplg`
- Menampilkan 8 kegiatan PPLG terbaru
- Otomatis update ketika admin menambah kegiatan baru

### 2. **TJKT Page**
- URL: `/jurusan/tjkt`
- Menampilkan 8 kegiatan TJKT terbaru

### 3. **TPFL Page**
- URL: `/jurusan/tpfl`
- Menampilkan 8 kegiatan TPFL terbaru

### 4. **TO Page**
- URL: `/jurusan/to`
- Menampilkan 8 kegiatan TO terbaru

## File Storage

### Struktur Direktori
```
storage/app/public/jurusan-activities/
├── pplg_activity_1.jpg
├── tjkt_workshop_1.jpg
├── tpfl_lab_1.jpg
└── to_project_1.jpg
```

### Konfigurasi
- **Disk**: `public`
- **Path**: `jurusan-activities/`
- **Max Size**: 2MB
- **Format**: JPG, PNG, GIF

## Routes

### Admin Routes (Protected by Auth)
```php
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::resource('jurusan-activities', JurusanActivityController::class);
    Route::patch('jurusan-activities/{jurusanActivity}/toggle-status', [JurusanActivityController::class, 'toggleStatus']);
});
```

### Public Routes
```php
Route::get('/jurusan/pplg', [JurusanController::class, 'pplg'])->name('jurusan.pplg');
Route::get('/jurusan/tjkt', [JurusanController::class, 'tjkt'])->name('jurusan.tjkt');
Route::get('/jurusan/tpfl', [JurusanController::class, 'tpfl'])->name('jurusan.tpfl');
Route::get('/jurusan/to', [JurusanController::class, 'to'])->name('jurusan.to');
```

## Controller Methods

### JurusanActivityController
- `index()` - Daftar semua kegiatan
- `create()` - Form tambah kegiatan
- `store()` - Simpan kegiatan baru
- `show()` - Tampilkan detail kegiatan
- `edit()` - Form edit kegiatan
- `update()` - Update kegiatan
- `destroy()` - Hapus kegiatan
- `toggleStatus()` - Toggle status aktif/nonaktif

### JurusanController
- `pplg()` - Halaman PPLG dengan kegiatan
- `tjkt()` - Halaman TJKT dengan kegiatan
- `tpfl()` - Halaman TPFL dengan kegiatan
- `to()` - Halaman TO dengan kegiatan

## Model Scopes

### JurusanActivity Model
```php
// Scope untuk kegiatan aktif
JurusanActivity::active()

// Scope untuk filter berdasarkan jurusan
JurusanActivity::byJurusan('PPLG')

// Scope untuk urutan terbaru
JurusanActivity::latest()

// Kombinasi
JurusanActivity::active()->byJurusan('PPLG')->latest()->take(8)->get()
```

## Keamanan

### 1. **Authentication**
- Semua route admin dilindungi middleware `auth`
- Hanya user yang sudah login yang bisa akses

### 2. **File Upload Validation**
- Validasi tipe file (JPG, PNG, GIF)
- Validasi ukuran file (max 2MB)
- Validasi input required

### 3. **CSRF Protection**
- Semua form dilindungi CSRF token
- Method spoofing untuk PUT/DELETE

## Maintenance

### 1. **Backup Database**
```bash
php artisan db:backup
```

### 2. **Clear Cache**
```bash
php artisan cache:clear
php artisan config:clear
php artisan view:clear
```

### 3. **Storage Maintenance**
```bash
# Hapus file yang tidak terpakai
php artisan storage:clean

# Recreate symbolic link
php artisan storage:link
```

## Troubleshooting

### 1. **Gambar Tidak Muncul**
- Pastikan symbolic link storage sudah dibuat
- Cek permission direktori storage
- Cek path gambar di database

### 2. **Upload Gagal**
- Cek ukuran file (max 2MB)
- Cek tipe file (JPG, PNG, GIF)
- Cek permission direktori storage

### 3. **Route Not Found**
- Jalankan `php artisan route:clear`
- Cek file `routes/web.php`
- Pastikan controller ada

## Update Log

### v1.0.0 (28/08/2025)
- ✅ Sistem admin kegiatan jurusan
- ✅ CRUD lengkap untuk kegiatan
- ✅ Upload dan manajemen gambar
- ✅ Tampilan dinamis di halaman jurusan
- ✅ Filter berdasarkan jurusan
- ✅ Status aktif/nonaktif
- ✅ Pagination dan search
- ✅ Responsive design
