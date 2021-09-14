<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'prenom_nom', 'adresse', 'telephone', 'agent_id'
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
}
