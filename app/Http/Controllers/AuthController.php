<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showloginform() {
        return view('auth.auth');
    }
    public function login( Request $request){
        $info= $request->validate([
        'email'=>'required|email',
        'password'=>'required',
    ]);
        if(Auth::attempt($info)){
$request->session()->regenerate();
return redirect()->route('dashbord');
}
return back()->withErrors(["message"=>"invalid email or password"]);
    }
    public function main(){
        return view('auth.main');
    }
public function index(){
    return view('auth.dashbord');
}
public function logout(Request $request){
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect()->route('login.show');
}
    }

