<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Services\BookService;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Symfony\Component\HttpKernel\Exception\HttpException;

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


    public function store(Request $request) : mixed
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
}
