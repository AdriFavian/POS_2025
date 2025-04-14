@extends('layouts.template')
@section('content')
<div class="card">
    <div class="card-body" style="padding-top: 16px;">
        <div class="d-flex justify-content-between align-items-center border-bottom mb-2 p-2">
            <!-- Kode Pertama: Tombol -->
            <div class="btn-group">
                <button onclick="modalAction('{{ url('/barang/import') }}')" class="btn btn-info btn-sm mr-2">
                    Import Barang
                </button>
                <button onclick="modalAction('{{ url('/barang/create_ajax') }}')" class="btn btn-success btn-sm mr-2">
                    Tambah Barang (Ajax)
                </button>
                <a href="{{ url('/barang/export_excel') }}" class="btn btn-primary btn-sm mr-2">
                    Export Barang (Excel)
                </a>
                {{-- 
                <a href="{{ url('/barang/export_pdf') }}" class="btn btn-warning btn-sm mr-2">
                    Export Barang (PDF)
                </a>
                --}}
            </div>
    
            <!-- Kode Kedua: Filter -->
            <div class="form-horizontal filter-date">
                <div class="form-group form-group-sm d-flex align-items-center mb-0">
                    <label for="kategori_id" class="col-form-label mr-2" style="min-width: 50px;">Filter</label>
                    <div>
                        <select name="kategori_id" id="kategori_id" class="form-control form-control-sm" style="width: 200px;">
                            <option value="">- Semua -</option>
                            @foreach($kategori as $l)
                                <option value="{{ $l->kategori_id }}">{{ $l->kategori_nama }}</option>
                            @endforeach
                        </select>
                        <small class="form-text text-muted">Kategori Barang</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Alert -->
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <!-- Table -->
        <table class="table table-bordered table-sm table-striped table-hover" id="table_barang">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Kategori</th>
                    <th>Harga Beli</th>
                    <th>Harga Jual</th>
                    <th>Aksi</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<!-- Modal -->
<div id="myModal" class="modal fade animate shake" tabindex="-1" data-backdrop="static"
    data-keyboard="false" data-width="75%"></div>
@endsection

@push('js')
<script>
    function modalAction(url = '') {
        $('#myModal').load(url, function() {
            $('#myModal').modal('show');
        });
    }

    var dataBarang;
    $(document).ready(function() {
        dataBarang = $('#table_barang').DataTable({
            serverSide: true,
            processing: true,
            ajax: {
                url: "{{ route('barang.list') }}",
                type: "POST",
                data: function(d) {
                    d.kategori_id = $('#kategori_id').val();
                }
            },
            columns: [
                { data: "DT_RowIndex", className: "text-center", orderable: false, searchable: false },
                { data: "barang_kode" },
                { data: "barang_nama" },
                { data: "kategori" },
                { data: "harga_beli", render: function(data){ return new Intl.NumberFormat('id-ID').format(data); }},
                { data: "harga_jual", render: function(data){ return new Intl.NumberFormat('id-ID').format(data); }},
                { data: "aksi", className: "text-center", orderable: false, searchable: false }
            ]
        });

        $('#kategori_id').change(function() {
            dataBarang.ajax.reload();
        });
    });
</script>
@endpush