<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClientRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nom' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:clients,email,'.$this->client->id,
            'telephone' => 'required|string|max:20',
            'adresse' => 'required|string|max:255',
        ];
    }
}
