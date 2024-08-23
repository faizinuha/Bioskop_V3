<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GenreRequest extends FormRequest
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
            "genre" => "required|max:20|regex:/^[a-zA-Z\s]+$/|unique:genre,genre",
        ];
    }

    public function messages(): array
    {
        return[
            "genre.required"=> "Genre Harus Diisi",
            "genre.max"=> "Genre Harus Diisi",
            "genre.regex"=> "Genre Hanya Boleh Abjad",
            "genre.unique"=> "Genre Tidak Boleh Sama",
        ];
    }
}
