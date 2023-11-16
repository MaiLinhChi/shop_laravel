@extends('layouts.admin')
 
@section('title')
  <title>Role create</title>
@endsection

@section('css')
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('js')
  <script>
    $('.permission_top').on('click', function() {
      $(this).parents('.card').find('.permission_bottom').prop('checked', $(this).prop('checked'));
    })
    $('.check_all').on('click', function() {
      $(this).parents().find('.permission_bottom').prop('checked', $(this).prop('checked'));
      $(this).parents().find('.permission_top').prop('checked', $(this).prop('checked'));
    })
  </script>
@endsection
@section('content')
      <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper container-fluid">
    <!-- Content Header (Page header) -->
    <div class="content-wrapper container p-3">
      @include('components.content_header', ['content' => 'Role create'])
      <form method="POST" action="{{ route("admin.role.store") }}" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
          <label for="name" class="form-label">Role</label>
          <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" id="name" name="name">
          @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
          @enderror
        </div>
        <div class="mb-3">
          <label for="display_name" class="form-label">Display name</label>
          <input type="text" class="form-control @error('display_name') is-invalid @enderror" value="{{ old('display_name') }}" id="display_name" name="display_name">
        </div>
        <div class="mb-3">
          <label for="display_name" class="form-label">Check all</label>
          <input type="checkbox" class="form-control check_all">
        </div>
        @foreach ($permissionParent as $permissionItem)
          <div class="card text-black col-12">
            <div class="card-header bg-primary">
              {{ $permissionItem->name }}
              <input type="checkbox" class="permission_top">
            </div>
            <div class="row">
                @foreach ($permissionItem->permissionChildren as $item)
                  <div class="card-body col-md-3">
                    <div class="d-flex align-center">
                      <h5 class="mb-0">{{ $item->name }}</h5>
                      <input type="checkbox" class="form-control permission_bottom" value="{{ $item->id }}" name="permission_id[]">
                    </div>
                  </div>
                @endforeach
            </div>
          </div>
        @endforeach
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