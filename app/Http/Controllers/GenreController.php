<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Services\GenreService;
use Illuminate\Http\Request;


class GenreController extends Controller
{
    protected $genreService;

    public function __construct()
    {
        $this->genreService = new GenreService();
    }

    public function indgetAllGenresx() : mixed
    {
        return $this->genreService->getAllGenres();
    }

    public function store(Request $request) : mixed
    {
        return $this->genreService->createGenre($request);
    }

    public function show(string|int $id) : mixed
    {
        return $this->genreService->showGenre($id);
    }

    public function update(Request $request, string $id)
    {
        return $this->genreService->updateGenre($request, $id);
    }

    public function destroy(string|int $id) :mixed
    {
       return $this->genreService->destroyGenre($id);
    }
}
