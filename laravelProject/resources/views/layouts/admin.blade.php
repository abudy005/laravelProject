<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <title>@yield('title', 'Admin Dashboard')</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/admin/images/favicon_io/favicon-32x32.png') }}">

  {{-- Tabler Icons --}}
  <link rel="stylesheet" href="{{ asset('assets/admin/css/tabler-icons.min.css') }}">

  {{-- Main Stylesheet (Bootstrap + Custom) --}}
  <link rel="stylesheet" href="{{ asset('assets/admin/css/style.css') }}">
</head>

<body>
  <div id="overlay" class="overlay"></div>

  {{-- TOPBAR --}}
  <nav id="topbar" class="navbar bg-white border-bottom fixed-top topbar px-3">
    <button id="toggleBtn" class="d-none d-lg-inline-flex btn btn-light btn-icon btn-sm">
      <i class="ti ti-layout-sidebar-left-expand"></i>
    </button>

    {{-- MOBILE --}}
    <button id="mobileBtn" class="btn btn-light btn-icon btn-sm d-lg-none me-2">
      <i class="ti ti-layout-sidebar-left-expand"></i>
    </button>

    <div>
      <ul class="list-unstyled d-flex align-items-center mb-0 gap-1">

        {{-- User Dropdown --}}
        <li class="ms-3 dropdown">
          <a href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="{{ asset('assets/admin/images/avatar/avatar-1.jpg') }}" alt="" class="avatar avatar-sm rounded-circle" />
          </a>
          <div class="dropdown-menu dropdown-menu-end p-0" style="min-width: 200px;">
            <div>
              <div class="d-flex gap-3 align-items-center border-dashed border-bottom px-3 py-3">
                <img src="{{ asset('assets/admin/images/avatar/avatar-1.jpg') }}" alt="" class="avatar avatar-md rounded-circle" />
                <div>
                  <h4 class="mb-0 small">{{ Auth::user()->name }}</h4>
                  <p class="mb-0 small">{{ Auth::user()->email }}</p>
                </div>
              </div>
              <div class="p-3 d-flex flex-column gap-1 small lh-lg">
                <form action="{{ route('logout') }}" method="POST">
                  @csrf
                  <button type="submit" class="btn btn-link p-0 text-decoration-none"><span>Log Out</span></button>
                </form>
              </div>
            </div>
          </div>
        </li>

      </ul>
    </div>
  </nav>

  {{-- SIDEBAR --}}
  <aside id="sidebar" class="sidebar">
    <div class="logo-area">
      <a href="{{ route('admin.dashboard') }}" class="d-inline-flex">
        <img src="{{ asset('assets/admin/images/logo-icon.svg') }}" alt="" width="24">
        <span class="logo-text ms-2"><img src="{{ asset('assets/admin/images/logo.svg') }}" alt=""></span>
      </a>
    </div>
    <ul class="nav flex-column">
      <li class="px-4 py-2"><small class="nav-text">Main</small></li>
      <li>
        <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
          <i class="ti ti-home"></i><span class="nav-text">Dashboard</span>
        </a>
      </li>
      <li>
        <a class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}" href="{{ route('admin.categories.index') }}">
          <i class="ti ti-box-seam"></i><span class="nav-text">Categories</span>
        </a>
      </li>
      <li>
        <a class="nav-link {{ request()->routeIs('admin.product.*') ? 'active' : '' }}" href="{{ route('admin.product.index') }}">
          <i class="ti ti-shopping-cart"></i><span class="nav-text">Products</span>
        </a>
      </li>
      <li>
        <a class="nav-link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}" href="#">
          <i class="ti ti-clipboard-check"></i><span class="nav-text">Orders</span>
        </a>
      </li>

      <li class="px-4 pt-4 pb-2"><small class="nav-text">Account</small></li>
      <li>
        <form action="{{ route('logout') }}" method="POST">
          @csrf
          <button type="submit" class="nav-link border-0 bg-transparent w-100 text-start">
            <i class="ti ti-logout"></i><span class="nav-text">Log Out</span>
          </button>
        </form>
      </li>
    </ul>
  </aside>

  {{-- MAIN CONTENT --}}
  <main id="content" class="content py-10">
    <div class="container-fluid">
      @yield('content')

      <div class="row">
        <div class="col-12">
          <footer class="text-center py-2 mt-6 text-secondary">
            <p class="mb-0">Copyright &copy; {{ date('Y') }} Admin Dashboard</p>
          </footer>
        </div>
      </div>
    </div>
  </main>

  {{-- Bootstrap JS --}}
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  {{-- Sidebar toggle --}}
  <script src="{{ asset('assets/admin/js/sidebar.js') }}"></script>

  {{-- Page-specific scripts --}}
  @yield('scripts')

</body>

</html>
