<?php

namespace App\Services;

use App\Http\Requests\BookRequest;
use App\Models\Book;
use Exception;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use PhpParser\Node\Stmt\TryCatch;
use Symfony\Component\HttpKernel\Exception\HttpException;

class BookService
{
    /**
     * Display a listing of the resource.
     */
    public function getAllBooks() : mixed
    {
        if($books = Book::all())

            return response()->json($books, Response::HTTP_OK);
        else
            return response()->json(['Error' =>['message' => 'An error occurred in the request' ]],Response::HTTP_BAD_GATEWAY);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function createBooks(BookRequest $request) :mixed
    {
        try {
            Book::create($request->all());

            return response()->json(['message' => 'Books successfully registered.'], Response::HTTP_CREATED);
        } catch (ValidationException $e) {

            return response()->json(['Error' => $e->errors()], Response::HTTP_UNPROCESSABLE_ENTITY);
        } catch (\Exception $e) {

            return response()->json(['Error' => ['message'=>'Failed to register the Books.']], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Display the specified resource.
     */
    public function showBooks(string|int $id) : mixed
    {
        $books = Book::find($id);

        return ($books) ? response()->json($books,Response::HTTP_FOUND):response()->json(['Error' =>['message' => 'Books Not Found']], Response::HTTP_NOT_FOUND);
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateBooks(Request $request, string|int $id) : mixed
    {
        try{

            $books = Book::findOrFail($id);

            $books->update($request->all());

            return response()->json(['Success' => 'Books data changed successfully!'],Response::HTTP_OK);

        }catch( HttpException $e){
            return response()->json(['Error' =>['message' => $e->getMessage()]],Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroyBooks(string|int $id) : mixed
    {

        try{

            if(Book::destroy($id))

                return response()->json(['success'=> 'sucessfully delete genre.'],Response::HTTP_OK);
            else

                throw new Exception("Error when deleting Books with id {$id}", Response::HTTP_BAD_REQUEST);
        }catch (Exception $e){

            return response()->json(['Error' =>['message'=> "{$e->getMessage()}"]], Response::HTTP_BAD_REQUEST);
        }
    }

    public function getBookOrGenre(Request $request){

        try{

            $sqlBook = Book::query();

            if(!empty($request->authorId)){

                $sqlBook->where('author_id',$request->authorId);
            }
            if(!empty($request->genreId)){

                $sqlBook->where('genre_id',$request->genreId);
            }

            if(empty($book = $sqlBook->get())){

                throw new HttpException(Response::HTTP_NOT_FOUND,"The requested book could not be found, please try new parameters");
            }

            return response()->json($book,Response::HTTP_OK);

        }catch(HttpException $e){

            return response()->json(['Error'=>['message' => "{$e->getMessage()}"]],Response::HTTP_NOT_FOUND);
        }

    }

    public function countBookByGenre(Request $request)
    {
        try {
            if (empty($request->genreId)) {
                throw new HttpException(Response::HTTP_BAD_REQUEST, 'It is necessary to enter the gender for the search');
            }

            $bookGenre = Book::where('genre_id', $request->genreId)->count();

            if ($bookGenre == 0) {

                throw new HttpException(Response::HTTP_NOT_FOUND, 'No book with the given genre was found.');
            }

            return response()->json(['message' => "{$bookGenre} books with this genre were found.", 'data' => $bookGenre], Response::HTTP_OK  );

        }catch (HttpException $e) {
            return response()->json(['error' => ['message' => $e->getMessage()]], Response::HTTP_BAD_REQUEST);
        }
    }

}
