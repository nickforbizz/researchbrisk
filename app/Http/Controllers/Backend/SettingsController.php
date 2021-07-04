<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


// models
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class SettingsController extends Controller
{
    public function index(Request $request)
    {
        $roles = Role::all();
        $permissions = Permission::all();
        $users = User::where('status', 1)->get();

        return view('Backend.settings.index', compact('roles', 'permissions', 'users'));
    }



    public function roleGivePermissions(Request $request)
    {
        
        $validator = \Validator::make($request->all(), [
            'role_id' => 'required',
            'to_permissions' => 'required',
        ]);
        
        if ($validator->fails()) {
            $notification = array(
                'message' => 'validation error on the fields',
                'alert-type' => 'error'
            );
            return back()->with($notification);
        }


        $role =  $request->role_id;
        $permissions =  $request->to_permissions;


        $role = Role::where('id', $role)->first();

        
        foreach($permissions as $permission){
            $permission = Permission::where('id', $permission)->first();;
            $role->givePermissionTo($permission);
        }
        
       
        
        $notification = array(
            'message' => 'success creating record',
            'alert-type' => 'success'
        );

        return back()->with($notification);
    }



    public function userGiveRoles(Request $request)
    {
        
        $validator = \Validator::make($request->all(), [
            'user_action' => 'required',
            'user_roles' => 'required',
            'user2roles' => 'required',
        ]);
        
        if ($validator->fails()) {
            $notification = array(
                'message' => 'validation error on the fields',
                'alert-type' => 'error'
            );
            return back()->with($notification);
        }

        // :TODO


        $user_id =  $request->user_roles;
        $roles =  $request->user2roles;


        $user = User::where('id', $user_id)->first();

        if ($request->user_action == 'assign') {
            foreach($roles as $role){
                $role = Role::where('id', $role)->first();;
                $user->assignRole($role->name);
            }
        }else{
            foreach($roles as $role){
                $role = Role::where('id', $role)->first();;
                $user->removeRole($role->name);
            }
        }

        
       
        
        $notification = array(
            'message' => 'success',
            'alert-type' => 'success'
        );

        return back()->with($notification);
    }



    public function userGivePermissions(Request $request)
    {
        
        $validator = \Validator::make($request->all(), [
            'user_permissions' => 'required',
            'user2permissions' => 'required',
        ]);
        
        if ($validator->fails()) {
            $notification = array(
                'message' => 'validation error on the fields',
                'alert-type' => 'error'
            );
            return back()->with($notification);
        }

        // :TODO


        $user_id =  $request->user_permissions;
        $permissions =  $request->user2permissions;


        $user = User::where('id', $user_id)->first();

        
        foreach($permissions as $permission){
            $permission = Permissions::where('id', $permission)->first();;
            $user->givePermissionTo($permission->name);
        }
        
       
        
        $notification = array(
            'message' => 'success creating record',
            'alert-type' => 'success'
        );

        return back()->with($notification);
    }
}
