@extends('layouts.template')

@section('content')
    <div class="card card-outline mr-3 ml-3">
        <div class="card-header">
            {{-- <h3 class="card-title">{{ $page->title }}</h3> --}}
            <div class="card-tools">
                <a href="{{ url('/penjualan/export_excel') }}" class="btn btn-sm bg-light mr-2" style="border: 1px solid black">
                    <i class="fa fa-file-excel mr-1" style="color: green"></i>Export Excel
                </a>
                <a href="{{ url('/penjualan/export_pdf') }}"class="btn btn-sm btn-light mr-2" style="border: 1px solid black">
                    <i class="fa fa-file-pdf mr-1" style="color: tomato"></i> Export PDF
                </a>
            </div>
        </div>
        <div class="card-body">
            <!-- Pesan Sukses dan Error -->
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <!-- Filter -->
            <div class="row mb-3">
                <div class="col-md-12">
                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label">Filter</label>
                        <div class="col-3">
                            <select class="form-control" id="filter_user" name="filter_user">
                                <option value="">Semua Kasir</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->user_id }}">{{ $user->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabel Data Penjualan -->
            <table class="table table-bordered table-striped table-hover table-sm" id="table_penjualan">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Penjualan Kode</th>
                        <th>Pembeli</th>
                        <th>Tanggal</th>
                        <th>Total Harga</th>
                        <th>User</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    <!-- Modal Global untuk AJAX (gunakan id "myModal") -->
    <div id="myModal" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <!-- Konten modal akan dimuat secara dinamis melalui AJAX -->
            </div>
        </div>
    </div>
@endsection

@push('css')
@endpush

@push('js')
    <script>
        // Fungsi untuk memuat konten modal via AJAX
        function modalAction(url = '') {
            $('#myModal').load(url, function () {
                $('#myModal').modal('show');
            });
        }

        $(document).ready(function () {
            var dataPenjualan = $('#table_penjualan').DataTable({
                serverSide: true,
                processing: true,
                ajax: {
                    url: "{{ route('penjualan.list') }}",
                    type: "POST",
                    data: function(d) {
                    d.user_id = $('#filter_user').val();
                }
                },
                columns: [
                    { data: "DT_RowIndex", className: "text-center", orderable: false, searchable: false },
                    { data: "penjualan_kode", orderable: true, searchable: true },
                    { data: "pembeli", orderable: true, searchable: true },
                    { data: "penjualan_tanggal", orderable: true, searchable: true },
                    { data: "total_harga", render: function(data) {return 'Rp ' + new Intl.NumberFormat('id-ID').format(data);}, orderable: true, searchable: true },
                    { data: "user_name", orderable: false, searchable: false },
                    { data: "aksi", className: "text-center", orderable: false, searchable: false }
                ]
            });
            // window.dataPenjualan = dataPenjualan;
            $('#filter_user').change(function() {
            dataPenjualan.ajax.reload();
        });
        });
    </script>
@endpush