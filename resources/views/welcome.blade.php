@extends('layouts.template')

@section('content')
    <div class="container-fluid" style="padding: 0px 20px" >
        <!-- Info boxes -->
        <div class="row mb-4">
            <div class="col-12 col-sm-6 col-md-6">
                <div class="stat-card">
                    <div class="stat-card-content">
                        <div class="stat-card-icon">
                            <i class="fas fa-boxes"></i>
                        </div>
                        <div class="stat-card-info">
                            <p class="stat-card-label">Total Stok Barang</p>
                            <h3 class="stat-card-value">{{ number_format($totalStok, 0, ',', '.') }}</h3>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-md-6">
                <div class="stat-card">
                    <div class="stat-card-content">
                        <div class="stat-card-icon sales-icon">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                            <p class="stat-card-label">Total Penjualan Hari Ini</p>
                            <h3 class="stat-card-value ml-3 mb-2">Rp {{ number_format($totalPenjualanHariIni, 0, ',', '.') }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Transaksi Terakhir -->
        <div class="row" style="padding: 0px 20px">
            <div class="col-md-12">
                <div class="data-card">
                    <div class="data-card-header">
                        <h3 class="data-card-title">
                            <i class="fas fa-history mr-2"></i>
                            Transaksi Terakhir
                        </h3>
                    </div>
                    <div class="data-card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>No Transaksi</th>
                                        <th>Tanggal</th>
                                        <th>Kasir</th>
                                        <th>Total Items</th>
                                        <th>Total Harga</th>
                                        <th>Detail</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($transaksiTerakhir as $transaksi)
                                        <tr>
                                            <td>{{ $transaksi->penjualan_kode }}</td>
                                            <td>{{ $transaksi->created_at->format('d/m/Y H:i') }}</td>
                                            <td>{{ $transaksi->user->nama }}</td>
                                            <td>{{ $transaksi->detail->sum('jumlah') }}</td>
                                            <td>Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</td>
                                            <td>
                                                <button type="button" class="btn-detail"
                                                    onclick="showDetail('{{ $transaksi->penjualan_id }}')">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center">Belum ada transaksi</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Detail Transaksi -->
    <div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailModalLabel">Detail Transaksi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="detailContent">
                    <!-- Content will be loaded here -->
                </div>
            </div>
        </div>
    </div>
    @endsection

@push('js')
    <script>
        function showDetail(id) {
            $.ajax({
                url: "{{ url('/penjualan') }}/" + id + "/show_ajax",
                type: "GET",
                success: function (response) {
                    $("#detailContent").html(response);
                    $("#detailModal").modal('show');
                },
                error: function (xhr) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Terjadi kesalahan! Silakan coba lagi.'
                    });
                }
            });
        }
    </script>
@endpush

