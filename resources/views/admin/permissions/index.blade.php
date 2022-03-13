@extends('admin.layouts.main')
@section('yield', 'AdminLTE 3 | Permissions')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Permissions</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href=" {{ route('admin.role') }} ">Roles</a></li>
              <li class="breadcrumb-item active">Permissions</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Permission field start -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-3">
                <form action="{{ route('admin.permission-store') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Name">
                        @error('name')
                            {{$message}}
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-success">Create</button>
                </form>
            </div>
            <div class="col-sm-9 pl-sm-5  mt-3">
            @if(count($permissions) > 0)
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Slug</th>
                    <th scope="col">Created</th>
                    <th scope="col">Updated</th>
                    <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($permissions as $permission)
                    <tr id="item-{{$permission->id}}">
                    <td>{{ $permission->name }}</td>
                    <td>{{$permission->slug}}</td>
                    <td><span class="badge badge-info">{{$permission->getDate($permission->created_at)}}</span></td>
                    <td><span class="badge badge-warning">{{$permission->getDate($permission->updated_at)}}</span></td>
                    <td>
                        <a href="{{ route('admin.permission-edit', ['slug' => $permission->slug, 'id' => $permission->id]) }}" class="btn btn-outline-primary btn-sm"><i class="fas fa-edit"></i></a> &nbsp;
                        <a href="javascript:void(0)" data-id="{{$permission->id}}" data-item="#item-{{$permission->id}}" class="btn btn-outline-danger btn-sm delete-permission"><i class="fas fa-trash-alt"></i></a>
                    </td>
                    </tr>
                    @endforeach
                </tbody>
                </table>
                {{$permissions->links()}}
                @else
                <h5 class="border border-dark p-3">No results found</h5>
                @endif
            </div>
        </div>
    </div>
    <!-- Permission field end -->
@endsection
@section('js')
    <script>
        $(function(){
            $('.delete-permission').click(function(){
                var id = $(this).attr('data-id');
                var item = $(this).data('item');
                var url = '{{route("admin.permission-destroy")}}';
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
                        $.post(url, {id: id}, function(){
                            $(item).remove();
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