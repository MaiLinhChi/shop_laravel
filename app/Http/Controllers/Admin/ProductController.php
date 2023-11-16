<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductAddRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductTag;
use App\Models\Tag;
use App\Services\Recursive;
use App\Traits\DeleteModelTrait;
use App\Traits\StorageUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    use StorageUploadTrait, DeleteModelTrait;
    private $recursive;
    private $category;
    private $product;
    private $productImage;
    private $tag;
    private $productTag;
    private $htmlCategory;
    public function __construct(Category $category, Product $product, ProductImage $productImage, Tag $tag, ProductTag $productTag) {
        $this->category = $category;
        $this->product = $product;
        $this->productImage = $productImage;
        $this->tag = $tag;
        $this->productTag = $productTag;
        $this->recursive = new Recursive($this->category);
    }

    public function index() {
        $data = $this->product::paginate(5);
        return view('admin.product.index', ['product' => $data]);
    }

    public function create() {
        $this->htmlCategory = $this->recursive->getCategory(0);
        return view('admin.product.create', ['category' => $this->htmlCategory]);
    }

    public function store(ProductAddRequest $request) {
        DB::beginTransaction();
        $dataInsert = [
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'feature_image' => $request->avatar,
            'user_id' => auth()->id(),
            'category_id' => $request->category_id,
        ];

        $dataUpload = $this->StorageImageUploadTrait($request, 'avatar', 'product');
        if (!empty($dataUpload)) {
            $dataInsert['feature_image_name'] = $dataUpload['file_name'];
            $dataInsert['feature_image'] = $dataUpload['file_patch'];
        }

        try {
            $product = $this->product::create($dataInsert);
            if ($request->hasFile('image_small')) {
                foreach ($request->image_small as $fileItem) {
                    $dataUploadImageSmall = $this->StorageImageMultipleUploadTrait($fileItem, 'product');
                    $product->image()->create([
                        'image_name' => $dataUploadImageSmall['file_name'],
                        'image_patch' => $dataUploadImageSmall['file_patch']
                    ]);
                }
            }
            if (!empty($request->tags)) {
                foreach ($request->tags as $tagImage) {
                    $tagInstace = $this->tag::firstOrCreate(['name' => $tagImage]);
                    $tagList[] = $tagInstace->id;
                }
                $product->tag()->sync($tagList);
            }
            DB::commit();
            return redirect('/admin/product')->with('success', 'Bản ghi đã được thêm mới thành công.');
        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }

    public function edit($id) {
        $product = $this->product->find($id);
        $this->htmlCategory = $this->recursive->getCategory($product);
        return view('admin.product.edit', ['category' => $this->htmlCategory, 'product' => $product]);
    }

    public function update(Request $request, $id) {
        DB::beginTransaction();
        $dataUpdate = [
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'feature_image' => $request->avatar,
            'user_id' => auth()->id(),
            'category_id' => $request->category_id,
        ];

        $dataUpload = $this->StorageImageUploadTrait($request, 'avatar', 'product');
        if (!empty($dataUpload)) {
            $dataUpdate['feature_image_name'] = $dataUpload['file_name'];
            $dataUpdate['feature_image'] = $dataUpload['file_patch'];
        }

        try {
            $this->product->find($id)->update($dataUpdate);
            $product = $this->product->find($id);
            if ($request->hasFile('image_small')) {
                $this->productImage->where('product_id', $id)->delete();
                foreach ($request->image_small as $fileItem) {
                    $dataUploadImageSmall = $this->StorageImageMultipleUploadTrait($fileItem, 'product');
                    $product->image()->create([
                        'image_name' => $dataUploadImageSmall['file_name'],
                        'image_patch' => $dataUploadImageSmall['file_patch']
                    ]);
                }
            }
            if (!empty($request->tags)) {
                foreach ($request->tags as $tagImage) {
                    $tagInstace = $this->tag::firstOrCreate(['name' => $tagImage]);
                    $tagList[] = $tagInstace->id;
                }
                $product->tag()->sync($tagList);
            }
            DB::commit();
            return redirect('/admin/product')->with('success', 'Bản ghi đã được thêm mới thành công.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect('/admin/product/edit/' . $id)->with('success', 'Lỗi: Bản ghi không thể thêm mới.');
        }
    }

    public function delete($id) {
        return $this->deleteModelTrait($this->product, $id);
    }
}
