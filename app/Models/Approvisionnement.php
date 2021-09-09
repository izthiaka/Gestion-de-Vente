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
        'quantite_approv_retour', 'activite'
    ];

    /**
     * The attributes from categorie Model.
     *
     * @var array
     */
    public function article()
    {
        return $this->belongsTo(Article::class);
    }

    /**
     * The attributes from categorie Model.
     *
     * @var array
     */
    public function agent()
    {
        return $this->belongsTo(User::class);
    }
}
