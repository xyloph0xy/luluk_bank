<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function redirectIfAuthenticated()
    {
        if (auth()->check()) {
            return redirect()->intended('/admin/dashboard');
        } else {
            return redirect()->intended('login');
        }
    }

    public function login()
    {
        //view
        return view('auth.login.index');
    }
}
