<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCommentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'author_name' => ['required', 'string', 'max:255'],
            'body'        => ['required', 'string', 'max:5000'],
        ];
    }

    public function messages(): array
    {
        return [
            'author_name.required' => 'Please enter your name.',
            'body.required'        => 'Please write a comment.',
        ];
    }
}
