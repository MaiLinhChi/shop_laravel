@extends('layouts.admin')
 
@section('title')
  <title>Product create</title>
@endsection

@section('css')
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
@section('content')
      <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper container-fluid">
    <!-- Content Header (Page header) -->
    <div class="content-wrapper container p-3">
      @include('components.content_header', ['content' => 'Product create'])
      <form method="POST" action="{{ route("admin.product.update", $product->id) }}" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
          <label for="name" class="form-label">Name</label>
          <input type="text" class="form-control" id="name" name="name" value="{{ $product->name }}">
        </div>
        <div class="mb-3">
          <label for="price" class="form-label">Price</label>
          <input type="text" class="form-control" id="price" name="price" value="{{ $product->price }}">
        </div>
        <div class="mb-3">
          <label for="description" class="form-label">Description</label>
          <textarea type="file" class="form-control edit_product" id="description" name="description">{{ $product->description }}</textarea>
        </div>
        <div class="mb-3">
          <label for="avatar" class="form-label">Image</label>
          <input type="file" class="form-control" id="avatar" name="avatar">
          <img src="{{ $product->feature_image }}" class="w-80" alt="">
        </div>
        <div class="mb-3">
          <label for="image_small" class="form-label">Image small</label>
          <input type="file" multiple class="form-control" id="image_small" name="image_small[]">
          <div class="col-md-12">
            <div class="row">
              @foreach($product->image as $productImageItem)
                <div class="col-md-3">
                  <img src="{{ $productImageItem->image_patch }}" alt=" " class="w-50">
                </div>
              @endforeach
            </div>
          </div>
        </div>
        <div class="mb-3">
          <label for="tag" class="form-label">Tag</label>
          <select class="form-control js-example-tokenizer" multiple="multiple" name="tags[]">
            @foreach($product->tag as $tagItem)
              <option value="{{ $tagItem->name }}" selected>{{ $tagItem->name }} </option>
            @endforeach
          </select>
        </div>
        <div class="mb-3">
          <label for="parent_id" class="form-label">Choose product</label>
          <select class="custom-select" id="parent_id" name="category_id">
            <option value="0">Danh mục cha</option>
            {!! $category !!}
          </select>
        </div>
        <div class="text-center">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </form>
      <!-- /.content-header -->
    </div>
  </div>
  <!-- /.content-wrapper -->
@endsection
@section('js')
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
  <script src="/select2/index.js"></script>
@endsection