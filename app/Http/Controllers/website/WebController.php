<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WebController extends Controller
{
    //
    public function home(){
        return view('website.index');
    }
    public function admin(){
        return view('admin.pages.dashboard.index');
    }
}
