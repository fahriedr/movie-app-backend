<?php

use Facade\FlareClient\View;
use Illuminate\Support\Facades\Route;
use Illuminate\View\View as ViewView;

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

Route::get('/', function () {
    return view('welcome');
});


Route::get('/movie/now-playing/{page}', 'MovieController@index');
Route::get('/movie/find/{query}/{page}', 'MovieController@searchMovie');
Route::get('/movie/top-rated/{page}', 'MovieController@topRatedMovies');
Route::get('/movie/popular/{page}', 'MovieController@popularMovies');
Route::get('/movie/{id}', 'MovieController@getMovieDetail');
