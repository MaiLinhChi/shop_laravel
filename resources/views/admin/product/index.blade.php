@extends('layouts.admin')
 
@section('title')
  <title>Product list</title>
@endsection

@section('js')
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="/admins/product/index.js"></script>
@endsection

@section('content')
      <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper container-fluid">
    <!-- Content Header (Page header) -->
    <div class="content-wrapper container p-3">
      <div class="row">
        <div class="col-6">
          @include('components.content_header', ['content' => 'Product list', 'align' => 'left'])
        </div>
        <div class="col-6 text-right">
          <a class="btn btn-outline-success btn-lg" href="{{ route('admin.product.create') }}">Create product</a>
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
                      <th scope="col">Price</th>
                      <th scope="col">Description</th>
                      <th scope="col">Image</th>
                      <th scope="col">Category id</th>
                      <th scope="col">User id create</th>
                      <th scope="col">Tag</th>
                      <th scope="col" colspan="2" class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($product as $key=>$productItem)
                      <tr>
                        <th scope="row">{{ $productItem['id'] }}</th>
                        <td>{{ $productItem['name'] }}</td>
                        <td>{{ number_format($productItem['price']) }}</td>
                        <td>{!! $productItem['description'] !!}</td>
                        <td><img src="{{ $productItem['feature_image'] }}" width="50" alt=""></td>
                        <td>{{ optional($productItem->category)->name }}</td>
                        <td>{{ $productItem['user_id'] }}</td>
                        <td>{{ $productItem['tag'] }}</td>
                        <td class="text-center">
                          <a class="btn btn-warning" href="{{ route('admin.product.edit', ['id' => $productItem->id]) }}">
                            Edit
                          </a>
                        </td>
                        <td class="text-center">
                          <a
                            class="btn btn-danger action_delete"
                            data-url="{{ route('admin.product.delete', ['id' => $productItem->id]) }}"
                            href="{{ route('admin.product.delete', ['id' => $productItem->id]) }}">
                            Delete
                          </a>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <div class="pagination d-flex justify-content-center">
                {{ $product->links() }}
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