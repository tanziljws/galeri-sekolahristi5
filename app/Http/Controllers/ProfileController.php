<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ProfileController extends Controller
{
    public function index()
    {
        // Cek apakah user sudah login
        if (!session('user_id')) {
            return redirect()->route('user.login.form')->with('error', 'Silakan login terlebih dahulu');
        }

        $user = User::find(session('user_id'));
        
        if (!$user) {
            return redirect()->route('user.login.form')->with('error', 'User tidak ditemukan');
        }

        return view('profile.index', compact('user'));
    }

    public function update(Request $request)
    {
        // Cek apakah user sudah login
        if (!session('user_id')) {
            return redirect()->route('user.login.form')->with('error', 'Silakan login terlebih dahulu');
        }

        $user = User::find(session('user_id'));

        if (!$user) {
            return redirect()->route('user.login.form')->with('error', 'User tidak ditemukan');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'name.required' => 'Nama harus diisi',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah digunakan',
            'profile_photo.image' => 'File harus berupa gambar',
            'profile_photo.mimes' => 'Format gambar harus: jpeg, png, jpg, atau gif',
            'profile_photo.max' => 'Ukuran gambar maksimal 2MB',
        ]);

        // Update nama dan email
        $user->name = $request->name;
        $user->email = $request->email;

        // Handle upload foto profil
        if ($request->hasFile('profile_photo')) {
            // Hapus foto lama jika ada
            if ($user->profile_photo && Storage::disk('public')->exists($user->profile_photo)) {
                Storage::disk('public')->delete($user->profile_photo);
            }

            // Upload foto baru
            $file = $request->file('profile_photo');
            $filename = 'profile_' . $user->id . '_' . time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('profile_photos', $filename, 'public');
            $user->profile_photo = $path;
        }

        $user->save();

        // Update session name jika nama berubah
        session(['user_name' => $user->name]);

        return redirect()->route('home', ['page' => 'profile'])->with('success', 'Profil berhasil diperbarui!');
    }

    public function updatePassword(Request $request)
    {
        // Cek apakah user sudah login
        if (!session('user_id')) {
            return redirect()->route('user.login.form')->with('error', 'Silakan login terlebih dahulu');
        }

        $user = User::find(session('user_id'));

        if (!$user) {
            return redirect()->route('user.login.form')->with('error', 'User tidak ditemukan');
        }

        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ], [
            'current_password.required' => 'Password lama harus diisi',
            'new_password.required' => 'Password baru harus diisi',
            'new_password.min' => 'Password baru minimal 8 karakter',
            'new_password.confirmed' => 'Konfirmasi password tidak cocok',
        ]);

        // Cek password lama
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password lama tidak sesuai']);
        }

        // Update password
        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->route('home', ['page' => 'profile'])->with('success', 'Password berhasil diubah!');
    }

    public function deletePhoto()
    {
        // Cek apakah user sudah login
        if (!session('user_id')) {
            return redirect()->route('user.login.form')->with('error', 'Silakan login terlebih dahulu');
        }

        $user = User::find(session('user_id'));

        if (!$user) {
            return redirect()->route('user.login.form')->with('error', 'User tidak ditemukan');
        }

        if ($user->profile_photo && Storage::disk('public')->exists($user->profile_photo)) {
            Storage::disk('public')->delete($user->profile_photo);
            $user->profile_photo = null;
            $user->save();
        }

        return redirect()->route('home', ['page' => 'profile'])->with('success', 'Foto profil berhasil dihapus!');
    }
}
