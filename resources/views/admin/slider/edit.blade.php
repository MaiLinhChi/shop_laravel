@extends('layouts.admin')
 
@section('title')
  <title>Slider create</title>
@endsection

@section('css')
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
@section('js')
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="/admins/sweatalert.js"></script>
@endsection
@section('content')
      <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper container-fluid">
    <!-- Content Header (Page header) -->
    <div class="content-wrapper container p-3">
      @include('components.content_header', ['content' => 'Slider create'])
      <form method="POST" action="{{ route("admin.slider.update", $slider->id) }}" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
          <label for="name" class="form-label">Name</label>
          <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{ $slider->name }}" id="name" name="name">
          @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
          @enderror
        </div>
        <div class="mb-3">
          <label for="description" class="form-label">Description</label>
          <textarea 
            type="file"
            class="form-control @error('description') is-invalid @enderror"
            id="description"
            name="description"
          >
            {{ $slider->description }}
          </textarea>
          @error('description')
            <div class="alert alert-danger">{{ $message }}</div>
          @enderror
        </div>
        <div class="mb-3">
          <label for="image_patch" class="form-label">Image</label>
          <input type="file" class="form-controlr" id="image_patch" name="image_patch">
          <img src="{{ $slider->image_patch }}" alt="" class="w-70">
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