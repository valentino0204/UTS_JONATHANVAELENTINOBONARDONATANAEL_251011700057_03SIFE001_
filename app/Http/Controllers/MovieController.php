<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    private array $sorts = [
        'judul'  => ['title', 'asc'],
        'tahun'  => ['release_years', 'desc'],
        'durasi' => ['duration', 'desc'],
    ];

    public function index(Request $request)
    {
        $sort = array_key_exists($request->sort, $this->sorts) ? $request->sort : 'judul';
        [$column, $direction] = $this->sorts[$sort];

        $movies = Movie::query()
            ->when($request->q, fn ($q, $s) => $q->where('title', 'like', "%{$s}%"))
            ->when($request->genre, fn ($q, $g) => $q->where('genre', $g))
            ->orderBy($column, $direction)
            ->paginate(8)
            ->withQueryString();

        $genres = Movie::select('genre')->distinct()->orderBy('genre')->pluck('genre');

        $isFiltering = $request->filled('q') || $request->filled('genre')
            || $request->filled('sort') || $request->integer('page', 1) > 1;

        
        $latest = $isFiltering
            ? collect()
            : Movie::orderByDesc('release_years')->orderBy('title')->take(5)->get();

        return view('movies.index', compact('movies', 'genres', 'sort', 'latest'));
    }

    public function show(Movie $movie)
    {
        $related = Movie::where('genre', $movie->genre)
            ->where('id', '!=', $movie->id)
            ->inRandomOrder()
            ->take(4)
            ->get();

        return view('movies.show', compact('movie', 'related'));
    }
}