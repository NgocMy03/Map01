<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class AuthController extends Controller
{

    public function showLoginForm(){
        if (Auth::id() > 0) {
            return redirect()->route('product.index');
        }
        return view('login');
    }

    public function login(AuthRequest $request){
        $credentials = [
        'email' => $request->input('email'),
        'password' => $request->input('password')
        ];
        if (Auth::guard('web')->attempt($credentials)){
            toastify()->success('Đăng nhập thành công.');
            return redirect()->route('product.index');
        }
        toastify()->error('Email hoặc Mật khẩu không chính xác.');
        return redirect()->route('login.form');
    }

    public function logout(Request $request){
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login.form');
    }
}
