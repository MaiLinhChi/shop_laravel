<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Services\Recursive;
use App\Traits\DeleteModelTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    use DeleteModelTrait;
    private $categoryHtml;
    private $category;
    private $recursive;

    public function __construct(Category $category) {
        $this->category = $category;
        $this->recursive = new Recursive($this->category);
    }

    public function index () {
        $data = $this->category::paginate(5);
        return view('admin.category.index', ['category' => $data]);
    }

    public function create () {
        $this->categoryHtml = $this->recursive->getCategory(0);
        return view('admin.category.create', ['category' => $this->categoryHtml]);
    }

    public function store (Request $request) {
        try {
            $data = $request->validate([
                'name' => 'required',
                'parent_id' => 'required',
            ]);
            $data['slug'] = Str::slug($request->name);
            $this->category::create($data);
            return redirect('/admin/category')->with('success', 'Bản ghi đã được thêm mới thành công.');
        } catch (\Throwable $th) {
            return redirect('/admin/category/create')->with('success', 'Lỗi: Bản ghi không thể thêm mới.');
        }
    }

    public function edit ($id) {
        $data = $this->category::find($id);
        $this->categoryHtml = $this->recursive->getCategory($data);
        return view('admin.category.edit', ['category' => $this->categoryHtml, 'categories' => $data]);
    }

    public function update ($id, Request $request) {
        try {
            $data = $request->validate([
                'name' => 'required',
                'parent_id' => 'required',
            ]);
            $data['slug'] = Str::slug($request->name);
            $this->category->find($id)->update($data);
            return redirect('/admin/category')->with('success', 'Bản ghi đã được chỉnh sửa thành công.');
        } catch (\Throwable $th) {
            return redirect('/admin/category/create')->with('success', 'Lỗi: Bản ghi không thể chỉnh sửa.');
        }
    }

    public function delete ($id) {
        return $this->deleteModelTrait($this->category, $id);
    }
}
