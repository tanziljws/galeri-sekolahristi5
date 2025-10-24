# ✅ Checklist Setup reCAPTCHA

## Pre-Setup
- [ ] Punya akun Google
- [ ] Koneksi internet aktif
- [ ] Laravel server bisa dijalankan

---

## Setup Google reCAPTCHA

### Pendaftaran
- [ ] Buka https://www.google.com/recaptcha/admin/create
- [ ] Login dengan akun Google
- [ ] Isi Label: "Galeri SMK Negeri 4 Bogor"
- [ ] Pilih Type: reCAPTCHA v2 → "I'm not a robot"
- [ ] Tambahkan domain: `127.0.0.1`
- [ ] Tambahkan domain: `localhost`
- [ ] Centang Terms of Service
- [ ] Klik Submit

### Simpan Keys
- [ ] Copy Site Key
- [ ] Copy Secret Key
- [ ] Simpan keys di tempat aman (notepad sementara)

---

## Konfigurasi Laravel

### File .env
- [ ] Buka file `.env` di root project
- [ ] Tambahkan baris baru di bagian bawah:
  ```
  # Google reCAPTCHA v2
  RECAPTCHA_SITE_KEY=
  RECAPTCHA_SECRET_KEY=
  ```
- [ ] Paste Site Key setelah `RECAPTCHA_SITE_KEY=`
- [ ] Paste Secret Key setelah `RECAPTCHA_SECRET_KEY=`
- [ ] Save file `.env`

### Clear Cache
- [ ] Buka terminal/command prompt
- [ ] Jalankan: `php artisan config:clear`
- [ ] Jalankan: `php artisan cache:clear`
- [ ] Restart Laravel server

---

## Testing

### Test di Localhost
- [ ] Buka browser
- [ ] Akses: http://127.0.0.1:8000
- [ ] Scroll ke section "Hubungi Kami"
- [ ] Periksa reCAPTCHA muncul
- [ ] Isi form contact:
  - [ ] Nama: Test User
  - [ ] Email: test@example.com
  - [ ] Pesan: Testing reCAPTCHA
- [ ] Centang checkbox "I'm not a robot"
- [ ] Selesaikan challenge (jika muncul)
- [ ] Klik "Kirim Pesan"
- [ ] Verifikasi pesan berhasil terkirim

### Verifikasi Database
- [ ] Buka database
- [ ] Cek tabel `messages`
- [ ] Pastikan data test tersimpan

---

## Production Deployment (Opsional)

### Update Domain
- [ ] Buka Google reCAPTCHA Console
- [ ] Pilih site Anda
- [ ] Tambahkan domain production
- [ ] Save

### Update Server
- [ ] Upload file `.env` dengan keys production
- [ ] Jalankan `php artisan config:clear` di server
- [ ] Jalankan `php artisan cache:clear` di server
- [ ] Test di domain production

---

## Troubleshooting

### reCAPTCHA Tidak Muncul
- [ ] Cek koneksi internet
- [ ] Clear cache browser (Ctrl + Shift + Delete)
- [ ] Cek Console Browser (F12) untuk error
- [ ] Pastikan script reCAPTCHA dimuat
- [ ] Periksa site key di `.env` benar

### Validasi Gagal
- [ ] Periksa secret key di `.env` benar
- [ ] Jalankan `php artisan config:clear`
- [ ] Restart server
- [ ] Cek response dari Google (tambahkan `dd($responseData)` di controller)

### "Invalid Site Key"
- [ ] Pastikan domain terdaftar di Google Console
- [ ] Untuk localhost: gunakan `127.0.0.1` atau `localhost`
- [ ] Periksa typo di site key

---

## Status Setup

**Tanggal Setup:** _______________

**Status:**
- [ ] ✅ Setup Selesai
- [ ] ⏳ Dalam Progress
- [ ] ❌ Belum Dimulai

**Catatan:**
```
_____________________________________________________
_____________________________________________________
_____________________________________________________
```

---

## Kontak Support

**Google reCAPTCHA:**
- Docs: https://developers.google.com/recaptcha
- Console: https://www.google.com/recaptcha/admin

**Laravel:**
- Docs: https://laravel.com/docs

---

**Dibuat:** 22 Oktober 2025
**Untuk:** Galeri SMK Negeri 4 Bogor
