<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Services\Recursive;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    private $categoryHtml;
    private $category;

    public function __construct(Category $category) {
        $this->category = $category;
    }

    public function index () {
        $data = $this->category::paginate(5);
        return view('admin.category.index', ['category' => $data]);
    }

    public function create () {
        $this->getCategory(0);
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
        $this->getCategory($data);
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
        try {
            $this->category::find($id)->delete();
            return redirect('/admin/category')->with('success', 'Bản ghi đã được xóa thành công.');
        } catch (\Throwable $th) {
            return redirect('/admin/category/create')->with('success', 'Lỗi: Bản ghi không thể xóa.');
        }
    }

    public function getCategory ($categories) {
        if (is_object($categories)) {
            $data = $this->category::where('id', '!=', $categories['id'])->get();
            $recursive = new Recursive($data);
            $this->categoryHtml = $recursive->printCategories($categories['parent_id'], 0, '');
        } else {
            $data = $this->category::all();
            $recursive = new Recursive($data);
            $this->categoryHtml = $recursive->printCategories(null, 0, '');
        }


        return $this->categoryHtml;
    }
}
