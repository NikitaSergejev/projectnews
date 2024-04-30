<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;//Модель
use Auth;//сервис аутентификации

class AuthController extends Controller
{
    //----login: from -> reguest authenticate
    public function login()
    {
        return view('start');
    }
    //---------------authenticate проверка формы Login
    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        //данные для входа: только email, password-решаете, что использовать
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            //return redirect('dashboard');
            return redirect('/');
        }
        return redirect('login')->with('error','Упс! Выввели неверные учётные данные');
    }
    //-------logout
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}//end class