@push('css')
    <style>
        .stat-card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
            margin-bottom: 20px;
            transition: all 0.2s ease;
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.08);
        }

        .stat-card-content {
            display: flex;
            padding: 20px;
            align-items: center;
        }

        .stat-card-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 48px;
            height: 48px;
            border-radius: 8px;
            background-color: rgba(255, 193, 7, 0.1);
            color: #ffc107;
            margin-right: 16px;
        }

        .sales-icon {
            background-color: rgba(40, 167, 69, 0.1);
            color: #28a745;
        }

        .stat-card-info {
            flex: 1;
        }

        .stat-card-label {
            color: #6c757d;
            font-size: 14px;
            margin-bottom: 4px;
        }

        .stat-card-value {
            color: #212529;
            font-size: 22px;
            font-weight: 600;
            margin: 0;
        }

        /* Data Card (Table) Styles */
        .data-card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
            margin-bottom: 20px;
        }

        .data-card-header {
            padding: 16px 20px;
            border-bottom: 1px solid #f5f5f5;
        }

        .data-card-title {
            font-size: 16px;
            font-weight: 600;
            color: #212529;
            margin: 0;
        }

        .data-card-body {
            padding: 0;
        }

        /* Table Styles */
        .table {
            margin-bottom: 0;
        }

        .table th {
            border-top: none;
            border-bottom: 1px solid #f0f0f0;
            color: #6c757d;
            font-weight: 500;
            padding: 12px 20px;
            font-size: 13px;
        }

        .table td {
            border-top: none;
            border-bottom: 1px solid #f5f5f5;
            padding: 14px 20px;
            vertical-align: middle;
            color: #495057;
        }

        .table tr:last-child td {
            border-bottom: none;
        }

        /* Button Styles */
        .btn-detail {
            background-color: rgba(23, 162, 184, 0.1);
            color: #17a2b8;
            border: none;
            width: 32px;
            height: 32px;
            border-radius: 6px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .btn-detail:hover {
            background-color: rgba(23, 162, 184, 0.2);
        }

        /* Modal Styles */
        .modal-content {
            border: none;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .modal-header {
            border-bottom: 1px solid #f5f5f5;
            padding: 16px 20px;
        }

        .modal-title {
            font-weight: 600;
        }

        .close {
            opacity: 0.5;
            transition: opacity 0.2s ease;
        }

        .close:hover {
            opacity: 0.8;
        }
    </style>
@endpush 







{{-- @extends('layouts.template')

@section('content')
<div class="container-fluid">
    <!-- Info boxes -->
    <div class="row">
        <div class="col-12 col-sm-6 col-md-6">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-boxes"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Total Stok Barang</span>
                    <span class="info-box-number">{{ number_format($totalStok, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-md-6">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Total Penjualan Hari Ini</span>
                    <span class="info-box-number">Rp {{ number_format($totalPenjualanHariIni, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Transaksi Terakhir -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-history mr-1"></i>
                        Transaksi Terakhir
                    </h3>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>No Transaksi</th>
                                <th>Tanggal</th>
                                <th>Kasir</th>
                                <th>Total Items</th>
                                <th>Total Harga</th>
                                <th>Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($transaksiTerakhir as $transaksi)
                            <tr>
                                <td>{{ $transaksi->penjualan_kode }}</td>
                                <td>{{ $transaksi->created_at->format('d/m/Y H:i') }}</td>
                                <td>{{ $transaksi->user->nama }}</td>
                                <td>{{ $transaksi->detail->sum('jumlah') }}</td>
                                <td>Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</td>
                                <td>
                                    <button type="button" class="btn btn-info btn-sm"
                                        onclick="showDetail('{{ $transaksi->penjualan_id }}')">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center">Belum ada transaksi</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Detail Transaksi -->
<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModalLabel">Detail Transaksi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="detailContent">
                <!-- Content will be loaded here -->
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
    function showDetail(id) {
        $.ajax({
            url: "{{ url('/penjualan') }}/" + id + "/show_ajax",
            type: "GET",
            success: function (response) {
                $("#detailContent").html(response);
                $("#detailModal").modal('show');
            },
            error: function (xhr) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Terjadi kesalahan! Silakan coba lagi.'
                });
            }
        });
    }
</script>
@endpush

@push('css')
<style>
    .info-box {
        transition: transform 0.3s ease;
    }

    .info-box:hover {
        transform: translateY(-5px);
    }

    .table td,
    .table th {
        vertical-align: middle;
    }
</style>
@endpush --}}


{{-- @extends ('layouts.template')

@section('content')
<div class="card mr-3 ml-3">
    <div class="card-header">
        <h3 class="card-title">Halo, apakabar!!!</h3>
        <div class="card-tools"></div>
    </div>
    <div class="card-body">
        Elit ex nostrud nulla elit. Lorem quis proident commodo deserunt mollit ullamco adipisicing. Occaecat duis
        proident minim laborum Lorem nulla. Dolor quis velit consectetur est Lorem minim commodo et ut deserunt tempor
        do qui.
    </div>
</div>
@endsection --}}