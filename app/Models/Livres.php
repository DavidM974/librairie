<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livres extends Model
{
    use HasFactory;

    
    /**
     * Get the post that owns the comment.
     */
    public function author()
    {
        return $this->belongsTo(AuthorsModel::class,'authors_id');
    }

    public function categories()
    {
        return $this->belongsToMany(Categories::class, 'categories_livres', 'livres_id', 'categories_id');
    }
}
