<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
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
            'author_name' => ['required'],
        ];
    }

    public function messages()
    {
        return [
          //  "min"       => "The :attribute must be at least three letters long.",
            "required"  => "The :attribute is mandatory."
        ];
    }

    public function attributes()
    {
        return [
            "author_name" => "author's name"
        ];
    }
}
