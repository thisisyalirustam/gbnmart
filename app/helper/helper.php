<?php

use App\Models\AppManagement;
use App\Models\Banner;
use App\Models\ProductCat;

function settings(){
    // Assuming you want the first record or a specific record
    return AppManagement::first(); // Or AppManagement::find($id) if you want a specific record
}

function getCategories(){

    return ProductCat::where('status', '1')->where('sof', 'yes')->get();
}
function getbanners(){
    return Banner::with('product_cat','product_sub_category', 'product_brand')->get();
}
