@php
  $activeMenu = $activeMenu ?? '';
@endphp

<div class="sidebar">
  <!-- Sidebar Menu -->
  <nav class="mt-2 sidebar-nav">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      <li class="nav-item">
        <a href="{{ url('/') }}" class="nav-link {{ ($activeMenu == 'dashboard') ? 'active' : '' }}">
          <i class="nav-icon fas fa-tachometer-alt"></i>
          <p>Dashboard</p>
        </a>
      </li>

      <li class="nav-header">
        <span class="nav-header-text">DATA PENGGUNA</span>
      </li>
      <li class="nav-item">
        <a href="{{ url('/level') }}" class="nav-link {{ ($activeMenu == 'level') ? 'active' : '' }}">
          <i class="nav-icon fas fa-layer-group"></i>
          <p>Level User</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ url('/user') }}" class="nav-link {{ ($activeMenu == 'user') ? 'active' : '' }}">
          <i class="nav-icon far fa-user"></i>
          <p>Data User</p>
        </a>
      </li>

      <li class="nav-header">
        <span class="nav-header-text">DATA BARANG</span>
      </li>
      <li class="nav-item">
        <a href="{{ url('/kategori') }}" class="nav-link {{ ($activeMenu == 'kategori') ? 'active' : '' }}">
          <i class="nav-icon far fa-bookmark"></i>
          <p>Kategori Barang</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ url('/barang') }}" class="nav-link {{ ($activeMenu == 'barang') ? 'active' : '' }}">
          <i class="nav-icon far fa-list-alt"></i>
          <p>Daftar Barang</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ url('/supplier') }}" class="nav-link {{ ($activeMenu == 'supplier') ? 'active' : '' }}">
          <i class="nav-icon fas fa-truck"></i>
          <p>Daftar Supplier</p>
        </a>
      </li>

      <li class="nav-header">
        <span class="nav-header-text">DATA TRANSAKSI</span>
      </li>
      <li class="nav-item">
        <a href="{{ url('/stok') }}" class="nav-link {{ ($activeMenu == 'stok') ? 'active' : '' }}">
          <i class="nav-icon fas fa-cubes"></i>
          <p>Stok Barang</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ url('/penjualan') }}" class="nav-link {{ ($activeMenu == 'penjualan') ? 'active' : '' }}">
          <i class="nav-icon fas fa-cash-register"></i>
          <p>Transaksi Penjualan</p>
        </a>
      </li>
      
      <li class="nav-header">
        <span class="nav-header-text">KONTAK</span>
      </li>
      <li class="nav-item">
        <a href="https://wa.me/6281234567890" target="_blank" class="nav-link">
          <i class="nav-icon fab fa-whatsapp"></i>
          <p>WhatsApp</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="https://instagram.com/yourprofile" target="_blank" class="nav-link">
          <i class="nav-icon fab fa-instagram"></i>
          <p>Instagram</p>
        </a>
      </li>
    </ul>
  </nav>

  <style>
    /* Sidebar style improvements */
    .main-sidebar {
      position: fixed !important;
      /* Ensure sidebar is fixed */
      height: 100vh !important;
      /* Full viewport height */
      overflow-y: hidden !important;
      /* Hide overflow initially */
      z-index: 1038 !important;
      /* Above most content */
      transition: all 0.3s ease !important;
    }

    .sidebar {
      padding-top: 0.5rem;
      height: calc(100% - 57px) !important;
      /* Subtract height of the navbar brand/logo */
      overflow-y: auto !important;
      /* Enable scrolling inside sidebar */
      scrollbar-width: thin;
      position: relative;
      transition: all 0.3s ease;
    }

    .sidebar::-webkit-scrollbar {
      width: 5px;
    }

    .sidebar::-webkit-scrollbar-track {
      background: transparent;
    }

    .sidebar::-webkit-scrollbar-thumb {
      background-color: rgba(255, 255, 255, 0.2);
      border-radius: 20px;
    }

    .sidebar-nav .nav-header {
      position: sticky;
      top: 0;
      z-index: 5;
      background: #343a40;
      padding: 1rem 1rem 0.5rem 1rem;
      font-size: 0.75rem;
      opacity: 0.85;
      /* box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1); */
      margin-bottom: 0.5rem;
    }

    .sidebar-nav .nav-header-text {
      font-weight: 600;
      letter-spacing: 1px;
    }

    .sidebar-nav .nav-link {
      color: #c2c7d0 !important;
      border-radius: 6px;
      padding: 0.75rem 1rem;
      margin: 0 0.5rem 0.25rem 0.5rem;
      position: relative;
      overflow: hidden;
      transition: all 0.25s ease;
    }

    .sidebar-nav .nav-link:hover {
      background-color: rgba(255, 255, 255, 0.1) !important;
      color: #ffffff !important;
      transform: translateX(3px);
    }

    .sidebar-nav .nav-link.active {
      background: linear-gradient(45deg, #0e82ff, #007bff) !important;
      color: #ffffff !important;
      box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16);
      transform: translateX(3px);
    }

    .sidebar-nav .nav-link i {
      font-size: 1rem;
      margin-right: 0.5rem;
      transition: transform 0.25s ease;
      width: 20px;
      text-align: center;
    }

    .sidebar-nav .nav-link:hover i {
      transform: translateX(2px);
    }

    .sidebar-nav .nav-link p {
      transition: transform 0.25s ease;
      font-weight: 500;
    }

    .sidebar-nav .nav-link:hover p {
      transform: translateX(2px);
    }

    .sidebar-nav .nav-link::before {
      content: '';
      position: absolute;
      left: 0;
      top: 0;
      height: 100%;
      width: 3px;
      background: #007bff;
      opacity: 0;
      transition: opacity 0.25s ease;
    }

    .sidebar-nav .nav-link:hover::before {
      opacity: 0.5;
    }

    .sidebar-nav .nav-link.active::before {
      opacity: 1;
    }

    /* Add scroll indicator */
    .sidebar::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 0;
      right: 0;
      height: 20px;
      background: linear-gradient(to top, rgba(52, 58, 64, 1), rgba(52, 58, 64, 0));
      pointer-events: none;
      opacity: 0;
      transition: opacity 0.3s;
    }

    .sidebar.can-scroll::after {
      opacity: 1;
    }

    /* Mobile optimization */
    @media (max-width: 768px) {
      .sidebar-nav .nav-link {
        padding: 0.65rem 0.75rem;
        margin: 0 0.25rem 0.25rem 0.25rem;
      }

      .sidebar-nav .nav-header {
        padding: 0.75rem 0.75rem 0.35rem 0.75rem;
      }
    }

    /* Fix potential layout issues */
    body:not(.sidebar-mini-md):not(.sidebar-mini-xs):not(.layout-top-nav) .content-wrapper,
    body:not(.sidebar-mini-md):not(.sidebar-mini-xs):not(.layout-top-nav) .main-footer,
    body:not(.sidebar-mini-md):not(.sidebar-mini-xs):not(.layout-top-nav) .main-header {
      transition: margin-left .3s ease-in-out !important;
    }
  </style>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      // Check if sidebar can be scrolled
      const sidebar = document.querySelector('.sidebar');

      function checkScroll() {
        if (sidebar.scrollHeight > sidebar.clientHeight) {
          sidebar.classList.add('can-scroll');
        } else {
          sidebar.classList.remove('can-scroll');
        }
      }

      // Check initially and on resize
      checkScroll();
      window.addEventListener('resize', checkScroll);

      // On scroll, remove indicator when at bottom
      sidebar.addEventListener('scroll', function () {
        if (sidebar.scrollHeight - sidebar.scrollTop - sidebar.clientHeight < 10) {
          sidebar.classList.remove('can-scroll');
        } else {
          checkScroll();
        }
      });
    });
  </script>
</div>