<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $loginField = filter_var($request->input('username'), FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        $credentials = [
            $loginField => $request->input('username'),
            'password' => $request->input('password'),
            'role' => 'admin', // hanya admin
        ];
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('admin.articles.index');
        }
        return back()->withErrors(['username' => 'Login gagal']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login');
    }
}
