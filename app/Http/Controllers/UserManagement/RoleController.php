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
        $data = array();
        foreach ($request->permissions as $key => $item){
           $data[$key] = (int)$item;
        }
        
        if (!empty($data)){
           $role->syncPermissions($data);
        }
        return redirect()->route('viewroles')->with('success','Role Added Successfully');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $id = decrypt($id);
        $role = Role::find($id);
        $permissions = Permission::all();
        return view('menu.user_management.roles.edit' , compact('role','permissions'));
    }

    public function update(Request $request, $id)
    {
        $id = decrypt($id);
        $this->validate($request,[
            'role'=>'required|max:255',
        ]);
        $role = Role::find($id);
        $role->name = $request->role;
        $role->description = $request->description;
        $role->save();
        $data = array();
        foreach ($request->permissions as $key => $item){
           $data[$key] = (int)$item;
        }
        
        if (!empty($data)){
           $role->syncPermissions($data);
        }
        return redirect()->route('viewroles')->with('success','Role Updated Successfully');
    }

    public function destroy($id)
    {
        $id = decrypt($id);
        Role::find($id)->delete();
        return redirect()->route('viewroles')->with('success','Role Deleted Successfully');
    }
}
