<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StokModel as Stok;
use App\Models\BarangModel as Barang;
use App\Models\UserModel as User;
use Illuminate\Support\Facades\Log;

class StokController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Stok',
            'list' => ['Home', 'Stok']
        ];

        $page = (object) [
            'title' => 'Daftar stok yang terdaftar dalam sistem'
        ];

        $activeMenu = 'stok'; //set menu yg sedang aktif

        $stoks = $request = Stok::all();

        Log::info('Stok: ' . $stoks);

        return view('stok.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'stoks' => $stoks, 'activeMenu' => $activeMenu]);
    }

    public function create()
    {
        $barangs = Barang::all();
        $users = User::all();
        $activeMenu = 'Tambah Stok';
        $breadcrumb = (object) [
            'title' => 'Tambah Data',
            'list' => ['Home', 'Tambah Stok']
        ];
        return view('stok.create', ['activeMenu' => $activeMenu, 'breadcrumb' => $breadcrumb, 'barangs' => $barangs, 'users' => $users]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'barang_id' => 'required',
            'user_id' => 'required',
            'stok_tanggal' => 'required|date',
            'stok_jumlah' => 'required|integer',
        ]);

        Stok::create($request->all());

        return redirect()->route('stok.index')
            ->with('success', 'Stok berhasil ditambahkan.');
    }

    public function edit(Stok $stok)
    {
        $barangs = Barang::all();
        $users = User::all();
        $activeMenu = 'Edit Stok';
        $breadcrumb = (object) [
            'title' => 'Edit Data',
            'list' => ['Home', 'Edit Stok']
        ];

        return view('stok.edit', ['stok' => $stok, 'activeMenu' => $activeMenu, 'breadcrumb' => $breadcrumb, 'barangs' => $barangs, 'users' => $users]);
    }

    public function update(Request $request, Stok $stok)
    {
        $request->validate([
            'barang_id' => 'required',
            'user_id' => 'required',
            'stok_tanggal' => 'required|date',
            'stok_jumlah' => 'required|integer',
        ]);

        $stok->update($request->all());

        return redirect()->route('stok.index')
            ->with('success', 'Stok berhasil diperbarui.');
    }

    public function destroy(Stok $stok)
    {
        $stok->delete();

        return redirect()->route('stok.index')
            ->with('success', 'Stok berhasil dihapus.');
    }
}
