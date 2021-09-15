<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Approvisionnement extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'agent_id', 'article_id', 'quantite_approv_depart',
        'quantite_approv_retour', 'activite', 'confirmed',
        'created_at', 'updated_at', 'quantite_restant', 'date_retour'
    ];

    /**
     * The attributes from categorie Model.
     *
     * @var array
     */
    public function article()
    {
        return $this->belongsTo(Article::class, 'article_id');
    }

    /**
     * The attributes from categorie Model.
     *
     * @var array
     */
    public function agent()
    {
        return $this->belongsTo(User::class, 'agent_id');
    }
}
