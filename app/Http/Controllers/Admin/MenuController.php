<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Services\Recursive;
use App\Traits\DeleteModelTrait;
use Illuminate\Support\Str;

class MenuController extends Controller
{
    use DeleteModelTrait;
    private $menu;
    private $recursive;
    private $menuHtml;

    public function __construct(Menu $menu) {
        $this->menu = $menu;
        $this->recursive = new Recursive($menu);
    }
    
    public function index () {
        $data = $this->menu::paginate(5);
        return view('admin.menu.index', ['menu' => $data]);
    }

    public function create () {
        $this->menuHtml = $this->recursive->getCategory(0);
        return view("admin.menu.create", ['menu' => $this->menuHtml]);
    }

    public function store (Request $request) {
        try {
            $data = $request->validate([
                'name' => 'required',
                'parent_id' => 'required',
            ]);
            $data['slug'] = Str::slug($request->name);
            $this->menu::create($data);
            return redirect('/admin/menu')->with('success', 'Bản ghi đã được thêm mới thành công.');
        } catch (\Throwable $th) {
            return redirect('/admin/menu/create')->with('success', 'Lỗi: Bản ghi không thể thêm mới.');
        }
    }

    public function edit ($id) {
        $data = $this->menu->find($id);
        $this->menuHtml = $this->recursive->getCategory($data);
        return view("admin.menu.edit", ['menu' => $this->menuHtml, 'item' => $data]);
    }

    public function update ($id, Request $request) {
        try {
            $data = $request->validate([
                'name' => 'required',
                'parent_id' => 'required',
            ]);
            $data['slug'] = Str::slug($request->name);
            $this->menu->find($id)->update($data);
            return redirect('/admin/menu')->with('success', 'Bản ghi đã được thêm mới thành công.');
        } catch (\Throwable $th) {
            return redirect('/admin/menu/create')->with('success', 'Lỗi: Bản ghi không thể thêm mới.');
        }
    }

    public function delete ($id) {
        return $this->deleteModelTrait($this->menu, $id);
    }
}
