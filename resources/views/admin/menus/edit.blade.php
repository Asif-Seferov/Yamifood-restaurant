@extends('admin.layouts.main')
@section('title', 'AdminLTE | Menu')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Update menu</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href=" {{ route('admin.menu') }} ">Menus</a></li>
              <li class="breadcrumb-item active">Update menu</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Update menu form start -->
    <div class="col-sm-6">
        <form action="{{route('admin.update-menu', $menu->id)}}" method="post">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="menu" value="{{$menu->name}}">
            </div>
            <div class="d-flex justify-content-between mb-3">
                <div class="custom-control custom-switch">
                    <input type="radio" class="custom-control-input" id="activeMenu" {{($menu->status === "active" ? 'checked' : null)}} name="status" value="active">
                    <label class="custom-control-label" for="activeMenu">Active</label>
                </div>
                <div class="custom-control custom-switch">
                    <input type="radio" class="custom-control-input" id="passiveMenu" {{($menu->status === "passive" ? "checked" : null)}} name="status" value="passive">
                    <label class="custom-control-label" for="passiveMenu">Passive</label>
                </div>
            </div>
            <button type="submit" class="btn btn-success">Update</button>
        </form>
    </div>
    <!-- Update menu form end -->
@endsection