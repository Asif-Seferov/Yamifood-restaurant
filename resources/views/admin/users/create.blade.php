@extends('admin.layouts.main')
@section('title', 'AdminLTE 3 | Add-user')
@section('content')
     <!-- Content Header (Page header) -->
     <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Add user</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href=" {{ route('admin.user') }} ">Users</a></li>
              <li class="breadcrumb-item active">Add user</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Create user form start -->
    <div class="col-6">
        <form action="{{ route('admin.store') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" value="{{ old('name') }}" autofocus class="form-control @error('name') is-invalid @enderror" id="name" aria-describedby="emailHelp">
                @error('name')
                    {{ $message }}
                @enderror
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" name="email" value="{{ old('email') }}"  class="form-control @error('email') is-invalid @enderror" id="email" aria-describedby="emailHelp">
                @error('email')
                    {{ $message }}
                @enderror
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" aria-describedby="emailHelp">
                @error('password')
                    {{ $message }}
                @enderror
            </div>
            <button type="submit" class="btn btn-success btn-send" id="send">Send</button>
        </form>
    </div>
    <!-- Create user form end -->
    
@endsection

       