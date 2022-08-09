<?php

namespace Database\Seeders;

use App\Models\ModelRekening;
use App\Models\ModelUsers;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $dataUsers = [
            [
                'first_name' => "admin",
                'last_name' => "admin",
                'phone_number' => "0894382948932",
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin123@'),
                'role' => 1,
                'is_verif' => 1,
            ],
            [
                'first_name' => "genta",
                'last_name' => "prima",
                'phone_number' => "0894382948932",
                'email' => 'gentaprima600@gmail.com',
                'password' => Hash::make('1234'),
                'role' => 0,
                'is_verif' => 1
            ],
            [
                'first_name' => "prasetya",
                'last_name' => "hadi",
                'phone_number' => "0899229292",
                'email' => 'prasetya2423@gmail.com',
                'password' => Hash::make('1234'),
                'role' => 0,
                'is_verif' => 1
            ],
            [
                'first_name' => "Bapak",
                'last_name' => "RT Perumahan",
                'phone_number' => "0899229292",
                'email' => 'rt@rt.com',
                'password' => Hash::make('1234'),
                'role' => 2,
                'is_verif' => 1
            ]
        ];
        DB::table('tbl_users')->insert($dataUsers);

        DB::table('tbl_jenis_iuran')->insert([
            [
                'jenis_iuran'   => "Iuran 1 Bulan",
                'nominal'   => 80000,
                'keterangan'   => "Iuran Kebersihan, Iuran Keamanan, Kas RT",
            ],
            [
                'jenis_iuran'   => "Iuran Sukarela",
                'nominal'   => 0,
                'keterangan'   => "Untuk Iuran Sukarela di bayar seiklasnya",
            ],
        ]);

        ModelRekening::create(
            [
                'number_account'  => 123456789,
                'bank_name'  => 'BCA',
                'account_name'  => 'Genta Prima Syahnur',
            ]
        );
        DB::table("jenis_pengeluaran")->insert(
            [
                'keterangan' => "Gaji Keamanan",
                'tipe_pengeluaran' => 0,
            ],
        );
        DB::table("jenis_pengeluaran")->insert(
            [
                'keterangan' => "Gaji Kebersihan",
                'tipe_pengeluaran' => 0,
            ],
        );
    }
}
