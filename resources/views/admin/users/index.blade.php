@extends('admin.layouts.main')
@section('title', 'AdminLTE 3 | Users')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Users</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href=" {{ route('admin.home') }} ">Home</a></li>
              <li class="breadcrumb-item active">Users</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Table Users list start -->
            <div class="col-md-12">
                <div class="text-right mb-3">
                    <a href=" {{ route('admin.add-user') }} "><button type="button" class="btn btn-danger"><i class="fas fa-plus"></i>  Add user</button></a>
                </div>
                @if(count($users)  > 0)
                <table class="table table-bordered table-hover table-user">
                    <thead>
                        <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Role</th>
                        <th scope="col">Permissions</th>
                        <th scope="col">Created</th>
                        <th scope="col">Updated</th>
                        <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach($users as $user)
                        <tr id="item-{{$user->id}}">
                        <td> {{ $user->name }} </td>
                        <td>
                          @if($user->roles->isEmpty())
                            <span class="badge badge-danger">null</span>
                          @endif
                          @if($user->roles->isNotEmpty())
                            @foreach($user->roles as $role)
                              <span class="badge badge-secondary">{{$role->name}}</span>
                            @endforeach
                          @endif
                        </td>
                        <td>
                          @if($user->permissions->isEmpty())
                            <div class="badge badge-danger">null</div>
                          @endif
                          @if(count($user->permissions) >= 5)
                                <span class="badge badge-success">+5 permissions</span>
                          @endif
                          @if($user->permissions->isNotEmpty() && count($user->permissions) <= 4)
                            @foreach($user->permissions as $permission)
                              <span class="badge badge-secondary">{{$permission->name}}</span>
                            @endforeach
                          @endif
                        </td>
                        <td> <span class="badge badge-info">{{$user->getDate($user->created_at) }}</span></td>
                        <td> <span class="badge badge-danger">{{$user->getDate($user->updated_at) }}</span></td>
                        <td>
                          <a href="{{ route('admin.edit', ['id' => $user->id]) }}" class="btn btn-outline-primary btn-sm"><i class="fas fa-edit"></i></a> &nbsp;
                          <a href="javascript:void(0)" data-id="{{ $user->id }}" data-item="#item-{{$user->id}}" class="btn btn-outline-danger btn-sm delete-user"><i class="fas fa-trash-alt"></i></a>
                        </td>
                        </tr>
                      @endforeach
                    </tbody>
                    
                </table>
                @else
                  <h1>Hec bir netice tapilmadi</h1>
                @endif
                
                <div class="">
                {{ $users->links() }}
                </div>
                
            </div>
    <!-- Table Users list end -->
@endsection
@section('js')
    <script>
        $(function(){
          $('.delete-user').click(function(e){
            e.preventDefault();
            var id = $(this).data('id');
            var item = $(this).data('item');
            var url = '{{route('admin.user-destroy')}}';

            Swal.fire({
                title: 'Sən əminsən?',
                text: "Bunu geri qaytara bilməyəcəksiniz!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
              }).then((result) => {
                if (result.isConfirmed) {
                  $.post(url, {data: id}, function(response){
                    $(item).remove();
                    Swal.fire(
                      'Silindi!',
                      'Faylınız silindi.',
                      'success'
                    )
                  });
                }
              });
          });
        });
    </script>
@endsection