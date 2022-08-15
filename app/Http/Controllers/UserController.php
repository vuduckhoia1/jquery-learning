<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    public function register(){
        $data['title']='Register';
        return view('user/register',$data);
    }

    public function register_action(Request $request){
        $request->validate([
            'email' => 'required',
            'username' => 'required|unique:table_users',
            'password' => 'required',
            'password_confirmation'=>'required:same:password'
        ]);
        $user=new User([
            'email'=>$request->email,
            'username'=>$request->username,
            'password'=>Hash::make($request->password)
        ]);
        $user->save();
        return redirect()->route('login')->with('success', 'registration success. Please login');
    }

    public function login_action(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password])){
            $request->session()->regenerate();
            return redirect()->intended('/');
        }
        return back()->withErrors('password', 'Wrong username or password');
    }

    public function login(){
        return view('user/login');
    }


}
