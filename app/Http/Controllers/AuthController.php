<?php

namespace App\Http\Controllers;

use Illuminate\Database\Query\Expression;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function dashboard()
    {
        if(Auth::check() === true) {
            return view('admin.dashboard');    
        }   
        
        return redirect()->route('admin.login');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];
        
        if(Auth::attempt($credentials)) {
            return redirect()->route('admin');
        }

        return redirect()->back()->withInput()->withErrors(['Os dados informados não conferem!']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin');
    }
}
