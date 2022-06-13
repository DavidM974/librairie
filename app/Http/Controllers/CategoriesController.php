<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    function getAll($id)
    {
        $category = Categories::with('livres')->find($id);
        $livres = $category->livres();
        return view('categories', [
            'title' => 'Livre de la catégorie : '. $category->label,
            'livres' => $livres->paginate(10),
            'category' => $category
        ]);
    }
    function getAutors($id)
    {
        $category = Categories::with('livres')->find($id);
        return view('categories', [
            'title' => 'Livre de la catégorie : '. $category->label,
            'livres' => $category->livres
        ]);
    }

}
