<?php

namespace App\Http\Controllers\Backend\Jobs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\Models\JobIndustry;

class IndustryController extends Controller
{

    protected $code = -1;
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Backend.Jobs.industry');
    }

     /**
     * Show the list for  resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        $model = JobIndustry::all();

        return DataTables::of($model)
                ->addColumn('Actions', function($data) {
                    return '<i class="fa fa-edit text-success fa-icon"
                                onClick="editIndustry(`'.$data->id.'`)">
                            </i>
                            <i data-id="'.$data->id.'" class="fa fa-trash text-danger fa-icon"
                                onClick="delData(`'.$data->id.'`, `job_del_industry`)">
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
    public function store(Request $request, JobIndustry $industry)
    {
        $code = -1;
        $validator = \Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
        ]);
        
        if ($validator->fails()) {
            return response()->json([ 'code' =>  -1,'errors' => $validator->errors()->all()]);
        }

        // return $industry->storeData($request->all());
        if($industry->storeData($request->all()) ){
            return response()->json([
                'code' =>  1,
                'msg' => "Record added successfully",
                'data' => [],
            ]);
        }

        return response()->json([
            'code' =>  -1,
            'msg' => "Error saving Record",
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
            'data' => JobIndustry::find($id)
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
        if (JobIndustry::find($id)->update($request->all())) {
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
        $industry = new JobIndustry;
        if($industry->deleteData($id)){ $code = 1;}
        return response()->json([
            'code' => $code,
            'msg' => 'JobIndustry deleted successfully',
            'data' => [] 
        ]);
    }
}
