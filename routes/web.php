<?php

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
use App\Http\Controllers\MovieController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\OmdbController;



// Movie routes
Route::get('/movies/by-genres/{genreId?}', [MovieController::class, 'byGenre']);
Route::get('/movies/{id}', [MovieController::class, 'getId']);
Route::put('/movies/{id?}', [MovieController::class, 'save']);
Route::post('/movies/{id?}', [MovieController::class, 'save']);


// Genre routes
Route::get('/genre/index-names', [GenreController::class, 'indexNames']);


// ombd routes
Route::get('/omdb/title', [OmdbController::class, 'byTitle']);
Route::get('/omdb/id', [OmdbController::class, 'byId']);


// home-page 
Route::get('/{any}', function () {
    return view('app');
})->where('any', '.*');