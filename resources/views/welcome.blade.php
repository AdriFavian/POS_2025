@extends('layouts.template')

@section('content')
    <div class="container-fluid" style="padding: 0px 20px">
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
                        <div class="stat-card-info">
                            <p class="stat-card-label">Total Penjualan Hari Ini</p>
                            <h3 class="stat-card-value">Rp {{ number_format($totalPenjualanHariIni, 0, ',', '.') }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Transaksi Terakhir -->
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-history mr-2"></i>
                            Transaksi Terakhir
                        </h3>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover table-sm"
                                style="table-layout: fixed; width: 100%;">
                                <colgroup>
                                    <col style="width: 15%;">
                                    <col style="width: 18%;">
                                    <col style="width: 20%;">
                                    <col style="width: 12%;">
                                    <col style="width: 20%;">
                                    <col style="width: 10%;">
                                </colgroup>
                                <thead>
                                    <tr>
                                        <th>No Transaksi</th>
                                        <th>Tanggal</th>
                                        <th>Kasir</th>
                                        <th class="text-center">Total Item</th>
                                        <th class="text-right">Total Harga</th>
                                        <th class="text-center">Detail</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($transaksiTerakhir as $transaksi)
                                        <tr>
                                            <td>
                                                <span class="font-weight-medium">{{ $transaksi->penjualan_kode }}</span>
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($transaksi->created_at)->format('d M Y, H:i') }}</td>
                                            <td>{{ $transaksi->user->nama }}</td>
                                            <td class="text-center">
                                                <span>{{ $transaksi->detail->sum('jumlah') }}</span>
                                            </td>
                                            <td class="text-right font-weight-medium">
                                                Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}
                                            </td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-sm btn-info"
                                                    onclick="showDetail('{{ $transaksi->penjualan_id }}')">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center py-3 text-muted">
                                                <i class="fas fa-info-circle mr-1"></i>
                                                Belum ada transaksi
                                            </td>
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
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <!-- Modal content will be loaded here via AJAX -->
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
                    $(".modal-content").html(response);
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
        /* Stats Cards */
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

        /* Table Improvements */
        .table {
            margin-bottom: 0;
        }

        .table thead th {
            border-bottom: 2px solid #dee2e6;
            font-weight: 600;
            color: #495057;
            background-color: #f8f9fa;
            padding: 0.65rem;
            vertical-align: middle;
            font-size: 0.9rem;
            white-space: nowrap;
        }

        .table tbody td {
            padding: 0.65rem;
            vertical-align: middle;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(0, 0, 0, 0.02);
        }

        .table-hover tbody tr:hover {
            background-color: rgba(0, 123, 255, 0.04);
        }

        .font-weight-medium {
            font-weight: 500;
        }

        /* Badge styling */
        .badge-info {
            background-color: #17a2b8;
            color: white;
            padding: 0.35em 0.65em;
            font-size: 80%;
        }

        /* Button Styling */
        .btn-info {
            background-color: #17a2b8;
            border-color: #17a2b8;
            transition: all 0.2s ease;
        }

        .btn-info:hover {
            background-color: #138496;
            border-color: #117a8b;
        }

        /* Modal Improvements */
        .modal-content {
            border: none;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .modal-header {
            border-bottom: 1px solid #f5f5f5;
            padding: 1rem;
        }

        .modal-title {
            font-weight: 600;
            font-size: 1.1rem;
        }

        .modal-body {
            padding: 1.25rem;
        }

        .modal-footer {
            border-top: 1px solid #f5f5f5;
            padding: 0.75rem 1rem;
        }

        /* Card styling consistent with modal */
        .card {
            border: none;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
            margin-bottom: 1.5rem;
        }

        .card-header {
            padding: 0.75rem 1.25rem;
            background-color: rgba(0, 0, 0, 0.02);
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .card-title {
            margin-bottom: 0;
            font-size: 1rem;
            font-weight: 600;
        }

        .card-body {
            padding: 1.25rem;
        }

        .card-outline.card-primary {
            border-top: 2px solid #90c5ff;
        }
    </style>
@endpush