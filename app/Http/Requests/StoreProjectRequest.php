<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class StoreProjectRequest extends Request
{
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
            'project_name' => 'required|max:150',
            'project_creator' => 'max:150',
            'project_adress' => 'max:150',
            'project_email' => 'max:50',
            'project_phone' => 'max:15',
            'project_mediator' => 'max:150',
            'mediator_adress' => 'max:150',
            'mediator_email' => 'max:50',
            'mediator_phone' => 'max:15',
            'project_type' => 'required|max:30',
        ];
    }
    public function messages()
    {
        return [
            'project_name.required' => 'Un nom de projet est nécessaire',
            'project_name.max' => 'Votre nom de projet dépasse les 150 caractères',
            'project_creator.max' => 'le nom, prénom et fonction du commanditaire ne doit pas dépasser les 150 caractères',
            'project_adress.max' => 'l\'adresse du commanditaire ne doit pas dépasser les 150 caractères',
            'project_email.max' => 'L\'adresse mail du commanditaire ne doit pas dépasser les 50 caractères',
            'project_phone.max' => 'Le numéro de téléphone du commanditaire ne doit pas dépasser les 15 caractères',
            'project_mediator.max' => 'le nom, prénom et fonction de la personne à contacter ne doit pas dépasser les 150 caractères',
            'mediator_adress.max' => 'l\'adresse du contact ne doit pas dépasser les 150 caractères',
            'mediator_email.max' => 'L\'adresse mail du contact ne doit pas dépasser les 50 caractères',
            'mediator_phone.max' => 'Le numéro de téléphone du contact ne doit pas dépasser les 15 caractères',
            'project_type.required' => 'Veuillez définir le type de projet',
            'project_type.max' => 'le type de projet défini est invalide',
        ];
    }
}
