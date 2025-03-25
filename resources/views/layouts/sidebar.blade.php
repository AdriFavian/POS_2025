<div class="sidebar">
  <!-- SidebarSearch Form -->
  <div class="form-inline mt-2">
    <div class="input-group" data-widget="sidebar-search">
      <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
      <div class="input-group-append">
        <button class="btn btn-sidebar">
          <i class="fas fa-search fa-fw"></i>
        </button>
      </div>
    </div>
  </div>
  <!-- Sidebar Menu -->
  <nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      <li class="nav-item">
        <a href="{{ url('/') }}" class="nav-link {{ ($activeMenu == 'dashboard') ? 'active' : '' }} ">
          <i class="nav-icon fas fa-tachometer-alt"></i>
          <p>Dashboard</p>
        </a>
      </li>
      <li class="nav-header">Data Pengguna</li>
      <li class="nav-item">
        <a href="{{ url('/level') }}" class="nav-link {{ ($activeMenu == 'level') ? 'active' : '' }} ">
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
      <li class="nav-header">Data Barang</li>
      <li class="nav-item">
        <a href="{{ url('/kategori') }}" class="nav-link {{ ($activeMenu == 'kategori') ? 'active' : '' }} ">
          <i class="nav-icon far fa-bookmark"></i>
          <p>Kategori Barang</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ url('/barang') }}" class="nav-link {{ ($activeMenu == 'barang') ? 'active' : '' }} ">
          <i class="nav-icon far fa-list-alt"></i>
          <p>Daftar Barang</p>
        </a>
      </li>
      <li class="nav-header">Data Transaksi</li>
      <li class="nav-item">
        <a href="{{ url('/stok') }}" class="nav-link {{ ($activeMenu == 'stok') ? 'active' : '' }} ">
          <i class="nav-icon fas fa-cubes"></i>
          <p>Stok Barang</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ url('/penjualan') }}" class="nav-link {{ ($activeMenu == 'penjualan') ? 'active' : '' }} ">
          <i class="nav-icon fas fa-cash-register"></i>
          <p>Transaksi Penjualan</p>
        </a>
      </li>
      {{-- <li class="nav-item" style="margin-top: 20px; margin-bottom: 10px;">
        <a href="#" class="nav-link bg-danger text-white" onclick="logoutConfirm(event)">
          <i class="nav-icon fas fa-sign-out-alt"></i>
          <p>Keluar</p>
        </a>
        <form id="logout-form" action="{{ url('/logout') }}" method="POST" class="d-none">
          @csrf
        </form>
      </li> --}}
      <li class="nav-item" style="margin-top: 20px; margin-bottom: 10px;">
        <a href="#" class="nav-link logout-btn" onclick="logoutConfirm(event)"
          style="background: linear-gradient(45deg, #dc3545, #ff0000);
                  color: white; 
                  padding: 10px 15px; 
                  border-radius: 10px;
                  transition: all 0.3s ease-in-out;
                  display: flex;
                  align-items: center;
                  justify-content: left;
                  text-decoration: none;">
            <i class="nav-icon fas fa-sign-out-alt" style="margin-right: 8px;"></i>
            <p style="margin: 0;">Keluar</p>
        </a>
        <form id="logout-form" action="{{ url('/logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </li>
    
    </ul>
  </nav>
</div>
<script>
  function logoutConfirm(e) {
    e.preventDefault();
    Swal.fire({
      title: 'Konfirmasi Logout',
      text: 'Apakah Anda yakin ingin logout?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Ya, Logout',
      cancelButtonText: 'Batal'
    }).then((result) => {
      if (result.isConfirmed) {
        document.getElementById('logout-form').submit();
      }
    });
  }

  document.addEventListener("DOMContentLoaded", function() {
        let logoutBtn = document.querySelector(".logout-btn");
        logoutBtn.addEventListener("mouseenter", function() {
            this.style.background = "linear-gradient(45deg, #c82333, #b50000)";
            this.style.transform = "scale(1.05)";
        });
        logoutBtn.addEventListener("mouseleave", function() {
            this.style.background = "linear-gradient(45deg, #dc3545, #ff0000)";
            this.style.transform = "scale(1)";
        });
    });
</script>