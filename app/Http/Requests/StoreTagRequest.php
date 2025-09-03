<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTagRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check(); 
    }

    public function rules(): array
    {
        return [
            'name'  => ['required','string','max:255','unique:tags,name'],
            'color' => ['nullable','string','max:20'],
        ];
    }
}
