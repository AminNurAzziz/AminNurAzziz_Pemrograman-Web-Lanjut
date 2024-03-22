<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\DataTables\KategoriDataTable;
use App\Models\KategoriModel;

class KategoriController extends Controller
{
    // public function index()
    // {
    //     /* $data = [
    //         'kategori_kode' => 'SNK',
    //         'kategori_nama' => 'Snack/Makanan Ringan',
    //         'created_at' => now()
    //     ];
    //     DB::table('m_kategori')->insert($data);
    //     return 'Insert data baru berhasil.'; */

    //     /* $row = DB::table('m_kategori')
    //         ->where('kategori_kode', 'SNK')
    //         ->update(['kategori_nama' => 'Camilan']);
    //         return 'Update data berhasil. Jumlah data yang diupdate: ' . $row. ' baris'; */

    //     /* $row = DB::table('m_kategori')
    //         ->where('kategori_kode', 'SNK')
    //         ->delete();
    //         return 'Delete data berhasil. Jumlah data yang dihapus: ' . $row. ' baris'; */

    //     $data = DB::table('m_kategori')->get();
    //     return view('kategori', ['data' => $data]);
    // }

    public function index(KategoriDataTable $dataTable)
    {
        return $dataTable->render('kategori.index');
    }

    public function create()
    {
        return view('kategori.create');
    }

    public function store(Request $request)
    {
        KategoriModel::create([
            'kategori_kode' => $request->kategori_kode,
            'kategori_nama' => $request->kategori_nama,
        ]);

        return redirect('/kategori');
    }

    public function updateForm($id)
    {
        $kategori = KategoriModel::findOrFail($id);
        return view('kategori.edit', compact('kategori'));
    }

    public function update(Request $request, $id)
    {
        $kategori = KategoriModel::findOrFail($id);
        $kategori->update([
            'kategori_kode' => $request->kategori_kode,
            'kategori_nama' => $request->kategori_nama,
        ]);

        return redirect('/kategori');
    }

    public function delete($id)
    {
        $kategori = KategoriModel::findOrFail($id);
        $kategori->delete();

        return redirect('/kategori');
    }
}
