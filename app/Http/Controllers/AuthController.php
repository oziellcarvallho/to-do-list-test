<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * Auth user.
     */
    public function loginGet()
    {
        return view('login');
    }
    
    public function loginPost(Request $request)
    {
        $credetials = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        
        if (Auth::attempt($credetials)) {
            return redirect()->route('home');
        }
        
        return back()->with('error', 'Email ou senha incorretos!');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
