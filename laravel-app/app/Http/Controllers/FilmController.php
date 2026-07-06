<?php

namespace App\Http\Controllers;

use App\Models\Film;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class FilmController extends Controller
{public function index(Request $request)
{
    $apiKey = env('TMDB_API_KEY');
    $genre  = $request->input('genre');
    $sort   = $request->input('sort', 'popularity.desc');

    // Use discover whenever a genre or non-default sort is applied
    if ($genre || $sort !== 'popularity.desc') {
        $params = ['api_key' => $apiKey, 'sort_by' => $sort, 'vote_count.gte' => 100];
        if ($genre) $params['with_genres'] = $genre;

        $results = Http::get('https://api.themoviedb.org/3/discover/movie', $params)->json('results', []);

        return view('Film', [
            'filteredFilms' => $results,
            'trendingFilms' => [],
            'popularFilms'  => [],
            'activeGenre'   => $genre ? (int)$genre : null,
            'activeSort'    => $sort,
        ]);
    }

    // Default: show trending + popular
    $trendingFilms = Http::get('https://api.themoviedb.org/3/trending/movie/week', ['api_key' => $apiKey])->json('results', []);
    $popularFilms  = Http::get('https://api.themoviedb.org/3/movie/popular', ['api_key' => $apiKey])->json('results', []);

    return view('Film', [
        'filteredFilms' => [],
        'trendingFilms' => $trendingFilms,
        'popularFilms'  => $popularFilms,
        'activeGenre'   => null,
        'activeSort'    => $sort,
    ]);
}

    public function show($film)
    {
        $apiKey = env('TMDB_API_KEY');

        $response = Http::get("https://api.themoviedb.org/3/movie/{$film}", [
            'api_key' => $apiKey,
        ]);

        $film = $response->json();

        return view('FilmInfo', compact('film'));
    }

    public function search(Request $request)
    {
        $q       = trim($request->input('q', ''));
        $results = collect();

        if ($q) {
            $data = Http::get('https://api.themoviedb.org/3/search/movie', [
                'api_key' => env('TMDB_API_KEY'),
                'query'   => $q,
            ])->json('results', []);

            $results = collect($data);
        }

        return view('search', compact('results', 'q'));
    }
}
