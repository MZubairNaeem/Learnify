<?php

namespace App\Http\Controllers\UserManagement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        $permissions = Permission::all();
        return view('menu.user_management.roles.list' , compact('roles','permissions'));
    }

    public function create()
    {
        $permissions = Permission::all();
        return view('menu.user_management.roles.add' , compact('permissions'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'role'=>'required|max:255',
        ]);
        $role = Role::create([
            'name'=>$request->role,
            'guard_name'=>'web',
            'description'=>$request->description,   
        ]);
        $role->syncPermissions($request->permissions);
        return redirect()->route('viewroles')->with('success','Role Added Successfully');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $role = Role::find($id);
        $permissions = Permission::all();
        return view('menu.user_management.roles.edit' , compact('role','permissions'));
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
