<?php
/**
 * Test Script untuk Google reCAPTCHA
 * Jalankan: php test-recaptcha.php
 */

echo "========================================\n";
echo "  Test Google reCAPTCHA Configuration\n";
echo "========================================\n\n";

// Load .env file
$envFile = __DIR__ . '/.env';
if (!file_exists($envFile)) {
    echo "❌ ERROR: File .env tidak ditemukan!\n";
    echo "   Lokasi: $envFile\n";
    exit(1);
}

echo "✅ File .env ditemukan\n";

// Parse .env
$envContent = file_get_contents($envFile);
$lines = explode("\n", $envContent);
$siteKey = null;
$secretKey = null;

foreach ($lines as $line) {
    $line = trim($line);
    if (strpos($line, 'RECAPTCHA_SITE_KEY=') === 0) {
        $siteKey = trim(substr($line, strlen('RECAPTCHA_SITE_KEY=')));
    }
    if (strpos($line, 'RECAPTCHA_SECRET_KEY=') === 0) {
        $secretKey = trim(substr($line, strlen('RECAPTCHA_SECRET_KEY=')));
    }
}

echo "\n--- Checking Configuration ---\n";

// Check Site Key
if (empty($siteKey)) {
    echo "❌ RECAPTCHA_SITE_KEY tidak ditemukan atau kosong!\n";
    echo "   Tambahkan ke .env: RECAPTCHA_SITE_KEY=your_site_key\n";
    $hasError = true;
} else {
    echo "✅ RECAPTCHA_SITE_KEY: " . substr($siteKey, 0, 20) . "...\n";
    
    // Check if still using test key
    if ($siteKey === '6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI') {
        echo "⚠️  WARNING: Masih menggunakan testing key!\n";
        echo "   Daftar key production di: https://www.google.com/recaptcha/admin/create\n";
    }
}

// Check Secret Key
if (empty($secretKey)) {
    echo "❌ RECAPTCHA_SECRET_KEY tidak ditemukan atau kosong!\n";
    echo "   Tambahkan ke .env: RECAPTCHA_SECRET_KEY=your_secret_key\n";
    $hasError = true;
} else {
    echo "✅ RECAPTCHA_SECRET_KEY: " . substr($secretKey, 0, 20) . "...\n";
    
    // Check if still using test key
    if ($secretKey === '6LeIxAcTAAAAAGG-vFI1TnRWxMZNFuojJ4WifJWe') {
        echo "⚠️  WARNING: Masih menggunakan testing key!\n";
        echo "   Daftar key production di: https://www.google.com/recaptcha/admin/create\n";
    }
}

// Check config/services.php
echo "\n--- Checking Laravel Config ---\n";
$servicesFile = __DIR__ . '/config/services.php';
if (!file_exists($servicesFile)) {
    echo "❌ File config/services.php tidak ditemukan!\n";
} else {
    $servicesContent = file_get_contents($servicesFile);
    if (strpos($servicesContent, "'recaptcha'") !== false) {
        echo "✅ Config recaptcha sudah ada di services.php\n";
    } else {
        echo "❌ Config recaptcha belum ditambahkan ke services.php\n";
    }
}

// Check MessageController
echo "\n--- Checking Controller ---\n";
$controllerFile = __DIR__ . '/app/Http/Controllers/MessageController.php';
if (!file_exists($controllerFile)) {
    echo "❌ MessageController.php tidak ditemukan!\n";
} else {
    $controllerContent = file_get_contents($controllerFile);
    if (strpos($controllerContent, "config('services.recaptcha.secret_key')") !== false) {
        echo "✅ MessageController menggunakan config untuk secret key\n";
    } else {
        echo "⚠️  MessageController mungkin masih hardcode secret key\n";
    }
    
    if (strpos($controllerContent, 'g-recaptcha-response') !== false) {
        echo "✅ MessageController validasi g-recaptcha-response\n";
    } else {
        echo "❌ MessageController tidak validasi reCAPTCHA!\n";
    }
}

// Check View
echo "\n--- Checking View ---\n";
$viewFile = __DIR__ . '/resources/views/home.blade.php';
if (!file_exists($viewFile)) {
    echo "❌ home.blade.php tidak ditemukan!\n";
} else {
    $viewContent = file_get_contents($viewFile);
    if (strpos($viewContent, "config('services.recaptcha.site_key')") !== false) {
        echo "✅ View menggunakan config untuk site key\n";
    } else {
        echo "⚠️  View mungkin masih hardcode site key\n";
    }
    
    if (strpos($viewContent, 'g-recaptcha') !== false) {
        echo "✅ View memiliki div g-recaptcha\n";
    } else {
        echo "❌ View tidak memiliki div g-recaptcha!\n";
    }
    
    if (strpos($viewContent, 'recaptcha/api.js') !== false) {
        echo "✅ View memuat script reCAPTCHA\n";
    } else {
        echo "❌ View tidak memuat script reCAPTCHA!\n";
    }
}

// Test connection to Google
echo "\n--- Testing Connection to Google ---\n";
if (!empty($secretKey) && function_exists('curl_init')) {
    echo "Testing verifikasi ke Google reCAPTCHA API...\n";
    
    // Simulate a test (will fail because no actual response token)
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
        'secret' => $secretKey,
        'response' => 'test',
    ]));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    if ($httpCode === 200) {
        echo "✅ Koneksi ke Google reCAPTCHA API berhasil (HTTP 200)\n";
        $data = json_decode($response, true);
        if (isset($data['success'])) {
            echo "✅ Response dari Google valid\n";
            if ($data['success'] === false && isset($data['error-codes'])) {
                echo "   Error codes: " . implode(', ', $data['error-codes']) . "\n";
                echo "   (Normal jika 'invalid-input-response' karena ini test)\n";
            }
        }
    } else {
        echo "❌ Gagal koneksi ke Google (HTTP $httpCode)\n";
    }
} else {
    echo "⚠️  Tidak bisa test koneksi (CURL tidak tersedia atau secret key kosong)\n";
}

// Summary
echo "\n========================================\n";
echo "  SUMMARY\n";
echo "========================================\n";

if (isset($hasError)) {
    echo "❌ Ada konfigurasi yang belum lengkap!\n";
    echo "   Silakan perbaiki error di atas.\n\n";
    echo "Langkah selanjutnya:\n";
    echo "1. Daftar di: https://www.google.com/recaptcha/admin/create\n";
    echo "2. Copy Site Key dan Secret Key\n";
    echo "3. Tambahkan ke file .env\n";
    echo "4. Jalankan: php artisan config:clear\n";
    echo "5. Jalankan test ini lagi: php test-recaptcha.php\n";
} else {
    echo "✅ Konfigurasi reCAPTCHA sudah lengkap!\n\n";
    echo "Langkah selanjutnya:\n";
    echo "1. Jalankan: php artisan config:clear\n";
    echo "2. Jalankan: php artisan cache:clear\n";
    echo "3. Start server: php artisan serve\n";
    echo "4. Buka: http://127.0.0.1:8000\n";
    echo "5. Test form contact dengan reCAPTCHA\n";
}

echo "\n";
