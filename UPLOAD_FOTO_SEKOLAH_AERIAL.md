# 📸 Upload Foto Sekolah Aerial (Drone View)

## 🎯 Foto yang Dibutuhkan

Foto aerial/drone view sekolah yang baru saja Anda kirim (foto gedung sekolah dari atas).

---

## 📁 Langkah Upload

### **1. Simpan Foto**
- Save foto aerial sekolah yang Anda kirim
- Rename menjadi: **`sekolah-aerial.jpg`**

### **2. Upload ke Folder Images**
```
Copy file ke:
c:\xampp\htdocs\galeri-sekolahristi\public\images\sekolah-aerial.jpg
```

### **3. Refresh Browser**
- Tekan `Ctrl + F5` untuk hard refresh
- Background semua section akan otomatis update

---

## ✅ Hasil Setelah Upload

**Semua section akan menggunakan foto aerial sekolah:**
- ✅ SMK Pusat Keunggulan - Background gedung sekolah (dark blur)
- ✅ Galeri Kegiatan - Background gedung sekolah (light blur)
- ✅ Berita Terbaru - Background gedung sekolah (dark blur)

---

## 🎨 Keuntungan Foto Aerial

- ✅ **Lebih Representatif** - Menampilkan keseluruhan sekolah
- ✅ **Professional** - Foto drone view terlihat modern
- ✅ **Unik** - Berbeda dari foto siswa
- ✅ **Warna Hijau** - Lebih fresh dan natural

---

## 📞 Troubleshooting

**Foto tidak muncul?**
1. Pastikan nama file: `sekolah-aerial.jpg`
2. Lokasi: `public/images/`
3. Clear cache: `Ctrl + Shift + Delete`
4. Hard refresh: `Ctrl + F5`

**Ingin kembali ke foto siswa?**
Edit `home.blade.php`, ganti:
```css
background-image: url('{{ asset("images/sekolah-aerial.jpg") }}');
```
Menjadi:
```css
background-image: url('{{ asset("images/siswa-background.jpg") }}');
```

---

**Dibuat:** 28 Oktober 2025  
**Status:** Ready to upload
