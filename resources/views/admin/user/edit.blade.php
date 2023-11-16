@extends('layouts.admin')
 
@section('title')
  <title>User edit</title>
@endsection

@section('css')
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
@section('content')
      <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper container-fluid">
    <!-- Content Header (Page header) -->
    <div class="content-wrapper container p-3">
      @include('components.content_header', ['content' => 'User edit'])
      <form method="POST" action="{{ route("admin.user.update", $user->id) }}" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
          <label for="name" class="form-label">Name</label>
          <input type="text" class="form-control" value="{{ $user->name }}" id="name" name="name">
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}">
        </div>
        <div class="mb-3">
          <label for="roles" class="form-label">Role</label>
          <select class="form-control js-example-tokenizer" multiple="multiple" name="roles[]">
            <option value="">Choose roles</option>
            @foreach ($roles as $item)
              <option {{ $rolesOfUser->contains('id', $item->id) ? 'selected' : '' }}
                value="{{ $item->id }}">{{ $item->display_name }}</option>
            @endforeach
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
  <script src="/select2/index.js"></script>
@endsection