<?php

namespace App\Http\Controllers\admin\settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingsMainController extends Controller
{
    //
    public function index(){
        return view("admin.pages.settings.setting_dashboard");
    }
}
