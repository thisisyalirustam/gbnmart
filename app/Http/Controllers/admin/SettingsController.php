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
        $setting = AppManagement::findOrFail($id);
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
        if ($request->hasFile('profileImage')) {
            $image = $request->file('profileImage');
            $destinationPath = public_path('admin/settings/logo');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true); // Create the directory if it doesn't exist
            }
            $fileName = time() . '_' . $image->getClientOriginalName();
            $image->move($destinationPath, $fileName);
            $setting->logo = 'admin/settings/logo/' . $fileName;  // Change to 'logo'
        }

        $setting->update([
            'name'        => $request->fullName,  // Make sure the input name is 'fullName'
            'email'       => $request->email,
            'address'     => $request->address,
            'phone'       => $request->phone,
            'description' => $request->about,
            'twitter'     => $request->twitter,
            'facebook'    => $request->facebook,
            'instagram'   => $request->instagram,
            'linkedin'    => $request->linkedin,
        ]);
        return redirect()->route('admin.setting', $setting->id)->with('success', 'Settings updated successfully');
    }


}
