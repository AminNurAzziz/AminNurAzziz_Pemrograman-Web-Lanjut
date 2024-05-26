<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\BarangModel;

use Illuminate\Database\QueryException;

use Illuminate\Http\JsonResponse;
use App\Models\BarangModel as Barang;
use Illuminate\Support\Facades\Log;

class BarangController extends Controller

{

    public function index(): JsonResponse

    {

        $barangs = BarangModel::all();

        return response()->json($barangs, 200);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'kategori_id' => 'required',
            'barang_kode' => 'required|unique:m_barang',
            'barang_nama' => 'required',
            'harga_beli' => 'required',
            'harga_jual' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imagePath = $request->file('image')->store('images', 'public');
        $baseName = basename($imagePath);
        $barang = Barang::create([
            'kategori_id' => $request->kategori_id,
            'barang_kode' => $request->barang_kode,
            'barang_nama' => $request->barang_nama,
            'harga_beli' => $request->harga_beli,
            'harga_jual' => $request->harga_jual,
            'image' => $baseName,
        ]);

        Log::info('Barang created: ' . $barang->barang_id);

        return response()->json($barang, 201);
    }

    public function show($id): JsonResponse

    {

        $barang = BarangModel::findOrFail($id);

        return response()->json($barang, 200);
    }

    public function update(Request $request, $id): JsonResponse
    {
        try {
            // Validasi request
            $validated = $request->validate([
                'kategori_id' => 'required',
                'barang_nama' => 'required',
                'harga_beli' => 'required',
                'harga_jual' => 'required',
            ]);

            // Ambil data barang yang akan diperbarui
            $barang = BarangModel::findOrFail($id);

            // Cek apakah ada perubahan pada kode barang
            if ($request->has('barang_kode') && $request->input('barang_kode') !== $barang->barang_kode) {
                // Validasi unik hanya jika ada perubahan pada kode barang
                $request->validate([
                    'barang_kode' => 'required|unique:m_barang,barang_kode,' . $id . ',barang_id',
                ]);
                $validated['barang_kode'] = $request->input('barang_kode');
            }

            // Perbarui atribut-atribut barang dengan data yang divalidasi
            $barang->update($validated);

            // Return response dengan status 200 (OK) dan data barang yang diperbarui
            return response()->json($barang, 200);
        } catch (QueryException $e) {
            // Jika terjadi error saat melakukan query ke database
            // return response dengan status 500 (Internal Server Error) dan pesan error
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }



    public function destroy($id): JsonResponse

    {

        try {

            $barang = BarangModel::findOrFail($id);

            $barang->delete();

            return response()->json(['message' => 'Barang berhasil dihapus.'], 200);
        } catch (QueryException $e) {

            if ($e->errorInfo[1] == 1451) {

                return response()->json(['error' => 'Tidak dapat menghapus barang karena ada data yang terkait.'], 409);
            }

            throw $e;
        }
    }
}
