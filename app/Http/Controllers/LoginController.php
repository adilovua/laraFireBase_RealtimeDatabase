<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Kreait\Firebase\Contract\Auth as FCMauth;


class LoginController extends Controller
{

    public function __construct(FCMAuth $auth)
    {
        $this->auth = $auth;
    }

    public function login(){
        return view('auth.login');
    }

    public function user_login(Request $request) {
        if (Auth::attempt([
            'email'=>$request->input('email'),
            'password'=>$request->input('password')
        ])) {
             //  $this->auth->signInWithEmailAndPassword($request->input('email'), $request->input('password'));


                return response()->json(['success'=>'You are logged in']);

            }
            else {
                return response()->json(['error'=>'Something went wrong']);
            }
    }

    public function logout() {
        Auth::logout();
        return redirect()->route('login');
    }


}
