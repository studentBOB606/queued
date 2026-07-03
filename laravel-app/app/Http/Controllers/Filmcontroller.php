<?php

namespace App\Http\Controllers;

use App\Models\Film;
use Illuminate\Http\Request;

class Filmcontroller extends Controller
{
    public function index()
    {
        $trendingFilms = Film::orderBy('rating', 'desc')
            ->take(5)
            ->get();

        $popularFilms = Film::latest()
            ->take(5)
            ->get();

        return view('Film', compact('trendingFilms', 'popularFilms'));
    }
}
