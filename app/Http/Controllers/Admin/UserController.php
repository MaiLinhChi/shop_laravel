<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserAddRequest;
use App\Models\Role;
use App\Models\User;
use App\Traits\DeleteModelTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    private $user;
    private $role;
    use DeleteModelTrait;
    public function __construct(User $user, Role $role) {
        $this->user = $user;
        $this->role = $role;
    }

    public function index() {
        $data = $this->user::paginate(5);
        return view('admin.user.index', ['user' => $data]);
    }

    public function create() {
        $role = $this->role->all();
        return view('admin.user.create', ['role' => $role]);
    }

    public function store(UserAddRequest $request) {
        DB::beginTransaction();
        try {
            $dataInsert = [
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ];
            $user = $this->user->create($dataInsert);
            $user->roles()->attach($request->roles);
            DB::commit();
            return redirect('/admin/user');
        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }

    public function edit($id) {
        $user = $this->user->find($id);
        $roles = $this->role->all();
        $rolesOfUser = $user->roles;
        return view('admin.user.edit', ['user' => $user, 'roles' => $roles, 'rolesOfUser' => $rolesOfUser]);
    }

    public function update(Request $request, $id) {
        DB::beginTransaction();
        try {
            $dataUpdate = [
                'name' => $request->name,
                'email' => $request->email,
            ];
        
            $this->user->find($id)->update($dataUpdate);
            $user = $this->user->find($id);
            $user->roles()->sync($request->roles);
            DB::commit();
            return redirect('/admin/user');
        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }

    public function delete($id) {
        return $this->deleteModelTrait($this->user, $id);
    }
}
