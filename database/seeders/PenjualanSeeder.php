<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenjualanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
               'id_penjualan' => 1,
               'kode_penjualan' => 'TM001',
               'id_nasabah' => 1,
               'id_tanah' =>  2,
               'pembayaran' => 'Debit',
            ],
            [
                'id_penjualan' => 2,
                'kode_penjualan' => 'TM002',
                'id_nasabah' => 2,
                'id_tanah' =>  3,
                'pembayaran' => 'Kredit',
            ],
            [
                'id_penjualan' => 3,
                'kode_penjualan' => 'TM003',
                'id_nasabah' => 3,
                'id_tanah' =>  6,
                'pembayaran' => 'Cash',
            ],
        ];
        DB::table('t_penjualan')->insert($data);
    }
}
