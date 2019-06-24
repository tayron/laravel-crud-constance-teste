<?php
namespace App\Http\Requests\Users;

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
            'profile_id' => 'required',
            'name' => 'required|unique:users|max:255',
            'email' => 'required|email|unique:users|max:255',
            'phone' => 'required|max:255',
            'birthdate' => 'required|max:255',
            'occupation' => 'required|max:255',
            'salary' => 'required|regex:/^\d{1,3}(?:\.\d{3})*?,\d{2}/',
            'photo' => 'required',
        ];
    }
    
    public function messages()
    {
        return [
            'profile_id.required' => 'O campo Perfil não pode ser vazio',
            'name.required' => 'O campo Nome do Usuário não pode ser vazio',
            'name.unique' => 'O Nome do Usuário já existe cadastrado no sistema',
            'name.max' => 'O Nome do Usuário não pode ter mais de 255 caracteres',
            'email.required' => 'O campo Email não pode ser vazio',
            'email.email' => 'O Email informado é inválido',
            'email.unique' => 'O Email já existe cadastrado no sistema',
            'email.max' => 'O Email não pode ter mais de 191 caracteres',
            'phone.required' => 'O campo Nome do Usuário não pode ser vazio',
            'phone.max' => 'O Nome do Usuário não pode ter mais de 191 caracteres',
            'birthdate.required' => 'O campo Nome do Usuário não pode ser vazio',
            'birthdate.max' => 'O Nome do Usuário não pode ter mais de 255 caracteres',
            'salary.required' => 'O Valor do Salário deve ser informado',
            'salary.regex' => 'O Valor do Salário deve ser no formato 00,00 ou 0.000,00',
            'photo.required' => 'O campo Foto é obrigatório',
        ];
    }    
}
