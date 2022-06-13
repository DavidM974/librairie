
@extends('layout.app')

@section('header')
<header class="bg-white shadow">
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
      <h1 class="text-3xl font-bold text-gray-900">{{ $title }} : {{$livre['title']}}</h1>
    </div>
  </header>
  @endsection

@section('main')





<div class="flex items-center justify-between space-x-4">
  <h1 class="text-xl font-medium text-gray-800 ">Mise à jour d'un livre</h1>


</div>



<form class="mt-5" method="POST" action="{{route('updateLivre')}}"  enctype="multipart/form-data" >
  @csrf
  <div>
    <input type="hidden" name="id" value="{{$livre->id}}">
      <label for="title" class="label">Titre du livre</label>
      @error('title') 
          <p class=" text-sm text-red-500 mt-0 py-0">
              Veuillez entrer un titre
          </p>
          @enderror
      <input placeholder="Votre titre" name="title" type="text" value="{{ old('title')? old('title'): $livre->title}} " class="block w-full px-3 py-2 mt-2 text-gray-600 placeholder-gray-400 bg-white border border-gray-200 rounded-md focus:border-indigo-400 focus:outline-none focus:ring focus:ring-indigo-300 focus:ring-opacity-40">
  </div>

  <div class="mt-4">
      <div>
          <label for="description" class="label">Description</label>
          @error('description') 
          <p class=" text-sm text-red-500 mt-0 py-0">
              Veuillez entrer une description
          </p>
          @enderror
          <textarea  class="label" class="" name="description" id="description" cols="30" rows="10">{{ old('description')? old('description'): $livre->description}}</textarea>
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700"> Image du llivre </label>
        <div class="flex">
            <img class='p-1 bg-white border rounded object-cover h-48 w-96 '   src=' {{ $livre['image'] ? asset('storage/'.$livre->image) : "/images/livres/default-placeholder.png" }}'>
        </div>
        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
            <div class="space-y-1 text-center">
            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            <div class="flex text-sm text-gray-600">
                <label for="image" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                
                    @error('image') 
                    <p class=" text-sm text-red-500 mt-0 py-0">
                        Veuillez entrer une image
                    </p>
                    @enderror    
                    <span>Uploader un fichier</span>
                <input id="image" name="image" type="file" class="sr-only" >
                </label>
                <p class="pl-1">or drag and drop</p>
            </div>
            <p class="text-xs text-gray-500">PNG, JPG, GIF up to 10MB</p>
            </div>
        </div>
        </div>
      <div>
          <label for="description" class="label">Pages</label>
          @error('pages') 
          <p class=" text-sm text-red-500 mt-0 py-0">
              Veuillez entrer le nombre de pages
          </p>
          @enderror
          <input type="text" class="" name="pages" id="pages" placeholder="Entrer le nombre de page" value="{{ old('pages')? old('pages'): $livre->pages}}">
      </div>
      <div>
          <label for="author" class="label">Choix de l'auteur</label>
          @error('authors') 
          <p class=" text-sm text-red-500 mt-0 py-0">
              Veuillez choisir un auteur
          </p>
          @enderror
          <select name="authors" id="authors" class="form-select  " aria-label="Default select example">
           @foreach ($authors as $author)
           @if (old('authors'))
           <option value="{{$author->id}}" {{ (old("authors") ==  $author->id  ? " selected":"") }}>{{$author->firstname}} {{$author->lastname}}</option>
           @else
           <option value="{{$author->id}}" {{ ($livre->author->id ==  $author->id  ? " selected":"") }}>{{$author->firstname}} {{$author->lastname}}</option>
          @endif
           @endforeach
          </select>
      </div>
      <div>
         
      <div>
      <label for="author" class="label">Choix des categories</label>
      @error('categories') 
      <p class=" text-sm text-red-500 mt-0 py-0">
          Veuillez choisir au moins une categories
      </p>
      @enderror
      <select name="categories[]" id="categories"  class="form-select" multiple>
        
          @foreach ($categories as $category)
            @if (old('categories'))
              <option value="{{ $category->id }}"   {{ (collect(old('categories'))->contains($category->id)) ? 'selected':'' }}>{{ $category->label }}</option>
            @else
              <option value="{{ $category->id }}" {{ (collect($tabCategories)->contains($category->id)) ? 'selected':'' }}>{{ $category->label }}</option>
            @endif
          @endforeach
      </select>
      
            </div>
          
      </div>

  </div>
  <div class="flex justify-end mt-6">
      <button type="submit" class="px-3 py-2 text-sm tracking-wide text-white capitalize transition-colors duration-200 transform bg-indigo-500 rounded-md dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:bg-indigo-700 hover:bg-indigo-600 focus:outline-none focus:bg-indigo-500 focus:ring focus:ring-indigo-300 focus:ring-opacity-50">
          Valider
      </button>
  </div>
</form>
</div>






@endsection
