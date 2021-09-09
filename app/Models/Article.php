<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nom_article', 'description_article', 'prix_article', 'categorie_id',
        'photo_article', 'disponibilite', 'quantite_article'
    ];

    /**
     * The attributes from categorie Model.
     *
     * @var array
     */
    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }
}
