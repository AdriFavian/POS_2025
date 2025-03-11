<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KategoriModel;;
use Illuminate\Support\Facades\DB;
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

        return view('kategori.index', compact('breadcrumbs', 'page', 'activeMenu'));
    }

    public function list()
    {
        // Ambil data dari tabel m_kategori
        $kategories = KategoriModel::select('kategori_id', 'kategori_kode', 'kategori_nama');

        return DataTables::of($kategories)
            ->addIndexColumn()
            ->addColumn('aksi', function ($kategori) {
                // Tombol edit & hapus
                $btn = '<a href="' . url('/kategori/' . $kategori->kategori_id . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> ';
                $btn .= '<form class="d-inline-block" method="POST" action="' . url('/kategori/' . $kategori->kategori_id) . '">'
                    . csrf_field() . method_field('DELETE') .
                    '<button type="submit" class="btn btn-danger btn-sm" 
                    onclick="return confirm(\'Apakah Anda yakin menghapus kategori ini?\');">Hapus</button></form>';

                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function create()
    {
        $breadcrumbs = (object)[
            'title' => 'Tambah Kategori',
            'list'  => ['Home', 'Kategori', 'Tambah']
        ];

        $page = (object)[
            'title' => 'Tambah kategori baru'
        ];

        $activeMenu = 'kategori';

        return view('kategori.create', compact('breadcrumbs', 'page', 'activeMenu'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori_kode' => 'required|string|max:50|unique:m_kategori,kategori_kode',
            'kategori_nama' => 'required|string|max:100|unique:m_kategori,kategori_nama'
        ]);

        KategoriModel::create([
            'kategori_kode' => $request->kategori_kode,
            'kategori_nama' => $request->kategori_nama
        ]);

        return redirect('/kategori')->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function edit(string $id)
    {
        $kategori = KategoriModel::findOrFail($id);

        $breadcrumbs = (object)[
            'title' => 'Edit Kategori',
            'list'  => ['Home', 'Kategori', 'Edit']
        ];

        $page = (object)[
            'title' => 'Edit kategori'
        ];

        $activeMenu = 'kategori';

        return view('kategori.edit', compact('breadcrumbs', 'page', 'kategori', 'activeMenu'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'kategori_kode' => 'required|string|max:50|unique:m_kategori,kategori_kode,' . $id . ',kategori_id',
            'kategori_nama' => 'required|string|max:100|unique:m_kategori,kategori_nama,' . $id . ',kategori_id'
        ]);

        // $kategori = KategoriModel::findOrFail($id);
        $kategori = KategoriModel::where('kategori_id', $id)->firstOrFail();
        $kategori->update([
            'kategori_kode' => $request->kategori_kode,
            'kategori_nama' => $request->kategori_nama
        ]);

        return redirect('/kategori')->with('success', 'Kategori berhasil diperbarui!');
    }

    public function destroy(string $id)
    {
        // $kategori = KategoriModel::find($id);
        $kategori = KategoriModel::where('kategori_id', $id)->first();

        if (!$kategori) {
            return redirect('/kategori')->with('error', 'Kategori tidak ditemukan!');
        }

        try {
            $kategori->delete();
            return redirect('/kategori')->with('success', 'Kategori berhasil dihapus!');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/kategori')->with('error', 'Kategori gagal dihapus karena masih terkait dengan data lain!');
        }
    }
}

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