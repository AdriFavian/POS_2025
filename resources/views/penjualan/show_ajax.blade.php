<div class="modal-header">
    <h5 class="modal-title">Detail Penjualan</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    @if(is_null($penjualan))
        <div class="alert alert-danger">
            Data penjualan tidak ditemukan.
        </div>
    @else
        <!-- Informasi Penjualan (Header) -->
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
                        <td>{{ \Carbon\Carbon::parse($penjualan->penjualan_tanggal)->format('Y-m-d H:i') }}</td> {{-- Format
                        tanggal diubah --}}
                    </tr>
                    <tr>
                        <th>User yang Mencatat</th>
                        <td>{{ $penjualan->user ? $penjualan->user->nama : '-' }}</td>
                    </tr>
                    <tr>
                        <th>Total Harga</th>
                        <td>Rp. {{ number_format($penjualan->total_harga, 0, ',', '.') }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <hr>

        <!-- Detail Penjualan -->
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
                                <td>Rp. {{ number_format($detail->harga, 0, ',', '.') }}</td>
                                <td>{{ $detail->jumlah }}</td>
                                <td>Rp. {{ number_format($subtotal, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                        <!-- Tambahkan baris total di bawah subtotal -->
                        <tr>
                            <th colspan="4" class="text-right">Total</th>
                            <th>Rp. {{ number_format($grandTotal, 0, ',', '.') }}</th>
                        </tr>
                    </tbody>
                </table>
            </div>
        @endif
    @endif
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
</div>