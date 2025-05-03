<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ config('app.name', 'PWL Laravel Starter Code') }}</title>

  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Untuk mengirimkan token Laravel CSRF pada setiap request ajax -->

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
  <!-- jquery-validation -->
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/jquery-validation/jquery.validate.min.css') }}">

  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">

  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">

  @stack('css') <!-- untuk memanggil custom css dari perintah push('css') pada masing-masing view -->

  <style>
    /* Ensuring content scrolls properly with fixed sidebar */
    .wrapper {
      overflow-x: hidden;
    }

    .content-wrapper {
      min-height: calc(100vh - 114px);
      /* Adjust based on your header + footer height */
    }

    /* Improved user image in header */
    .user-image {
      height: 30px;
      width: 30px;
      object-fit: cover;
    }

    /* Fix for user menu dropdown */
    .navbar-nav .user-menu .dropdown-menu {
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
      border: none;
      border-radius: 8px;
      overflow: hidden;
    }

    /* Gradual transition when navbar collapses */
    @media (max-width: 991.98px) {
      .layout-navbar-fixed .wrapper .main-header {
        left: 0;
      }
    }
  </style>

</head>

<body class="hold-transition sidebar-mini">
  <!-- Site wrapper -->
  <div class="wrapper">
    <!-- Navbar -->
    @include('layouts/header')
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-2">
      <!-- Brand Logo -->
      {{-- <a href="{{ url('/') }}" class="brand-link">
        <img src="{{ asset('adminlte/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo"
          class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">{{ Auth::user()->username ?? 'Guest'}}</span>
      </a> --}}
      <!-- Dropdown Menu untuk Profil dan Logout -->
      <li class="nav-item dropdown" style="margin-top: 4px;">
        <a class="nav-link d-flex align-items-center brand-link" data-toggle="dropdown" href="" role="button"
          aria-haspopup="true" aria-expanded="false">
          @if(Auth::user()->photo)
        <!-- Jika user punya foto -->
        <img src="{{ asset('storage/profiles/' . Auth::user()->photo) }}" alt="" class="rounded-circle elevation-3"
        style="opacity: .8; object-fit: cover; width: 42px; height: 42px; margin: 10px;">
        <span class="brand-text rounded-circle"
        style="color: white; margin-left: 10px;">{{ Auth::user()->username ?? 'Guest'}}</span>
      @else
        <!-- Jika user belum punya foto -->
        <img src="{{ asset('adminlte/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo"
        class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text" style="color: white">{{ Auth::user()->username ?? 'Guest'}}</span>
      @endif
        </a>
        <div class="dropdown-menu dropdown-menu-left" style="width: 97%">
          <!-- Menu Profil -->
          <a href="{{ url('user/edit_profile') }}" class="dropdown-item" style="border-bottom: 1px solid gray">
            <i class="fas fa-user mr-2 mb-2" style="color: dodgerblue"></i> profile
          </a>
          <!-- Menu Logout -->
          <a href="logout" class="dropdown-item" onclick="logoutConfirm(event)">
            <i class="fas fa-sign-out-alt mr-2" style="color: tomato"></i> Logout
          </a>
          <!-- Form Logout (tersembunyi) -->
          <form id="logout-form" action="{{ url('/logout') }}" method="POST" class="d-none">
            @csrf
          </form>
        </div>
      </li>

      <!-- Sidebar -->
      @include('layouts/sidebar')
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      @include('layouts/breadcrumb')

      <!-- Main content -->
      @yield('content')
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    @include('layouts/footer')
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="{{ asset('adminlte/plugins/jquery/jquery.min.js')}}"></script>
  <!-- Bootstrap 4 -->
  <script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <!-- DataTables  & Plugins -->
  <script src="{{ asset('adminlte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
  <script src="{{ asset('adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('adminlte/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
  <script src="{{ asset('adminlte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('adminlte/plugins/jszip/jszip.min.js') }}"></script>
  <script src="{{ asset('adminlte/plugins/pdfmake/pdfmake.min.js') }}"></script>
  <script src="{{ asset('adminlte/plugins/pdfmake/vfs_fonts.js') }}"></script>
  <script src="{{ asset('adminlte/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
  <script src="{{ asset('adminlte/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
  <script src="{{ asset('adminlte/plugins/datatables-buttons/js/buttons.colvis.min.js') }}"></script>

  <!-- jquery-validation -->
  <script src="{{ asset('adminlte/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
  <script src="{{ asset('adminlte/plugins/jquery-validation/additional-methods.min.js') }}"></script>

  <!-- SweetAlert2 -->
  <script src="{{ asset('adminlte/plugins/sweetalert2/sweetalert2.min.js') }}"></script>

  <!-- AdminLTE App -->
  <script src="{{ asset('adminlte/dist/js/adminlte.min.js')}}"></script>
  <script>
    // untuk mengirimkan token Laravel CSRF pada setiap request ajax
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
  </script>

  @stack('js') <!-- untuk memanggil custom js dari perintah push('js') pada masing-masing view -->
</body>

</html>