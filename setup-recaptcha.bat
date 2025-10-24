@echo off
echo ========================================
echo   Setup Google reCAPTCHA v2
echo   Galeri SMK Negeri 4 Bogor
echo ========================================
echo.

echo [1/4] Membuka Google reCAPTCHA Console...
start https://www.google.com/recaptcha/admin/create
echo.

echo [2/4] Instruksi:
echo   1. Login dengan akun Google Anda
echo   2. Isi form pendaftaran:
echo      - Label: Galeri SMK Negeri 4 Bogor
echo      - Type: reCAPTCHA v2 - "I'm not a robot"
echo      - Domains: 127.0.0.1, localhost
echo   3. Klik Submit
echo   4. Copy Site Key dan Secret Key
echo.

pause

echo.
echo [3/4] Membuka file .env untuk edit...
notepad .env
echo.

echo   Tambahkan di bagian bawah file .env:
echo.
echo   # Google reCAPTCHA v2
echo   RECAPTCHA_SITE_KEY=paste_site_key_anda_disini
echo   RECAPTCHA_SECRET_KEY=paste_secret_key_anda_disini
echo.

pause

echo.
echo [4/4] Clearing cache...
php artisan config:clear
php artisan cache:clear
echo.

echo ========================================
echo   Setup Selesai!
echo ========================================
echo.
echo Langkah selanjutnya:
echo   1. Restart server: php artisan serve
echo   2. Buka: http://127.0.0.1:8000
echo   3. Test form contact
echo.

pause
