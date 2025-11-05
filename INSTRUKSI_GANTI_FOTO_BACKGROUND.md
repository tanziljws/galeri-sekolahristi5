# 📸 Instruksi Ganti Foto Background

## 🎯 Foto yang Dibutuhkan

Untuk mengganti background dengan **foto siswa asli** (foto ke-2 yang lebih terang/jelas), ikuti langkah berikut:

---

## 📁 Langkah Upload Foto Baru

### **1. Simpan Foto Siswa Asli**
- Download/save foto siswa (foto ke-2) yang lebih terang
- Rename menjadi: **`siswa-background.jpg`**

### **2. Upload ke Folder Images**
- Copy file ke: `c:\xampp\htdocs\galeri-sekolahristi\public\images\`
- Pastikan nama file: `siswa-background.jpg`

### **3. File Akan Otomatis Digunakan**
- Background akan otomatis update
- Refresh browser dengan `Ctrl + F5`

---

## 🔄 Atau Gunakan Script Otomatis

Jika Anda sudah punya foto di folder lain, jalankan script ini:

```bash
php update_background_photo.php
```

Script akan:
1. Mencari foto siswa terbaik di galeri
2. Copy ke `public/images/siswa-background.jpg`
3. Update otomatis

---

## ✅ Verifikasi

Setelah upload, cek:
1. File ada di: `public/images/siswa-background.jpg`
2. Refresh browser: `Ctrl + F5`
3. Background section About, Galeri, Berita akan update

---

## 📞 Troubleshooting

**Foto tidak berubah?**
1. Pastikan nama file exact: `siswa-background.jpg`
2. Clear cache browser: `Ctrl + Shift + Delete`
3. Hard refresh: `Ctrl + F5`

**Ingin kembali ke foto lama?**
1. Rename `siswa-upacara.jpg` ke `siswa-background.jpg`
2. Atau edit CSS di `home.blade.php`

---

**Dibuat:** 28 Oktober 2025  
**Status:** Ready to use
