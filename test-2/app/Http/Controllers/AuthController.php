<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('login.index');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('name', 'password');

        if (Auth::attempt($credentials)) {
            // Jika autentikasi berhasil
            return redirect()->intended('/koutas');
        }

        // Jika autentikasi gagal
        return back()->withErrors(['name' => 'Username atau password salah.']);
    }
    public function logout(Request $request)
    {
        Auth::logout();

        // Redirect ke halaman login setelah logout
        return redirect('/login');
    }
}
