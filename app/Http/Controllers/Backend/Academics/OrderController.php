<?php

namespace App\Http\Controllers\Backend\Academics;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use DataTables;

use App\Models\Order;
use App\Models\OrderCategory;
use App\Models\OrderFormat;
use App\Models\OrderLanguage;
use App\Models\OrderDoc;

class OrderController extends Controller
{

    /**
     * Show the list for  resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        $model = Order::all();

        return DataTables::of($model)
                ->addColumn('Actions', function($data) {
                    return '<i class="fa fa-edit text-success fa-icon"
                                onClick="editOrder(`'.$data->id.'`)">
                                
                            </i>
                            <i data-id="'.$data->id.'" class="fa fa-trash text-danger fa-icon"
                                onClick="delData(`'.$data->id.'`, `academic_del_format`)">
                               
                            </i>
                            <a href="academic_show_order/'.$data->id.'" class="fa fa-eye text-info">
                                
                            </a>';
                })
                ->rawColumns(['Actions'])
                ->make(true);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $order_cats = OrderCategory::where('active', 1)->get();
        $formats = OrderFormat::where('active', 1)->get();
        $langs = OrderLanguage::where('active', 1)->get();
        return view('Backend.Academics.order', compact('order_cats', 'formats', 'langs'));
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
    public function store(Request $request, Order $order)
    {
        $validate = Validator::make($request->all(), [
            'order_category_id' => 'required|exists:order_categories,id',
        ]);

        if ($validate->fails()) {
            return  response()->json([
                'code'=> -2,
                'msg'=>$validate->errors()
            ]);
        }
        // create order
        $model = $order->storeData($request->all());
        if(!$model){
            return  response()->json([
                'code'=> -1,
                'msg'=> 'error creating record'
            ]);
        }
        // check for files
        if($request->hasFile('files')){
            // return $request->file('files');
            foreach ($request->file('files') as $doc){
                OrderDoc::create([
                    'user_id'=>\Auth::user()->id,
                    'order_id'=>$model->id,
                    'name'=>$doc->getClientOriginalName(),
                    'media_link'=>Storage::putFile('public/orders', $doc),
                    'sys_name'=>$doc,
                    'extension'=>$doc->getClientOriginalExtension(),
                    'type'=>$doc->getClientOriginalExtension()
                ]);
            }
        }

        return  response()->json([
            'code'=> 1,
            'msg'=> 'data created successfully'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::find($id);
        $order_docs = OrderDoc::where('order_id', $id)->get();

        return view('Backend.Academics.order_details', compact('order', 'order_docs'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Order $order)
    {
        $model = Order::find($id);
        if (!$model) {
            return response()->json([
                'code' => -1,
                 'msg' => 'Error fetching data',
                 'data' => []   
            ]);
        }

        // find documents
        $docs = OrderDoc::where('order_id', $model->id)->get();
        return response()->json([
            'code' => 1,
             'msg' => 'data fetched successfully',
             'data' => $model,   
             'docs' => $docs,   
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            'order_category_id' => 'required|exists:order_categories,id',
        ]);

        if ($validate->fails()) {
            return  response()->json([
                'code'=> -2,
                'msg'=>$validate->errors()
            ]);
        }

        // update record
        $order = new Order;
        $model = $order->updateData($id, $request->all());
        if(!$model){
            return  response()->json([
                'code'=> -1,
                'msg'=> 'error creating record'
            ]);
        }

         // check for files
         if($request->hasFile('files')){
            // return $request->file('files');
            foreach ($request->file('files') as $doc){
                OrderDoc::create([
                    'user_id'=>\Auth::user()->id,
                    'order_id'=>$id,
                    'name'=>$doc->getClientOriginalName(),
                    'media_link'=>Storage::putFile('public/orders', $doc),
                    'extension'=>$doc->getClientOriginalExtension(),
                    'type'=>$doc->getClientOriginalExtension()
                ]);
            }
        }

        return  response()->json([
            'code'=> 1,
            'msg'=> 'data created successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Order $order)
    {
        if($order->deleteData($id)){
            return response()->json([
                'code' => 1,
                 'msg' => 'data deleted successfully',                
            ]);
        }
        return response()->json([
            'code' => -1,
             'msg' => 'error deleting data',                
        ]);
    }


    public function destroyDoc($id)
    {
        $order_doc = OrderDoc::find($id);
        if(OrderDoc::find($id)->delete() ){
            Storage::delete($order_doc->media_link);
            return response()->json([
                'code' => 1,
                 'msg' => 'data deleted successfully',                
            ]);
        }
        return response()->json([
            'code' => -1,
             'msg' => 'error deleting data',                
        ]);
    }



    public function destroyDocs(Order $order)
    {
        if($order->deleteData($id)){
            return response()->json([
                'code' => 1,
                 'msg' => 'data deleted successfully',                
            ]);
        }
        return response()->json([
            'code' => -1,
             'msg' => 'error deleting data',                
        ]);
    }
}
