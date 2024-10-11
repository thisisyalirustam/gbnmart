<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ProductCat;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $product_cat=ProductCat::all();
        return view('admin.pages.products.products_cat',compact('product_cat'));
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
       $p_cat=ProductCat::create([
            'name' => request('name'),
        ]);
        return response()->json(['success'=>true,'message'=>'product create successfully','product'=>$p_cat]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $product = ProductCat::select(
            'id',
            'name',
        )->where(['id' => $id])->get();

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
        $p_cat=ProductCat::where('id',$id)->update([
            'name' => request('name')
        ]);
        return response()->json(['success'=>true,'message'=>'product updated successfully','product'=>$p_cat]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $p_cat=ProductCat::destroy($id);
        return response()->json(['success'=>true,'message'=>'product Delete successfully','product'=>$p_cat]);
    }
}
