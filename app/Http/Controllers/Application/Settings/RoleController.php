<?php

namespace App\Http\Controllers\Application\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Permission;
use App\Models\Role;
use DB;
use Auth;


class RoleController extends Controller
{

    public function index()
    {
        if (!Auth::user()->can('role-view')) {
            abort(403);
        }
        $roles = Role::paginate(10);
        return view('application.settings.role.index', compact('roles'));
    }

    public function create()
    {
        if (!Auth::user()->can('role-create')) {
            abort(403);
        }
        $permission = Permission::all();
        return view('application.settings.role.create', compact('permission'));
    }

    public function store(Request $request)
    {
        if (!Auth::user()->can('role-create')) {
            abort(403);
        }

        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);
    
        $role = Role::create([
            'name' => $request->name,
            'slug' => str_replace(' ', '-', $request->name)
        ]);
        //$role->syncPermissions($request->input('permission'));
        $role->permissions()->attach($request->input('permission'));
    
        session()->flash('alert-success','Role created successfully');
        return redirect()->route('settings.role');
    }

    public function edit($id)
    {
        if (!Auth::user()->can('role-edit')) {
            abort(403);
        }

        $role = Role::find($id);
        $permission = Permission::get();
        $rolePermissions = DB::table("roles_permissions")->where("roles_permissions.role_id",$id)
            ->pluck('roles_permissions.permission_id','roles_permissions.permission_id')
            ->all();
        return view('application.settings.role.edit',compact('role','permission','rolePermissions'));
    }

    public function update(Request $request, $id)
    {
        if (!Auth::user()->can('role-edit')) {
            abort(403);
        }

        $this->validate($request, [
            'name' => 'required|unique:roles,name,'.$id.',id',
            'permission' => 'required',
        ]);
    
        $role = Role::find($id);
        $role->update([
            $role->name = $request->input('name'),
            $role->slug = str_replace(' ', '-', $request->name),
        ]);

        $role->permissions()->sync($request->input('permission'));
    
        session()->flash('alert-success','Role updated successfully');
        return redirect()->route('settings.role');
    }

    public function destroy($id)
    {
        if (!Auth::user()->can('role-delete')) {
            abort(403);
        }

        if($id == 1){ //id 1 set default for superadmin
            return redirect()->route('settings.role');
        }
        DB::table("roles")->where('id',$id)->delete();

        session()->flash('alert-success','Role deleted successfully');
        return redirect()->route('settings.role');
 


    }
}
