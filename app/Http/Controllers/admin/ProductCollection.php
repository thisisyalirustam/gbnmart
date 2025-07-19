<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProductCollection extends Controller
{
    //
    public function index()
    {
        return view('admin.pages.products.collections');
    }
    public function getCollection()
    {
        $collection = Collection::withCount('products')->get()->map(function ($item) {
            if ($item->image) {
                $item->image = asset($item->image);
            }
            return $item;
        });

        return response()->json($collection);
    }




    public function assignCollections(Request $request)
    {
        $request->validate([
            'product_ids' => 'required|array',
            'product_ids.*' => 'exists:products,id',
            'collection_ids' => 'required|array',
            'collection_ids.*' => 'exists:collections,id',
        ]);

        try {
            $productIds = $request->input('product_ids');
            $collectionIds = $request->input('collection_ids');

            foreach ($productIds as $productId) {
                foreach ($collectionIds as $collectionId) {
                    // Check if the association already exists
                    $exists = DB::table('collection_products')
                        ->where('product_id', $productId)
                        ->where('collection_id', $collectionId)
                        ->exists();

                    if (!$exists) {
                        DB::table('collection_products')->insert([
                            'product_id' => $productId,
                            'collection_id' => $collectionId,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                    }
                }
            }

            return response()->json([
                'success' => true,
                'message' => 'Products successfully added to collections',
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error assigning collections: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function show($id)
    {
        $collection = Collection::findOrFail($id);
        return response()->json([
            'product' => [$collection]
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'sometimes|boolean',
            'show_on_front' => 'sometimes|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            $imagePath = null;
            if ($request->hasFile('image')) {
                $img = $request->file('image');
                $ext = $img->getClientOriginalExtension();
                $imageName = time() . '.' . $ext;
                $img->move(public_path('images/collection_img'), $imageName);
                $imagePath = 'images/collection_img/' . $imageName;
            }

            $collection = new Collection();
            $collection->name = $request->name;
            $collection->description = $request->description;
            $collection->is_active = $request->boolean('is_active', true);
            $collection->show_on_front = $request->boolean('show_on_front', false);
            $collection->image = $imagePath;
            $collection->save();

            return response()->json([
                'success' => true,
                'message' => 'Collection created successfully.',
                'data' => $collection,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create collection.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'sometimes|boolean',
            'show_on_front' => 'sometimes|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            $collection = Collection::findOrFail($id);

            $imagePath = $collection->image;
            if ($request->hasFile('image')) {
                // Delete old image if exists
                if ($imagePath && file_exists(public_path($imagePath))) {
                    unlink(public_path($imagePath));
                }

                $img = $request->file('image');
                $ext = $img->getClientOriginalExtension();
                $imageName = time() . '.' . $ext;
                $img->move(public_path('images/collection_img'), $imageName);
                $imagePath = 'images/collection_img/' . $imageName;
            }

            $collection->name = $request->name;
            $collection->description = $request->description;
            $collection->is_active = $request->boolean('is_active', true);
            $collection->show_on_front = $request->boolean('show_on_front', false);
            $collection->image = $imagePath;
            $collection->save();

            return response()->json([
                'success' => true,
                'message' => 'Collection updated successfully.',
                'data' => $collection,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update collection.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $collection = Collection::findOrFail($id);

            // Delete associated image if exists
            if ($collection->image && file_exists(public_path($collection->image))) {
                unlink(public_path($collection->image));
            }

            $collection->delete();

            return response()->json([
                'success' => true,
                'message' => 'Collection deleted successfully.',
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete collection.',
                // optionally: 'error' => $e->getMessage(),  <-- for debugging only
            ], 500);

        }
    }

    public function showProducts($id)
    {
        $collection = Collection::with('products')->findOrFail($id);

        return view('admin.pages.products.product_collection', [
            'collection' => $collection,
            'products' => $collection->products,
        ]);
    }
    public function removeProduct($collectionId, $productId)
    {
        $collection = Collection::findOrFail($collectionId);
        $collection->products()->detach($productId);

        return redirect()->back()->with('success', 'Product removed from collection.');
    }

}
