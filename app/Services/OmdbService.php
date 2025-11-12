<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class OmdbService
{
    protected $apiKey;
    protected $baseUrl = 'http://www.omdbapi.com/';

    public function __construct()
    {
        $this->apiKey = env('OMDB_API_KEY');
    }

    // Search by title
    public function getByTitle(string $title)
    {
        $response = Http::get($this->baseUrl, [
            't' => $title,
            'apikey' => $this->apiKey
        ]);

        return $response->json();
    }

    // Search by IMDB ID
    public function getById(string $id)
    {
        $response = Http::get($this->baseUrl, [
            'i' => $id,
            'apikey' => $this->apiKey
        ]);

        return $response->json();
    }
}
