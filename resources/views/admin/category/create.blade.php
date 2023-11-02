@extends('layouts.admin')
 
@section('title')
  <title>Categories create</title>
@endsection

@section('content')
      <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper container-fluid">
    <!-- Content Header (Page header) -->
    <div class="content-wrapper container p-3">
      @include('components.content_header', ['content' => 'Categories create'])
      <form method="POST" action="{{ route("admin.category.store") }}">
        @csrf
        <div class="mb-3">
          <label for="name" class="form-label">Name</label>
          <input type="text" class="form-control" id="name" name="name" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
          <label for="parent_id" class="form-label">Choose parent</label>
          <select class="custom-select" id="parent_id" name="parent_id">
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