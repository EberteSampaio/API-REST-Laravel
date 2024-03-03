<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'book_name' => ['required','min:3'],
            'author_id' => ['required'],
            'genre_id'  => ['required']
        ];
    }

    public function messages()
    {
        return [
            'required' => 'It is necessary to specify the :attribute'
        ];
    }

    public function attributes()
    {
        return[
            'book_name' =>'name of the book',
            'author_id' => 'author id',
            'genre_id' => 'genre id'
        ];
    }
}
