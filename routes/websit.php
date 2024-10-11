<?php

use App\Http\Controllers\website\WebController;
use Illuminate\Support\Facades\Route;

Route::get('/',[WebController::class, 'home'])->name('homepage');
Route::get('/admin-dashboard',[WebController::class, 'admin'])->name('admin');
