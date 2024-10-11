<?php

namespace App\Http\Controllers\suplair;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SuplairController extends Controller
{
    //
    public function index(){
        return view('suplair.pages.dashboard.index');
    }
}
