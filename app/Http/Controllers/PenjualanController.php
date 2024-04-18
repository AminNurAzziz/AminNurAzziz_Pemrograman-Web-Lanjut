<?php

namespace App\Http\Controllers;

use App\Models\BarangModel as Barang;
use App\Models\PenjualanModel as Penjualan;
use App\Models\PenjualanDetailModel as PenjualanDetail;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

class PenjualanController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Penjualan',
            'list' => ['Home', 'Penjualan']
        ];

        $page = (object) [
            'title' => 'Daftar penjualan yang terdaftar'
        ];

        $activeMenu = 'penjualan'; //set menu yg sedang aktif

        $penjualan = Penjualan::with('user', 'details')->get();

        return view('penjualan.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'penjualan' => $penjualan, 'activeMenu' => $activeMenu]);

        // // $penjualan = Penjualan::with('user', 'details')->get();
        // // dd($penjualan);
    }

    public function create()
    {
        $barangs = Barang::all();
        return view('penjualan.create', compact('barangs'));
    }

    public function store(Request $request)
    {
        // Decode JSON string into array
        $barang_id_array = json_decode($request->barang_id, true);

        // Check if $barang_id_array is not an array or empty
        if (!is_array($barang_id_array) || empty($barang_id_array)) {
            return redirect()->back()->withErrors('Daftar barang tidak valid.');
        }

        $request->validate([
            'pembeli' => 'required|string|max:50',
            'penjualan_tanggal' => 'required|date',
            'barang_id' => 'required|string', // Validation for JSON string
        ]);

        $penjualan_kode = 'PNJ' . date('YmdHis');
        $penjualan = Penjualan::create([
            'user_id' => '1', // Hardcoded '1' as 'user_id' because there is no authentication in this project
            'pembeli' => $request->pembeli,
            'penjualan_kode' => $penjualan_kode,
            'penjualan_tanggal' => $request->penjualan_tanggal,
        ]);

        foreach ($barang_id_array as $barang) {
            PenjualanDetail::create([
                'penjualan_id' => $penjualan->penjualan_id,
                'barang_id' => $barang['id'],
                'harga' => $barang['harga'],
                'jumlah' => $barang['jumlah'],
            ]);
        }

        return redirect()->route('penjualan.index')
            ->with('success', 'Penjualan berhasil ditambahkan.');
    }


    public function show(Penjualan $penjualan)
    {
        return view('penjualan.show', compact('penjualan'));
    }

    public function edit(Penjualan $penjualan)
    {
        $barangs = Barang::all();
        $activeMenu = 'penjualan';
        $breadcrumb = (object) [
            'title' => 'Edit Penjualan',
            'list' => ['Home', 'Penjualan', 'Edit']
        ];

        return view('penjualan.edit', ['penjualan' => $penjualan, 'activeMenu' => $activeMenu, 'breadcrumb' => $breadcrumb, 'barangs' => $barangs]);
    }

    public function update(Request $request, Penjualan $penjualan)
    {
        $request->validate([
            'pembeli' => 'required|string|max:50',
            'penjualan_kode' => 'required|unique:t_penjualan,penjualan_kode,' . $penjualan->penjualan_id . ',penjualan_id',
            'penjualan_tanggal' => 'required|date',
        ]);

        $penjualan->update($request->only(['pembeli', 'penjualan_kode', 'penjualan_tanggal']));

        return redirect()->route('penjualan.index')
            ->with('success', 'Penjualan berhasil diperbarui.');
    }

    public function destroy(Penjualan $penjualan)
    {
        try {
            $penjualan->delete();

            return redirect()->route('penjualan.index')
                ->with('success', 'Penjualan berhasil dihapus.');
        } catch (QueryException $e) {
            return redirect()->route('penjualan.index')
                ->with('error', 'Penjualan gagal dihapus karena terdapat data yang terkait.');
        }
    }
}
