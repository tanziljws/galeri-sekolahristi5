# 📸 Fitur Slide Foto Galeri - Instagram Style

## ✨ Fitur Baru: Navigasi Slide Foto

Sekarang pengunjung bisa **slide foto ke kiri/kanan** seperti di Instagram! Tidak perlu tutup dan buka foto lagi untuk lihat foto berikutnya.

---

## 🎯 Fitur yang Ditambahkan

### 1️⃣ **Tombol Navigasi < >**
- **Tombol Previous (<)** - Kiri foto
- **Tombol Next (>)** - Kanan foto
- **Desain:** Bulat putih dengan shadow, seperti Instagram
- **Posisi:** Di pinggir kiri dan kanan foto
- **Hover Effect:** Membesar saat di-hover

### 2️⃣ **Photo Counter**
- Menampilkan posisi foto saat ini
- Format: "1 / 10" (foto ke-1 dari 10 foto)
- Posisi: Bawah tengah foto
- Background: Hitam transparan

### 3️⃣ **Keyboard Navigation**
- **Arrow Left (←)** - Foto sebelumnya
- **Arrow Right (→)** - Foto berikutnya
- **Escape (Esc)** - Tutup modal

### 4️⃣ **Auto Loop**
- Dari foto terakhir → kembali ke foto pertama
- Dari foto pertama → ke foto terakhir
- Navigasi tanpa batas

---

## 🎨 Desain Visual

### **Modal Foto dengan Navigasi:**
```
┌─────────────────────────────────────────┐
│ 📷 Pratinjau Foto: Senam Pagi      [X] │
├─────────────────────────────────────────┤
│                                         │
│  <  [    FOTO BESAR    ]  >            │
│                                         │
│           1 / 5                         │
└─────────────────────────────────────────┘
```

### **Tombol Navigasi:**
- **Shape:** Bulat (circle)
- **Size:** 45px x 45px (desktop), 35px x 35px (mobile)
- **Color:** Putih dengan opacity 0.9
- **Icon:** Chevron left/right
- **Shadow:** Soft shadow untuk depth
- **Hover:** Scale 1.1 + shadow lebih besar

### **Photo Counter:**
- **Background:** rgba(0, 0, 0, 0.7)
- **Text:** White, bold
- **Padding:** 8px 16px
- **Border-radius:** 20px (pill shape)

---

## 🚀 Cara Menggunakan

### **Untuk Pengunjung:**

**1. Klik Foto di Galeri**
- Buka halaman Galeri Kegiatan Sekolah
- Klik foto yang ingin dilihat
- Modal foto akan terbuka

**2. Navigasi dengan Mouse:**
- Klik tombol **<** untuk foto sebelumnya
- Klik tombol **>** untuk foto berikutnya
- Klik **X** atau di luar foto untuk tutup

**3. Navigasi dengan Keyboard:**
- Tekan **Arrow Left (←)** untuk foto sebelumnya
- Tekan **Arrow Right (→)** untuk foto berikutnya
- Tekan **Escape (Esc)** untuk tutup modal

**4. Lihat Posisi Foto:**
- Counter di bawah foto menunjukkan posisi
- Contoh: "3 / 10" = foto ke-3 dari 10 foto

---

## 💡 Keuntungan

### **Untuk Pengunjung:**
- ✅ **Lebih Cepat** - Tidak perlu tutup dan buka foto lagi
- ✅ **Lebih Mudah** - Tinggal klik < > atau tekan arrow
- ✅ **Seperti Instagram** - Familiar dengan user experience
- ✅ **Keyboard Support** - Bisa pakai keyboard untuk navigasi
- ✅ **Auto Loop** - Dari foto terakhir kembali ke awal

### **Untuk Admin:**
- ✅ **Tidak perlu setting** - Otomatis aktif untuk semua foto
- ✅ **Responsive** - Bekerja di desktop dan mobile
- ✅ **Modern** - Meningkatkan user experience website

---

## 🔧 Technical Details

### **JavaScript Functions:**

**1. `initPhotoNavigation()`**
- Mengumpulkan semua foto yang visible
- Menyimpan src dan title foto
- Dipanggil saat modal dibuka

**2. `openPhotoModal(index)`**
- Membuka foto pada index tertentu
- Update gambar, title, dan counter
- Update status tombol navigasi

**3. `navigatePhoto(direction)`**
- Navigate ke foto sebelumnya (-1) atau berikutnya (+1)
- Auto loop jika sudah di ujung
- Update modal dengan foto baru

**4. `updateNavigationButtons()`**
- Hide tombol jika hanya 1 foto
- Show tombol jika lebih dari 1 foto

