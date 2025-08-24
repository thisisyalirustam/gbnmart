<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use App\Models\ShippingCharge;
use App\Models\State;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class ShippingController extends Controller implements HasMiddleware
{
        public static function middleware(): array
    {
        return [
            new Middleware('permission:shipping.view', only: ['index']),
            new Middleware('permission:shipping.view', only: ['show']),
            new Middleware('permission:shipping.view', only: ['update']),
            new Middleware('permission:shipping.view', only: ['destroy']),
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $countries = Country::all();
        $states = State::all();
        $cities = City::all();
        $units = Unit::all();
        return view('admin.pages.shipping.index', compact('countries', 'states', 'cities', 'units'));
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
        $request->validate([
            'country_id' => 'required|exists:countries,id',
            'state_id' => 'nullable|exists:states,id',
            'city_id' => 'nullable|exists:cities,id',
            'unit_id' => 'nullable|exists:units,id',
            'charge' => 'required|numeric|min:0',
            'description' => 'nullable',
        ]);

        $shipping = ShippingCharge::create($request->all());

        return response()->json([
            'success' => true,
            'message' => ' created successfully',
            'product' => $shipping,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $shipping = ShippingCharge::find($id);

        if ($shipping) {
            return response()->json([
                'status' => true,
                'message' => 'Shipping details retrieved successfully',
                'shipping' => $shipping,
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Shipping record not found',
        ], 404);
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
        $request->validate([
            'country_id' => 'required|exists:countries,id',
            'state_id' => 'nullable|exists:states,id',
            'city_id' => 'nullable|exists:cities,id',
            'charge' => 'required|numeric|min:0',
            'description' => 'nullable',
        ]);

        // Find the shipping record by ID
        $shipping = ShippingCharge::findOrFail($id);

        // Update the shipping record
        $shipping->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Updated successfully',
            'shipping' => $shipping,
        ]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $shipping = ShippingCharge::findOrFail($id);  // Find the shipping record
        $shipping->delete();  
 
        return response()->json(['status'=>true,'message' => 'Shipping deleted successfully!']);
    }
}
