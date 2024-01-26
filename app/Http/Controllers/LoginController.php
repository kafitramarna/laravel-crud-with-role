<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function index(){
        return view('auth.login');
    }
    public function loginProcess(Request $request){
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors($validator);
        }
        $credential=[
            'username' => $request->username,
            'password' => $request->password
        ];
        if(Auth::attempt($credential)){
            session(['username' => $request->username]);
            return redirect()->route('dashboard.index');
        }
        return redirect()->back()->with('error', 'Username atau password salah');
    }
    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }
}
