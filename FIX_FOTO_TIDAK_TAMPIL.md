# 🔧 Fix: Foto Tidak Tampil di Galeri

## 🐛 Masalah

Foto tidak tampil di halaman galeri publik (area kosong/placeholder).

## 🔍 Penyebab

**Symbolic link tidak berfungsi dengan baik di Windows XAMPP.**

Laravel menggunakan symbolic link dari `public/storage` → `storage/app/public`, tapi di Windows (terutama XAMPP) symbolic link sering tidak berfungsi dengan benar.

## ✅ Solusi yang Sudah Diterapkan

### 1. **Dual Storage (Windows Fix)**
Setiap foto yang diupload sekarang otomatis disimpan di **2 lokasi**:
- `storage/app/public/galeri/` (lokasi utama Laravel)
- `public/storage/galeri/` (lokasi fallback untuk Windows)

### 2. **ImageHelper dengan Fallback**
File `app/Helpers/ImageHelper.php` sudah diupdate untuk mencari foto di berbagai lokasi:
1. `public/storage/galeri/` (cek dulu)
2. `storage/app/public/galeri/` (fallback)
3. `public/images/galeri/` (fallback terakhir)

### 3. **Update View**
File `resources/views/galeri/public.blade.php` sudah menggunakan:
```php
\App\Helpers\ImageHelper::getImageUrl($photo->file)
```
Bukan lagi `asset('storage/galeri/' . $photo->file)`

## 🚀 Hasil

- ✅ Foto baru yang diupload langsung tampil
- ✅ Tidak perlu manual copy file
- ✅ Bekerja di Windows tanpa symbolic link
- ✅ Tetap kompatibel dengan Linux/Mac

## 📋 File yang Dimodifikasi

1. **`app/Http/Controllers/GaleriController.php`**
   - Method `store()` - Tambah copy ke public/storage
   - Method `quickUpload()` - Tambah copy ke public/storage

2. **`resources/views/galeri/public.blade.php`**
   - Ganti `asset()` dengan `ImageHelper::getImageUrl()`

3. **`app/Helpers/ImageHelper.php`**
   - Sudah ada fallback ke storage/app/public

## 🔧 Jika Foto Lama Tidak Tampil

Jika ada foto lama yang belum tampil, jalankan script ini:

```bash
php artisan tinker
```

Lalu jalankan:
```php
// Copy semua foto dari storage/app/public/galeri ke public/storage/galeri
$files = File::files(storage_path('app/public/galeri'));
foreach ($files as $file) {
    $filename = $file->getFilename();
    $dest = public_path('storage/galeri/' . $filename);
    if (!file_exists($dest)) {
        copy($file->getRealPath(), $dest);
        echo "Copied: $filename\n";
    }
}
```

Atau buat script PHP sederhana:

```php
<?php
// sync_photos.php
$source = __DIR__ . '/storage/app/public/galeri/';
$dest = __DIR__ . '/public/storage/galeri/';

if (!is_dir($dest)) {
    mkdir($dest, 0755, true);
}

$files = scandir($source);
foreach ($files as $file) {
    if ($file != '.' && $file != '..') {
        $src = $source . $file;
        $dst = $dest . $file;
        if (is_file($src) && !file_exists($dst)) {
            copy($src, $dst);
            echo "Copied: $file\n";
        }
    }
}
echo "Done!\n";
```

Jalankan: `php sync_photos.php`

## 💡 Catatan

- Solusi ini khusus untuk environment Windows/XAMPP
- Di production (Linux), symbolic link biasanya berfungsi normal
- Dual storage memang menggunakan space 2x, tapi memastikan foto selalu tampil
- ImageHelper tetap akan mencari di storage/app/public jika file tidak ada di public/storage

## 📞 Support

Jika masih ada masalah, cek:
1. Apakah folder `public/storage/galeri` ada?
2. Apakah file foto ada di `storage/app/public/galeri`?
3. Apakah permission folder sudah benar? (755)

**Dibuat:** 28 Oktober 2025
**Status:** ✅ Fixed
