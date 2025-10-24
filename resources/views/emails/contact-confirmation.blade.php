<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Pesan - SMK Negeri 4 Kota Bogor</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f8f9fa;
        }
        .email-container {
            background: white;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            border-bottom: 3px solid #10b981;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        .header h1 {
            color: #10b981;
            margin: 0;
            font-size: 24px;
        }
        .header p {
            color: #6b7280;
            margin: 5px 0 0 0;
            font-size: 14px;
        }
        .success-message {
            background: #d1fae5;
            border: 1px solid #10b981;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
            text-align: center;
        }
        .success-message h2 {
            color: #10b981;
            margin: 0 0 10px 0;
        }
        .success-message p {
            margin: 0;
            color: #065f46;
        }
        .message-summary {
            background: #f8fafc;
            border-left: 4px solid #1e40af;
            padding: 20px;
            margin: 20px 0;
            border-radius: 0 8px 8px 0;
        }
        .message-summary h3 {
            color: #1e40af;
            margin-top: 0;
        }
        .next-steps {
            background: #e0e7ff;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
        }
        .next-steps h3 {
            color: #1e40af;
            margin-top: 0;
        }
        .next-steps ul {
            margin: 10px 0;
            padding-left: 20px;
        }
        .next-steps li {
            margin: 8px 0;
            color: #374151;
        }
        .contact-info {
            background: #f3f4f6;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
            text-align: center;
        }
        .contact-info h3 {
            color: #374151;
            margin-top: 0;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
            color: #6b7280;
            font-size: 14px;
        }
        .timestamp {
            background: #f3f4f6;
            padding: 10px;
            border-radius: 6px;
            text-align: center;
            margin: 20px 0;
            font-size: 14px;
            color: #6b7280;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <h1>✅ Pesan Berhasil Dikirim</h1>
            <p>SMK Negeri 4 Kota Bogor</p>
        </div>

        <div class="success-message">
            <h2>🎉 Terima Kasih, {{ $name }}!</h2>
            <p>Pesan Anda telah berhasil dikirim dan akan segera kami proses.</p>
        </div>

        <div class="message-summary">
            <h3>📝 Ringkasan Pesan Anda:</h3>
            <p><strong>Nama:</strong> {{ $name }}</p>
            <p><strong>Email:</strong> {{ $email }}</p>
            <p><strong>Pesan:</strong></p>
            <p style="background: white; padding: 15px; border-radius: 6px; margin: 10px 0; border-left: 3px solid #10b981;">
                "{{ $message }}"
            </p>
        </div>

        <div class="next-steps">
            <h3>📋 Langkah Selanjutnya:</h3>
            <ul>
                <li>✅ Pesan Anda telah diterima oleh tim admin</li>
                <li>⏰ Kami akan merespons dalam 1-2 hari kerja</li>
                <li>📧 Balasan akan dikirim ke email: <strong>{{ $email }}</strong></li>
                <li>📞 Untuk hal mendesak, hubungi: (0251) 7547381</li>
            </ul>
        </div>

        <div class="contact-info">
            <h3>📞 Informasi Kontak</h3>
            <p><strong>SMK Negeri 4 Kota Bogor</strong></p>
            <p>Jl. Raya Tajur, Kp. Buntar RT.02/RW.08, Kel. Muara sari, Kec. Bogor Selatan</p>
            <p>📞 (0251) 7547381 | 📧 info@smkn4bogor.sch.id</p>
        </div>

        <div class="timestamp">
            <strong>📅 Dikirim pada:</strong> {{ $timestamp }}
        </div>

        <div class="footer">
            <p style="margin-top: 15px; font-size: 12px; color: #9ca3af;">
                Email konfirmasi ini dikirim otomatis. Mohon tidak membalas email ini.
            </p>
        </div>
    </div>
</body>
</html>
