<aside class="main-sidebar sidebar-dark-primary elevation-3">
    <!-- Sidebar -->
    @php $route = Route::current()->getName(); @endphp
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
        @if(auth()->user()->photo)
            <img src="/storage/{{ auth()->user()->photo }}" style="width: 2.5rem !important;height:2.5rem" class="img-circle elevation-2" alt="User Photo">
          @else
            <img src="{{asset('backend/dist/img/user-placeholder.jpg')}}" class="img-circle elevation-2" alt="User Photo">
          @endif
        </div>
        <div class="info">
          <a href="{{ route('backend.profile') }}" class="d-block">{{ auth()->user()->name }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{ route('backend.dashboard') }}" class="nav-link {{ $route == 'backend.dashboard' ? 'active' : '' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>

          <li class="nav-item {{ ($route == 'backend.school_admin' || $route == 'backend.other_users') ? 'menu-is-openning menu-open' : '' }}">
            <a href="javascript:void(0)" class="nav-link {{ ($route == 'backend.school_admin' || $route == 'backend.other_users') ? 'active' : '' }}">
              <i class="nav-icon fas fa-users-cog"></i>
              <p>
                User Management
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('backend.school_admin') }}" class="nav-link {{ $route == 'backend.school_admin' ? 'active' : '' }}">
                  <i class="nav-icon fas fa-angle-right"></i>
                  <p>School Admin</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('backend.other_users') }}" class="nav-link">
                  <i class="nav-icon fas fa-angle-right"></i>
                  <p>Others</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-school"></i>
              <p>
                Schools
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="javascript:void(0)" class="nav-link">
              <i class="nav-icon fas fa-tools"></i>
              <p>
                Configuration
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-angle-right"></i>
                  <p>Class</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-angle-right"></i>
                  <p>Department</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-angle-right"></i>
                  <p>Section</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-angle-right"></i>
                  <p>Subject</p>
                </a>
              </li>
            </ul>
          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>