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
                <form action="{{route('admin.menu-store')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="menu">Name</label>
                        <input type="text" class="form-control @error('menu') is-invalid @enderror" id="menu" name="menu">
                        @error('name')
                            {{$message}}
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-success mb-3">Create</button>
                </form>
            </div>
            <div class="col-sm-9 pl-sm-3">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">First</th>
                    <th scope="col">Last</th>
                    <th scope="col">Handle</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <th scope="row">1</th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                    </tr>
                    <tr>
                    <th scope="row">2</th>
                    <td>Jacob</td>
                    <td>Thornton</td>
                    <td>@fat</td>
                    </tr>
                    <tr>
                    <th scope="row">3</th>
                    <td>Larry</td>
                    <td>the Bird</td>
                    <td>@twitter</td>
                    </tr>
                </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Menu form and table end -->
@endsection