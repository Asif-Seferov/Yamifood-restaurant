@extends('admin.layouts.main')
@section('yield', 'AdminLTE 3 | Add-roles')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Roles</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href=" {{ route('admin.user') }} ">User</a></li>
              <li class="breadcrumb-item active">Roles</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Create role form start -->
       <div class="container-fluid">
           <div class="row">
                <div class="col-12 col-sm-3">
                    <form action=" {{ route('admin.role-store') }} " method="post">
                      @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name">
                        @error('name')
                          {{$message}}
                        @enderror
                    </div>
                    
                    @foreach($permissions as $permission)
                      <div class="div d-flex align-items-center justify-content-between">
                      <label for="{{$permission->name}}" class="mr-5">{{$permission->name}}</label>
                        <label class="switch">
                          <input type="checkbox" name="permissions[]" value="{{$permission->id}}" class="text-right" id="{{$permission->name}}">
                          <span class="slider round"></span>
                        </label>
                      </div>
                    @endforeach

                    <button type="submit" class="btn btn-success">Create</button>
                    </form>
                </div>
                <div class="col-12 col-sm-9 pl-md-5">
                  @if(count($roles) > 0)
                <table class="table table-hover table-bordered mt-3">
                    <thead>
                        <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Slug</th>
                        <th scope="col">Permissions</th>
                        <th scope="col">Created</th>
                       
                        <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach($roles as $role)
                        <tr id="item-{{$role->id}}">
                        <td> {{ $role->name }} </td>
                        <td> {{ $role->slug }} </td>
                        <td>
                          @if($role->permissions != null && count($role->permissions) <= 4)
                            @foreach($role->permissions as $permission)
                              <span class="badge badge-secondary">{{$permission->name}}</span>
                            @endforeach
                          @endif
                          @if(count($role->permissions) >= 5)
                              <span class="badge badge-success">+5 permissions</span>
                          @endif
                          @if(count($role->permissions) == 0)
                              <span class="badge badge-danger">null</span>
                          @endif
                        </td>
                        <td><span class="badge badge-info">{{ $role->getDate($role->created_at) }}</span></td>
                        <td>
                          <a href=" {{ route('admin.role-edit', ['slug' => $role->slug, 'id' => $role->id]) }} " class="btn btn-outline-primary btn-sm"><i class="fas fa-edit"></i></a> &nbsp;
                          <a href="javascript:void(0)" data-item="#item-{{$role->id}}" data-id="{{$role->id}}" class="btn btn-outline-danger btn-sm delete-role"><i class="fas fa-trash-alt"></i></a>
                        </td>
                        </tr>
                      @endforeach
                    </tbody>
                    </table>
                    {{ $roles->links() }}
                    @else
                    <h5 class="border border-dark mt-3 mt-sm-4 p-2">No results found</h5>
                    @endif
                </div>
            </div>
       </div>
    <!-- Create role form end -->
@endsection
@section('js')
    <script>
        $(function(){
            $('.delete-role').click(function(e){
                e.preventDefault();
                var id = $(this).data('id');
                var item = $(this).attr('data-item');
                var url = '{{route('admin.role-destroy')}}';
                Swal.fire({
                  title: 'Əminsiniz?',
                  text: "Bunu geri qaytara bilməyəcəksiniz!",
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                  if (result.isConfirmed) {
                   $.post(url,
                        {id: id},
                        function(response){
                            $(item).remove();
                            Swal.fire(
                              'Silindi!',
                              'İstifadəçi rolu uğurla silindi.',
                              'success'
                            )
                        }); 
                      }
                  });
            });
        });
    </script>
@endsection