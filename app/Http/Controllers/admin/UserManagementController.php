<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class UserManagementController extends Controller
{
    public function getadmin() {
        $users = User::where('user_type', 'admin')
            ->with('roles') // Eager load the roles relationship
            ->get()
            ->map(function ($user) {
                if ($user->image) {
                    $user->image = url('uploads/' . $user->image);
                }
                $user->role_names = $user->roles->pluck('name')->implode(', ');
                return $user;
            });

        return response()->json($users);
    }

    public function adminshow() {
        return view('admin.pages.user.user_role');
    }

    // New method to get user details with roles
    public function getUserWithRoles($id) {
        $user = User::with('roles')->findOrFail($id);
        $roles = Role::all(); // Get all available roles
        
        return response()->json([
            'user' => $user,
            'all_roles' => $roles,
            'user_image' => $user->image ? url('uploads/' . $user->image) : null
        ]);
    }

    // New method to assign roles
public function assignRoles(Request $request, $userId)
{
    try {
        $request->validate([
            'roles' => 'nullable|array',
            'roles.*' => 'exists:roles,id'
        ]);

        $user = User::findOrFail($userId);
        
        // Get role names instead of IDs
        $roleNames = Role::whereIn('id', $request->input('roles', []))
                        ->pluck('name')
                        ->toArray();
        
        $user->syncRoles($roleNames);

        return response()->json([
            'success' => true,
            'message' => 'Roles updated successfully'
        ]);

    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Failed to update roles',
            'error' => $e->getMessage()
        ], 500);
    }
}
}
