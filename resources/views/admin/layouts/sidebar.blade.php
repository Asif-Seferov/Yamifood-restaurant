 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href=" {{ route('admin.home') }} " class="brand-link">
      <img src=" {{ asset('admin/assets/img/AdminLTELogo.png') }} " alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src=" {{ asset('admin/assets/img/user2-160x160.jpg') }} " class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">
            @auth
              {{Auth::user()->name}} ({{ Auth::user()->roles->isNotEmpty() ? Auth::user()->roles->first()->name : ""}})
            @endauth
          </a>
        </div>
      </div>

      

      <!-- Sidebar Menu -->
      <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          @can('isAdmin')
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fas fa-users f-2x mr-1"></i>
              <p class="user-paragraf">
                Users settings
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href=" {{ route('admin.user') }} " class="nav-link">
                  <i class="nav-icon fas fa-user"></i>
                  <p>
                    Users
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.role') }}" class="nav-link">
                  <i class="fas fa-user-tag"></i>
                  <p>Roles</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.permission') }}" class="nav-link">
                <i class="fab fa-accessible-icon ml-2"></i>
                  <p class="ml-2">Permissions</p>
                </a>
              </li>
            </ul>
          </li>
          @endcan
          <li class="nav-item">
            <a href="{{route('admin.menu')}}" class="nav-link">
            <i class="fas fa-bars ml-2"></i>
              <p class="ml-2">
                Menus
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('admin.logout')}}" class="nav-link">
            <i class="fas fa-sign-out ml-2"></i>
              <p class="ml-2">
                Log out
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>