<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Blog;
use App\Models\Job;
use App\Models\Order;

class DashboardController extends Controller
{
    //

    public function viewDashboard(Request $request)
    {
        $users = User::where('status', 1)->get();
        $active_users = User::where('status', 1)->where('active', 1)->get();
        $blogs = Blog::where('status', 1)->get();
        $jobs = Job::where('status', 1)->get();
        $orders = Order::where('status', 1)->get();
        return view('Backend.index', compact('users', 'active_users', 'blogs', 'jobs', 'orders'));
    }
}
