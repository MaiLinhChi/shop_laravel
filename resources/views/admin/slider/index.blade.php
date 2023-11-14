@extends('layouts.admin')
 
@section('title')
  <title>Slider list</title>
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
          @include('components.content_header', ['content' => 'Slider list', 'align' => 'left'])
        </div>
        <div class="col-6 text-right">
          <a class="btn btn-outline-success btn-lg" href="{{ route('admin.slider.create') }}">Create slider</a>
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
                      <th scope="col">Description</th>
                      <th scope="col">Image</th>
                      <th scope="col" colspan="2" class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($slider as $key=>$sliderItem)
                      <tr>
                        <th scope="row">{{ $sliderItem['id'] }}</th>
                        <td>{{ $sliderItem['name'] }}</td>
                        <td>{!! $sliderItem['description'] !!}</td>
                        <td><img src="{{ $sliderItem['image_patch'] }}" width="50" alt=""></td>
                        <td class="text-center">
                          <a class="btn btn-warning" href="{{ route('admin.slider.edit', ['id' => $sliderItem->id]) }}">
                            Edit
                          </a>
                        </td>
                        <td class="text-center">
                          <a
                            class="btn btn-danger action_delete"
                            data-url="{{ route('admin.slider.delete', ['id' => $sliderItem->id]) }}"
                            href="{{ route('admin.slider.delete', ['id' => $sliderItem->id]) }}">
                            Delete
                          </a>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <div class="pagination d-flex justify-content-center">
                {{ $slider->links() }}
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