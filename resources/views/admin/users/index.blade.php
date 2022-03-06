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
                
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Status</th>
                        <th scope="col">Role</th>
                        <th scope="col">Created</th>
                        <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach($users as $user)
                        <tr>
                        <td> {{ $user->name }} </td>
                        <td> Aktiv </td>
                        <td> Admin </td>
                        <td> <span class="badge badge-info">{{$user->getDate($user->created_at) }}</span></td>
                        <td>
                          <a href="" class="btn btn-outline-primary btn-sm"><i class="fas fa-edit"></i></a> &nbsp;
                          <a href="" class="btn btn-outline-danger btn-sm"><i class="far fa-trash-alt"></i></a>
                        </td>
                        </tr>
                      @endforeach
                    </tbody>
                </table>
            </div>
    <!-- Table Users list end -->
@endsection