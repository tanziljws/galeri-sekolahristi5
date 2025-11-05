# 🔧 Fix: Foto Berita Muncul di Galeri Kegiatan Sekolah

## 🐛 Masalah

Foto berita yang diupload muncul di halaman "Galeri Kegiatan Sekolah", padahal seharusnya hanya tampil di halaman detail berita.

**Contoh:**
- Upload foto untuk berita "TKA (Tes Kemampuan Akademik)"
- Foto muncul di "Galeri Kegiatan Sekolah" ❌
- Seharusnya hanya muncul di detail berita ✅

## 🔍 Penyebab

Saat membuat galeri untuk berita, sistem set `category` = 'umum', sehingga foto berita ikut ditampilkan di halaman "Galeri Kegiatan Sekolah" yang menampilkan semua galeri dengan status aktif.

## ✅ Solusi yang Diterapkan

### 1. **Ubah Category Galeri Berita**
Galeri untuk berita sekarang menggunakan category khusus: `'berita'`

**Sebelum:**
```php
'category' => 'umum'  // ❌ Ikut tampil di Galeri Kegiatan
```

**Sesudah:**
```php
'category' => 'berita'  // ✅ Tidak tampil di Galeri Kegiatan
```

### 2. **Filter Halaman Galeri Kegiatan**
Halaman "Galeri Kegiatan Sekolah" sekarang **exclude** galeri berita:

```php
->whereHas('galery', function ($q) {
    $q->where('status', 1)
      ->where('category', '!=', 'berita'); // Exclude galeri berita
})
```

### 3. **Update Galeri Lama**
Galeri berita yang sudah ada (seperti TKA, Upacara) sudah diupdate category-nya dari 'umum' ke 'berita'.

## 📁 File yang Dimodifikasi

1. **`app/Http/Controllers/PostController.php`**
   - Method `store()` - Category 'berita'
   - Method `update()` - Category 'berita'

2. **`app/Http/Controllers/GaleriController.php`**
   - Method `public()` - Filter exclude 'berita'

3. **Database**
   - Update existing galeri berita category

## 🎯 Hasil

### **Sebelum Fix:**
```
Galeri Kegiatan Sekolah:
├── Senam ✅ (kegiatan sekolah)
├── TKA ❌ (berita, seharusnya tidak muncul)
└── Upacara ❌ (berita, seharusnya tidak muncul)
```

### **Sesudah Fix:**
```
Galeri Kegiatan Sekolah:
└── Senam ✅ (kegiatan sekolah)

Detail Berita TKA:
└── Foto TKA ✅ (tampil di sini)

Detail Berita Upacara:
└── Foto Upacara ✅ (tampil di sini)
```

## 📊 Category Galeri

Sekarang ada 3 jenis category galeri:

| Category | Tampil di | Contoh |
|----------|-----------|--------|
| `umum` | Galeri Kegiatan Sekolah | Senam, Olahraga |
| `prestasi` | Galeri Kegiatan Sekolah (tab Prestasi) | Juara Lomba |
| `ekstrakurikuler` | Galeri Kegiatan Sekolah | Pramuka, PMR |
| `tpfl`, `pplg`, `tjkt`, `to` | Halaman Jurusan | Kegiatan Jurusan |
| `berita` | **HANYA** di Detail Berita | Foto berita |

## 🚀 Workflow Foto Berita

```
1. Admin upload foto di form berita
   ↓
2. Sistem create galeri dengan category 'berita'
   ↓
3. Foto disimpan ke galeri tersebut
   ↓
4. Foto HANYA tampil di:
   - Detail berita (hero image + sidebar)
   ✅ Tidak tampil di Galeri Kegiatan Sekolah
```

## 💡 Catatan Penting

### **Untuk Admin:**
- ✅ Upload foto berita di form berita (bukan di menu Galeri)
- ✅ Foto berita otomatis tidak muncul di Galeri Kegiatan
- ✅ Foto berita hanya tampil di halaman detail berita
- ✅ Galeri Kegiatan Sekolah untuk foto kegiatan sekolah saja

### **Perbedaan Galeri Berita vs Galeri Kegiatan:**

**Galeri Berita:**
- Category: `berita`
- Dibuat otomatis saat upload foto berita
- Terhubung dengan post via `post_id`
- Tampil di: Detail berita
- Tidak tampil di: Galeri Kegiatan Sekolah

**Galeri Kegiatan:**
- Category: `umum`, `prestasi`, `ekstrakurikuler`, dll
- Dibuat manual di menu Galeri
- Tidak terhubung dengan post (`post_id` = null)
- Tampil di: Galeri Kegiatan Sekolah
- Tidak tampil di: Detail berita

## 🔧 Script Update

Jika ada galeri berita lama yang perlu diupdate:

```bash
php update_galeri_berita.php
```

Script ini akan:
1. Cari galeri dengan `category` = 'umum' dan `post_id` tidak null
2. Update category menjadi 'berita'
3. Tampilkan hasil update

## ✅ Checklist

- [x] Update PostController - category 'berita'
- [x] Update GaleriController - filter exclude 'berita'
- [x] Update galeri lama (TKA, Upacara)
- [x] Test: Foto berita tidak muncul di Galeri Kegiatan
- [x] Test: Foto berita tampil di detail berita
- [x] Dokumentasi

## 📞 Support

Jika masih ada foto berita yang muncul di Galeri Kegiatan:
1. Cek category galeri di database
2. Jalankan script `update_galeri_berita.php`
3. Clear cache browser
4. Refresh halaman

---

**Dibuat:** 28 Oktober 2025  
**Status:** ✅ Fixed  
**Affected Files:** 2 controllers, 1 database update
