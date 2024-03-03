<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookRequest;
use App\Services\BookService;
use Illuminate\Http\Request;

class BookController extends Controller
{
    private $bookService;

    public function __construct()
    {

        $this->bookService = new BookService();

    }

    public function index() : mixed
    {

        return $this->bookService->getAllBooks();

    }


    public function store(BookRequest $request) : mixed
    {
        return $this->bookService->createBooks($request);
    }


    public function show(string $id) : mixed
    {
       return  $this->bookService->showBooks($id);
    }


    public function update(Request $request, string $id) : mixed
    {
        return $this->bookService->updateBooks($request, $id);
    }

    public function destroy(string $id) : mixed
    {
        return $this->bookService->destroyBooks($id);
    }

    public function listBookOrGenre(Request $request)
    {
        return $this->bookService->getBookOrGenre($request);
    }
}
