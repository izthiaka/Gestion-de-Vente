<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $client = [

            [
                'id' => 1,
                'prenom_nom' => 'Cheikh Ndiaye',
                'telephone' => '00221781454753',
                'adresse' => null,
                'agent_id' => 3,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],

            [
                'id' => 2,
                'prenom_nom' => 'Ndioumé Fall',
                'telephone' => '00221776237312',
                'adresse' => 'HLM',
                'agent_id' => 3,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
        ];

        DB::table('clients')->insert($client);
    }
}
