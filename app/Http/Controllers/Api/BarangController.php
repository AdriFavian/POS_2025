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

    // Try Catch
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kategori_id' => 'required',
            'barang_kode' => 'required|unique:m_barang,barang_kode',
            'barang_nama' => 'required',
            'harga_beli' => 'required|numeric',
            'harga_jual' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal INI TRY CATCH ',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
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
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan pada server',
                'error' => $e->getMessage()
            ], 500);
        }
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
            'barang_kode' => 'sometimes|required|unique:m_barang,barang_kode,' . $id . ',barang_id',
            'barang_nama' => 'sometimes|required',
            'harga_beli' => 'sometimes|required|numeric',
            'harga_jual' => 'sometimes|required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
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
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan pada server',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy(BarangModel $barang)
    {
        try {
            $barang->delete();
            return response()->json([
                'success' => true,
                'message' => 'Data terhapus',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan pada server',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}