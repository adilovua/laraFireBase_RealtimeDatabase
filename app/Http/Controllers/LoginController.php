<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class LoginController extends Controller
{
    public function login(){
        return view('auth.login');
    }

    public function user_login(Request $request) {

        if (Auth::attempt([
            'email'=>$request->input('email'),
            'password'=>$request->input('password')
        ])) {
                return response()->json(['success'=>'You are logged in']);
            }
            else {
                return response()->json(['erroe'=>'Something went wrong']);
            }
    }

    public function logout() {
        Auth::logout();
        return redirect()->route('login');
    }


}
