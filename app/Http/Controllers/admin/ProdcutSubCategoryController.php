<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ProductCat;
use App\Models\ProductSubCategory;
use Illuminate\Http\Request;

class ProdcutSubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $product_cat=ProductCat::where('status',1)->get();
        $product_sub_cat = ProductSubCategory::with('product_cat')->get();
        return view('admin.pages.products.product_sub_cat',compact('product_sub_cat', 'product_cat'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $p_sub_category = ProductSubCategory::create([
            'product_cat_id' => request('product_cat_id'),
            'name' => request('name')

        ]);

        return response()->json([
            'success' => true,
            'message' => 'Product created successfully',
            'product' => $p_sub_category
        ]);


    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $product =  ProductSubCategory::with('product_cat')->where(['id' => $id])->get();

        return response()->json([
            'status' => true,
            'message' => 'Your beautiful user',
            'product' => $product
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $product=ProductSubCategory::where('id',$id)->update([
            'product_cat_id' => request('product_cat_id'),
            'name' => request('name')
        ]);
        return response()->json(['success'=>true,'message'=>'updated successfully','product'=>$product]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $p_cat=ProductSubCategory::destroy($id);
        return response()->json(['success'=>true,'message'=>'product Delete successfully','product'=>$p_cat]);
        //
    }
}
