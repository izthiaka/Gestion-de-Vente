<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vente extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'agent_id', 'article_id', 'montant_total',
        'quantite_article', 'client_id',
    ];

    /**
     * The attributes from categorie Model.
     *
     * @var array
     */
    public function agent()
    {
        return $this->belongsTo(User::class, 'agent_id');
    }

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
    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }
}
