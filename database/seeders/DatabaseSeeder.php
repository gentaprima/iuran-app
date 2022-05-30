<?php

namespace Database\Seeders;

use App\Models\ModelRekening;
use App\Models\ModelUsers;
use Illuminate\Database\Seeder;
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
        ModelUsers::create(
            [
                'first_name'=>"phs",
                'last_name'=>"hhahaha",
                'phone_number'=>"0894382948932",
                'email' =>'admin@gmail.com',
                'password'=>Hash::make('admin'),
                'role'=>1
            ]
        );      

        ModelRekening::create(
            [
                'number_account'  => 123456789,
                'bank_name'  => 'BCA',
                'account_name'  => 'Genta Prima Syahnur',
            ]
        );
    }
}
