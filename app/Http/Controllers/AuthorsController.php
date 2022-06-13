<?php

namespace App\Http\Controllers;
use Illuminate\Database\Eloquent\Builder;
use App\Models\AuthorsModel;
use App\Models\Livres;
use Illuminate\Http\Request;

class AuthorsController extends Controller
{

    function getAllLivres($id)
    {
        $author = AuthorsModel::with('livres')->find($id);


        $livres = $author->livres();
        return view('authorsLivres', [
            'title' => 'Livre de l\'auteur : '. $author->firstname . ' '.$author->lastname,
            'livres' => $livres->paginate(10),
            'author' => $author
        ]);
    }

    function getAllByCategory($idCategory){
        $authors = AuthorsModel::wherehas('livres.categories', function (Builder $query) {
            $query->where('categories_id', 'like', 'code%');
        }, '=', $idCategory)->get();
        dd($authors);
        return view('authorsCategory', [
            'title' => 'Auteur par categorie : ',
            'authors' => $authors
        ]);
    }


}
