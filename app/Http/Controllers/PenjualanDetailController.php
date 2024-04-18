<?php

namespace App\Http\Controllers;

use App\Models\BarangModel;
use Illuminate\Http\Request;
use App\Models\PenjualanDetailModel as PenjualanDetail;

class PenjualanDetailController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Cari detail penjualan dengan ID yang diberikan
        $penjualanDetail = PenjualanDetail::findOrFail($id);

        // Ambil daftar barang untuk dropdown
        $barangs = BarangModel::all();

        // Kembalikan view edit dengan detail penjualan yang ditemukan dan daftar barang
        return view('penjualan_detail.edit', compact('penjualanDetail', 'barangs'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Cari detail penjualan dengan ID yang diberikan
        $penjualanDetail = PenjualanDetail::findOrFail($id);

        // Validasi data yang diterima
        $request->validate([
            'barang_id' => 'required',
            'harga' => 'required|numeric|min:0',
            'jumlah' => 'required|integer|min:1',
        ]);

        // Perbarui detail penjualan
        $penjualanDetail->update([
            'barang_id' => $request->barang_id,
            'harga' => $request->harga,
            'jumlah' => $request->jumlah,
        ]);



        // Redirect ke halaman yang sesuai setelah perubahan berhasil
        return redirect()->route('penjualan.index')->with('success', 'Detail penjualan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Cari detail penjualan dengan ID yang diberikan
        $penjualanDetail = PenjualanDetail::findOrFail($id);

        // Hapus detail penjualan
        $penjualanDetail->delete();

        // Redirect ke halaman yang sesuai setelah penghapusan berhasil
        return redirect()->route('penjualan.index')->with('success', 'Detail penjualan berhasil dihapus.');
    }
}
