<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\AppManagement;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    //
    public function index(){
        $settings= AppManagement::first();
        return view ('admin.pages.settings.index',compact('settings'));
    }

    public function updateSetting(Request $request, $id)
    {
        // Find the record from the database
        $setting = AppManagement::findOrFail($id);

        // Validate the incoming request data
        $validated = $request->validate([
            'fullName'    => 'required|string|max:255',
            'about'       => 'nullable|string|max:1000',
            'address'     => 'nullable|string|max:255',
            'phone'       => 'nullable|string|max:15',
            'email'       => 'nullable|email|max:255',
            'twitter'     => 'nullable|url|max:255',
            'facebook'    => 'nullable|url|max:255',
            'instagram'   => 'nullable|url|max:255',
            'linkedin'    => 'nullable|url|max:255',
            'profileImage'=> 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);


        // Handle the logo upload if necessary
        if ($request->hasFile('profileImage')) {
            // Get the uploaded image file
            $image = $request->file('profileImage');

            // Define the destination folder path
            $destinationPath = public_path('admin/settings/logo');

            // Create the folder if it does not exist
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true); // Create the directory if it doesn't exist
            }

            // Define the file name (optional: you can use a unique name like time-based or a random string)
            $fileName = time() . '_' . $image->getClientOriginalName();

            // Move the file to the destination folder
            $image->move($destinationPath, $fileName);

            // Save the image path to the 'logo' column
            $setting->logo = 'admin/settings/logo/' . $fileName;  // Change to 'logo'
        }

        // Update the settings with the new data from the request
        $setting->update([
            'name'        => $request->fullName,  // Make sure the input name is 'fullName'
            'email'       => $request->email,
            'address'     => $request->address,
            'phone'       => $request->phone,
            'description' => $request->about,   // Assuming 'about' corresponds to 'description' in your database
            'twitter'     => $request->twitter,
            'facebook'    => $request->facebook,
            'instagram'   => $request->instagram,
            'linkedin'    => $request->linkedin,
        ]);

        // Redirect back to the settings page with a success message
        return redirect()->route('admin.setting', $setting->id)->with('success', 'Settings updated successfully');
    }


}
