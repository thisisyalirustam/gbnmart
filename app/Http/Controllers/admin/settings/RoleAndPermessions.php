<?php

namespace App\Http\Controllers\admin\settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\HasPermissions;

class RoleAndPermessions extends Controller
{
    // Permission CRUD Methods
    public function permession()
    {
        return view('admin.pages.settings.pages.permessions');
    }

    public function index()
    {
        $permissions = Permission::all();
        return response()->json([
            '@odata.count' => $permissions->count(),
            'value' => $permissions
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:permissions,name',
        ]);
     

        $permission = Permission::create([
            'name' => $request->name,
            'guard_name' => 'web',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Permission created successfully',
            'data' => $permission
        ]);
    }

    public function show($id)
    {
        return response()->json(Permission::findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:permissions,name,' . $id,
        ]);

        
        $permission = Permission::findOrFail($id);
        $permission->update([
            'name' => $request->name,
            'guard_name' => 'web',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Permission updated successfully',
            'data' => $permission
        ]);
    }

    public function destroy($id)
    {
        $permission = Permission::findOrFail($id);
        $permission->delete();

        return response()->json([
            'success' => true,
            'message' => 'Permission deleted successfully'
        ]);
    }

    // Role-Permission Assignment Methods
    public function roleAndPermession()
    {
        $roles = Role::with('permissions')->get();
        $permissions = Permission::all();
        return view('admin.pages.settings.pages.assignRoleAndPermessions', compact('roles', 'permissions'));
    }

    public function getRoles()
    {
        $permession = Permission::all();
        return response()->json($permession);
    }

    public function getRolePermissions($roleId)
    {
        $role = Role::findOrFail($roleId);
        $permissions = $role->permissions->pluck('id');
        
        return response()->json([
            'assignedPermissions' => $permissions,
            'allPermissions' => Permission::all()
        ]);
    }

 public function assignPermissionsToRole(Request $request)
    {
        $request->validate([
            'permission_ids'   => 'required|array',
            'permission_ids.*' => 'exists:permissions,id',
            'role_ids'         => 'required|array',
            'role_ids.*'       => 'exists:roles,id',
        ]);

        $permissions = Permission::whereIn('id', $request->permission_ids)->get();
        $roles = Role::whereIn('id', $request->role_ids)->get();

        foreach ($roles as $role) {
            $role->givePermissionTo($permissions); // ✅ append permissions
        }

        return response()->json([
            'success' => true,
            'message' => 'Permissions assigned successfully'
        ]);
    }

}