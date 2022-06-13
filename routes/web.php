<?php

use App\Http\Controllers\AuthorsController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\LivresController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::controller(LoginController::class)->group(function () {
    Route::get('/login',function () { return view('admin.login.index', []);})->name('login');
    Route::post('/login','authenticate')->name('authenticate');
    Route::get('/logout','logout')->name('logout');
});

Route::get('/test', function () {
    return view('test', []);
});

Route::controller(UserController::class)->group(function () {
    Route::get('/init','initUSer');
});
Route::controller(LivresController::class)->group(function () {
    Route::get('/livres/{id}', 'show')->name('show');
    Route::post('/livres/update', 'update')->name('updateLivre');
    Route::get('/livres/del/{id}', 'showDelete');
    Route::delete('/livres/del/', 'delete')->name('deleteLivre');
    Route::get('/livres', 'getAll')->name('livres');
    Route::post('livres', 'store');
});

Route::middleware(['auth','role:ROLE_USER'])->group(function () {

    Route::controller(AuthorsController::class)->group(function () {
        Route::get('/authors/{id}', 'getAllLivres')->name('authorsLivres');
        Route::get('/authors/categ/{id}', 'getAllByCategory');
        
    });
    
});



Route::controller(CategoriesController::class)->group(function () {
    Route::get('/categories/{id}', 'getAll')->name('categoryLivres');
});