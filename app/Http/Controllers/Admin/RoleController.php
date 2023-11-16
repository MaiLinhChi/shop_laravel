<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\RoleAddRequest;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use App\Traits\DeleteModelTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    private $user;
    private $role;
    private $permission;
    use DeleteModelTrait;
    public function __construct(User $user, Role $role, Permission $permission) {
        $this->user = $user;
        $this->role = $role;
        $this->permission = $permission;
    }

    public function index() {
        $data = $this->role::paginate(5);
        return view('admin.role.index', ['role' => $data]);
    }

    public function create() {
        $role = $this->role->all();
        $permissionParent = $this->permission->where('parent_id', 0)->get();
        return view('admin.role.create', ['role' => $role, 'permissionParent' => $permissionParent]);
    }

    public function store(RoleAddRequest $request) {
        DB::beginTransaction();
        try {
            $dataInsert = [
                'name' => $request->name,
                'display_name' => $request->display_name,
            ];
            $role = $this->role->create($dataInsert);
            $role->permissions()->attach($request->permission_id);
            DB::commit();
            return redirect('/admin/role');
        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }

    public function edit($id) {
        $role = $this->role->find($id);
        $permissionParent = $this->permission->where('parent_id', 0)->get();
        $permissionChecked = $role->permissions;
        return view('admin.role.edit', ['role' => $role, 'permissionParent' => $permissionParent, 'permissionChecked' => $permissionChecked]);
    }

    public function update(Request $request, $id) {
        DB::beginTransaction();
        try {
            $dataUpdate = [
                'name' => $request->name,
                'display_name' => $request->display_name,
            ];
        
            $this->role->find($id)->update($dataUpdate);
            $role = $this->role->find($id);
            $role->permissions()->sync($request->permission_id);
            DB::commit();
            return redirect('/admin/role');
        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }

    public function delete($id) {
        return $this->deleteModelTrait($this->user, $id);
    }
}
