<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NasabahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'id_nasabah' => 1,
                'kode_nasabah' => 'NSB001',
                'nama_nasabah' => 'Walid Cianjur',
                'alamat_nasabah' => 'Jalan Mengkudu, Kota Malang',
                'telp_nasabah' => '081249647956',
                'nama_kerabat_nasabah' => 'Joko Cianjur', 
                'telp_kerabat_nasabah' => '081245684255'
            ],
            [
                'id_nasabah' => 2,
                'kode_nasabah' => 'NSB002',
                'nama_nasabah' => 'Dewi Ginaini',
                'alamat_nasabah' => 'Jalan Jakarta, Kota Balikpapan',
                'telp_nasabah' => '082489756855',
                'nama_kerabat_nasabah' => 'Siti Bahruni', 
                'telp_kerabat_nasabah' => '082456872588'
            ],
            [
                'id_nasabah' => 3,
                'kode_nasabah' => 'NSB003',
                'nama_nasabah' => 'Baiduri Diane',
                'alamat_nasabah' => 'Jalan Mekar Asri, Kota Surabaya',
                'telp_nasabah' => '084522485145',
                'nama_kerabat_nasabah' => 'Kulsum Murowaah', 
                'telp_kerabat_nasabah' => '08524986252'
            ],
        ];
        DB::table('t_nasabah')->insert($data);
    }
}
