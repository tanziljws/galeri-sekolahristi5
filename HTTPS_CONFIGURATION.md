# HTTPS Configuration

Aplikasi ini sudah dikonfigurasi untuk menggunakan HTTPS di production dan menghindari peringatan mixed content.

## ✅ Yang Sudah Dikonfigurasi

### 1. **AppServiceProvider** (`app/Providers/AppServiceProvider.php`)
- Memaksa HTTPS di production dan staging
- Mendeteksi proxy (Railway, Heroku, dll) dan memaksa HTTPS

### 2. **.htaccess** (`public/.htaccess`)
- Redirect otomatis dari HTTP ke HTTPS (kecuali localhost)
- Hanya berlaku untuk Apache server

### 3. **Form Actions**
- Semua form menggunakan `route()` helper yang otomatis menggunakan HTTPS
- Tidak ada hardcoded HTTP URL di form

### 4. **JavaScript/AJAX**
- Semua fetch() menggunakan relative URL (`/api/...`)
- Tidak ada hardcoded HTTP URL di JavaScript

### 5. **External Resources**
- Semua CDN sudah menggunakan HTTPS:
  - `https://cdn.jsdelivr.net`
  - `https://cdnjs.cloudflare.com`
  - `https://fonts.bunny.net`
  - `https://fonts.googleapis.com`

### 6. **reCAPTCHA**
- Sudah menggunakan HTTPS: `https://www.google.com/recaptcha/api/siteverify`

## 📝 Catatan Penting

### SVG Namespace
`xmlns="http://www.w3.org/2000/svg"` adalah namespace SVG yang valid dan **TIDAK PERLU** diubah. Ini bukan URL yang di-load, hanya namespace declaration.

### Localhost Development
- Di localhost, aplikasi tetap menggunakan HTTP (tidak di-redirect ke HTTPS)
- Ini untuk memudahkan development

### Production Deployment
Pastikan di file `.env` production:
```env
APP_ENV=production
APP_URL=https://yourdomain.com
```

## 🔧 Untuk Railway/Heroku/Cloud Hosting

Hosting seperti Railway dan Heroku biasanya sudah handle HTTPS di reverse proxy. Aplikasi akan otomatis mendeteksi header `X-Forwarded-Proto: https` dan memaksa HTTPS.

## ✅ Checklist Sebelum Deploy

- [ ] Set `APP_ENV=production` di `.env`
- [ ] Set `APP_URL=https://yourdomain.com` di `.env`
- [ ] Pastikan SSL certificate sudah terpasang di server
- [ ] Test semua form submission
- [ ] Test semua AJAX/fetch requests
- [ ] Cek browser console untuk mixed content warnings

## 🐛 Troubleshooting

### Masih ada peringatan mixed content?
1. Cek browser console untuk URL yang masih menggunakan HTTP
2. Pastikan semua external resources menggunakan HTTPS
3. Pastikan `APP_URL` di `.env` menggunakan HTTPS
4. Clear cache: `php artisan config:clear` dan `php artisan cache:clear`

### Form tidak submit di HTTPS?
1. Pastikan CSRF token valid
2. Cek apakah form action menggunakan `route()` helper
3. Pastikan `APP_URL` sudah benar di `.env`

