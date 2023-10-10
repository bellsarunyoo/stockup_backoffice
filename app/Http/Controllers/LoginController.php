<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Notifications\Action;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
// use Illuminate\Support\Facades\Request;

class LoginController extends Controller
{
    // use AuthenticatesUsers;

    // protected $redirectTo = '/login';

    // public function __construct()
    // {
    //     $this->middleware('guest')->except('logout');
    // }

    public function login(Request $request)
    {

        $credentials = $request->only('username', 'password');

        if (isset($credentials)) {
            if ($request->username == 'admin' && $request->password == 'Stu#!2024%$') {
                session(['username' => $request->username]);
                session(['role' => 'superAdmin']);

                // dd(session()->all());
                return redirect('/orders');
            } else {
                session()->forget('username');
                session()->forget('role');
                session()->flash('success', 'ชื่อผู้ใช้งานหรือรหัสผ่านไม่ถูกต้อง!');

                return redirect('/');
            }
        }
    }

    public function logout()
    {
        // session()->forget('username');
        // session()->forget('role');
        session()->invalidate();
        return redirect('/');
    }
}
