<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthorRequest;
use App\Services\AuthorService;



class AuthorController extends Controller
{
    protected $authorService;

    public function __construct()
    {
        $this->authorService = new AuthorService();
    }

    public function index() : mixed
    {
        return $this->authorService->getAllAuthors();
    }


    public function store(AuthorRequest $request) : mixed
    {
      return $this->authorService->createAuthor($request);
    }


    public function show(string|int $id) : mixed
    {
        return $this->authorService->showAuthor($id);
    }


    public function update(AuthorRequest $request, string|int $id) : mixed
    {
       return $this->authorService->updateAuthor($request, $id);
    }


    public function destroy(string|int $id) : mixed
    {
        return $this->authorService->destroyAuthor($id);
    }
}
