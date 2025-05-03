<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BarangModel;
use Illuminate\Support\Facades\Validator;

class BarangController extends Controller
{
    public function index()
    {
        return BarangModel::all();
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kategori_id' => 'required',
            'barang_kode' => 'required',
            'barang_nama' => 'required',
            'harga_beli' => 'required|numeric',
            'harga_jual' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $data = $request->only(['kategori_id', 'barang_kode', 'barang_nama', 'harga_beli', 'harga_jual']);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image->storeAs('public/barang', $image->hashName());
            $data['image'] = $image->hashName();
        }

        $barang = BarangModel::create($data);

        return response()->json([
            'success' => true,
            'barang' => $barang
        ], 201);
    }

    public function show(BarangModel $barang)
    {
        return BarangModel::find($barang);
    }

    public function update(Request $request, $id)
    {
        $barang = BarangModel::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'kategori_id' => 'sometimes|required',
            'barang_kode' => 'sometimes|required',
            'barang_nama' => 'sometimes|required',
            'harga_beli' => 'sometimes|required|numeric',
            'harga_jual' => 'sometimes|required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $data = $request->only(['kategori_id', 'barang_kode', 'barang_nama', 'harga_beli', 'harga_jual']);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image->storeAs('public/barang', $image->hashName());
            $data['image'] = $image->hashName();
        }

        $barang->update($data);

        return response()->json([
            'success' => true,
            'barang' => $barang
        ]);
    }

    public function destroy(BarangModel $barang)
    {
        $barang->delete();
        return response()->json([
            'success' => true,
            'message' => 'Data terhapus',
        ]);
    }
}



// namespace App\Http\Controllers\Api;

// use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;
// use App\Models\BarangModel;
// use Illuminate\Support\Facades\Validator;

// class BarangController extends Controller
// {
//     public function index()
//     {
//         return BarangModel::all();
//     }

//     public function store(Request $request)
//     {
//         $barang = BarangModel::create($request->all());
//         return response()->json($barang, 201);
//     }
//     public function show(BarangModel $barang)
//     {
//         return BarangModel::find($barang);
//     }
//     public function update(Request $request, BarangModel $barang)
//     {
//         $barang->update($request->all());
//         return BarangModel::find($barang);
//     }
//     public function destroy(BarangModel $barang)
//     {
//         $barang->delete();
//         return response()->json([
//             'success' => true,
//             'message' => 'Data terhapus',
//         ]);
//     }
// }
