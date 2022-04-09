@extends('admin.layouts.main')
@section('title', 'AdminLTE | Menu')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Menus</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href=" {{ route('admin.home') }} ">Home</a></li>
              <li class="breadcrumb-item active">Menus</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Menu form and table start -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-3">
              @canany(['isAdmin','isUser','isAuthor'])
                <form action="{{route('admin.menu-store')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="menu">Name</label>
                        <input type="text" class="form-control @error('menu') is-invalid @enderror" id="menu" name="menu">
                        @error('name')
                            {{$message}}
                        @enderror
                    </div>
                    <div class="d-flex justify-content-between mb-3">
                      <div class="custom-control custom-switch">
                        <input type="radio" class="custom-control-input" id="activeMenu" name="status" value="active">
                        <label class="custom-control-label" for="activeMenu">Active</label>
                      </div>
                      <div class="custom-control custom-switch">
                        <input type="radio" class="custom-control-input" id="passiveMenu" name="status" value="passive">
                        <label class="custom-control-label" for="passiveMenu">Passive</label>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-success mb-3">Create</button>
                </form>
                @endcanany
            </div>
            <div class="col-sm-9 pl-sm-3">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                    <th scope="col">Number</th>
                    <th scope="col">Name</th>
                    <th scope="col">Status</th>
                    @cannot('isAuthor')
                    <th scope="col">Actions</th>
                    @endcannot
                    </tr>
                </thead>
                <tbody class="sortable">
                    @foreach($menus as $key => $menu)
                    <tr id="item-{{$menu->id}}">
                    <th scope="row">{{$key + 1}}</th>
                    <td>{{$menu->name}}</td>
                    <td>
                      @if($menu->status === "active")
                        <span class="badge badge-success">{{$menu->status}}</span>
                      @else
                        <span class="badge badge-danger">{{$menu->status}}</span>
                      @endif
                      
                    </td>
                    @cannot('isAuthor')
                    <td>
                      <a href="{{route('admin.edit-menu', $menu->id)}}" class="btn btn-outline-primary btn-sm"><i class="fas fa-edit"></i></a> &nbsp;
                      @cannot('isEditor')
                      <a href="javascript:void(0)" class="btn btn-outline-danger btn-sm delete-menu" data-id="{{$menu->id}}" data-item="#item-{{$menu->id}}"><i class="fas fa-trash-alt"></i></a>
                      @endcannot
                    </td>
                    </tr>
                    @endcannot
                    @endforeach
                </tbody>
                </table>
                <div class="d-flex justify-content-end">{{$menus->links()}}</div>
            </div>
        </div>
    </div>
    <!-- Menu form and table end -->
@endsection
@section('js')
    <script>
        $( function() {
          $('.sortable').sortable({
            cursor: "move",
            opacity: 0.4,
            axis: "y",
            update: function(event, ui){
              var myData = $(this).sortable('serialize');
              $.ajax({
                type: "POST",
                url: '{{route('admin.menu-list')}}',
                data: myData,
                dataType: "text",
                 success: function(response){
                  Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'The ranking has been updated',
                    showConfirmButton: false,
                    timer: 1500
                  });
                } 
              });
            }
          });
          $('.delete-menu').click(function(e){
              e.preventDefault();
              var id = $(this).attr('data-id');
              var item = $(this).data('item');
              var url = '{{route('admin.destroy-menu')}}';

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
                    $.post(url,
                      {id: id},
                      function(response){
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