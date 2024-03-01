<?php
namespace App\Services;

use Illuminate\Http\Response;
use App\Models\Genre;
use Dotenv\Exception\ValidationException;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

class GenreService {


    public function getAllGenres() : mixed
    {

        if($genres = Genre::all())

            return response()->json($genres, Response::HTTP_OK);
        else
            return response()->json(['Error' => 'An error occurred in the request' ],Response::HTTP_BAD_GATEWAY);
    }

    public function createGenre(Request $request) : mixed
    {
        try {
            Genre::create($request->all());

            return response()->json(['message' => 'Genre successfully registered.'], Response::HTTP_CREATED);
        } catch (ValidationException $e) {

            return response()->json(['erros' => $e->getMessage()], Response::HTTP_UNPROCESSABLE_ENTITY);
        } catch (Exception $e) {

            return response()->json(['mensagem' => 'Failed to register the Genre.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function showGenre(int|string $id) : mixed
    {
        $genre = Genre::find($id);

        return ($genre) ? response()->json($genre,Response::HTTP_FOUND):response()->json(['error' => 'Genre Not Found'], Response::HTTP_NOT_FOUND);

    }

    public function updateGenre(Request $request, int|string $id) : mixed
    {
        try{

            $genre = Genre::findOrFail($id);

            $genre->update($request->all());

            return response()->json(['Success' => 'genre data changed successfully!'],Response::HTTP_OK);

        }catch( HttpException $e){
            return response()->json(['Error' => $e->getMessage()],Response::HTTP_BAD_REQUEST);
        }
    }

    public function destroyGenre (int|string $id) : mixed
    {
        try{

            if(Genre::destroy($id))
                return response()->json(['success'=> 'sucessfully genre book.']);
            else
                throw new Exception("error when deleting book with id {$id}", Response::HTTP_BAD_REQUEST);
        }catch (Exception $e){
            return response()->json(['error' => "{$e->getMessage()}"]);
    }
    }

}
