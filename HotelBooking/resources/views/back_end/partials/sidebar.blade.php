<div class="sidebar">

  <!-- Sidebar Menu -->
  <nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
      <li class="nav-item has-treeview">
      <a href="{{route('admin.dashboard')}}" class="nav-link {{ Request::segment(2) === 'dashboard' ? 'active' : null }}">
          <i class="nav-icon fas fa-tachometer-alt"></i>
          <p>
            Dashboard
          </p>
        </a>
      </li>
      <li class="nav-item">
      <a href="{{ route('admin.bookings.index') }}" class="nav-link {{ Request::segment(2) === 'bookings' ? 'active' : null }}">
          <i class="nav-icon fas fa-th"></i>
          <p>
            Bookings
            <span class="right badge badge-danger">New</span>
          </p>
        </a>
      </li>
      <li class="nav-item has-treeview {{ Request::segment(2) === 'hotel' || Request::segment(2) === 'room-types' || Request::segment(2) === 'rooms' ? 'menu-open' : null }}">
        <a href="#" class="nav-link">
          <i class="nav-icon fa fa-fw fa-cubes"></i>
          <p>
            Hotel Configuration
            <i class="right fas fa-angle-left"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{ route('admin.hotel.index') }}" class="nav-link {{ Request::segment(2) === 'hotel' ? 'active' : null }}">
              <i class="far fa-circle nav-icon"></i>
              <p>Hotel Info</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.room-types.index') }}" class="nav-link {{ Request::segment(2) === 'room-types' ? 'active' : null }}">
              <i class="far fa-circle nav-icon"></i>
              <p>Room Type</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.rooms.index') }}" class="nav-link {{ Request::segment(2) === 'rooms' ? 'active' : null }}">
              <i class="far fa-circle nav-icon"></i>
              <p>Room</p>
            </a>
          </li>
        </ul>
      </li>

      <li class="nav-item has-treeview {{ Request::segment(2) === 'gallery-categories' || Request::segment(2) === 'galleries' ? 'menu-open' : null }}">
        <a href="#" class="nav-link">
          <i class="nav-icon far fa-image"></i>
          <p>
            Gallery
            <i class="fas fa-angle-left right"></i>
          </p>
        </a>

        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{ route('admin.gallery-categories.index') }}" class="nav-link {{Request::segment(2) === 'gallery-categories' ? 'active' : null }}">
              <i class="far fa-circle nav-icon"></i>
              <p>Categories</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.galleries.index') }}" class="nav-link {{ Request::segment(2) === 'galleries' ? 'active' : null }}">
              <i class="far fa-circle nav-icon"></i>
              <p>Gallery</p>
            </a>
          </li>
        </ul>
      </li>
    </ul>
  </nav>
  <!-- /.sidebar-menu -->
</div>