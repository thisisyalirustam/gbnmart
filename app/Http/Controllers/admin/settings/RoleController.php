<?php

namespace App\Http\Controllers\admin\settings;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        return view('admin.pages.settings.pages.role');
    }

    public function indexjson()
    {
        $roles = Role::select('id', 'name', 'guard_name')->get();

        return response()->json([
            'data' => $roles,
            'totalCount' => $roles->count()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name',
        ]);

        $role = Role::create([
            'name' => $request->name,
            'guard_name' => 'web',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Role created successfully',
            'data' => $role,
        ]);
    }

    public function show(string $id)
    {
        $role = Role::findOrFail($id);
        return response()->json($role);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|unique:roles,name,' . $id,
        ]);

        $role = Role::findOrFail($id);
        $role->update([
            'name' => $request->name,
            'guard_name' => 'web',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Role updated successfully',
            'data' => $role,
        ]);
    }

    public function destroy(string $id)
    {
        $role = Role::findOrFail($id);
        $role->delete();

        return response()->json([
            'success' => true,
            'message' => 'Role deleted successfully',
        ]);
    }
}
