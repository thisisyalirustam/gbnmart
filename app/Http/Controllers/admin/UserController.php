<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class UserController extends Controller implements HasMiddleware
{
      public static function middleware(): array
    {
        return [
            new Middleware('permission:user.managment', only: ['index']),
            new Middleware('permission:user.managment', only: ['store']),
            new Middleware('permission:user.managment', only: ['show']),
            new Middleware('permission:user.managment', only: ['update']),
            new Middleware('permission:user.managment', only: ['destroy']),
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.pages.user.adduser');
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
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'user_type' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle the image upload
        $img = $request->image;
        $ext = $img->getClientOriginalExtension();
        $imageName = time() . '.' . $ext;
        $img->move(public_path('uploads'), $imageName);

        // Create the user instance and set its properties
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->user_type = $request->user_type;
        $user->image = $imageName;

        // Save the user instance to the database
        $user->save();

        return response()->json(['success' => true, 'message' => 'User created successfully']);


    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $user = User::select(
            'id',
            'name',
            'email',
            'password',
            'user_type',
            'image'
        )->where(['id' => $id])->get();

        return response()->json([
            'status' => true,
            'message' => 'Your beautiful user',
            'user' => $user
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
        // Validate the incoming request data
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email,' . $id,
        'password' => 'nullable|string|min:8', // Password is optional for updating
        'user_type' => 'required|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Image is optional for updating
    ]);

    // Find the user by ID
    $user = User::findOrFail($id);

    // Handle the image upload if a new image is provided
    if ($request->hasFile('image')) {
        // Delete the old image if it exists
        if ($user->image && file_exists(public_path('uploads/' . $user->image))) {
            unlink(public_path('uploads/' . $user->image));
        }
        // Upload the new image
        $img = $request->image;
        $ext = $img->getClientOriginalExtension();
        $imageName = time() . '.' . $ext;
        $img->move(public_path('uploads'), $imageName);

        // Update the image name in the database
        $user->image = $imageName;
    }

    // Update the user's properties
    $user->name = $request->name;
    $user->email = $request->email;
    $user->user_type = $request->user_type;

    // Save the updated user instance to the database
    $user->save();

    return response()->json(['success' => true, 'message' => 'User updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
       // Find the user by ID
       $user = User::findOrFail($id);

       // Delete the user's image from storage if it exists
       if ($user->image && Storage::exists('public/uploads/' . $user->image)) {
           Storage::delete('public/uploads/' . $user->image);
       }


       // Delete the user record from the database
       $user->delete();

       // Return a JSON response indicating success
       return response()->json(['success' => true, 'message' => 'User deleted successfully']);
    }
}
