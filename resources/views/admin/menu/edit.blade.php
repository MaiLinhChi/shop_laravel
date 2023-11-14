@extends('layouts.admin')
 
@section('title')
  <title>Menu edit</title>
@endsection

@section('content')
      <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper container-fluid">
    <!-- Content Header (Page header) -->
    <div class="content-wrapper container p-3">
      @include('components.content_header', ['content' => 'Menu edit'])
      <form method="POST" action="{{ route("admin.menu.update", $item->id) }}">
        @csrf
        <div class="mb-3">
          <label for="name" class="form-label">Name</label>
          <input type="text" class="form-control" id="name" name="name" aria-describedby="emailHelp" value="{{ $item->name }}">
        </div>
        <div class="mb-3">
          <label for="parent_id" class="form-label">Choose parent</label>
          <select class="custom-select" id="parent_id" name="parent_id">
            <option value="0">Danh mục cha</option>
            {!! $menu !!}
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