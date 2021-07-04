<?php

namespace App\Http\Controllers\Backend\Academics;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\Models\OrderFormat;

class FormatController extends Controller
{

    protected $code = -1;
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Backend.Academics.format');
    }

     /**
     * Show the list for  resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        $model = OrderFormat::all();

        return DataTables::of($model)
                ->addColumn('Actions', function($data) {
                    if(\Auth::user()->hasRole("admin")){

                        $actions = '<i class="fa fa-edit text-success fa-icon"
                                    onClick="editFormat(`'.$data->id.'`)">
                                    
                                </i>
                                <i data-id="'.$data->id.'" class="fa fa-trash text-danger fa-icon"
                                    onClick="delData(`'.$data->id.'`, `academic_del_format`)">
                                    
                                </i>';
                    }else{
                        $actions = "_ _";
                    }

                    return $actions;
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
    public function store(Request $request, OrderFormat $order_format)
    {
        $code = -1;
        $validator = \Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
        ]);
        
        if ($validator->fails()) {
            return response()->json([ 'code' =>  -1,'errors' => $validator->errors()->all()]);
        }

        
        if($order_format->storeData($request->all()) ){
            return response()->json([
                'code' =>  1,
                'msg' => "format added successfully",
                'data' => [],
            ]);
        }

        return response()->json([
            'code' =>  -1,
            'msg' => "Error while adding Record",
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
            'data' => OrderFormat::find($id)
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
        if (OrderFormat::find($id)->update($request->all())) {
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
        $order_format = new OrderFormat;
        if($order_format->deleteData($id)){ $code = 1;}
        return response()->json([
            'code' => $code,
            'msg' => 'OrderFormat deleted successfully',
            'data' => [] 
        ]);
    }
}
