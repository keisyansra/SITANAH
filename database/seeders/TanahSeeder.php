<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TanahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'id_tanah' => 1,
                'kode_tanah' => 'TN001',
                'id_lokasi' => 1,
                'no_kav_tanah' => '124',
                'panjang_tanah' => 2.5,
                'lebar_tanah' => 1,
                'harga' => 12000000.00
            ],
            [
                'id_tanah' => 2,
                'kode_tanah' => 'TN002',
                'id_lokasi' => 1,
                'no_kav_tanah' => '157',
                'panjang_tanah' => 2.9,
                'lebar_tanah' => 1.2,
                'harga' => 135000000.00
            ],
            [
                'id_tanah' => 3,
                'kode_tanah' => 'TN003',
                'id_lokasi' => 2,
                'no_kav_tanah' => '295',
                'panjang_tanah' => 2,
                'lebar_tanah' => 1.2,
                'harga' => 102400000.00
            ],
            [
                'id_tanah' => 4,
                'kode_tanah' => 'TN004',
                'id_lokasi' => 2,
                'no_kav_tanah' => '228',
                'panjang_tanah' => 3.1,
                'lebar_tanah' => 2,
                'harga' => 20200000.00
            ],
            [
                'id_tanah' => 5,
                'kode_tanah' => 'TN005',
                'id_lokasi' => 3,
                'no_kav_tanah' => '348',
                'panjang_tanah' => 2.4,
                'lebar_tanah' => 2,
                'harga' => 24000000.00
            ],
            [
                'id_tanah' => 6,
                'kode_tanah' => 'TN006',
                'id_lokasi' => 3,
                'no_kav_tanah' => '317',
                'panjang_tanah' => 3,
                'lebar_tanah' => 1.8,
                'harga' => 26000000.00
            ],
        ];
        DB::table('t_tanah')->insert($data);
    }
}
