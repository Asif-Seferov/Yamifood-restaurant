@extends('admin.layouts.main')
@section('title', 'AdminLTE 3 | Edit role')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Update role</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href=" {{ route('admin.role') }} ">Roles</a></li>
              <li class="breadcrumb-item active">Update role</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Edit role form start -->
    <div class="col-md-6">
        <form action=" {{ route('admin.role-update', ['id' => $role->id]) }} " method="post">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" id="name" value="{{ $role->name }}">
            </div>
            @php
            @endphp
              @foreach($permissions as $permission)
                  <div class="div d-flex align-items-center justify-content-between">
                    <label for="{{$permission->name}}" class="mr-5">{{$permission->name}}</label>
                      <label class="switch">
                        <input type="checkbox" @foreach($role->permissions as $rolePermission) @if($rolePermission->id === $permission->id) checked @endif @endforeach name="permissions[]" value="{{$permission->id}}" class="text-right" id="{{$permission->name}}">
                        <span class="slider round"></span>
                      </label>
                  </div>
              @endforeach
               
            <button type="submit" class="btn btn-success">Update</button>
        </form>
    </div>
    <!-- Edit role form end -->
@endsection