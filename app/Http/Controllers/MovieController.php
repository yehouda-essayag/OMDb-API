<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Movie;
use App\Http\Requests\MovieRequest;

class MovieController extends Controller
{

    // return movies with requested genre , null or 0 return all 
    public function byGenre($genreId = null)
    {
        if (is_null($genreId) || $genreId == 0) {
            // return all movies if no genre selected
            $movies = Movie::all();
        } else {
            // return movies filtered by genre
            $movies = Movie::whereHas('genres', function ($query) use ($genreId) {
                $query->where('genres.id', $genreId);
            })->get();
        }

        return response()->json($movies);
    }

    // get a movie by id
    public function getId($id)
    {
        // Find the movie by ID
        $movie = Movie::find($id);

        // Check if movie exists
        if (!$movie) {
            return response()->json(['message' => 'Movie not found'], 404);
        }

        // Return the movie as JSON
        return response()->json($movie);
    }

    // Update or create movie by ID
    public function save(MovieRequest $request, $id = null)
    {
        // If no ID or ID = 0, create a new movie
        if (!$id || $id == 0) {
            $movie = Movie::create($request->validated());
        } else {
            // Find the movie or fail
            $movie = Movie::findOrFail($id);
            // Only validated fields will be used
            $movie->update($request->validated());
        }

        // Return movie as JSON
        return response()->json([
            'success' => true,
            'movie' => $movie
        ]);
    }

}
