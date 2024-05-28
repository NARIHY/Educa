<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MessageRecuRequest extends FormRequest
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
            'nom' => ['required', 'min:3'],
            'prenon' => ['required', 'min:3'],
            'email' => ['required', 'email'],
            'sujet' => ['required'],
            'introduction' => ['required'],
            'contenu' => ['required'],
            'fin' => ['required']
        ];
    }
}
