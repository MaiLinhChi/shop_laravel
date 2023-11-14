<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\SettingAddRequest;
use App\Models\Setting;
use App\Traits\DeleteModelTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingController extends Controller
{
    use DeleteModelTrait;
    private $setting;
    public function __construct(Setting $setting) {
        $this->setting = $setting;
    }
    public function index() {
        $data = $this->setting::paginate(5);
        return view('admin.setting.index', ['setting' => $data]);
    }

    public function create() {
        return view('admin.setting.create');
    }

    public function store(SettingAddRequest $request) {
        DB::beginTransaction();
        try {
            $dataInsert = [
                'setting_key' => $request->setting_key,
                'setting_value' => $request->setting_value,
                'type' => $request->type
            ];
            $this->setting::create($dataInsert);
            DB::commit();
            return redirect('/admin/setting');
        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }

    public function edit($id) {
        $setting = $this->setting->find($id);
        return view('admin.setting.edit', ['setting' => $setting]);
    }

    public function update(Request $request, $id) {
        DB::beginTransaction();
        try {
            $dataUpdate = [
                'setting_key' => $request->setting_key,
                'setting_value' => $request->setting_value,
                'type' => $request->type
            ];
            $this->setting->find($id)->update($dataUpdate);
            DB::commit();
            return redirect('/admin/setting');
        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }

    public function delete($id) {
        return $this->deleteModelTrait($this->setting, $id);
    }
}
