<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Models\Staff;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{

    public function showLoginForm(){
        return view('login');
    }

    public function login(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ], [
            'email.required' => 'Vui lòng nhập email',
            'password.required' => 'Vui lòng nhập mật khẩu.',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự.',
        ]);

        $loginField = 'email';
        if (filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            $loginField = 'email';
        }
    
        $credentials = [
            $loginField => $request->email,
            'password'  => $request->password
        ];
    
        if (Auth::guard('staff')->attempt($credentials)) {
            $currentStaff = Staff::find(Auth::guard('staff')->user()->id);
            $currentStaff->update(['status' => true]);
            toastify()->success('Đăng nhập thành công.');
            return redirect()->route('product.index');
        }
    
        // toastify()->error('Email hoặc Mật khẩu không chính xác.');
        return back()->withErrors(['email' => 'Email đã nhập không đúng.', 'password' => 'Mật khẩu đã nhập không đúng.'])->withInput();
    }
    

    public function logout(Request $request){
        $currentStaff = Staff::find(Auth::guard('staff')->user()->id);
        $currentStaff->update(['status' => false]);
        Auth::guard('staff')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login.form');
    }
}
