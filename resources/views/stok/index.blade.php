@extends('layouts.template')

@section('content')
    <div class="card card-outline card-primary mr-3 ml-3">
        <div class="card-header">
            {{-- <h3 class="card-title">{{ $page->title }}</h3> --}}
            <div class="card-tools">
                <button onclick="modalAction('{{ url('stok/import') }}')" class="btn btn-sm bg-light mr-2"
                    style="border: 1px solid black">
                    <i class="fa fa-download mr-1" style="color: dodgerblue"></i>Import Stok
                </button>
                <a href="{{ url('/stok/export_excel') }}" class="btn btn-sm bg-light mr-2" style="border: 1px solid black">
                    <i class="fa fa-file-excel mr-1" style="color: green"></i>Export Excel
                </a>
                <a href="{{ url('/stok/export_pdf') }}" class="btn btn-sm btn-light mr-2" style="border: 1px solid black">
                    <i class="fa fa-file-pdf mr-1" style="color: tomato"></i> Export PDF
                </a>
                <button onclick="modalAction('{{ url('stok/create_ajax') }}')" class="btn btn-sm btn-success">
                    Tambah Stok
                </button>
            </div>
        </div>
        <div class="card-body">
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
                            <select class="form-control" id="barang_id" name="barang_id">
                                <option value="">Semua</option>
                                @foreach($barang as $item)
                                    <option value="{{ $item->barang_id }}">{{ $item->barang_nama }}</option>
                                @endforeach
                            </select>
                            <small class="form-text text-muted">Stok Barang</small>
                        </div>
                    </div>
                </div>
            </div>
            <table class="table table-bordered table-striped table-hover table-sm" id="table_stok">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>ID Barang</th>
                        <th>Nama Barang</th>
                        <th>Jumlah Stok</th>
                        <th>Tanggal Stok</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <div id="myModal" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                
            </div>
        </div>
    </div>
@endsection

@push('css')
@endpush

@push('js')
    <script>
        function modalAction(url = '') {
            $('#myModal').load(url, function () {
                $('#myModal').modal('show');
            });
        }

        var dataStok;
        $(document).ready(function () {
            dataStok = $('#table_stok').DataTable({
                serverSide: true,
                processing: true,
                ajax: {
                    url: "{{ route('stok.list') }}",
                    type: "POST",
                    data: function (d) {
                        d.barang_id = $('#barang_id').val();
                    }
                },
                columns: [{
                    data: "DT_RowIndex",
                    className: "text-center",
                    orderable: false,
                    searchable: false
                },
                {
                    data: "barang_id",
                    orderable: true,
                    searchable: true
                },
                {
                    data: "barang_nama",
                    orderable: true,
                    searchable: true
                },
                {
                    data: "stok_jumlah",
                    orderable: true,
                    searchable: false
                },
                {
                    data: "stok_tanggal",
                    orderable: true,
                    searchable: false
                },
                {
                    data: "aksi",
                    className: "text-center",
                    orderable: false,
                    searchable: false
                }
                ]
            });

            $('#barang_id').on('change', function () {
                dataStok.ajax.reload();
            });
        });
    </script>
@endpush