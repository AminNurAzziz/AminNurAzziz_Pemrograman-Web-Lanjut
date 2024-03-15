<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StokSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Data stok
        $stok = [
            [
                'barang_id' => 1,
                'user_id' => 1,
                'stok_tanggal' => now(),
                'stok_jumlah' => 100
            ],
            [
                'barang_id' => 2,
                'user_id' => 1,
                'stok_tanggal' => now(),
                'stok_jumlah' => 50
            ],
            [
                'barang_id' => 3,
                'user_id' => 2,
                'stok_tanggal' => now(),
                'stok_jumlah' => 200
            ],
            [
                'barang_id' => 4,
                'user_id' => 2,
                'stok_tanggal' => now(),
                'stok_jumlah' => 80
            ],
            [
                'barang_id' => 5,
                'user_id' => 3,
                'stok_tanggal' => now(),
                'stok_jumlah' => 150
            ],
            [
                'barang_id' => 6,
                'user_id' => 3,
                'stok_tanggal' => now(),
                'stok_jumlah' => 120
            ],
            [
                'barang_id' => 7,
                'user_id' => 1,
                'stok_tanggal' => now(),
                'stok_jumlah' => 300
            ],
            [
                'barang_id' => 8,
                'user_id' => 2,
                'stok_tanggal' => now(),
                'stok_jumlah' => 90
            ],
            [
                'barang_id' => 9,
                'user_id' => 3,
                'stok_tanggal' => now(),
                'stok_jumlah' => 80
            ],
            [
                'barang_id' => 10,
                'user_id' => 1,
                'stok_tanggal' => now(),
                'stok_jumlah' => 120
            ],
        ];

        // Masukkan data ke dalam tabel t_stok
        foreach ($stok as $data) {
            DB::table('t_stok')->insert($data);
        }
    }
}
