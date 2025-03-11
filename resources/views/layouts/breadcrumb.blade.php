<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>{{ $breadcrumbs->title }}</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb d-flex justify-content-end">
          @foreach($breadcrumbs->list as $key => $value)
              @if($key == count($breadcrumbs->list) - 1)
                  <li class="breadcrumb-item active" aria-current="page">{{ $value }}</li>
              @else
                  <li class="breadcrumb-item">
                      <a href="#">{{ $value }}</a>
                  </li>
              @endif
          @endforeach
      </ol>
      </div>
    </div>
  </div>
</section> 