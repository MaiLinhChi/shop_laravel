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
      <form method="POST" action="{{ route("admin.product.store") }}" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
          <label for="name" class="form-label">Name</label>
          <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" id="name" name="name">
          @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
          @enderror
        </div>
        <div class="mb-3">
          <label for="price" class="form-label">Price</label>
          <input type="text" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price') }}">
          @error('price')
            <div class="alert alert-danger">{{ $message }}</div>
          @enderror
        </div>
        <div class="mb-3">
          <label for="description" class="form-label">Description</label>
          <textarea type="file" class="form-control edit_product @error('price') is-invalid @enderror" id="description" name="description">{{ old('description') }}</textarea>
          @error('description')
            <div class="alert alert-danger">{{ $message }}</div>
          @enderror
        </div>
        <div class="mb-3">
          <label for="avatar" class="form-label">Image</label>
          <input type="file" class="form-control" id="avatar" name="avatar">
        </div>
        <div class="mb-3">
          <label for="image_small" class="form-label">Image small</label>
          <input type="file" multiple class="form-control" id="image_small" name="image_small[]">
        </div>
        <div class="mb-3">
          <label for="tag" class="form-label">Tag</label>
          <select class="form-control js-example-tokenizer" multiple="multiple" name="tags[]">
          </select>
        </div>
        <div class="mb-3">
          <label for="parent_id" class="form-label">Choose product</label>
          <select class="custom-select @error('category_id') is-invalid @enderror" id="parent_id" name="category_id">
            <option value="0">Danh mục cha</option>
            {!! $category !!}
          </select>
          @error('category_id')
            <div class="alert alert-danger">{{ $message }}</div>
          @enderror
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
  <script src="/select2/index.js"></script>
  <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
@endsection