<?php

namespace App\Http\Controllers;

use App\Models\AuthorsModel;
use App\Models\Categories;
use App\Models\Livres;

use Illuminate\Http\Request;

class LivresController extends Controller
{



    function getAll(Request $request)
    {
        $authors = AuthorsModel::all();
        if ($request->input('search')) {
            $search = $request->input('search');
            $livres =  Livres::with('author')->with('categories')->where('title', 'like', "%$search%")->paginate(10);
        } else
            $livres = Livres::with('author')->with('categories')->paginate(10);

        $categories = Categories::all();
        $paginator = Livres::paginate(10);

        return view('livres', [
            'title' => 'Liste des livres',
            'livres' => $livres,
            'paginator' => $paginator,
            'authors' => $authors,
            'categories' => $categories,



        ]);
    }

    function show($id)
    {
        $livre = Livres::with(['author', 'categories'])->find($id);
        $authors = AuthorsModel::all();
        $categories = Categories::all();
        $tabCategories = collect($livre->categories->toArray())->map(function ($category) {
            return $category['id'];
        });
        if (isset($livre)) {
            return view('livre', [
                'title' => 'Détails livre',
                'livre' => $livre,
                'categories' => $categories,
                'authors' => $authors,
                'tabCategories' => $tabCategories,
            ]);
        } else
            return redirect()->route('livres');
    }

    function showDelete($id)
    {
        $livre = Livres::find($id);
        return view('showDelete', [
            'title' => 'Suppression livre',
            'livre' => $livre,
        ]);
    }

    function delete(Request $request)
    {
        $livre = Livres::with(['author', 'categories'])->find($request->input('id'));
        $livre->delete();
        return redirect()->route('livres')->with('status', 'Livre supprimer avec succès !');
    }

    function update(Request $request)
    {

        $livre = Livres::with(['author', 'categories'])->find($request->input('id'));
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required|max:1024',
            'pages' => 'required|integer',
            'authors' => 'required|exists:authors,id',
            'categories' => 'required',
            'categories.*' => 'numeric|exists:categories,id',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('/images/livres', 'public');
            $livre->image = $path;
        }

        $livre->title = $validated['title'];
        $livre->description = $validated['description'];
        $livre->pages = $validated['pages'];
        $livre->authors_id = $validated['authors'];
        $livre->save();
        $livre->categories()->sync($validated['categories']);

        return redirect()->route('show', ['id' => $request->input('id')])->with('status', 'Livre maj avec succès');
    }




    /**
     * Show the form to create a new blog post.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('livres');
    }

    /**
     * Store a new blog post.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required|max:1024',
            'pages' => 'required|integer',
            'authors' => 'required|exists:authors,id',
            'categories' => 'required',
            'categories.*' => 'numeric|exists:categories,id',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        $path = null;

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('/images/livres', 'public');
        }
        //  dd($validated);

        $livre = new Livres();
        $livre->title = $validated['title'];
        $livre->description = $validated['description'];
        $livre->pages = $validated['pages'];
        $livre->authors_id = $validated['authors'];
        $livre->image = $path;
        $livre->save();
        $livre->categories()->attach($validated['categories']);
        $request->session()->flash('status', 'Task was successful!');
        return redirect()->route('livres')->session()->flash('status', 'Task was successful!');;
    }
}
