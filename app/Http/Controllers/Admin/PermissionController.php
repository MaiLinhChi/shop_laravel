<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function create() {
        return view('admin.permission.create');
    }

    public function store(Request $request) {
        $permission = Permission::create([
            'name' => 'manager_' . $request->name,
            'display_name' => $request->name,
            'parent_id' => 0
        ]);

        foreach ($request->feature_name as $item) {
            Permission::create([
                'name' => $request->name . '_' . $item,
                'display_name' => $request->name,
                'parent_id' => $permission->id
            ]);
        }
    }
}
