<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Symfony\Component\HttpKernel\Exception\HttpException;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        if($books = Book::all())

            return response()->json($books, Response::HTTP_OK);
        else
            return response()->json(['Error' => 'An error occurred in the request' ],Response::HTTP_BAD_GATEWAY);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            Book::create($request->all());

            return response()->json(['message' => 'Book successfully registered.'], Response::HTTP_CREATED);
        } catch (ValidationException $e) {

            return response()->json(['erros' => $e->errors()], Response::HTTP_UNPROCESSABLE_ENTITY);
        } catch (\Exception $e) {

            return response()->json(['mensagem' => 'Failed to register the Book.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $book = Book::find($id);

        return ($book) ? response()->json($book,Response::HTTP_FOUND):response()->json(['error' => 'Book Not Found'], Response::HTTP_NOT_FOUND);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
                $book = Book::findOrFail($id);

                if ($book->update($request->all())) {
                    return response()->json(['Success' => 'Book data changed successfully!'], Response::HTTP_OK);
                } else {
                    throw new HttpException(Response::HTTP_BAD_REQUEST, "Error changing data in the {$book['book_name']} book. Check the passed parameters");
                }

        } catch (HttpException $e) {

            return response()->json(['error' => "erro ao sadfas}"], Response::HTTP_BAD_REQUEST);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            
                if(Book::destroy($id))
                    return response()->json(['success'=> 'sucessfully delete book.']);
                else
                    throw new Exception("error when deleting book with id {$id}", Response::HTTP_BAD_REQUEST);
        }catch (Exception $e){
            return response()->json(['error' => "{$e->getMessage()}"]);
        }
    }
}
