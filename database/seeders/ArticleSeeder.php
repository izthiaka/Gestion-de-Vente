<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $article = [
            [
                'nom_article' => 'Bonbon Virgini',
                'description_article' => null,
                'prix_article' => 2000,
                'categorie_id' => 1,
                'photo_article' => null,
                'disponibilite' => 1,
                'quantite_article' => 15,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'nom_article' => '3x energy',
                'description_article' => null,
                'prix_article' => 15000,
                'categorie_id' => 1,
                'photo_article' => null,
                'disponibilite' => 1,
                'quantite_article' => 5,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'nom_article' => 'Pressea',
                'description_article' => 'Boisson à base de fruits naturel.',
                'prix_article' => 7000,
                'categorie_id' => 1,
                'photo_article' => null,
                'disponibilite' => 0,
                'quantite_article' => 0,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
        ];
        DB::table('articles')->insert($article);
    }
}
