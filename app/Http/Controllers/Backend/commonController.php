<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class commonController extends Controller
{
    public function download($file)
    {
        $file = "public/orders/bFWsf9akIRDWGp9k1L9BHRbRJRUG2goRuL3OP8BE.pdf";
        return response()->download($file);
    }
}
