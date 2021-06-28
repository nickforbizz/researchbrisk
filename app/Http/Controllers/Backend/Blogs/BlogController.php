<?php

namespace App\Http\Controllers\Backend\Blogs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use DataTables;
use Session;
use DB;

use App\Models\Blog;
use App\Models\BlogTag;
use App\Models\BlogTagsPivot;
use App\Models\BlogCategory;

class BlogController extends Controller
{

     /**
     * Show the list for  resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        $model = Blog::all();

        return DataTables::of($model)
                ->addColumn('Actions', function($data) {
                    return '<i class="fa fa-edit text-success fa-icon"
                                onClick="editCategory(`'.$data->id.'`)">
                                 
                            </i> |
                            <i data-id="'.$data->id.'" class="fa fa-trash text-danger fa-icon"
                                onClick="delData(`'.$data->id.'`, `blog_del_category`)">
                            </i>';
                })
                ->rawColumns(['Actions'])
                ->make(true);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function advanceAddOrUpdate(Request $request)
    {
        
        $blog = Blog::where('uuid', $request->uuid)->first();
        if (!$blog) {
            // abort(404);
        }


        $categories = BlogCategory::where('status', 1)->get();
        $tags = BlogTag::where('status', 1)->get();



        return view('Backend.Blogs.blog_data', compact('categories', 'blog', 'tags')); 
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = BlogCategory::where('status', 1)->get();
        return view('Backend.Blogs.blogs', compact('categories')); 
    }

    /**
     * create tags
     *
     * @return \Illuminate\Http\Response
     */
    public function addTags(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'title' => 'required',
        ]);
        
        if ($validator->fails()) {
            $notification = array(
                'message' => 'validation error on the fields',
                'alert-type' => 'error'
            );
            return back()->with($notification);
        }

        $new_tag = BlogTag::create([
            'user_id' => \Auth::user()->id,
            'title' => $request->title,
        ]);

        if (!$new_tag) {
            $notification = array(
                'message' => 'unable to create record',
                'alert-type' => 'error'
            );
            return back()->with($notification);
        }


        $notification = array(
            'message' => 'success creating record',
            'alert-type' => 'success'
        );

        return back()->with($notification);


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'featured_image' => 'required|file|mimes:jpg,jpeg,png',
            'title' => 'required',
            'slug' => 'required|unique:blogs',
            'blog_category_id' => 'required|exists:blog_categories,id',
            'description' => 'required',
            'body' => 'required',
        ]);
        
        if ($validator->fails()) {
            return response()->json([ 'code' =>  -1, 'msg' => $validator->errors()->all()]);
        }

        DB::beginTransaction();
        try {
            // saved featured image
            if($request->hasFile('featured_image')){
                $featured_image = $request->file('featured_image');
                // save blog
                $new_blog = Blog::create([
                    'user_id' => \Auth::user()->id,
                    'title' => $request->title,
                    'slug' => $request->slug,
                    'blog_category_id' => $request->blog_category_id,
                    'archived' => $request->archived,
                    'description' => $request->description,
                    'body' => $request->body,
                    'media_link'=>Storage::putFile('public/posts/feature_imgs', $featured_image),
                    'media_name'=> $request->slug,
                    'media_type'=>$featured_image->getClientOriginalExtension()
                ]);
    
                if ($new_blog) {
                    // create tags
                    foreach ($request->blog_tags as $key => $value) {
                        $tag = BlogTag::where('id', $value)->first();
                        BlogTagsPivot::create([
                            'user_id' => \Auth::user()->id,
                            'blog_id' => $new_blog->id,
                            'blog_title' => $new_blog->title,
                            'tag_id' => $value,
                            'tag_title' => $tag->title,
                        ]);
                    }
                    DB::commit();
                    return response()->json([ 'code' =>  1, 'msg' => "success post creation"]);
                }
                return response()->json([ 'code' =>  -1, 'msg' => "error post creation"]);
            }
            
            return response()->json([ 'code' =>  -1, 'msg' => "error no featured_image"]);
        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }
    }


    public function advanceEdit(Request $request, $id){
        $validator = \Validator::make($request->all(), [
            'title' => 'required',
            'blog_category_id' => 'required|exists:blog_categories,id',
            'description' => 'required',
            'body' => 'required',
        ]);
        
        if ($validator->fails()) {
            return response()->json([ 'code' =>  -1, 'msg' => $validator->errors()->all()]);
        }

        $blog = Blog::where('uuid', $request->uuid)->first();
        if (!$blog) {
            return response()->json([ 'code' =>  -1, 'msg' => "record not found"]);
        }

        $blog->archived = $request->archived;
        $blog->blog_category_id = $request->blog_category_id;
        $blog->body = $request->body;
        $blog->description = $request->description;
        $blog->slug = $request->slug;
        $blog->title = $request->title;
        $blog->user_id = \Auth::user()->id;
        // saved featured image
        if($request->hasFile('featured_image')){
            $featured_image = str_replace('public', 'storage', $blog->media_link);
            if (file_exists($featured_image)){
                unlink($featured_image);
            }
            $featured_image = $request->file('featured_image');

            $blog->media_link = Storage::putFile('public/posts/feature_imgs', $featured_image);
            $blog->media_name = $request->slug;
            $blog->media_type = $featured_image->getClientOriginalExtension();
        }


        if($blog->save()){
            return response()->json([ 'code' =>  1, 'msg' => "record updated successfully"]);
        }
        return response()->json([ 'code' =>  -1, 'msg' => "error updating record"]);
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
            'data' => Blog::find($id)
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
        $validator = \Validator::make($request->all(), [
            'title' => 'required',
            'blog_category_id' => 'required|exists:blog_categories,id',
            'description' => 'required',
        ]);
        
        if ($validator->fails()) {
            return response()->json([ 'code' =>  -1, 'msg' => $validator->errors()->all()]);
        }

        $blog = Blog::find($id);
        if (!$blog) {
            return response()->json([ 'code' =>  -1, 'msg' => "record not found"]);
        }

        $blog->title = $request->title;
        $blog->description = $request->description;
        $blog->archived = $request->archived;
        $blog->blog_category_id = $request->blog_category_id;

          
        if($blog->save()){
            return response()->json([ 'code' =>  1, 'msg' => "record updated successfully"]);
        }
        return response()->json([ 'code' =>  -1, 'msg' => "error updating record"]);


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
    }
}
