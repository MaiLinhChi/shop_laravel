<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\SliderAddRequest;
use App\Models\Slider;
use App\Traits\DeleteModelTrait;
use App\Traits\StorageUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SliderController extends Controller
{
    use StorageUploadTrait, DeleteModelTrait;
    private $slider;
    public function __construct(Slider $slider) {
        $this->slider = $slider;
    }

    public function index() {
        $data = $this->slider::paginate(5);
        return view('admin.slider.index', ['slider' => $data]);
    }

    public function create() {
        return view('admin.slider.create');
    }

    public function store(SliderAddRequest $request) {
        DB::beginTransaction();
        try {
            $dataInsert = [
                'name' => $request->name,
                'description' => $request->description
            ];
            
            $imageUpload = $this->StorageImageUploadTrait($request, 'image_patch', 'slider');
            if (!empty($imageUpload)) {
                $dataInsert['image_name'] = $imageUpload['file_name'];
                $dataInsert['image_patch'] = $imageUpload['file_patch'];
            }
            $this->slider::create($dataInsert);
            DB::commit();
            return redirect('/admin/slider');
        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }

    public function edit($id) {
        $slider = $this->slider->find($id);
        return view('admin.slider.edit', ['slider' => $slider]);
    }

    public function update(Request $request, $id) {
        DB::beginTransaction();
        try {
            $dataUpdate = [
                'name' => $request->name,
                'description' => $request->description
            ];
            
            $imageUpload = $this->StorageImageUploadTrait($request, 'image_patch', 'slider');
            if (!empty($imageUpload)) {
                $dataUpdate['image_name'] = $imageUpload['file_name'];
                $dataUpdate['image_patch'] = $imageUpload['file_patch'];
            }
            $this->slider->find($id)->update($dataUpdate);
            DB::commit();
            return redirect('/admin/slider');
        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }

    public function delete($id) {
        return $this->deleteModelTrait($this->slider, $id);
    }
}
