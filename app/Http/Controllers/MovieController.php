<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
   public function index(Request $request)
{
    $query = Movie::query();

    //Search by movie title
    if ($request->search) {
        $query->where('title', 'LIKE', '%' . $request->search . '%');
    }

    //Filter by genre
    if ($request->genre) {
        $query->where('genre', $request->genre);
    }

    //Sort movies
    if ($request->sort) {
        switch ($request->sort) {
            case 'newest':
                $query->orderBy('release_year', 'desc');
                break;
            case 'oldest':
                $query->orderBy('release_year', 'asc');
                break;
            case 'highest':
                $query->orderBy('rating', 'desc');
                break;
            case 'lowest':
                $query->orderBy('rating', 'asc');
                break;
        }
    }

    // Get results with pagination and keep filters in URL
    $movies = $query->paginate(10)->withQueryString();

    // Get unique genres for dropdown
    $genres = Movie::select('genre')->distinct()->pluck('genre');

    return view('movies.index', compact('movies', 'genres'));
}



    public function create()
    {
        return view('movies.create');
    }

    public function store(Request $request)
    {
        $request->validate([
    'title' => 'required|max:255',
    'rating' => 'required|integer|min:1|max:5',
    'review' => 'required',
    'poster' => 'nullable|url',
    'genre' => 'nullable|string|max:50',
    'release_year' => 'nullable|integer|min:1888|max:' . date('Y'),
]);


        Movie::create($request->all());

        return redirect()->route('movies.index')->with('success', 'Movie added successfully!');
    }

    public function show(Movie $movie)
    {
        return view('movies.show', compact('movie'));
    }

    public function edit(Movie $movie)
    {
        return view('movies.edit', compact('movie'));
    }

    public function update(Request $request, Movie $movie)
    {
        $request->validate([
            'title' => 'required|max:255',
            'rating' => 'required|integer|between:1,5',
            'review' => 'required'
        ]);

        $movie->update($request->all());

        return redirect()->route('movies.index')->with('success', 'Movie updated successfully!');
    }

    public function destroy(Movie $movie)
    {
        $movie->delete();
        return redirect()->route('movies.index')->with('success', 'Movie deleted successfully!');
    }
}
