<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $userId = $this->route('user'); 

        return [
            'name'      => ['required', 'string', 'max:255'],
            'surname'   => ['required', 'string', 'max:255'],
            'email'     => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($userId),
            ],
            // 'phone'     => [
            //     'nullable',
            //     'string',
            //     'max:100',
            //     Rule::unique('users', 'phone')->ignore($userId),
            // ],
            'role'      => ['required', 'exists:roles,name'],
            'status'    => ['required', 'boolean'],
            'two_factor'=> ['required', 'boolean'],
        ];
    }
}
