<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $roles=Role::all();
        $permissions=Permission::all();
      
        return view('admin.dashboard.role',compact('roles','permissions'));
    }
    public function store(Request $request)
    {
        $role=new Role();
        $role->name=$request->name;
        $role->save();
        return redirect()->route('role.index');
        // Role::create($request->all());
        // return redirect()->route('admin.dashboard.role')->with('success', 'Role created successfully');
    }
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'permissions' => 'required|array',
            'permissions.*' => 'exists:permissions,id', 
        ]);
        $role->permissions()->sync($request->permissions);  

        return redirect()->route('role.index')->with('success', 'Role permissions updated successfully!');
    }
    public function destroy($id){
        $role = Role::findOrFail($id);
        $role->delete();
        return redirect()->route('admin.dashboard.role')->with('success', 'Role deleted successfully');
    }
}
