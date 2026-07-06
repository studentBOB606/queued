<?php

namespace App\Http\Controllers;

use App\Models\Film;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class FilmController extends Controller
{
    public function index()
    {
        $key  = config('services.tmdb.key');
        $base = 'https://api.themoviedb.org/3';

        $trending = Http::get("{$base}/trending/movie/week", ['api_key' => $key])
            ->json('results', []);

        $popular = Http::get("{$base}/movie/popular", ['api_key' => $key])
            ->json('results', []);

        return view('Film', [
            'trendingFilms' => array_slice($trending, 0, 8),
            'popularFilms'  => array_slice($popular, 0, 8),
        ]);
    }

    public function show(Film $film)
    {
        return view('FilmInfo', compact('film'));
    }

    public function search(Request $request)
    {
        $q       = trim($request->input('q', ''));
        $results = collect();

        if ($q) {
            $key  = config('services.tmdb.key');
            $data = Http::get('https://api.themoviedb.org/3/search/movie', [
                'api_key' => $key,
                'query'   => $q,
            ])->json('results', []);

            $results = collect($data);
        }

        return view('search', compact('results', 'q'));
    }
}
