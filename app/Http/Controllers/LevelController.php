<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LevelModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class LevelController extends Controller
{
    public function index()
    {
        $breadcrumbs = (object)[
            'title' => 'Daftar Level',
            'list' => ['Home', 'Level']
        ];

        $page = (object)[
            'title' => 'Daftar level'
        ];

        $activeMenu = 'level';
        $levels = LevelModel::all();

        return view('level.index', compact('breadcrumbs', 'page', 'activeMenu', 'levels'));
    }

    public function list(Request $request)
    {
        $levels = LevelModel::select('level_id', 'level_kode', 'level_nama');

        if ($request->level_id) {
            $levels->where('level_id', $request->level_id);
        }

        return DataTables::of($levels)
            ->addIndexColumn()
            ->addColumn('aksi', function ($level) {
                $btn = '<button onclick="modalAction(\'' . url('/level/' . $level->level_id . '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/level/' . $level->level_id . '/delete_ajax') . '\')" class="btn btn-danger btn-sm">Hapus</button> ';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function create_ajax()
    {
        return view('level.create_ajax');
    }

    public function update_ajax(Request $request, string $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'level_kode' => 'required|string|max:50|unique:m_level,level_kode,' . $id . ',level_id',
                'level_nama' => 'required|string|max:100|unique:m_level,level_nama,' . $id . ',level_id'
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi gagal.',
                    'msgField' => $validator->errors()
                ]);
            }

            $level = LevelModel::find($id);
            if ($level) {
                $level->update([
                    'level_kode' => $request->level_kode,
                    'level_nama' => $request->level_nama
                ]);

                return response()->json([
                    'status' => true,
                    'message' => 'Data level berhasil diperbarui'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data level tidak ditemukan'
                ]);
            }
        }
        return redirect('/level');
    }

    public function confirm_ajax(string $id)
    {
        $level = LevelModel::find($id);
        return view('level.confirm_ajax', compact('level'));
    }

    public function delete_ajax(Request $request, string $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $level = LevelModel::find($id);
            if ($level) {
                try {
                    $level->delete();
                    return response()->json([
                        'status' => true,
                        'message' => 'Data level berhasil dihapus'
                    ]);
                } catch (\Illuminate\Database\QueryException $e) {
                    return response()->json([
                        'status' => false,
                        'message' => 'Data level gagal dihapus karena masih terkait dengan data lain'
                    ]);
                }
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data level tidak ditemukan'
                ]);
            }
        }
        return redirect('/level');
    }
}

// DB:: insert('insert into m_level(level_kode, level_nama, created_at) values (?, ?, ?)', ['CUS', 'Pelanggan', now()]); 
// return 'Insert data baru berhasil';

// $row = DB::update('update m_level set level_nama = ? where level_kode = ?', ['Customer', 'CUS']); 
// return 'Update data berhasil. Jumlah data yang diupdate: '.$row.' baris';

// $row = DB:: delete('delete from m_level where level_kode = ?', ['CUS']); 
// return 'Delete data berhasil. Jumlah data yang dihapus: ' .$row.' baris';

// $data = DB::select('select*from m_level');
// return view('level', ['data' => $data]);

// public function create()
    // {
    //     $breadcrumbs = (object)[
    //         'title' => 'Tambah Level',
    //         'list' => ['Home', 'Level', 'Tambah']
    //     ];

    //     $page = (object)[
    //         'title' => 'Tambah level baru'
    //     ];

    //     $activeMenu = 'level';
    //     return view('level.create', compact('breadcrumbs', 'page', 'activeMenu'));
    // }

// public function store(Request $request)
    // {
    //     $request->validate([
    //         'level_kode' => 'required|string|max:50|unique:m_level,level_kode',
    //         'level_nama' => 'required|string|max:100|unique:m_level,level_nama'
    //     ]);

    //     LevelModel::create([
    //         'level_kode' => $request->level_kode,
    //         'level_nama' => $request->level_nama
    //     ]);

    //     return redirect('/level')->with('success', 'Level berhasil ditambahkan!');
    // }

    // public function edit(string $id)
    // {
    //     $level = LevelModel::find($id);

    //     $breadcrumbs = (object)[
    //         'title' => 'Edit Level',
    //         'list' => ['Home', 'Level', 'Edit']
    //     ];

    //     $page = (object)[
    //         'title' => 'Edit level'
    //     ];

    //     $activeMenu = 'level';

    //     return view('level.edit', compact('breadcrumbs', 'page', 'level', 'activeMenu'));
    // }

    // public function update(Request $request, string $id)
    // {
    //     $request->validate([
    //         'level_kode' => 'required|string|max:50|unique:m_level,level_kode,' . $id . ',level_id',
    //         'level_nama' => 'required|string|max:100|unique:m_level,level_nama,' . $id . ',level_id'
    //     ]);

    //     $level = LevelModel::find($id);
    //     $level->update([
    //         'level_kode' => $request->level_kode,
    //         'level_nama' => $request->level_nama
    //     ]);

    //     return redirect('/level')->with('success', 'Level berhasil diupdate!');
    // }

    // public function destroy(string $id)
    // {
    //     $check = LevelModel::find($id);

    //     if (!$check) {
    //         return redirect('/level')->with('error', 'Level tidak ditemukan!');
    //     }

    //     try {
    //         LevelModel::destroy($id);
    //         return redirect('/level')->with('success', 'Level berhasil dihapus!');
    //     } catch (\Illuminate\Database\QueryException $e) {
    //         return redirect('/level')->with('error', 'Level gagal dihapus karena masih terkait dengan data lain!');
    //     }
    // }