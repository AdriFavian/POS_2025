<?php

namespace App\Http\Controllers;

use App\Models\PenjualanModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Barryvdh\DomPDF\Facade\Pdf;
use Yajra\DataTables\Facades\DataTables;


class PenjualanController extends Controller
{
    public function index()
    {
        $breadcrumbs = (object) [
            'title' => 'Daftar Penjualan',
            'list' => ['Home', 'Penjualan'],
        ];
        $page = (object) [
            'title' => 'Daftar penjualan',
        ];

        $activeMenu = 'penjualan';

        // Ambil data user untuk filter
        $users = UserModel::select('user_id')->get();


        return view('penjualan.index', compact('breadcrumbs', 'page', 'activeMenu', 'users'));
    }

    public function list(Request $request)
    {
        $penjualan = PenjualanModel::select('penjualan_id', 'penjualan_kode', 'total_harga', 'pembeli', 'penjualan_tanggal', 'user_id')->with('user');

        // Filter berdasarkan user_id jika ada
        if ($request->filled('user_id')) {
            $penjualan->where('user_id', $request->user_id);
        }

        return DataTables::of($penjualan)
            ->addIndexColumn()
            ->addColumn('user_name', function ($p) {
                return $p->user ? $p->user->nama : '-';
            })
            ->addColumn('aksi', function ($p) {
                $btn = '<button onclick="modalAction(\'' . url('/penjualan/' . $p->penjualan_id . '/show_ajax') . '\')" class="btn btn-info btn-sm">Detail</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/penjualan/' . $p->penjualan_id . '/delete_ajax') . '\')" class="btn btn-danger btn-sm">Hapus</button> ';

                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function show_ajax($id)
    {
        // Memuat data penjualan beserta relasi user dan detail (termasuk barang)
        $penjualan = PenjualanModel::with(['user', 'detail.barang'])->find($id);

        // Mengembalikan view show_ajax (misalnya resources/views/penjualan/show_ajax.blade.php)
        return view('penjualan.show_ajax', compact('penjualan'));
    }

    public function confirm_ajax($id)
    {
        // Cari data penjualan berdasarkan id
        $penjualan = PenjualanModel::find($id);
        // Kembalikan view konfirmasi hapus via AJAX
        return view('penjualan.confirm_ajax', compact('penjualan'));
    }

    public function delete_ajax(Request $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $penjualan = PenjualanModel::find($id);
            if ($penjualan) {
                try {
                    $penjualan->delete();

                    return response()->json([
                        'status' => true,
                        'message' => 'Data penjualan berhasil dihapus.',
                    ]);
                } catch (\Illuminate\Database\QueryException $e) {
                    return response()->json([
                        'status' => false,
                        'message' => 'Data penjualan gagal dihapus karena masih terkait dengan data lain.',
                    ]);
                }
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data penjualan yang dimaksud tidak ditemukan. Pastikan ID yang Anda masukkan benar.'
                ]);
            }
        }
        return redirect('/');
    }

    public function export_pdf()
    {
        $penjualan = PenjualanModel::with(['user', 'detail.barang'])->orderBy('penjualan_tanggal', 'desc')->get();

        $pdf = Pdf::loadView('penjualan.export_pdf', ['penjualan' => $penjualan]);
        $pdf->setPaper('a4', 'portrait');

        return $pdf->stream('Data_Penjualan_' . date('Ymd_His') . '.pdf');
    }

    public function export_excel()
    {
        // Ambil data penjualan beserta relasi (pastikan relasi sudah didefinisikan di model PenjualanModel)
        $penjualan = PenjualanModel::with(['user', 'detail.barang'])
            ->orderBy('penjualan_tanggal', 'desc')
            ->get();

        // Buat objek Spreadsheet baru
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set header kolom
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Kode Penjualan');
        $sheet->setCellValue('C1', 'Pembeli');
        $sheet->setCellValue('D1', 'Tanggal');
        $sheet->setCellValue('E1', 'User');
        $sheet->setCellValue('F1', 'Total Harga');

        // Buat header bold
        $sheet->getStyle('A1:F1')->getFont()->setBold(true);

        // Isi data penjualan
        $no = 1;
        $row = 2;
        foreach ($penjualan as $p) {
            $sheet->setCellValue('A' . $row, $no);
            $sheet->setCellValue('B' . $row, $p->penjualan_kode);
            $sheet->setCellValue('C' . $row, $p->pembeli);
            $sheet->setCellValue('D' . $row, \Carbon\Carbon::parse($p->penjualan_tanggal)->format('Y-m-d'));
            $sheet->setCellValue('E' . $row, $p->user->nama ?? '-');
            $sheet->setCellValue('F' . $row, $p->total_harga);
            $no++;
            $row++;
        }

        // Set auto-size untuk kolom A sampai F
        foreach (range('A', 'F') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }

        // Set judul sheet
        $sheet->setTitle('Data Penjualan');

        // Buat writer untuk file Excel
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $filename = 'Data_Penjualan_' . date('Y-m-d_H-i-s') . '.xlsx';

        // Atur header HTTP untuk file download
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        header('Cache-Control: max-age=1');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
        header('Cache-Control: cache, must-revalidate');
        header('Pragma: public');

        // Tampilkan file Excel untuk diunduh
        $writer->save('php://output');
        exit;
    }

    public function create_ajax()
    {
        $users = UserModel::all();
        $barang = \App\Models\BarangModel::all();
        return view('penjualan.create_ajax', compact('users', 'barang'));
    }

    public function store_ajax(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:m_user,user_id',
            'pembeli' => 'required|string|max:50',
            'penjualan_tanggal' => 'required|date',
            'barang_id.*' => 'required|exists:m_barang,barang_id',
            'harga.*' => 'required|integer|min:0',
            'jumlah.*' => 'required|integer|min:1',
        ]);

        try {
            // Generate kode penjualan unik
            $kode = strtoupper(\Illuminate\Support\Str::random(10));

            $penjualan = PenjualanModel::create([
                'user_id' => $request->user_id,
                'pembeli' => $request->pembeli,
                'penjualan_kode' => $kode,
                'penjualan_tanggal' => $request->penjualan_tanggal,
                'total_harga' => 0,
            ]);

            $total = 0;
            foreach ($request->barang_id as $i => $barang_id) {
                $harga = $request->harga[$i];
                $jumlah = $request->jumlah[$i];
                $subtotal = $harga * $jumlah;
                $penjualan->detail()->create([
                    'barang_id' => $barang_id,
                    'harga' => $harga,
                    'jumlah' => $jumlah,
                ]);
                $total += $subtotal;
            }
            $penjualan->update(['total_harga' => $total]);

            return response()->json(['success' => true, 'message' => 'Transaksi penjualan berhasil ditambahkan.']);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan pada server',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
