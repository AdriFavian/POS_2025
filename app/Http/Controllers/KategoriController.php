<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KategoriModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class KategoriController extends Controller
{
    public function index()
    {
        $breadcrumbs = (object)[
            'title' => 'Daftar Kategori',
            'list'  => ['Home', 'Kategori']
        ];

        $page = (object)[
            'title' => 'Daftar Kategori'
        ];

        $activeMenu = 'kategori';

        $categories = KategoriModel::all();

        return view('kategori.index', compact('breadcrumbs', 'page', 'activeMenu', 'categories'));
    }

    public function list(Request $request)
    {
        // Ambil data dari tabel m_kategori
        $categories = KategoriModel::select('kategori_id', 'kategori_kode', 'kategori_nama');

        if ($request->kategori_id) {
            $categories->where('kategori_id', $request->kategori_id);
        }

        return DataTables::of($categories)
            ->addIndexColumn()
            ->addColumn('aksi', function ($kategori) {
                // Tombol edit & hapus
                $btn  = '<button onclick="modalAction(\'' . url('/kategori/' . $kategori->kategori_id . '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/kategori/' . $kategori->kategori_id . '/delete_ajax') . '\')" class="btn btn-danger btn-sm">Hapus</button>';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function create_ajax()
    {
        return view('kategori.create_ajax');
    }

    public function store_ajax(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'kategori_kode' => 'required|string|max:50|unique:m_kategori,kategori_kode',
                'kategori_nama' => 'required|string|max:100|unique:m_kategori,kategori_nama'
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status'   => false,
                    'message'  => 'Validasi gagal.',
                    'msgField' => $validator->errors()
                ]);
            }

            KategoriModel::create([
                'kategori_kode' => $request->kategori_kode,
                'kategori_nama' => $request->kategori_nama
            ]);

            return response()->json([
                'status'  => true,
                'message' => 'Data kategori berhasil disimpan.'
            ]);
        }

        return redirect('/kategori');
    }

    public function edit_ajax($id)
    {
        $kategori = KategoriModel::find($id);
        return view('kategori.edit_ajax', compact('kategori'));
    }

    public function update_ajax(Request $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'kategori_kode' => 'required|string|max:50|unique:m_kategori,kategori_kode,'.$id.',kategori_id',
                'kategori_nama' => 'required|string|max:100|unique:m_kategori,kategori_nama,'.$id.',kategori_id'
            ];

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'status'   => false,
                    'message'  => 'Validasi gagal.',
                    'msgField' => $validator->errors()
                ]);
            }

            $kategori = KategoriModel::find($id);
            if ($kategori) {
                $kategori->update([
                    'kategori_kode' => $request->kategori_kode,
                    'kategori_nama' => $request->kategori_nama
                ]);

                return response()->json([
                    'status'  => true,
                    'message' => 'Data kategori berhasil diperbarui.'
                ]);
            } else {
                return response()->json([
                    'status'  => false,
                    'message' => 'Data kategori tidak ditemukan.'
                ]);
            }
        }
        return redirect('kategori/');
    }

    public function confirm_ajax($id)
    {
        $kategori = KategoriModel::find($id);
        return view('kategori.confirm_ajax', compact('kategori'));
    }

    public function delete_ajax(Request $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $kategori = KategoriModel::find($id);
            if ($kategori) {
                try {
                    $kategori->delete();
                    return response()->json([
                        'status'  => true,
                        'message' => 'Data kategori berhasil dihapus.'
                    ]);
                } catch (\Illuminate\Database\QueryException $e) {
                    return response()->json([
                        'status'  => false,
                        'message' => 'Data kategori gagal dihapus karena masih terkait dengan data lain.'
                    ]);
                }
            } else {
                return response()->json([
                    'status'  => false,
                    'message' => 'Data kategori tidak ditemukan.'
                ]);
            }
        }
        return redirect('/kategori');
    }
}

    // public function update(Request $request, string $id)
    // {
    //     $request->validate([
    //         'kategori_kode' => 'required|string|max:50|unique:m_kategori,kategori_kode,' . $id . ',kategori_id',
    //         'kategori_nama' => 'required|string|max:100|unique:m_kategori,kategori_nama,' . $id . ',kategori_id'
    //     ]);

    //     // $kategori = KategoriModel::findOrFail($id);
    //     $kategori = KategoriModel::where('kategori_id', $id)->firstOrFail();
    //     $kategori->update([
    //         'kategori_kode' => $request->kategori_kode,
    //         'kategori_nama' => $request->kategori_nama
    //     ]);

    //     return redirect('/kategori')->with('success', 'Kategori berhasil diperbarui!');
    // }

    // public function destroy(string $id)
    // {
    //     // $kategori = KategoriModel::find($id);
    //     $kategori = KategoriModel::where('kategori_id', $id)->first();

    //     if (!$kategori) {
    //         return redirect('/kategori')->with('error', 'Kategori tidak ditemukan!');
    //     }

    //     try {
    //         $kategori->delete();
    //         return redirect('/kategori')->with('success', 'Kategori berhasil dihapus!');
    //     } catch (\Illuminate\Database\QueryException $e) {
    //         return redirect('/kategori')->with('error', 'Kategori gagal dihapus karena masih terkait dengan data lain!');
    //     }
    // }

// $data = [ 
//     'kategori_kode' => 'SNK', 
//     'kategori_nama' => 'Snack/Makanan Ringan', 
//     'created_at' => now() 
// ]; 
// DB::table('m_kategori')->insert($data); 
// return 'Insert data baru berhasil';

// $row = DB::table('m_kategori')->where('kategori_kode', 'SNK')->update(['kategori_nama' => 'Camilan']); 
// return 'Update data berhasil. Jumlah data yang diupdate: '.$row.' baris';

// $row = DB::table('m_kategori')->where('kategori_kode', 'SNK')->delete(); 
// return 'Delete data berhasil. Jumlah data yang dihapus: '.$row.' baris';

// $data = DB::table('m_kategori')->get(); 
// return view('kategori', ['data' => $data]);


    // public function edit(string $id)
    // {
    //     $kategori = KategoriModel::findOrFail($id);

    //     $breadcrumbs = (object)[
    //         'title' => 'Edit Kategori',
    //         'list'  => ['Home', 'Kategori', 'Edit']
    //     ];

    //     $page = (object)[
    //         'title' => 'Edit kategori'
    //     ];

    //     $activeMenu = 'kategori';

    //     return view('kategori.edit', compact('breadcrumbs', 'page', 'kategori', 'activeMenu'));
    // }

    