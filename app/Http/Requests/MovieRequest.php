<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MovieRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'release_date' => 'nullable|date',
            'poster_url' => 'nullable|url',
            'director' => 'nullable|string|max:255',
            'runtime_minutes' => 'nullable|integer|min:0',
            'actors' => 'nullable|string',
        ];
    }
}
