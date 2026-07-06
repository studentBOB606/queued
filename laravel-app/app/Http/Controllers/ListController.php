<?php

namespace App\Http\Controllers;

use App\Models\UserList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ListController extends Controller
{
    public function index()
    {
        $films = UserList::where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('List', compact('films'));
    }

    public function store(Request $request)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $request->validate([
            'tmdb_id'     => ['required', 'integer'],
            'title'       => ['required', 'string'],
            'poster_path' => ['nullable', 'string'],
        ]);

        UserList::firstOrCreate(
            ['user_id' => Auth::id(), 'tmdb_id' => $request->tmdb_id],
            ['title' => $request->title, 'poster_path' => $request->poster_path]
        );

        return back()->with('added', 'Film added to your list!');
    }

    public function destroy($tmdb_id)
    {
        UserList::where('user_id', Auth::id())
            ->where('tmdb_id', $tmdb_id)
            ->delete();

        return back()->with('removed', 'Film removed from your list.');
    }
}
