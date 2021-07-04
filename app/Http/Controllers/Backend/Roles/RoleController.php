<?php

namespace App\Http\Controllers\Backend\Roles;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;

use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the list for  resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        $model = Role::all();

        return DataTables::of($model)
                ->addColumn('Actions', function($data) {
                    return '<i class="fa fa-edit text-success fa-icon"
                                onClick="editRole(`'.$data->id.'`)">
                            </i>
                            <i data-id="'.$data->id.'" class="fa fa-trash text-danger fa-icon"
                                onClick="delData(`'.$data->id.'`, `role_del`)">
                            </i>';
                })
                ->rawColumns(['Actions'])
                ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Role $role)
    {
        $code = -1;
        $validator = \Validator::make($request->all(), [
            'name' => 'required|unique:roles',
        ]);
        
        if ($validator->fails()) {
            return response()->json([ 'code' =>  -1,'errors' => $validator->errors()->all()]);
        }

        
        if($role->create($request->all()) ){
            return response()->json([
                'code' =>  1,
                'msg' => "Record added successfully",
                'data' => [],
            ]);
    
        }


        return response()->json([
            'code' =>  -1,
            'msg' => "Error adding record",
            'data' => [],
        ]);


        

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return response()->json([
            'code' => 1,
            'msg' => 'fetching data',
            'data' => Role::find($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $code = -1;$msg='';$data=[];
        if (Role::find($id)->update($request->all())) {
            $code = 1;$msg="Updated successfully";
        }
        return response()->json([
            'code' => $code,
            'msg' => $msg,
            'data' => $data
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $code = -1;
        $role = where('id', $id)->delete();;
        if($role){ $code = 1;}
        return response()->json([
            'code' => $code,
            'msg' => 'Role deleted successfully',
            'data' => [] 
        ]);
    }
}
