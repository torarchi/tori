<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function getSignUp(){
        return view('auth.signup');
    }
    public function postSignUp(Request $request){
        $this->validate($request, [
           'email' => 'required|unique:users|email|max:255',
            'username' => 'required|unique:users|alpha_dash|max:20',
            'password' => 'required|min:6',
        ]);
        User::create([
            'email' => $request->input('email'),
            'username' => $request->input('username'),
            'password' => bcrypt($request->input('password')),
        ]);
        return redirect()->route('home')->with('info', 'Вы успешно создали аккаунт');
    }

    public function getSignIn(){
        return view('auth.signin');
    }

    public function postSignIn(Request $request){
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required',
        ]);

        if (!Auth::attempt($request->only(['email', 'password']), $request->has('remember'))) {
            return redirect()->back()->with('info', 'Ошибка авторизации');
        }
        return redirect()->route('signin')->with('info', 'Вы успешно авторизовались');
    }

    public function getSignOut(){
        Auth::logout();
        return redirect()->route('home');
    }
}
