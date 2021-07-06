<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;

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
            $permission = Permission::where('id', $permission)->first();;
            $user->givePermissionTo($permission->name);
        }
        
       
        
        $notification = array(
            'message' => 'success creating record',
            'alert-type' => 'success'
        );

        return back()->with($notification);
    }

    /**
     * Manage Users
     */
    public function showManageUsers(Request $request)
    {
        return view('backend.manageusers');
    }

    public function listManageUsers(Request $request)
    {
        $model = User::all();

        return DataTables::of($model)
                ->editColumn('active', function($data) {
                    if(\Auth::user()->hasRole("admin")){
                        if (\Auth::user()->id == $data->id) {
                            return '_ _';
                        }
                        $rec_type = ($data->active == 1) ? 'active' : 'deactive';
                        $rec_type_msg = ($data->active == 1) ? 'Deactivate' : 'Activate';
                        
                        $btn_actions = '<a href="#" data-id="'.$data->id.'" class=" fa-icon"
                                            onClick="activateDeactivate(`'.$data->id.'`,`'.$rec_type.'`)">
                                            '.$rec_type_msg.'
                                        </a>';
                        return $btn_actions;
                    }else{
                        return  ($data->active == 1) ? 'Active' : 'Inactive';
                    }

                })
                ->addColumn('Actions', function($data) {
                    if(\Auth::user()->hasRole("admin")){
                        if (\Auth::user()->id == $data->id) {
                            return '<i class="fa fa-edit text-success fa-icon"
                                        onClick="editUser(`'.$data->id.'`)">
                                    </i>';
                        }
                        $btn_actions = '<i class="fa fa-edit text-success fa-icon"
                                    onClick="editUser(`'.$data->id.'`)">
                                </i>
                                <i data-id="'.$data->id.'" class="fa fa-trash text-danger fa-icon"
                                    onClick="delData(`'.$data->id.'`, `manage_user_del`)">
                                </i>';
                    }else{
                        $btn_actions = 'N/A';
                    }

                    return $btn_actions;
                })
                ->rawColumns(['Actions', 'active'])
                ->make(true);
    }


    public function destroyManageUsers($id)
    {
        $code = -1;
        $user = new User;
        if($user->delete($id)){ $code = 1;}
        return response()->json([
            'code' => $code,
            'msg' => 'Record deleted successfully',
            'data' => [] 
        ]);
    }

    public function actdeactivateManageUsers(Request $request)
    {
        $code = -1;


        $user = User::where('id',$request->user_id)->first();
        if($user){ 
            $rec_type_msg = ($user->active == 1) ? 'Deactivated' : 'Activated';
            if ($request->rec_type == 'active') {
                $user->active = 0;
            }else if($request->rec_type == 'deactive') {
                $user->active = 1;
            } else{
                return back()->with([
                    'message' => 'unable to process record - ',
                    'alert-type' => 'error'
                ]);
            }
            $user->save();
            
        }
        $notification = array(
            'message' => 'success record - '.$rec_type_msg,
            'alert-type' => 'success'
        );

        return back()->with($notification);
    }


    public function userRolePermissions(Request $request)
    {
        if(!isset($request->rolePermission_userid)){
            $user = \Auth::user();
            $model = $user->roles;
            return DataTables::of($model)
                    ->addColumn('Actions', function($data) {
                        return '_ _';
                    }) 
                    ->rawColumns(['Actions'])
                    ->make(true);
        }

        $user = User::where('id', $request->rolePermission_userid)->first();
        if ($request->rolePermission_action == 'r') {
            // Get roles
            $model = $user->roles;
            return DataTables::of($model)
                    ->addColumn('Actions', function($data) {
                        return '_ _';
                    }) 
                    ->rawColumns(['Actions'])
                    ->make(true);
        }else{
            // Get Permissions
            $model = $user->getAllPermissions();
            return DataTables::of($model)
                    ->addColumn('Actions', function($data) {
                        return '_ _';
                    }) 
                    ->rawColumns(['Actions'])
                    ->make(true);
        }
       dd($request);
    }
}
