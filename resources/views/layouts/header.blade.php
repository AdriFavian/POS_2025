<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-dark navbar-dark">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="" role="button">
        <i class="fas fa-bars mr-2"></i>
        <span class="font-weight-bold text-white ml-2">POS System</span>
      </a>
    </li>
  </ul>

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <!-- Fullscreen Button -->
    <li class="nav-item">
      <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
      </a>
  </li>
  </ul>
</nav>

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
</script>