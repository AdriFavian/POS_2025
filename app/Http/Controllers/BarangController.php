<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BarangModel;
use App\Models\KategoriModel;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class BarangController extends Controller
{
    public function index()
    {
        $breadcrumbs = (object)[
            'title' => 'Daftar Barang',
            'list'  => ['Home', 'Barang']
        ];

        $page = (object)[
            'title' => 'Daftar barang'
        ];

        $activeMenu = 'barang';

        $kategori = KategoriModel::all();

        return view('barang.index', compact('breadcrumbs', 'page', 'activeMenu', 'kategori'));
    }

    public function list(Request $request)
    {
        $items = BarangModel::with('kategori')->select('m_barang.*');

        if ($request->filled('kategori_id')) {
            $items->where('kategori_id', $request->kategori_id);
        }

        return DataTables::of($items)
            ->addIndexColumn()
            ->addColumn('kategori', function ($barang) {
                return $barang->kategori ? $barang->kategori->kategori_nama : '-';
            })
            ->addColumn('aksi', function ($barang) {
                $btn = '<button onclick="modalAction(\'' . url('/barang/' . $barang->barang_id . '/show_ajax') . '\')" class="btn btn-info btn-sm">Detail</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/barang/' . $barang->barang_id . '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/barang/' . $barang->barang_id . '/delete_ajax') . '\')" class="btn btn-danger btn-sm">Hapus</button> ';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function create_ajax()
    {
        $kategori = KategoriModel::all();
        return view('barang.create_ajax', compact('kategori'));
    }

    public function store_ajax(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'kategori_id' => 'required|integer',
                'barang_kode' => 'required|string|max:50|unique:m_barang,barang_kode',
                'barang_nama' => 'required|string|max:100',
                'harga_beli'  => 'required|numeric',
                'harga_jual'  => 'required|numeric'
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi gagal.',
                    'msgField' => $validator->errors()
                ]);
            }

            BarangModel::create([
                'kategori_id' => $request->kategori_id,
                'barang_kode' => $request->barang_kode,
                'barang_nama' => $request->barang_nama,
                'harga_beli'  => $request->harga_beli,
                'harga_jual'  => $request->harga_jual
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Data barang berhasil disimpan.'
            ]);
        }
        return redirect('/');
    }


    public function show_ajax($id)
    {
        $barang = BarangModel::with('kategori')->find($id);
        return view('barang.show_ajax', compact('barang'));
    }

    public function edit_ajax($id)
    {
        $barang = BarangModel::find($id);
        $kategori = KategoriModel::all();
        return view('barang.edit_ajax', compact('barang', 'kategori'));
    }


    public function update_ajax(Request $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'kategori_id' => 'required|integer',
                'barang_kode' => 'required|string|max:50|unique:m_barang,barang_kode,' . $id . ',barang_id',
                'barang_nama' => 'required|string|max:100',
                'harga_beli' => 'required|numeric',
                'harga_jual' => 'required|numeric'
            ];

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi gagal.',
                    'msgField' => $validator->errors()
                ]);
            }

            $barang = BarangModel::find($id);
            if ($barang) {
                $barang->update([
                    'kategori_id' => $request->kategori_id,
                    'barang_kode' => $request->barang_kode,
                    'barang_nama' => $request->barang_nama,
                    'harga_beli' => $request->harga_beli,
                    'harga_jual' => $request->harga_jual
                ]);

                return response()->json([
                    'status' => true,
                    'message' => 'Data barang berhasil diperbarui.'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data barang tidak ditemukan.'
                ]);
            }
        }
        return redirect('/');
    }

    public function confirm_ajax($id)
    {
        $barang = BarangModel::find($id);
        return view('barang.confirm_ajax', compact('barang'));
    }

    public function delete_ajax(Request $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $barang = BarangModel::find($id);
            if ($barang) {
                try {
                    $barang->delete();
                    return response()->json([
                        'status' => true,
                        'message' => 'Data barang berhasil dihapus.'
                    ]);
                } catch (\Illuminate\Database\QueryException $e) {
                    return response()->json([
                        'status' => false,
                        'message' => 'Data barang gagal dihapus karena masih terkait dengan data lain.'
                    ]);
                }
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data barang tidak ditemukan.'
                ]);
            }
        }
        return redirect('/');
    }
}

// public function update(Request $request, $id)
// {
    //     $request->validate([
        //         'kategori_id' => 'required|integer',
        //         'barang_kode' => 'required|string|max:50|unique:m_barang,barang_kode,' . $id . ',barang_id',
        //         'barang_nama' => 'required|string|max:100',
//         'harga_beli' => 'required|numeric',
//         'harga_jual' => 'required|numeric'
//     ]);

//     $barang = BarangModel::findOrFail($id);
//     $barang->update([
    //         'kategori_id' => $request->kategori_id,
    //         'barang_kode' => $request->barang_kode,
    //         'barang_nama' => $request->barang_nama,
    //         'harga_beli' => $request->harga_beli,
    //         'harga_jual' => $request->harga_jual
    //     ]);
    
    //     return redirect('/barang')->with('success', 'Data barang berhasil diperbarui!');
    // }
    
    // public function destroy($id)
    // {
        //     $barang = BarangModel::find($id);
        
        //     if (!$barang) {
//         return redirect('/barang')->with('error', 'Data barang tidak ditemukan!');
//     }

//     try {
    //         $barang->delete();
    //         return redirect('/barang')->with('success', 'Data barang berhasil dihapus!');
    //     } catch (\Illuminate\Database\QueryException $e) {
        //         return redirect('/barang')->with('error', 'Data barang gagal dihapus karena masih terkait dengan data lain!');
        //     }
        // }
// public function edit($id)
// {
//     $breadcrumbs = (object)[
//         'title' => 'Edit Barang',
//         'list' => ['Home', 'Barang', 'Edit']
//     ];

//     $page = (object)[
//         'title' => 'Edit barang'
//     ];

//     $activeMenu = 'barang';

//     $barang = BarangModel::findOrFail($id);
//     $kategori = KategoriModel::all();

//     return view('barang.edit', compact('breadcrumbs', 'page', 'activeMenu', 'barang', 'kategori'));
// }

// public function create()
    // {
    //     $breadcrumbs = (object)[
    //         'title' => 'Tambah Barang',
    //         'list'  => ['Home', 'Barang', 'Tambah']
    //     ];

    //     $page = (object)[
    //         'title' => 'Tambah barang baru'
    //     ];

    //     $activeMenu = 'barang';

    //     // untuk dropdown menu
    //     $kategori = KategoriModel::all();

    //     return view('barang.create', compact('breadcrumbs', 'page', 'activeMenu', 'kategori'));
    // }


    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'kategori_id'=> 'required|integer',
    //         'barang_kode'=> 'required|string|max:50|unique:m_barang,barang_kode',
    //         'barang_nama'=> 'required|string|max:100',
    //         'harga_beli' => 'required|numeric',
    //         'harga_jual' => 'required|numeric'
    //     ]);

    //     BarangModel::create([
    //         'kategori_id'=> $request->kategori_id,
    //         'barang_kode'=> $request->barang_kode,
    //         'barang_nama'=> $request->barang_nama,
    //         'harga_beli' => $request->harga_beli,
    //         'harga_jual' => $request->harga_jual
    //     ]);

    //     return redirect('/barang')->with('success', 'Data barang berhasil ditambahkan!');
    // }