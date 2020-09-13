<?php

namespace App\Http\Controllers;

use Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MovieController extends Controller
{
    protected $tmdb_api_key; //Deklarasi variable api key
    protected $tmdb_base_url; //Deklarasi variable base url the movie db

    public function __construct()
    {
        $this->tmdb_base_url = "https://api.themoviedb.org/3/movie/"; //Base Url the movie db
        $this->tmdb_api_key = config('services.tmdb.key'); //Get api key from .env
    }

    //Get newest movies
    public function index($page)
    {
        $genre = Http::get("https://api.themoviedb.org/3/genre/movie/list?api_key=" . $this->tmdb_api_key );
        $genre = $genre['genres'];

        $response = Http::get($this->tmdb_base_url . "now_playing?api_key=" . $this->tmdb_api_key . "&page=". $page);
        $movies = $response['results'];

        return response()->json(['movies' => $movies, 'genre' => $genre]);
    }

    //Get popular movies
    public function popularMovies($page)
    {
        $response = Http::get($this->tmdb_base_url . "popular?api_key=" . $this->tmdb_api_key . "&page=" . $page);
        return json_encode($response['results']);
    }

    //Get searched movie by query
    public function searchMovie($query, $page)
    {
        $response = Http::get("https://api.themoviedb.org/3/search/movie/?query=" . $query . "&api_key=" . $this->tmdb_api_key . "&page=" . $page);
        return json_encode($response['results']);
    }

    //Get trending movies
    public function topRatedMovies($page)
    {
        $response = Http::get($this->tmdb_base_url . "top_rated?api_key=" . $this->tmdb_api_key . "&page=" . $page);
        return json_encode($response['results']);
    }

    //Get the movie detail by ID
    public function getMovieDetail($id)
    {
        // $number = (int)$id;
        $response = Http::get("https://api.themoviedb.org/3/movie/" . $id . "?api_key=" . $this->tmdb_api_key);
        return $response;
    }
}
