<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Genre;

class GenreController extends Controller
{
    // return id & name of all Genre
    public function indexNames()
    {
        $genres = Genre::select('id', 'name')->get(); 
        return response()->json($genres);
    }
}