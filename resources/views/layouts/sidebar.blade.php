@php
$activeMenu = $activeMenu ?? '';
@endphp

<div class="sidebar">
  {{-- <!-- SidebarSearch Form -->
  <div class="form-inline mt-2">
    <div class="input-group" data-widget="sidebar-search">
      <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
      <div class="input-group-append">
        <button class="btn btn-sidebar">
          <i class="fas fa-search fa-fw"></i>
        </button>
      </div>
    </div>
  </div> --}}
  <!-- Sidebar Menu -->
  <nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      <li class="nav-item">
        <a href="{{ url('/') }}" class="nav-link {{ ($activeMenu == 'dashboard') ? 'active' : '' }}"
          style="transition: all 0.3s ease-in-out;  padding: 10px 15px;">
          <i class="nav-icon fas fa-tachometer-alt" style="transition: transform 0.3s ease-in-out;"></i>
          <p style="transition: transform 0.3s ease-in-out;">Dashboard</p>
        </a>
      </li>
      <li class="nav-header">Data Pengguna</li>
      <li class="nav-item">
        <a href="{{ url('/level') }}" class="nav-link {{ ($activeMenu == 'level') ? 'active' : '' }}"
          style="transition: all 0.3s ease-in-out; padding: 10px 15px;">
          <i class="nav-icon fas fa-layer-group" style="transition: transform 0.3s ease-in-out;"></i>
          <p style="transition: transform 0.3s ease-in-out;">Level User</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ url('/user') }}" class="nav-link {{ ($activeMenu == 'user') ? 'active' : '' }}"
          style="transition: all 0.3s ease-in-out; padding: 10px 15px;">
          <i class="nav-icon far fa-user" style="transition: transform 0.3s ease-in-out;"></i>
          <p style="transition: transform 0.3s ease-in-out;">Data User</p>
        </a>
      </li>
      <li class="nav-header">Data Barang</li>
      <li class="nav-item">
        <a href="{{ url('/kategori') }}" class="nav-link {{ ($activeMenu == 'kategori') ? 'active' : '' }}"
          style="transition: all 0.3s ease-in-out; padding: 10px 15px;">
          <i class="nav-icon far fa-bookmark" style="transition: transform 0.3s ease-in-out;"></i>
          <p style="transition: transform 0.3s ease-in-out;">Kategori Barang</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ url('/barang') }}" class="nav-link {{ ($activeMenu == 'barang') ? 'active' : '' }}"
          style="transition: all 0.3s ease-in-out; padding: 10px 15px;">
          <i class="nav-icon far fa-list-alt" style="transition: transform 0.3s ease-in-out;"></i>
          <p style="transition: transform 0.3s ease-in-out;">Daftar Barang</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ url('/supplier') }}" class="nav-link {{ ($activeMenu == 'supplier') ? 'active' : '' }}"
          style="transition: all 0.3s ease-in-out; padding: 10px 15px;">
          <i class="nav-icon far fa-list-alt" style="transition: transform 0.3s ease-in-out;"></i>
          <p style="transition: transform 0.3s ease-in-out;">Daftar Supplier</p>
        </a>
      </li>
      <li class="nav-header">Data Transaksi</li>
      <li class="nav-item">
        <a href="{{ url('/stok') }}" class="nav-link {{ ($activeMenu == 'stok') ? 'active' : '' }}"
          style="transition: all 0.3s ease-in-out; padding: 10px 15px;">
          <i class="nav-icon fas fa-cubes" style="transition: transform 0.3s ease-in-out;"></i>
          <p style="transition: transform 0.3s ease-in-out;">Stok Barang</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ url('/penjualan') }}" class="nav-link {{ ($activeMenu == 'penjualan') ? 'active' : '' }}"
          style="transition: all 0.3s ease-in-out; padding: 10px 15px;">
          <i class="nav-icon fas fa-cash-register" style="transition: transform 0.3s ease-in-out;"></i>
          <p style="transition: transform 0.3s ease-in-out;">Transaksi Penjualan</p>
        </a>
      </li>
    </ul>
  </nav>

  <style>
    .nav-link {
      color: #c2c7d0 !important;
      /* Warna teks default */
      position: relative;
      overflow: hidden;
    }

    .nav-link:hover {
      background-color: rgba(255, 255, 255, 0.1) !important;
      color: #ffffff !important;
    }

    .nav-link:hover i,
    .nav-link:hover p {
      transform: translateX(5px);
    }

    .nav-link.active {
      background: linear-gradient(45deg, #0e82ff, #007bff) !important;
      color: #ffffff !important;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
      transform: translateX(5px);
      transition: all 0.3s ease-in-out;
    }

    .nav-link.active i,
    .nav-link.active p {
      transform: translateX(0);
    }

    .nav-link::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
      /* transition: 0.2s; */
    }

    .nav-link:hover::before {
      left: 100%;
    }
  </style>