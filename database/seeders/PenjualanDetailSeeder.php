<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PenjualanDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Data transaksi penjualan detail
        $penjualanDetail = [
            // Transaksi 1
            ['penjualan_id' => 1, 'barang_id' => 1, 'harga' => 6000000, 'jumlah' => 1],
            ['penjualan_id' => 1, 'barang_id' => 2, 'harga' => 3500000, 'jumlah' => 2],
            ['penjualan_id' => 1, 'barang_id' => 3, 'harga' => 200000, 'jumlah' => 3],

            // Transaksi 2
            ['penjualan_id' => 2, 'barang_id' => 4, 'harga' => 300000, 'jumlah' => 4],
            ['penjualan_id' => 2, 'barang_id' => 5, 'harga' => 250000, 'jumlah' => 5],
            ['penjualan_id' => 2, 'barang_id' => 6, 'harga' => 350000, 'jumlah' => 6],

            // Transaksi 3
            ['penjualan_id' => 3, 'barang_id' => 7, 'harga' => 400000, 'jumlah' => 7],
            ['penjualan_id' => 3, 'barang_id' => 8, 'harga' => 150000, 'jumlah' => 8],
            ['penjualan_id' => 3, 'barang_id' => 9, 'harga' => 120000, 'jumlah' => 9],

            // Transaksi 4
            ['penjualan_id' => 4, 'barang_id' => 10, 'harga' => 60000, 'jumlah' => 10],
            ['penjualan_id' => 4, 'barang_id' => 9, 'harga' => 120000, 'jumlah' => 9],
            ['penjualan_id' => 4, 'barang_id' => 8, 'harga' => 150000, 'jumlah' => 8],

            // Transaksi 5
            ['penjualan_id' => 5, 'barang_id' => 7, 'harga' => 500000, 'jumlah' => 7],
            ['penjualan_id' => 5, 'barang_id' => 6, 'harga' => 350000, 'jumlah' => 6],
            ['penjualan_id' => 5, 'barang_id' => 5, 'harga' => 250000, 'jumlah' => 5],

            // Transaksi 6
            ['penjualan_id' => 6, 'barang_id' => 4, 'harga' => 300000, 'jumlah' => 4],
            ['penjualan_id' => 6, 'barang_id' => 3, 'harga' => 200000, 'jumlah' => 3],
            ['penjualan_id' => 6, 'barang_id' => 2, 'harga' => 350000, 'jumlah' => 2],

            // Transaksi 7
            ['penjualan_id' => 7, 'barang_id' => 1, 'harga' => 6000000, 'jumlah' => 1],
            ['penjualan_id' => 7, 'barang_id' => 10, 'harga' => 60000, 'jumlah' => 10],
            ['penjualan_id' => 7, 'barang_id' => 9, 'harga' => 120000, 'jumlah' => 9],

            // Transaksi 8
            ['penjualan_id' => 8, 'barang_id' => 8, 'harga' => 150000, 'jumlah' => 8],
            ['penjualan_id' => 8, 'barang_id' => 7, 'harga' => 500000, 'jumlah' => 7],
            ['penjualan_id' => 8, 'barang_id' => 6, 'harga' => 350000, 'jumlah' => 6],

            // Transaksi 9
            ['penjualan_id' => 9, 'barang_id' => 5, 'harga' => 250000, 'jumlah' => 5],
            ['penjualan_id' => 9, 'barang_id' => 4, 'harga' => 300000, 'jumlah' => 4],
            ['penjualan_id' => 9, 'barang_id' => 3, 'harga' => 200000, 'jumlah' => 3],

            // Transaksi 10
            ['penjualan_id' => 10, 'barang_id' => 2, 'harga' => 350000, 'jumlah' => 2],
            ['penjualan_id' => 10, 'barang_id' => 1, 'harga' => 6000000, 'jumlah' => 1],
            ['penjualan_id' => 10, 'barang_id' => 10, 'harga' => 60000, 'jumlah' => 10],
        ];

        // Masukkan data ke dalam tabel t_penjualan_detail
        foreach ($penjualanDetail as $data) {
            DB::table('t_penjualan_detail')->insert($data);
        }
    }
}
