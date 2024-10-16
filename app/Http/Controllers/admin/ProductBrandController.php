<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ProductBrand;
use App\Models\ProductCat;
use Illuminate\Http\Request;

class ProductBrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product_cat=ProductCat::all();
        $product_brand = ProductBrand::with('product_cat')->get();
        return view('admin.pages.products.product_brand',compact('product_brand', 'product_cat'));

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
        $brand=ProductBrand::create([
            'product_cat_id' => request('product_cat_id'),
            'name' => request('name'),
        ]);
        return response()->json([
            'success' => true,
            'message' => 'Your beautiful user',
            'brand' => $brand
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $brand = ProductBrand::select(
            'id',
            'name',
        )->where(['id' => $id])->get();

        return response()->json([
            'success' => true,
            'message' => 'Your beautiful user',
            'product' => $brand
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
        $brand=ProductBrand::where('id',$id)->update([
            'name' => request('name')
        ]);
        return response()->json(['success'=>true,'message'=>'brand updated successfully','product'=>$brand]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $brand=ProductBrand::destroy($id);
        return response()->json(['success'=>true,'message'=>'product Delete successfully','product'=>$brand]);
    }
}
