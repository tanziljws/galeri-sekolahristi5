<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Http;

class MessageController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string|max:1000',
            'g-recaptcha-response' => 'required'
        ], [
            'g-recaptcha-response.required' => 'Mohon centang "I\'m not a robot" untuk verifikasi.'
        ]);

        // Verify reCAPTCHA
        $recaptchaResponse = $request->input('g-recaptcha-response');
        $secretKey = config('services.recaptcha.secret_key');
        
        try {
            $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
                'secret' => $secretKey,
                'response' => $recaptchaResponse,
                'remoteip' => $request->ip()
            ]);
            
            $responseData = $response->json();
            
            if (!$responseData['success']) {
                return back()->withErrors(['recaptcha' => 'Verifikasi reCAPTCHA gagal. Silakan coba lagi.'])->withInput();
            }
        } catch (\Exception $e) {
            return back()->withErrors(['recaptcha' => 'Terjadi kesalahan saat verifikasi reCAPTCHA. Silakan coba lagi.'])->withInput();
        }

        Message::create([
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
            'status' => 'unread'
        ]);

        return redirect()->route('home')->with('success', 'Pesan berhasil dikirim!')->with('scroll_to_testimoni', true);
    }

    public function index()
    {
        $messages = Message::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.messages.index', compact('messages'));
    }

    public function show($id)
    {
        $message = Message::findOrFail($id);
        
        // Mark as read
        if ($message->status == 'unread') {
            $message->update(['status' => 'read']);
        }
        
        return view('admin.messages.show', compact('message'));
    }


    public function destroy($id)
    {
        $message = Message::findOrFail($id);
        $message->delete();

        return redirect()->route('admin.messages.index')->with('success', 'Pesan berhasil dihapus!');
    }

    public function approveTestimonial($id)
    {
        $message = Message::findOrFail($id);
        $message->update(['testimonial_status' => 'approved']);

        return redirect()->route('admin.messages.index')->with('success', 'Pesan disetujui untuk ditampilkan sebagai testimoni!');
    }

    public function rejectTestimonial($id)
    {
        $message = Message::findOrFail($id);
        $message->update(['testimonial_status' => 'rejected']);

        return redirect()->route('admin.messages.index')->with('success', 'Pesan ditolak untuk testimoni!');
    }

    public function resetTestimonialStatus($id)
    {
        $message = Message::findOrFail($id);
        $message->update(['testimonial_status' => 'pending']);

        return redirect()->route('admin.messages.index')->with('success', 'Status testimoni direset ke menunggu!');
    }
}