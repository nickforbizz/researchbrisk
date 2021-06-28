<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\BlogsComment;
use App\Models\Job;
use App\Models\JobCategory;
use App\Models\JobIndustry;
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
            abort();
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


}
