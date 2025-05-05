@extends('layouts.template')

@section('content')
    <div class="card card-outline card-primary mr-3 ml-3">
        <div class="card-header">
            {{-- <h3 class="card-title">{{ $page->title }}</h3> --}}
            <div class="card-tools">
                <button onclick="modalAction('{{ url('supplier/create_ajax') }}')" class="btn btn-sm btn-success">
                    Tambah Supplier
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

            <table class="table table-bordered table-striped table-hover table-sm" id="table_supplier">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Supplier</th>
                        <th>Nama Supplier</th>
                        <th>Alamat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    <div id="myModal" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <!-- Konten modal akan dimuat di sini -->
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        function modalAction(url = '') {
            $('#myModal .modal-content').load(url, function (response, status, xhr) {
                if (status == "error") {
                    $(this).html('<div class="modal-header"><h5 class="modal-title">Error</h5><button type="button" class="close" data-dismiss="modal">&times;</button></div><div class="modal-body"><p>Gagal memuat konten: ' + xhr.status + " " + xhr.statusText + '</p></div><div class="modal-footer"><button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button></div>');
                }
                $('#myModal').modal('show');
            });
        }

        $(document).ready(function () {
            $('#table_supplier').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ url('supplier/list') }}",
                    type: "POST",
                },
                columns: [
                    {
                        data: 'DT_RowIndex',
                        className: 'text-center',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'supplier_kode',
                        name: 'supplier_kode'
                    },
                    {
                        data: 'supplier_nama',
                        name: 'supplier_nama'
                    },
                    {
                        data: 'supplier_alamat',
                        name: 'supplier_alamat'
                    },
                    {
                        data: 'aksi',
                        className: 'text-center',
                        orderable: false,
                        searchable: false
                    },
                ]
            });
        });
    </script>
@endpush