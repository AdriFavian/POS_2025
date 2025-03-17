@if(is_null($penjualan))
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Kesalahan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger">
                    Data penjualan tidak ditemukan.
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
@else
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Penjualan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h6>Informasi Penjualan</h6>
                <div class="table-responsive mb-3">
                    <table class="table table-bordered table-striped table-hover table-sm"
                        style="table-layout: fixed; width: 100%;">
                        <colgroup>
                            <col style="width: 30%;">
                            <col style="width: 70%;">
                        </colgroup>
                        <tbody>
                            <tr>
                                <th>ID Penjualan</th>
                                <td>{{ $penjualan->penjualan_id }}</td>
                            </tr>
                            <tr>
                                <th>Kode Penjualan</th>
                                <td>{{ $penjualan->penjualan_kode }}</td>
                            </tr>
                            <tr>
                                <th>Pembeli</th>
                                <td>{{ $penjualan->pembeli ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Tanggal</th>
                                <td>{{ \Carbon\Carbon::parse($penjualan->penjualan_tanggal)->format('Y-m-d') }}</td>
                            </tr>
                            <tr>
                                <th>Total Harga</th>
                                <td>{{ $penjualan->total_harga }}</td>
                            </tr>
                            <tr>
                                <th>User</th>
                                <td>{{ $penjualan->user ? $penjualan->user->nama : '-' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <hr>
                <h6>Detail Penjualan</h6>
                @if($penjualan->detail->isEmpty())
                    <p>Tidak ada detail penjualan.</p>
                @else
                        @php
                            $grandTotal = 0;
                        @endphp
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover table-sm"
                                style="table-layout: fixed; width: 100%;">
                                <colgroup>
                                    <col style="width: 5%;">
                                    <col style="width: 40%;">
                                    <col style="width: 15%;">
                                    <col style="width: 15%;">
                                    <col style="width: 15%;">
                                </colgroup>
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Barang</th>
                                        <th>Harga</th>
                                        <th>Jumlah</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($penjualan->detail as $key => $detail)
                                        @php
                                            $subtotal = $detail->harga * $detail->jumlah;
                                            $grandTotal += $subtotal;
                                        @endphp
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $detail->barang ? $detail->barang->barang_nama : '-' }}</td>
                                            <td>{{ $detail->harga }}</td>
                                            <td>{{ $detail->jumlah }}</td>
                                            <td>{{ $subtotal }}</td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <th colspan="4" class="text-left">Total</th>
                                        <th>{{ $grandTotal }}</th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
@endif