<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuthorsModel extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'authors';

    public function livres()
    {
        return $this->hasMany(Livres::class, 'authors_id', 'id');
    }
}
