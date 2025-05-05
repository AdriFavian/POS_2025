<div class="modal-header">
    <h5 class="modal-title">Detail Supplier</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    @if($supplier)
        <h6>Informasi Supplier</h6>
        <div class="table-responsive mb-4">
            <table class="table table-bordered table-striped table-hover table-sm"
                style="table-layout: fixed; width: 100%;">
                <colgroup>
                    <col style="width: 30%;">
                    <col style="width: 70%;">
                </colgroup>
                <tbody>
                    <tr>
                        <th>Kode Supplier</th>
                        <td>{{ $supplier->supplier_kode }}</td>
                    </tr>
                    <tr>
                        <th>Nama Supplier</th>
                        <td>{{ $supplier->supplier_nama }}</td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <td>{{ $supplier->supplier_alamat }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    @else
        <div class="alert alert-danger">Data supplier tidak ditemukan.</div>
    @endif
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
</div>