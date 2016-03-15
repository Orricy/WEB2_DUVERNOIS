<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class StorePostRequest extends Request
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
            'title' => 'required|min:10|max:150',
            'description' => 'required|min:10',
        ];
    }
    public function messages()
    {
        return [
            'title.required' => 'Titre requis',
            'title.min' => 'Titre de 10 caractères au moins',
            'title.max' => 'Titre de 150 caractères maximum',
            'description.required' => 'Description requise',
            'description.min' => 'Description de 10 caractères au moins',
        ];
    }
}
