@extends('layouts.admin')
 
@section('title')
  <title>Role list</title>
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
          @include('components.content_header', ['content' => 'Role list', 'align' => 'left'])
        </div>
        <div class="col-6 text-right">
          <a class="btn btn-outline-success btn-lg" href="{{ route('admin.role.create') }}">Create role</a>
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
                      <th scope="col">Name</th>
                      <th scope="col">Display name</th>
                      <th scope="col" colspan="2" class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($role as $key=>$roleItem)
                      <tr>
                        <th scope="row">{{ $roleItem['id'] }}</th>
                        <td>{{ $roleItem['name'] }}</td>
                        <td>{!! $roleItem['display_name'] !!}</td>
                        <td class="text-center">
                          <a class="btn btn-warning" href="{{ route('admin.role.edit', ['id' => $roleItem->id]) }}">
                            Edit
                          </a>
                        </td>
                        <td class="text-center">
                          <a
                            class="btn btn-danger action_delete"
                            data-url="{{ route('admin.role.delete', ['id' => $roleItem->id]) }}"
                            href="{{ route('admin.role.delete', ['id' => $roleItem->id]) }}">
                            Delete
                          </a>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <div class="pagination d-flex justify-content-center">
                {{ $role->links() }}
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