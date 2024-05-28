<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AcceuilInterfaceAjoutRequest extends FormRequest
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
            'titre' => ['required', 'min:3'],
            'contenu_1' => ['required', 'min:10'],
            'image' => ['required','image','max:20000'],
            'liste' => [],
            'contenu_2' => []
        ];
    }
}
