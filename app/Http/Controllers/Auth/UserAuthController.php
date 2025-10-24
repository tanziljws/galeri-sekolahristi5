<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserAuthController extends Controller
{
    // Show register form
    public function showRegisterForm()
    {
        return view('auth.user-register');
    }

    // Handle registration
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Auto login after register
        session([
            'user_id' => $user->id,
            'user_name' => $user->name,
            'user_email' => $user->email,
            'user_type' => 'user'
        ]);

        return redirect()->route('home')->with('success', 'Registrasi berhasil! Selamat datang, ' . $user->name);
    }

    // Show login form
    public function showLoginForm()
    {
        return view('auth.user-login');
    }

    // Handle login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            session([
                'user_id' => $user->id,
                'user_name' => $user->name,
                'user_email' => $user->email,
                'user_type' => 'user'
            ]);

            return redirect()->route('home')->with('success', 'Login berhasil! Selamat datang kembali, ' . $user->name);
        }

        return back()->withErrors(['email' => 'Email atau password salah'])->withInput();
    }

    // Handle logout
    public function logout()
    {
        session()->forget(['user_id', 'user_name', 'user_email', 'user_type']);
        return redirect()->route('home')->with('success', 'Anda telah logout');
    }
}
