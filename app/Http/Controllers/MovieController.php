<?php

namespace App\Http\Controllers;

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
    public function index()
    {
        $response = Http::get($this->tmdb_base_url . "now_playing?api_key=" . $this->tmdb_api_key);
        return json_encode($response['results']);
    }

    //Get popular movies
    public function popularMovies()
    {
        $response = Http::get($this->tmdb_base_url . "popular?api_key=" . $this->tmdb_api_key);
        return json_encode($response['results']);
    }

    //Get searched movie by query
    public function searchMovie($query)
    {
        $response = Http::get("https://api.themoviedb.org/3/search/movie/?query=" . $query . "&api_key=" . $this->tmdb_api_key);
        return json_encode($response['results']);
    }

    //Get trending movies
    public function trendingMovies()
    {
        $response = Http::get("https://api.themoviedb.org/3/trending/all/day?api_key=" . $this->tmdb_api_key);
        return json_encode($response);
    }
}
