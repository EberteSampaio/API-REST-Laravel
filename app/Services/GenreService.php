<?php
namespace App\Services;

use App\Http\Requests\GenreRequest;
use Illuminate\Http\Response;
use App\Models\Genre;
use Dotenv\Exception\ValidationException;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

class GenreService {


    public function getAllGenres() : mixed
    {

        if(empty($genres = Genre::all()))
            return response()->json(['Error' =>['message' => 'An Error occurred in the request']],Response::HTTP_BAD_GATEWAY);

        return response()->json($genres, Response::HTTP_OK);

    }

    public function createGenre(GenreRequest $request) : mixed
    {
        try {
            Genre::create($request->all());

            return response()->json(['success' =>['message' => 'Genre successfully registered.']], Response::HTTP_CREATED);
        } catch (ValidationException $e) {

            return response()->json(['Error' =>['message' => $e->getMessage()]], Response::HTTP_UNPROCESSABLE_ENTITY);
        } catch (Exception $e) {

            return response()->json(['Error' =>['message'=> 'Failed to register the Genre.']], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function showGenre(int|string $id) : mixed
    {
        $genre = Genre::find($id);

        return ($genre) ? response()->json($genre,Response::HTTP_FOUND):response()->json(['Error' =>['message' => 'Genre Not Found']], Response::HTTP_NOT_FOUND);

    }

    public function updateGenre(Request $request, int|string $id) : mixed
    {
        try{

            $genre = Genre::findOrFail($id);

            $genre->update($request->all());

            return response()->json(['Success' => ['message' =>'genre data changed successfully!']],Response::HTTP_OK);

        }catch( HttpException $e){
            return response()->json(['Error' => ['message' => $e->getMessage()]],Response::HTTP_BAD_REQUEST);
        }
    }

    public function destroyGenre (int|string $id) : mixed
    {
        try{

            if(Genre::destroy($id))
                return response()->json(['success'=> ['message' => 'sucessfully delete genre.']]);
            else
                throw new Exception("Error when deleting book with id {$id}", Response::HTTP_BAD_REQUEST);
        }catch (Exception $e){
            return response()->json(['Error' => ['message' => "{$e->getMessage()}"]]);
    }
    }

}
