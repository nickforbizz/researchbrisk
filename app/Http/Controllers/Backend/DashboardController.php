<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //

    public function viewDashboard(Request $request)
    {
        return view('Backend.index');
    }
}
