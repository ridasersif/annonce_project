<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;

class UserController extends Controller
{
    public function index(){
        $roles=Role::all();
        $users=User::orderBy('id','desc')->paginate(6);
        
        return view('admin.dashboard.user',compact('users','roles'));
    }
    public function destroy($id){
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('user.index');
    }
    public function updateRole(Request $request)
    {
        $user = User::findOrFail($request->user_id);
        $user->role_id = $request->role_id;
        $user->save();
        return redirect()->route('user.index');
    }

}
