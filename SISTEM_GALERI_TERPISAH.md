# Sistem Galeri Terpisah - SMKN 4 Bogor

## Overview
Sistem ini memisahkan dengan jelas antara **Galeri Kegiatan Jurusan** dan **Galeri Sekolah Umum** agar tidak tercampur.

## 🎯 **Pemisahan Sistem Galeri**

### 1. **GALERI KEGIATAN JURUSAN** (Jurusan Activities)
- **Lokasi**: Halaman jurusan masing-masing (PPLG, TJKT, TPFL, TO)
- **URL Admin**: `/admin/jurusan-activities`
- **Tabel Database**: `jurusan_activities`
- **Storage**: `storage/app/public/jurusan-activities/`
- **Fungsi**: Menampilkan foto kegiatan khusus jurusan

### 2. **GALERI SEKOLAH UMUM** (School Gallery)
- **Lokasi**: Halaman utama "Galeri Agenda Sekolah"
- **URL Admin**: `/admin/school-galleries`
- **Tabel Database**: `school_galleries`
- **Storage**: `storage/app/public/school-gallery/`
- **Fungsi**: Menampilkan foto kegiatan umum sekolah

## 📁 **Struktur File & Database**

### Database Tables
```sql
-- Tabel untuk kegiatan jurusan
jurusan_activities:
- id, jurusan, title, description, image_path, activity_type, activity_date, is_active

-- Tabel untuk galeri sekolah umum
school_galleries:
- id, title, description, image_path, category, event_date, is_active
```

### File Storage
```
storage/app/public/
├── jurusan-activities/     # Foto kegiatan jurusan
│   ├── pplg_activity_1.jpg
│   ├── tjkt_workshop_1.jpg
│   ├── tpfl_lab_1.jpg
│   └── to_project_1.jpg
└── school-gallery/         # Foto galeri sekolah umum
    ├── kegiatan_sekolah_1.jpg
    ├── acara_khusus_1.jpg
    ├── prestasi_1.jpg
    └── fasilitas_1.jpg
```

## 🔄 **Alur Kerja Admin**

### **Untuk Menambah Foto Kegiatan Jurusan:**
1. Buka `/admin/jurusan-activities`
2. Klik "Tambah Kegiatan Baru"
3. Pilih jurusan (PPLG, TJKT, TPFL, atau TO)
4. Upload foto + isi informasi
5. **Hasil**: Foto muncul di halaman jurusan yang dipilih

### **Untuk Menambah Foto Galeri Sekolah:**
1. Buka `/admin/school-galleries`
2. Klik "Tambah Foto Baru"
3. Pilih kategori (kegiatan sekolah, acara, prestasi, dll)
4. Upload foto + isi informasi
5. **Hasil**: Foto muncul di halaman utama "Galeri Agenda Sekolah"

## 🎨 **Tampilan di Website**

### **Halaman Jurusan (PPLG, TJKT, TPFL, TO):**
- **URL**: `/jurusan/pplg`, `/jurusan/tjkt`, `/jurusan/tpfl`, `/jurusan/to`
- **Konten**: Hanya menampilkan foto kegiatan jurusan yang dipilih
- **Sumber**: Tabel `jurusan_activities` dengan filter jurusan

### **Halaman Utama - Galeri Agenda Sekolah:**
- **URL**: `/` (section gallery)
- **Konten**: Hanya menampilkan foto galeri sekolah umum
- **Sumber**: Tabel `school_galleries`

## ✅ **Keuntungan Pemisahan**

1. **Tidak Tercampur**: Foto jurusan tidak akan muncul di galeri utama
2. **Manajemen Mudah**: Admin bisa mengelola galeri secara terpisah
3. **Konten Terorganisir**: Setiap jurusan punya galeri sendiri
4. **Fleksibilitas**: Bisa mengatur status aktif/nonaktif secara terpisah
5. **Storage Terpisah**: File tersimpan di direktori yang berbeda

## 🚫 **Yang TIDAK Akan Terjadi**

- ❌ Foto kegiatan PPLG tidak akan muncul di "Galeri Agenda Sekolah"
- ❌ Foto kegiatan TJKT tidak akan muncul di "Galeri Agenda Sekolah"
- ❌ Foto kegiatan TPFL tidak akan muncul di "Galeri Agenda Sekolah"
- ❌ Foto kegiatan TO tidak akan muncul di "Galeri Agenda Sekolah"
- ❌ Foto galeri sekolah umum tidak akan muncul di halaman jurusan

## 🔧 **Konfigurasi Routes**

### Admin Routes
```php
// Jurusan Activities (Kegiatan Jurusan)
Route::resource('jurusan-activities', JurusanActivityController::class);

// School Gallery (Galeri Sekolah Umum)
Route::resource('school-galleries', SchoolGalleryController::class);
```

### Public Routes
```php
// Halaman Jurusan (dengan kegiatan masing-masing)
Route::get('/jurusan/pplg', [JurusanController::class, 'pplg']);
Route::get('/jurusan/tjkt', [JurusanController::class, 'tjkt']);
Route::get('/jurusan/tpfl', [JurusanController::class, 'tpfl']);
Route::get('/jurusan/to', [JurusanController::class, 'to']);
```

## 📱 **Contoh Penggunaan**

### **Scenario 1: Admin ingin menambah foto lab PPLG**
1. Buka `/admin/jurusan-activities`
2. Pilih jurusan: **PPLG**
3. Upload foto lab coding
4. **Hasil**: Foto muncul di halaman `/jurusan/pplg` saja

### **Scenario 2: Admin ingin menambah foto upacara sekolah**
1. Buka `/admin/school-galleries`
2. Pilih kategori: **Kegiatan Sekolah**
3. Upload foto upacara
4. **Hasil**: Foto muncul di halaman utama "Galeri Agenda Sekolah" saja

## 🎯 **Kesimpulan**

Dengan sistem ini:
- **Foto kegiatan jurusan** → Hanya muncul di halaman jurusan masing-masing
- **Foto galeri sekolah** → Hanya muncul di halaman utama galeri
- **Tidak ada pencampuran** antara kedua jenis galeri
- **Admin bisa mengelola** kedua galeri secara terpisah dan mudah

Sistem ini memastikan bahwa setiap foto muncul di tempat yang tepat sesuai dengan kategorinya!
