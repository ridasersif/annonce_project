<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Models\Client;
use App\Models\Role;
use App\Models\Society;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showRegisterForm()
    {
        $roles = Role::all();
        return view('auth.register',compact('roles'));
    }
    public function register(RegisterRequest  $request){
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => 4,
           
         ]);
        Auth::login($user);
        return redirect()->route('home');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }
    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
    
        if (!Auth::attempt($credentials)) {
            return back()->withErrors([
                'password' => "Le mot de passe est incorrect.",
            ]);
        }
    
        return redirect()->route('home');
    }
    
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}

