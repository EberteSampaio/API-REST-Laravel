<?php

namespace App\Services;

use App\Http\Requests\AuthorRequest;
use App\Models\Author;
use Exception;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;

class AuthorService
{
    /**
     * Display a listing of the resource.
     */
    public function getAllAuthors() : mixed
    {
        if($authors = Author::all())

            return response()->json($authors, Response::HTTP_OK);
        else
            return response()->json(['Error' => 'An error occurred in the request' ],Response::HTTP_BAD_GATEWAY);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function createAuthor(AuthorRequest $request) :mixed
    {
        try {
            Author::create($request->all());

            return response()->json(['message' => 'Author successfully registered.'], Response::HTTP_CREATED);
        } catch (ValidationException $e) {

            return response()->json(['erros' => $e->errors()], Response::HTTP_UNPROCESSABLE_ENTITY);
        } catch (\Exception $e) {

            return response()->json(['mensagem' => 'Failed to register the author.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Display the specified resource.
     */
    public function showAuthor(string|int $id) : mixed
    {
        $author = Author::find($id);

        return ($author) ? response()->json($author,Response::HTTP_FOUND):response()->json(['error' => 'Author Not Found'], Response::HTTP_NOT_FOUND);
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateAuthor(AuthorRequest $request, string|int $id) : mixed
    {
        try{

            $author = Author::findOrFail($id);

            $author->update($request->all());

            return response()->json(['Success' => 'Author data changed successfully!'],Response::HTTP_OK);

        }catch( HttpException $e){
            return response()->json(['Error' => $e->getMessage()],Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroyAuthor(string|int $id) : mixed
    {

        try{

            if(Author::destroy($id))

                return response()->json(['success'=> 'sucessfully delete genre.']);
            else

                throw new Exception("error when deleting Author with id {$id}", Response::HTTP_BAD_REQUEST);
        }catch (Exception $e){

            return response()->json(['error' => "{$e->getMessage()}"]);
        }
    }
}
