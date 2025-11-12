<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\OmdbService;

class OmdbController extends Controller
{
    protected $omdb;

    public function __construct(OmdbService $omdb)
    {
        $this->omdb = $omdb;
    }

    // request to OMBD by title
    public function byTitle(Request $request)
    {
        $request->validate(['title' => 'required|string']);
        $data = $this->omdb->getByTitle($request->title);
        return response()->json($data);
    }

    // request to OMBD by ID
    public function byId(Request $request)
    {
        $request->validate(['id' => 'required|string']);
        $data = $this->omdb->getById($request->id);
        return response()->json($data);
    }
}
