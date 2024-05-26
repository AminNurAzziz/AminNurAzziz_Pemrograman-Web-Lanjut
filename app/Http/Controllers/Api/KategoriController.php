<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KategoriModel;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;

class KategoriController extends Controller
{
    public function index(): JsonResponse
    {
        $kategoris = KategoriModel::all();
        return response()->json($kategoris, 200);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'kategori_kode' => 'required|unique:m_kategori|max:255',
            'kategori_nama' => 'required',
        ]);

        $kategori = KategoriModel::create($validated);
        return response()->json($kategori, 201);
    }

    public function show($id): JsonResponse
    {
        $kategori = KategoriModel::findOrFail($id);
        return response()->json($kategori, 200);
    }

    public function update(Request $request, $id): JsonResponse
    {
        $validated = $request->validate([
            'kategori_kode' => 'required|unique:m_kategori,kategori_kode,' . $id . ',kategori_id',
            'kategori_nama' => 'required',
        ]);

        $kategori = KategoriModel::findOrFail($id);
        $kategori->update($validated);
        return response()->json($kategori, 200);
    }

    public function destroy($id): JsonResponse
    {
        try {
            $kategori = KategoriModel::findOrFail($id);
            $kategori->delete();
            return response()->json(['message' => 'Kategori berhasil dihapus.'], 200);
        } catch (QueryException $e) {
            if ($e->errorInfo[1] == 1451) {
                return response()->json(['error' => 'Tidak dapat menghapus kategori karena ada data yang terkait.'], 409);
            }
            throw $e;
        }
    }
}
