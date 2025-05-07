<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClientRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nom' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:clients',
            'telephone' => 'required|string|max:20',
            'adresse' => 'required|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'nom.required' => 'Le nom du client est obligatoire',
            'email.unique' => 'Cet email est déjà utilisé par un autre client',
            'telephone.required' => 'Le numéro de téléphone est obligatoire',
            'adresse.required' => 'L\'adresse est obligatoire',
        ];
    }
}
