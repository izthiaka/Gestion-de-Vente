<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $user = [

            [
                'id' => 1,
                'name' => 'Adja National',
                'login' => 'adja',
                'email' => 'dajkimi99@gmail.com',
                'numero_telephone' => "00221781454753",
                'role_id' => 1,
                'password' => bcrypt('123456'),
                'password_change_at' => null,
                'photo_profil' => null,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],

            [
                'id' => 2,
                'name' => 'Eva National',
                'login' => 'awa',
                'email' => 'ediop297@gmail.com',
                'numero_telephone' => "00221776237312",
                'role_id' => 1,
                'password' => bcrypt('123456'),
                'password_change_at' => null,
                'photo_profil' => null,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],

            [
                'id' => 3,
                'name' => 'Thiaka Badji',
                'login' => 'isthiaka',
                'email' => 'is@thiaka.space',
                'numero_telephone' => "00221777739260",
                'role_id' => 2,
                'password' => bcrypt('123456'),
                'password_change_at' => null,
                'photo_profil' => null,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
        ];

        DB::table('users')->insert($user);
    }
}
