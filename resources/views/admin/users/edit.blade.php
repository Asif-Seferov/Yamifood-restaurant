@extends('admin.layouts.main')
@section('title', 'AdminLTE 3 | Users')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Edit user</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href=" {{ route('admin.user') }} ">Users</a></li>
              <li class="breadcrumb-item active">Edit user</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Create user form start -->
    <div class="col-12 col-md-6">
        <form action="{{ route('admin.update', ['id' => $user->id]) }}" method="post">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" value="{{ $user->name }}" autofocus class="form-control @error('name') is-invalid @enderror" id="name" aria-describedby="emailHelp">
                @error('name')
                    {{ $message }}
                @enderror
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" name="email" value="{{ $user->email }}"  class="form-control @error('email') is-invalid @enderror" id="email" aria-describedby="emailHelp">
                @error('email')
                    {{ $message }}
                @enderror
            </div>
            <div class="form-froup mb-3">
                <label for="role">Select role</label>
                <select name="role" id="role" class="custom-select">
                  <option value="">User roles</option>
                  @foreach($roles as $role)
                    <option data-role-id="{{$role->id}}" data-role-slug="{{$role->slug}}" value="{{$role->id}}" {{$user->roles->isEmpty() || $role->name != $userRole->name ? "" : "selected"}}>{{$role->name}}</option>
                  @endforeach
                </select>
            </div>
            <div id="permissions_box">
              <label for="roles">Select Permissions</label>
              <div id="permissions_checkbox_list"></div>
            </div>
            @if($user->permissions->isNotEmpty())
              @if($rolePermissions != null)
                <div id="user_permissions_box">
                  <label for="roles">User Permissions</label>
                  <div id="user_permissions_checkbox_list">
                    @foreach($rolePermissions as $permission)
                        <div class="custom-control custom-checkbox">
                          <input type="checkbox" class="custom-control-input" name="permissions[]" id="{{$permission->slug}}" value="{{$permission->id}}" {{in_array($permission->id, $userPermissions->pluck('id')->toArray()) ? 'checked="checked"' : ""}}>
                          <label class="custom-control-label" for="{{$permission->slug}}">{{$permission->name}}</label>
                        </div>
                    @endforeach
                  </div>
                </div>
              @endif
            @endif
            <button type="submit" class="btn btn-success btn-send" id="send">Send</button>
        </form>
    </div>
    <!-- Create user form end -->

    @section('js_user_page')
      <script>
          $(document).ready(function(){
              var permissions_box = $('#permissions_box');
              var permissions_checkbox_list = $('#permissions_checkbox_list');
              var user_permissions_box = $('#user_permissions_box');
              var user_permissions_checkbox_list = $('#user_permissions_checkbox_list');
              
              permissions_box.hide();

              $('#role').on('change', function(){
                  var role = $(this).find(':selected');
                  var role_id = role.data('role-id');
                  var role_slug = role.data('role-slug');

                  permissions_checkbox_list.empty();
                  user_permissions_box.empty();
                  
                  $.ajax({
                    url: "{{route('admin.add-user')}}",
                    method: "get",
                    dataType: "json",
                    data: {
                        role_id: role_id,
                        role_slug: role_slug,
                    }
                  }).done(function(data){
                      console.log(data);

                      permissions_box.show();

                      $.each(data, function(index, element){
                          $(permissions_checkbox_list).append(
                              '<div class="custom-control custom-checkbox">'+
                              '<input class="custom-control-input" type="checkbox" name="permissions[]" id="'+element.slug+'" value="'+element.id+'">'+
                              '<label class="custom-control-label" for="'+element.slug+'">'+element.name+'</label>'+
                              '</div>'
                          );
                      });
                  });
              });
          });
      </script>
    @endsection
@endsection