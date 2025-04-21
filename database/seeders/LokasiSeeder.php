<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LokasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'id_lokasi' => 1,
                'kode_lokasi' => 'MALANG001',
                'alamat_lokasi' => 'Jl. Yonsei',
                'kelurahan_lokasi' => 'Mojolangu',
                'kecamatn_lokasi' => 'Lowokwaru',
                'kota_kab_lokasi' => 'Kota Malang',
                'provinsi_lokasi' => 'Jawa Timur'
            ],
            [
                'id_lokasi' => 2,
                'kode_lokasi' => 'MALANG002',
                'alamat_lokasi' => 'Jalan Candi Bayangan Walid',
                'kelurahan_lokasi' => 'Merjosari',
                'kecamatn_lokasi' => 'Bareng',
                'kota_kab_lokasi' => 'Kota Malang',
                'provinsi_lokasi' => 'Jawa Timur'
            ],
            [
                'id_lokasi' => 3,
                'kode_lokasi' => 'BALIKPAPAN001',
                'alamat_lokasi' => 'Jl. Onok Petir Onok Halilintar',
                'kelurahan_lokasi' => 'Manggar',
                'kecamatn_lokasi' => 'Balikpapan Timur',
                'kota_kab_lokasi' => 'Kota Balikpapan',
                'provinsi_lokasi' => 'Kalimantan Timur'
            ],
            [
                'id_lokasi' => 4,
                'kode_lokasi' => 'BALIKPAPAN002',
                'alamat_lokasi' => 'Jl. Mariposa Gunung Kidul',
                'kelurahan_lokasi' => 'Manggar',
                'kecamatn_lokasi' => 'Balikpapan Timur',
                'kota_kab_lokasi' => 'Kota Balikpapan',
                'provinsi_lokasi' => 'Kalimantan Timur'
            ],
            [
                'id_lokasi' => 5,
                'kode_lokasi' => 'SURABAYA001',
                'alamat_lokasi' => 'Grand Hello Harimau',
                'kelurahan_lokasi' => 'Kebraon',
                'kecamatn_lokasi' => 'Karang Pilang',
                'kota_kab_lokasi' => 'Kota Surabaya',
                'provinsi_lokasi' => 'Jawa Timur'
            ],
            [
                'id_lokasi' => 6,
                'kode_lokasi' => 'SURABAYA002',
                'alamat_lokasi' => 'Jl. Tunggu Kiris',
                'kelurahan_lokasi' => 'Gubeng',
                'kecamatn_lokasi' => 'Gayungan',
                'kota_kab_lokasi' => 'Kota Surabaya',
                'provinsi_lokasi' => 'Jawa Timur'
            ],

        ];
        DB::table('t_lokasi')->insert($data);
    }
}
