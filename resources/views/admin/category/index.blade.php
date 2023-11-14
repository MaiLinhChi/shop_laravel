@extends('layouts.admin')
 
@section('title')
  <title>Category list</title>
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
          @include('components.content_header', ['content' => 'Category list', 'align' => 'left'])
        </div>
        <div class="col-6 text-right">
          <a class="btn btn-outline-success btn-lg" href="{{ route('admin.category.create') }}">Create categories</a>
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
                      <th scope="col">Parent id</th>
                      <th scope="col">Slug</th>
                      <th scope="col" colspan="2" class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($category as $key=>$categories)
                      <tr>
                        <th scope="row">{{ $categories['id'] }}</th>
                        <td>{{ $categories['name'] }}</td>
                        <td>{{ $categories['parent_id'] }}</td>
                        <td>{{ $categories['slug'] }}</td>
                        <td class="text-center">
                          <a class="btn btn-warning" href="{{ route('admin.category.edit', ['id' => $categories->id]) }}">
                            Edit
                          </a>
                        </td>
                        <td class="text-center">
                          <a
                            class="btn btn-danger action_delete"
                            data-url="{{ route('admin.category.delete', ['id' => $categories->id]) }}"
                            href="{{ route('admin.category.delete', ['id' => $categories->id]) }}">
                            Delete
                          </a>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <div class="pagination d-flex justify-content-center">
                {{ $category->links() }}
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