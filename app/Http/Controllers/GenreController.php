<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if($genres = Genre::all())

            return response()->json($genres, Response::HTTP_OK);
        else
            return response()->json(['Error' => 'An error occurred in the request' ],Response::HTTP_BAD_GATEWAY);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            Genre::create($request->all());

            return response()->json(['message' => 'Genre successfully registered.'], Response::HTTP_CREATED);
        } catch (ValidationException $e) {

            return response()->json(['erros' => $e->errors()], Response::HTTP_UNPROCESSABLE_ENTITY);
        } catch (\Exception $e) {

            return response()->json(['mensagem' => 'Failed to register the Genre.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $genre = Genre::find($id);

        return ($genre) ? response()->json($genre,Response::HTTP_FOUND):response()->json(['error' => 'Genre Not Found'], Response::HTTP_NOT_FOUND);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try{

            $genre = Genre::findOrFail($id);

            $genre->update($request->all());

            return response()->json(['Success' => 'genre data changed successfully!'],Response::HTTP_OK);

        }catch( HttpException $e){
            return response()->json(['Error' => $e->getMessage()],Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{

            if(Genre::destroy($id))

                return response()->json(['success'=> 'sucessfully delete genre.']);
            else

                throw new Exception("error when deleting Genre with id {$id}", Response::HTTP_BAD_REQUEST);
        }catch (Exception $e){

            return response()->json(['error' => "{$e->getMessage()}"]);
        }
    }
}
