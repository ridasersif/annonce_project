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
            'role_id' => $request->role_id,
           
         ]);
    

         if ($request->role_id == 2) {
            Client::create([
                'user_id' => $user->id,
            ]);
        }
       
        if ($request->role_id == 3) {
            Society::create([
                'user_id' => $user->id,
                'company_name' => $request->company_name,  // تأكد من أن الحقول موجودة
                'address' => $request->address,
                'description' => $request->description,
            ]);
        }
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
        if (Auth::attempt($credentials)) {
            
            return redirect()->route('home');
        }
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}

