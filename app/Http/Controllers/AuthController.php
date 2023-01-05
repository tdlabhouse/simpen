<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Events\Failed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //
    public function login(Request $request)
    {
        // 
        return view('login.login');
    }

    public function authenticating(Request $request)
    {
        // 
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('dashboard');
        }

        session()->flash('status', 'Failed');
        session()->flash('message', 'Username/password salah');
        return redirect('login');
    }

    public function logout(Request $request)
    {
        // 
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('login');
    }
}
