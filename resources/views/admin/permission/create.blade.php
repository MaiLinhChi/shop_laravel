@extends('layouts.admin')
 
@section('title')
  <title>Role create</title>
@endsection

@section('css')
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
@section('content')
      <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper container-fluid">
    <!-- Content Header (Page header) -->
    <div class="content-wrapper container p-3">
      @include('components.content_header', ['content' => 'Role create'])
      <form method="POST" action="{{ route("admin.permission.store") }}" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
          <select class="custom-select" id="parent_id" name="name">
            <option>Chose parent permission</option>
            @foreach (config('permission.module') as $item)
              <option value="{{ $item }}">{{ $item }}</option>
            @endforeach
          </select>
        </div>
        <div class="row mb-5">
          @foreach (config('permission.feature_module') as $item)
            <div class="col-3 d-flex align-items-center">
              <label for="display_name" class="form-label">{{ $item }}</label>
              <input type="checkbox" class="form-control" id="display_name" name="feature_name[]" value="{{ $item }}">
            </div>
            @endforeach
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
@endsection