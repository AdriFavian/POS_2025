<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-dark"
  style="background: linear-gradient(90deg, #343a40, #1a1e21); box-shadow: 0 2px 5px rgba(0,0,0,0.2);">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="" role="button">
        <i class="fas fa-bars"></i>
      </a>
    </li>
  </ul>

  <!-- POS System logo/text in center -->
  <div class="navbar-brand mx-auto d-none d-md-block text-center">
    <span class="font-weight-bold" style="position: relative; padding: 0 15px;">
      <i class="fas fa-cash-register mr-2"></i>
      POS System
      <span
        style="position: absolute; bottom: -5px; left: 0; right: 0; height: 2px; background: linear-gradient(90deg, transparent, rgba(255,255,255,0.5), transparent);"></span>
    </span>
  </div>

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <!-- Fullscreen Button -->
    <li class="nav-item">
      <a class="nav-link" data-widget="fullscreen" href="#" role="button" title="Fullscreen">
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
      icon: 'question',
      showCancelButton: true,
      confirmButtonText: 'Ya, Logout',
      cancelButtonText: 'Batal',
      confirmButtonColor: '#d33',
      cancelButtonColor: '#3085d6',
      reverseButtons: true
    }).then((result) => {
      if (result.isConfirmed) {
        document.getElementById('logout-form').submit();
      }
    });
  }
</script>