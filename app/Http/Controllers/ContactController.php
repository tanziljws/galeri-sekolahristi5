<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function sendMessage(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string|max:1000',
        ], [
            'name.required' => 'Nama harus diisi',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email tidak valid',
            'message.required' => 'Pesan harus diisi',
            'message.max' => 'Pesan maksimal 1000 karakter',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Data pesan
            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'message' => $request->message,
                'timestamp' => now()->format('d/m/Y H:i:s'),
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ];

            // Untuk testing, kita simpan ke log dulu
            \Log::info('Contact Form Message Received', $data);
            
            // Kirim email ke admin (jika email dikonfigurasi)
            try {
                Mail::send('emails.contact-message', $data, function ($mail) use ($data) {
                    $mail->to('admin@smkn4bogor.sch.id', 'Admin SMK Negeri 4 Kota Bogor')
                         ->subject('Pesan Baru dari Website - ' . $data['name'])
                         ->from($data['email'], $data['name']);
                });

                // Kirim email konfirmasi ke pengirim
                Mail::send('emails.contact-confirmation', $data, function ($mail) use ($data) {
                    $mail->to($data['email'], $data['name'])
                         ->subject('Konfirmasi Pesan - SMK Negeri 4 Kota Bogor')
                         ->from('noreply@smkn4bogor.sch.id', 'SMK Negeri 4 Kota Bogor');
                });
            } catch (\Exception $mailError) {
                \Log::warning('Email sending failed, but message logged: ' . $mailError->getMessage());
                // Tetap return success karena pesan sudah tersimpan di log
            }

            return response()->json([
                'success' => true,
                'message' => 'Pesan berhasil dikirim! Kami akan segera menghubungi Anda.'
            ]);

        } catch (\Exception $e) {
            \Log::error('Contact form error: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengirim pesan. Silakan coba lagi nanti.'
            ], 500);
        }
    }
}
