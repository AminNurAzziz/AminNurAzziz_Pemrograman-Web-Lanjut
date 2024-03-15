<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PenjualanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Data transaksi penjualan
        $penjualan = [
            [
                'user_id' => 1,
                'pembeli' => 'Fillah',
                'penjualan_kode' => 'PJN001',
                'penjualan_tanggal' => now()
            ],
            [
                'user_id' => 1,
                'pembeli' => 'Fillah',
                'penjualan_kode' => 'PJN002',
                'penjualan_tanggal' => now()
            ],
            [
                'user_id' => 2,
                'pembeli' => 'Amanda',
                'penjualan_kode' => 'PJN003',
                'penjualan_tanggal' => now()
            ],
            [
                'user_id' => 2,
                'pembeli' => 'Amanda',
                'penjualan_kode' => 'PJN004',
                'penjualan_tanggal' => now()
            ],
            [
                'user_id' => 3,
                'pembeli' => 'Rosya',
                'penjualan_kode' => 'PJN005',
                'penjualan_tanggal' => now()
            ],
            [
                'user_id' => 3,
                'pembeli' => 'Rosya',
                'penjualan_kode' => 'PJN006',
                'penjualan_tanggal' => now()
            ],
            [
                'user_id' => 1,
                'pembeli' => 'Fillah',
                'penjualan_kode' => 'PJN007',
                'penjualan_tanggal' => now()
            ],
            [
                'user_id' => 2,
                'pembeli' => 'Amanda',
                'penjualan_kode' => 'PJN008',
                'penjualan_tanggal' => now()
            ],
            [
                'user_id' => 3,
                'pembeli' => 'Rosya',
                'penjualan_kode' => 'PJN009',
                'penjualan_tanggal' => now()
            ],
            [
                'user_id' => 1,
                'pembeli' => 'Fillah',
                'penjualan_kode' => 'PJN010',
                'penjualan_tanggal' => now()
            ],
        ];

        // Masukkan data ke dalam tabel t_penjualan
        foreach ($penjualan as $data) {
            DB::table('t_penjualan')->insert($data);
        }
    }
}
