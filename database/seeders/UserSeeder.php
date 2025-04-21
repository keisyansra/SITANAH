<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'id_user' => 1,
                'nama_user' => 'Admin 1',
                'username_user' => 'ADM01',
                'password_user' => Hash::make('admintanah1'),
                'role' => 'admin'
            ],
            [
                'id_user' => 2,
                'nama_user' => 'Admin 2',
                'username_user' => 'ADM02',
                'password_user' => Hash::make('admintanah2'),
                'role' => 'admin'
            ],
            [
                'id_user' => 3,
                'nama_user' => 'Kasir 1',
                'username_user' => 'KSR01',
                'password_user' => Hash::make('kasiranah1'),
                'role' => 'kasir'
            ],
            [
                'id_user' => 4,
                'nama_user' => 'Kasir 2',
                'username_user' => 'KSR02',
                'password_user' => Hash::make('kasirtanah2'),
                'role' => 'kasir'
            ],
        ];
        DB::table('t_user')->insert($data);
    }
}
