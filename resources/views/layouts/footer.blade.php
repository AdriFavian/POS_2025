<footer class="main-footer">
  <div class="container-fluid">
    <div class="row">
      <!-- Copyright Info -->
      <div class="col-md-6 col-sm-12">
        <div class="d-flex align-items-center h-100">
          <strong>&copy; {{ date('Y') }} POS System</strong>
          <span class="ml-1 d-none d-sm-inline-block">All rights reserved.</span>
          <div class="ml-2 d-inline-block">
            <span class="badge badge-info">v3.2.0</span>
          </div>
        </div>
      </div>

      <!-- Quick Links -->
      <div class="col-md-6 col-sm-12">
        <div class="text-md-right mt-2 mt-md-0">
          <div class="btn-group">
            {{-- <a href="{{ url('/') }}" class="btn btn-sm btn-outline-secondary">
              <i class="fas fa-home mr-1"></i> Home
            </a> --}}
            {{-- <a href="#" class="btn btn-sm btn-outline-secondary d-none d-sm-inline-block">
              <i class="fas fa-question-circle mr-1"></i> Help
            </a> --}}
            <a href="https://adminlte.io" target="_blank"
              class="btn btn-sm btn-outline-secondary d-none d-md-inline-block">
              <i class="fas fa-info-circle mr-1"></i> AdminLTE
            </a>
            <a href="" onclick="document.documentElement.scrollTop = 0;" class="btn btn-sm btn-outline-secondary" style="color: #000;">
              <i class="fas fa-arrow-up mr-1"></i> Top
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</footer>

<aside class="control-sidebar control-sidebar-dark">
  <!-- Control sidebar content goes here -->
</aside>