@extends('layouts.admin')
 
@section('title')
  <title>Setting list</title>
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
      <div class="row">
        <div class="col-6">
          @include('components.content_header', ['content' => 'Setting list', 'align' => 'left'])
        </div>
        <div class="col-6 text-right">
          <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Add Setting
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              <a class="dropdown-item" href="{{ route('admin.setting.create') . '?type=text' }}">Text value</a>
              <a class="dropdown-item" href="{{ route('admin.setting.create') . '?type=textarea' }}">Textarea value</a>
            </div>
          </div>
        </div>
      </div>
      <!-- Main content -->
      <div class="content">
          <div class="row">
            <div class="col">
              <div class="card">
                <table class="table table-bordered table-dark mb-0">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Setting key</th>
                      <th scope="col">Setting value</th>
                      <th scope="col" colspan="2" class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($setting as $key=>$settingItem)
                      <tr>
                        <th scope="row">{{ $settingItem['id'] }}</th>
                        <td>{{ $settingItem['setting_key'] }}</td>
                        <td>{{ $settingItem['setting_value'] }}</td>
                        <td class="text-center">
                          <a class="btn btn-warning" href="{{ route('admin.setting.edit', ['id' => $settingItem->id]) . '?type=' . $settingItem->type }}">
                            Edit
                          </a>
                        </td>
                        <td class="text-center">
                          <a
                            class="btn btn-danger action_delete"
                            data-url="{{ route('admin.setting.delete', ['id' => $settingItem->id]) }}"
                            href="{{ route('admin.setting.delete', ['id' => $settingItem->id]) }}">
                            Delete
                          </a>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <div class="pagination d-flex justify-content-center">
                {{ $setting->links() }}
              </div>
            </div>
            <!-- /.col-md-6 -->
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content -->
    </div>
  </div>
  <!-- /.content-wrapper -->
@endsection