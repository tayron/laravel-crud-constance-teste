<?php
namespace App\Http\Requests\Profiles;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|unique:profiles|max:255',
            'description' => 'required|max:255'
        ];
    }
    
    public function messages()
    {
        return [
            'name.required' => 'O campo Nome do Perfil não pode ser vazio',
            'name.unique' => 'O Nome do Perfil já existe cadastrado no sistema',
            'name.max' => 'O Nome do Perfil não pode ter mais de 255 caracteres',
            'description.required' => 'O campo Descrição do Perfil não pode ser vazio',
            'description.max' => 'O Nome do Descrição não pode ter mais de 255 caracteres',
        ];
    }    
}
