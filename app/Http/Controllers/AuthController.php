<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Petugas;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function showLogin()
    {
        // Jika sudah login sebagai admin, redirect ke dashboard
        if (Session::has('is_logged_in')) {
            return redirect()->route('dashboard');
        }
        
        // Clear user session jika ada (untuk memastikan tidak ada konflik)
        if (Session::has('user_type') && Session::get('user_type') === 'user') {
            Session::forget(['user_id', 'user_name', 'user_email', 'user_type']);
        }
        
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $petugas = Petugas::where('username', $request->username)->first();

        if ($petugas && \Illuminate\Support\Facades\Hash::check($request->password, $petugas->password)) {
            // Clear user session jika ada (untuk memastikan tidak ada konflik)
            Session::forget(['user_id', 'user_name', 'user_email', 'user_type']);
            
            // Set admin session
            session([
                'is_logged_in' => true, 
                'user_id' => $petugas->id, 
                'username' => $petugas->username,
                'user_type' => 'admin' // Tambahkan user_type untuk membedakan admin dan user
            ]);
            
            return redirect()->route('dashboard')->with('success', 'Selamat datang, ' . $petugas->username . '!');
        }

        return back()->withErrors(['username' => 'Username atau password salah!']);
    }

    public function register(Request $request)
    {
        $request->validate([
            'fullname' => 'required|string|max:255',
            'email' => 'required|email|unique:petugas,email',
            'password' => 'required|min:3|confirmed'
        ]);

        $petugas = Petugas::create([
            'username' => $request->email, // Use email as username
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'nama' => $request->fullname
        ]);

        if ($petugas) {
            // Auto login setelah register berhasil
            session(['is_logged_in' => true, 'user_id' => $petugas->id, 'username' => $petugas->username]);
            return redirect()->route('dashboard')->with('success', 'Akun berhasil dibuat! Selamat datang, ' . $petugas->nama . '!');
        }

        return back()->withErrors(['error' => 'Gagal membuat akun. Silakan coba lagi.']);
    }

    public function logout()
    {
        session()->forget(['is_logged_in', 'user_id', 'username']);
        session()->flush();
        
        return redirect()->route('home')->with('success', 'Anda berhasil logout!');
    }
}
