<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\DataTables\KategoriDataTable;
use App\Http\Requests\StorePostRequest;
use App\Models\KategoriModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

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
        $activeMenu = 'kategori';
        $breadcrumb = (object) [
            'title' => 'Kategori Data',
            'list' => ['Home', 'Kategori']
        ];
        return $dataTable->render('kategori.index', ['activeMenu' => $activeMenu, 'breadcrumb' => $breadcrumb]);
    }

    public function create()
    {
        $activeMenu = 'kategori';
        $breadcrumb = (object) [
            'title' => 'Tambah Kategori',
            'list' => ['Home', 'Kategori', 'Tambah']
        ];
        return view('kategori.create', ['activeMenu' => $activeMenu, 'breadcrumb' => $breadcrumb]);
    }

    public function store(StorePostRequest  $request): RedirectResponse
    {
        // $validated = $request->validate([
        //     'kategori_kode' => 'required',
        //     'kategori_nama' => 'required',
        // ]);

        // $request->validate([
        //     'kategori_kode' => 'bail|required|unique:m_kategori|max:255', // 'bail' stops running validation rules if one of them fails
        //     'kategori_nama' => ['required'],
        // ]);

        // $validatedData = $request->validateWithBag('post', [
        //     'kategori_kode' => ['required', 'unique:posts,max:255'],
        //     'kategori_nama' => ['required'],
        // ])

        $validated = $request->validated();

        $validated = $request->safe()->only(['kategori_kode', 'kategori_nama']);
        // $validated = $request->safe()->except(['kategori_kode', 'kategori_nama']);

        KategoriModel::create([
            'kategori_kode' => $validated['kategori_kode'],
            'kategori_nama' => $validated['kategori_nama'],
        ]);

        return redirect('/kategori');
    }

    public function updateForm($id)
    {
        $kategori = KategoriModel::findOrFail($id);
        $activeMenu = 'kategori';
        $breadcrumb = (object) [
            'title' => 'Edit Kategori',
            'list' => ['Home', 'Kategori', 'Edit']
        ];

        return view('kategori.edit', ['kategori' => $kategori, 'activeMenu' => $activeMenu, 'breadcrumb' => $breadcrumb]);
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
        try {
            $kategori = KategoriModel::findOrFail($id);
            $kategori->delete();
            return Redirect::back()->with('success', 'Kategori berhasil dihapus.');
        } catch (\Exception $e) {
            return Redirect::back()->with('error', 'Kategori gagal dihapus.');
        }
    }
}
