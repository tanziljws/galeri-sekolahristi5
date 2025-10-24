<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesan Baru dari Website</title>
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
            border-bottom: 3px solid #1e40af;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        .header h1 {
            color: #1e40af;
            margin: 0;
            font-size: 24px;
        }
        .header p {
            color: #6b7280;
            margin: 5px 0 0 0;
            font-size: 14px;
        }
        .message-content {
            background: #f8fafc;
            border-left: 4px solid #10b981;
            padding: 20px;
            margin: 20px 0;
            border-radius: 0 8px 8px 0;
        }
        .message-content p {
            margin: 0;
            font-size: 16px;
            line-height: 1.8;
        }
        .sender-info {
            background: #e0e7ff;
            padding: 15px;
            border-radius: 8px;
            margin: 20px 0;
        }
        .sender-info h3 {
            color: #1e40af;
            margin: 0 0 10px 0;
            font-size: 18px;
        }
        .info-item {
            margin: 8px 0;
            display: flex;
            align-items: center;
        }
        .info-item strong {
            color: #374151;
            min-width: 80px;
            display: inline-block;
        }
        .info-item span {
            color: #6b7280;
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
            <h1>📧 Pesan Baru dari Website</h1>
            <p>SMK Negeri 4 Kota Bogor</p>
        </div>

        <div class="sender-info">
            <h3>👤 Informasi Pengirim</h3>
            <div class="info-item">
                <strong>Nama:</strong>
                <span>{{ $name }}</span>
            </div>
            <div class="info-item">
                <strong>Email:</strong>
                <span>{{ $email }}</span>
            </div>
        </div>

        <div class="message-content">
            <h3 style="color: #10b981; margin-top: 0;">💬 Pesan:</h3>
            <p>{{ $message }}</p>
        </div>

        <div class="timestamp">
            <strong>📅 Dikirim pada:</strong> {{ $timestamp }}
        </div>

        <div class="footer">
            <p><strong>SMK Negeri 4 Kota Bogor</strong></p>
            <p>Jl. Raya Tajur, Kp. Buntar RT.02/RW.08, Kel. Muara sari, Kec. Bogor Selatan</p>
            <p>📞 (0251) 7547381 | 📧 info@smkn4bogor.sch.id</p>
            <p style="margin-top: 15px; font-size: 12px; color: #9ca3af;">
                Email ini dikirim otomatis dari website SMK Negeri 4 Kota Bogor
            </p>
        </div>
    </div>
</body>
</html>
