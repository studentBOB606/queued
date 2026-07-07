<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class WelcomeController extends Controller
{
    public function index()
    {
        $key  = config('services.tmdb.key');
        $base = 'https://api.themoviedb.org/3';

        $trending = Http::get("{$base}/trending/movie/week", ['api_key' => $key])
            ->json('results', []);

        $popular = Http::get("{$base}/movie/popular", ['api_key' => $key])
            ->json('results', []);

        $upcoming = Http::get("{$base}/discover/movie", [
            'api_key'                    => $key,
            'primary_release_date.gte'   => now()->toDateString(),
            'primary_release_date.lte'   => now()->addMonths(3)->toDateString(),
            'sort_by'                    => 'popularity.desc',
        ])->json('results', []);

        return view('welcome', [
            'trendingFilms' => array_slice($trending, 0, 8),
            'popularFilms'  => array_slice($popular, 0, 8),
            'upcomingFilms' => array_slice($upcoming, 0, 8),
        ]);
    }
}
