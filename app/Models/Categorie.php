<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nom_categorie', 'slug_categorie'
    ];

    /**
     * Get the phone record associated with the article.
     */
    public function article()
    {
        return $this->hasMany(Article::class);
    }
}
