<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nom_role', 'code_role',
    ];

    /**
     * Get the phone record associated with the user.
     */
    public function user()
    {
        return $this->hasOne(User::class);
    }
}
