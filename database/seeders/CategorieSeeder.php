<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CategorieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categorie = [
            [
                'nom_categorie' => 'Alimentation',
                'slug_categorie' => 'alimentation',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],

            [
                'nom_categorie' => 'Outils et Accessoires Beauté',
                'slug_categorie' => 'outils-et-accessoires-beaute',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],

            [
                'nom_categorie' => 'Vêtements Homme',
                'slug_categorie' => 'vetements-homme',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],

            [
                'nom_categorie' => 'Vêtements Femme',
                'slug_categorie' => 'vetements-femme',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],

            [
                'nom_categorie' => 'Produits Bébé',
                'slug_categorie' => 'produits-bebe',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],

            [
                'nom_categorie' => 'Maquillage',
                'slug_categorie' => 'maquillage',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],

            [
                'nom_categorie' => 'Montres',
                'slug_categorie' => 'montres',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],

            [
                'nom_categorie' => 'Electroménager',
                'slug_categorie' => 'electromenager',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],

            [
                'nom_categorie' => 'Parfums de luxe',
                'slug_categorie' => 'parfums-de-luxe',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
        ];
        DB::table('categories')->insert($categorie);
    }
}
