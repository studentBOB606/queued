<?php

namespace App\Http\Controllers;

use App\Models\Film;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class FilmController extends Controller
{public function index()
{
    $apiKey = env('TMDB_API_KEY');

    $trendingResponse = Http::get('https://api.themoviedb.org/3/trending/movie/week', [
        'api_key' => $apiKey,
    ]);

    $popularResponse = Http::get('https://api.themoviedb.org/3/movie/popular', [
        'api_key' => $apiKey,
    ]);

    $trendingFilms = $trendingResponse->json()['results'] ?? [];
    $popularFilms = $popularResponse->json()['results'] ?? [];

    return view('Film', compact('trendingFilms', 'popularFilms'));
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
