<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Kreait\Firebase\Contract\Auth;

class RegisterController extends Controller
{
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    public function register(){
        return view('auth.register');
    }

    public function save_user(Request $request){
        $user = User::where('email', $request['email'])->first();

        if ($user) {
            return response()->json(['exists' => 'Email already exists']);
        }
        else {
            $user = new User;
            $user->fname = $request['fname'];
            $user->lname = $request['lname'];
            $user->email = $request['email'];
            $user->password = bcrypt($request['password']);
            $this->auth->createUserWithEmailAndPassword($request['email'], $request['password']);
        }
        $user->save();
        return response()->json(['success' => 'user registered successfully!']);
    }
}
