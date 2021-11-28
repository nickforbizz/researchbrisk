<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\BlogsComment;
use App\Models\Job;
use App\Models\Enquiry;
use App\Models\JobCategory;
use App\Models\JobIndustry;
use App\Models\NilOrder;
use App\Models\NilOrderDoc;
use App\Models\OrderFormat;
use App\Models\OrderCategory;

class frontendController extends Controller
{

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function welcome(Request $request)
    {
        $news = Blog::where('status', 1)
                        ->orderBy('id', 'desc')
                        ->take(4)
                        ->get();
        $blogs = Blog::where('status', 1)->get();
        $blog_categories = BlogCategory::where('status', 1)->get();
        return view('welcome', compact('news', 'blogs', 'blog_categories'));
    }


    /**
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function singlePost(Request $request, $id=1, $slug="")
    {
        $blog = Blog::where('uuid', $id)->first();
        
        if (!$blog) {
            abort(404);
        }
        // return $blog->blogTagsPivots;
        $blogs = Blog::where('status', 1)->get();
        $simiral_blogs = Blog::where('status', 1)->where('blog_category_id',  $blog->blog_category_id)->get();
        $blog_comments = BlogsComment::where('blog_id', $blog->id)
                                    ->where('status', 1)
                                    ->orderBy('id', 'desc')
                                    ->orderBy('parent_id', 'desc')
                                    ->get();
        return view('frontend.singlepost', compact('blog','blogs', 'simiral_blogs', 'blog_comments'));
    }


    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function viewPosts(Request $request)
    {
        $news = Blog::where('status', 1)
            ->orderBy('id', 'desc')
            ->take(4)
            ->get();
        $blogs = Blog::where('status', 1)->get();
        $blog_categories = BlogCategory::where('status', 1)->get();
        return view('frontend.posts', compact('news', 'blogs', 'blog_categories'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function viewJobs(Request $request)
    {

        $categories = JobCategory::where('status', 1)->get();
        $industries = JobIndustry::where('status', 1)->get();
        $jobs = Job::where('status', 1)->paginate(10);
        return view('frontend.jobs.jobs', compact('categories', 'industries', 'jobs'));
    }


     /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function searchJobs(Request $request)
    {
        
        $validator = \Validator::make($request->all(), [ 
            'category' => 'required',
            'industry' => 'required',
        ]);
        
        if ($validator->fails()) {
            $notification = array(
                'message' => 'validation error on the fields, select both fields',
                'alert-type' => 'error'
            );
            return back()->with($notification);
        }


        $categories = JobCategory::where('status', 1)->get();
        $industries = JobIndustry::where('status', 1)->get();
        $jobs = Job::where('status', 1)
                    ->where('job_category_id', $request->category)
                    ->where('job_industry_id', $request->industry)
                    ->paginate(10);


        
        
        if(count($jobs) < 1){
            return  redirect()->route('jobs')->with([
                'message' => 'No data was found, redirected to Jobs Page ',
                'alert-type' => 'info'
                
            ]);
        }
        
        $notification = array(
            'message' => 'success fetched record/s',
            'alert-type' => 'success'
        );


        return view('frontend.jobs.jobs', compact('categories', 'industries', 'jobs'))->with($notification);
    }





    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function viewSingleJob(Request $request, $id)
    {

        $job = Job::where('uuid', $id)->first();
        
        if (!$job) {
            abort();
        }

        $categories = JobCategory::where('status', 1)->get();
        $industries = JobIndustry::where('status', 1)->get();
        return view('frontend.jobs.singlejob', compact('categories', 'industries', 'job'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function viewAbout(Request $request)
    {
        return view('frontend.about');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function viewContact(Request $request)
    {
        return view('frontend.contact');
    }


    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function viewAcademicplaceorder(Request $request)
    {
        if ($request->isMethod('post')) {
            $validator = \Validator::make($request->all(), [
                'title' => 'required',
                'email' => 'required',
                'category_id' => 'required',
                'format_id' => 'required',
                'language_id' => 'required',
                'pages' => 'required',
                'word_count' => 'required',
            ]);
    
            // return $request;
            
            if ($validator->fails()) {
                $notification = array(
                    'message' => 'validation error on the fields',
                    'alert-type' => 'error'
                );
                return back()->with($notification);
            }
            $order_number = NilOrder::max('order_number') + 1;
            $nil_order = NilOrder::create([
                'user_id' => $request->user_id,
                'order_category_id' => $request->category_id,
                'order_format_id' => $request->format_id,
                'order_language_id' => $request->language_id,
                'pages' => $request->pages,
                'email' => $request->email,
                'title' => $request->title,
                'word_count' => $request->word_count,
                'order_number' => $order_number,
                'nil' => $request->nil,
            ]);
    
            if ($nil_order) {
                if($request->hasFile('files')){
                    // return $request->file('files');
                    foreach ($request->file('files') as $doc){
                        NilOrderDoc::create([
                            'user_id'=>$request->user_id,
                            'order_id'=>$model->id,
                            'name'=>$doc->getClientOriginalName(),
                            'media_link'=>Storage::putFile('public/orders', $doc),
                            'sys_name'=>$doc,
                            'extension'=>$doc->getClientOriginalExtension(),
                            'type'=>$doc->getClientOriginalExtension()
                        ]);
                    }
                }
                $notification = array(
                    'message' => 'Record saved successfully',
                    'alert-type' => 'success'
                );
            }else{
                $notification = array(
                    'message' => 'Unaable to save Record',
                    'alert-type' => 'error'
                );
            }
        }
        $formats = OrderFormat::where('status', 1)->get();
        $categories = OrderCategory::where('status', 1)->get();
        return view('frontend.academic.orderassignment', compact('formats', 'categories'));
    }
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function viewAcademicbio(Request $request)
    {
        return view('frontend.academic.bio');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function viewAcademicpayrates(Request $request)
    {
        return view('frontend.academic.payrates');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function viewAcademicsamples(Request $request)
    {
        return view('frontend.academic.samples');
    }
    
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function viewAcademicservices(Request $request)
    {
        return view('frontend.academic.services');
    }



    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function createPostComments(Request $request)
    {
        $blog = Blog::where('uuid', $request->uuid)->first();
        $validator = \Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'comment' => 'required',
        ]);

        // return $request;
        
        if ($validator->fails()) {
            $notification = array(
                'message' => 'validation error on the fields',
                'alert-type' => 'error'
            );
            return back()->with($notification);
        }

        $blog_comment = BlogsComment::create([
            'user_id' => $blog->user_id,
            'blog_id' => $blog->id,
            'parent_id' => $request->parent_id,
            'email' => $request->email,
            'name' => $request->name,
            'comment' => $request->comment,
        ]);

        if ($blog_comment) {
            $notification = array(
                'message' => 'Record saved successfully',
                'alert-type' => 'success'
            );
        }else{
            $notification = array(
                'message' => 'Unaable to save Record',
                'alert-type' => 'error'
            );
        }
        
        return back()->with($notification);
    }


    public function clientPostOrder(Request $request)
    {
        return $request;
    }


    public function postEnquiry(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'names' => 'required',
            'email' => 'required',
            'msg' => 'required',
        ]);

        // return $request;
        
        if ($validator->fails()) {
            $notification = array(
                'message' => 'validation error on the fields',
                'alert-type' => 'error'
            );
            return back()->with($notification);
        }
    }


}
