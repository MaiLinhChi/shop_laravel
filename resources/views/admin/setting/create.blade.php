@extends('layouts.admin')
 
@section('title')
  <title>Setting create</title>
@endsection

@section('css')
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
@section('content')
      <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper container-fluid">
    <!-- Content Header (Page header) -->
    <div class="content-wrapper container p-3">
      @include('components.content_header', ['content' => 'Setting create'])
      <form method="POST" action="{{ route("admin.setting.store") . '?type=' . request()->type }}" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
          <label for="setting_key" class="form-label">Config key</label>
          <input type="text" class="form-control @error('setting_key') is-invalid @enderror" value="{{ old('setting_key') }}" id="setting_key" name="setting_key">
          @error('setting_key')
            <div class="alert alert-danger">{{ $message }}</div>
          @enderror
        </div>
          @if (request()->type === 'text')
            <div class="mb-3">
              <label for="setting_value" class="form-label">Config value</label>
              <input type="text" class="form-control @error('setting_value') is-invalid @enderror" value="{{ old('setting_value') }}" id="setting_value" name="setting_value">
              @error('setting_value')
                <div class="alert alert-danger">{{ $message }}</div>
              @enderror
            </div>
          @else
            <div class="mb-3">
              <label for="setting_value" class="form-label">Config value</label>
              <textarea 
                type="file"
                class="form-control @error('setting_value') is-invalid @enderror"
                id="setting_value"
                name="setting_value"
              >
                {{ old('setting_value') }}
              </textarea>
            </div>
          @endif
          @error('setting_value')
            <div class="alert alert-danger">{{ $message }}</div>
          @enderror
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