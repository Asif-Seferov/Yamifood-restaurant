@extends('admin.layouts.main')
@section('yield', 'AdminLTE 3 | Permission edit')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Update Permission</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href=" {{ route('admin.permission') }} ">Permissions</a></li>
              <li class="breadcrumb-item active">Update permission</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <div class="col-12 col-sm-6">
        <form action="{{ route('admin.permission-update', ['id' => $permission->id]) }}" method="post">
        @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{$permission->name}}">
            </div>
            <button type="submit" class="btn btn-success">Update</button>
        </form>
    </div>        
@endsection