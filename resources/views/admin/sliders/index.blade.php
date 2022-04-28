@extends('admin.layouts.main')
@section('title', 'AdminLTE | Slider')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Sliders</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
              <li class="breadcrumb-item active">Sliders</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Slider list start -->
    <div class="col-12">
        @can('create', App\Models\Slider::class)
        <div class="mb-3 text-right"><a href="{{route('admin.create-slider')}}" class="btn btn-danger"><i class="fas fa-plus"></i> Add Slider</a></div>
        @endcan
        @if(count($sliders) > 0)
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                <th scope="col">Image</th>
                <th scope="col">Title</th>
                <th scope="col">Status</th>
                <th scope="col">Created</th>
                <th scope="col">Updated</th>
                <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sliders as $slider)
                <tr id="item-{{$slider->id}}">
                <td><img src="{{$slider->getImage($slider->slider_img)}}" class="img-thumbnail" style="width: 100px; height: 100px; object-fit: cover;" alt="slider-image"></td>
                <td>{{$slider->slider_title}}</td>
                <td>
                  @if($slider->slider_status === 'active')
                    <span class="badge badge-success">{{$slider->slider_status}}</span>
                  @else
                    <span class="badge badge-danger">{{$slider->slider_status}}</span>
                  @endif
                </td>
                <td><span class="badge badge-info">{{$slider->getDate($slider->created_at)}}</span></td>
                <td><span class="badge badge-danger">{{$slider->getDate($slider->updated_at)}}</span></td>
                <td>
                  <a href="{{route('admin.edit-slider', $slider->id)}}" class="btn btn-outline-primary btn-sm"><i class="fas fa-edit"></i></a> &nbsp;
                  <a href="javascript:void(0)" data-id="{{$slider->id}}" data-item="#item-{{$slider->id}}" class="btn btn-outline-danger btn-sm delete-slider"><i class="fas fa-trash-alt"></i></a>
                </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
          <h5 class="border border-dark mt-3 mt-sm-4 p-2">No results found</h5>
        @endif
        <div class="d-flex justify-content-end">{{$sliders->links()}}</div>
        
    </div>
    <!-- Slider list end -->
@endsection
@section('js')
    <script>
        $(function(){
            $('.delete-slider').click(function(e){
                e.preventDefault();
                var sliderId = $(this).attr('data-id');
                var sliderItem = $(this).data('item');
                var url = '{{route('admin.destroy-slider')}}';
                
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                  }).then((result) => {
                    if (result.isConfirmed) {
                      $.post(url,{id: sliderId}, function(response){
                        $(sliderItem).remove();
                        Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                      )
                      });
                    }
                });
            });
        });
    </script>
@endsection