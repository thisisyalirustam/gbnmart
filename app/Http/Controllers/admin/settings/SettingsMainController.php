<?php

namespace App\Http\Controllers\admin\settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class SettingsMainController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:setting.view', only: ['index']),

        ];
    }
    //
    public function index()
    {
        return view("admin.pages.settings.setting_dashboard");
    }

    public function allRoles()
    {
        $roles = Role::with('permissions')->get();
        $permissions = Permission::all();

        return view('admin.pages.settings.pages.allRoleAndPermessions', compact('roles', 'permissions'));
    }
    public function getPermissions($id)
{
    $role = Role::with('permissions')->findOrFail($id);
    $all_permissions = Permission::all();

    return response()->json([
        'role' => $role,
        'all_permissions' => $all_permissions
    ]);
}


public function assignPermissions(Request $request, $id)
{
    try {
        $role = Role::findOrFail($id);

        // Ensure it's an array
        $permissionIds = $request->input('permissions', []);
        
        // Convert IDs → names
        $permissions = Permission::whereIn('id', $permissionIds)->pluck('name')->toArray();

        $role->syncPermissions($permissions);

        return response()->json(['message' => 'Permissions updated successfully']);
    } catch (\Exception $e) {
        Log::error('Assign permission error: ' . $e->getMessage());
        return response()->json(['message' => 'Failed: ' . $e->getMessage()], 500);
    }
}



}
