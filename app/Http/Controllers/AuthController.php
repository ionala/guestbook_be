<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string'
        ]);

        // Hard-coded credential (sama kayak kode kamu yang lama)
        if ($request->username === 'admin' && $request->password === '12345') {
            session(['is_admin' => true]);
            return redirect('/admin');
        }

        return back()->with('error', 'Username atau password salah!')->withInput();
    }

    public function logout()
    {
        session()->flush();
        return redirect('/admin/login');
    }
}