### **Event Listeners:**

**Click Event:**
```javascript
img.addEventListener('click', function(e) {
    initPhotoNavigation();
    const clickedIndex = visiblePhotos.indexOf(img);
    openPhotoModal(clickedIndex);
    bsModal.show();
});
```

**Keyboard Event:**
```javascript
document.addEventListener('keydown', function(e) {
    if (modalElement.classList.contains('show')) {
        if (e.key === 'ArrowLeft') navigatePhoto(-1);
        if (e.key === 'ArrowRight') navigatePhoto(1);
        if (e.key === 'Escape') bsModal.hide();
    }
});
```

---

## 📱 Responsive Design

### **Desktop (>768px):**
- Tombol: 45px x 45px
- Icon: 1.2rem
- Posisi tombol: 20px dari pinggir
- Keyboard hint: Visible

### **Mobile (≤768px):**
- Tombol: 35px x 35px
- Icon: 1rem
- Posisi tombol: 10px dari pinggir
- Keyboard hint: Hidden

---

## 🎯 Fitur Tambahan

### **Smart Photo List:**
- Hanya foto yang visible (sesuai filter) yang bisa di-slide
- Jika filter "Prestasi", hanya foto prestasi yang bisa di-slide
- Auto-refresh list saat filter berubah

### **Loop Navigation:**
- Dari foto terakhir → klik next → kembali ke foto pertama
- Dari foto pertama → klik prev → ke foto terakhir
- Infinite scroll experience

### **Dynamic Counter:**
- Update real-time saat navigasi
- Format: "current / total"
- Contoh: "1 / 15", "5 / 15", "15 / 15"

---

## 📁 File yang Dimodifikasi

1. **`resources/views/galeri/public.blade.php`**
   - Update modal HTML dengan tombol navigasi
   - Tambah CSS untuk tombol dan counter
   - Tambah JavaScript untuk navigasi system
   - Tambah keyboard event listener

---

## 🎨 CSS Classes

**Tombol Navigasi:**
- `.btn-nav-modal` - Base style
- `.btn-nav-prev` - Previous button (left)
- `.btn-nav-next` - Next button (right)

**Photo Counter:**
- `.photo-counter` - Counter container

**Keyboard Hint:**
- `.keyboard-hint` - Hint untuk keyboard navigation (desktop only)

---

## 🔍 Contoh Penggunaan

### **Scenario 1: Lihat Album Senam**
1. Buka Galeri Kegiatan Sekolah
2. Klik foto pertama album Senam
3. Modal terbuka, counter: "1 / 10"
4. Klik tombol **>** untuk lihat foto berikutnya
5. Counter update: "2 / 10"
6. Terus klik **>** sampai foto terakhir
7. Klik **>** lagi → kembali ke foto pertama (loop)

### **Scenario 2: Keyboard Navigation**
1. Buka foto di galeri
2. Tekan **Arrow Right** 3x
3. Sampai di foto ke-4
4. Tekan **Arrow Left** 1x
5. Kembali ke foto ke-3
6. Tekan **Escape** untuk tutup

### **Scenario 3: Filter + Navigation**
1. Klik filter "Prestasi"
2. Hanya foto prestasi yang tampil
3. Klik foto prestasi pertama
4. Counter: "1 / 5" (5 foto prestasi)
5. Navigasi hanya di antara 5 foto prestasi

---

## ✅ Checklist Fitur

- [x] Tombol Previous (<) di kiri
- [x] Tombol Next (>) di kanan
- [x] Photo counter (1 / total)
- [x] Keyboard navigation (Arrow keys)
- [x] Auto loop navigation
- [x] Responsive design
- [x] Hover effects
- [x] Smart photo list (filter aware)
- [x] Dynamic title update
- [x] Hide buttons if only 1 photo

---

## 🎉 Hasil Akhir

**Sebelum:**
- Klik foto → Lihat → Tutup
- Klik foto lain → Lihat → Tutup
- Repeat...

**Sesudah:**
- Klik foto → Slide → Slide → Slide
- Lihat semua foto tanpa tutup modal
- Seperti Instagram! 🚀

---

## 📞 Support

**Keyboard Shortcuts:**
- `←` Previous photo
- `→` Next photo
- `Esc` Close modal

**Tips:**
- Gunakan keyboard untuk navigasi lebih cepat
- Counter menunjukkan posisi foto saat ini
- Tombol auto-hide jika hanya 1 foto

---

**Dibuat:** 28 Oktober 2025  
**Versi:** 1.0  
**Status:** ✅ Active  
**Style:** Instagram-inspired
