<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRoleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->can('role.edit');
    }

    public function rules(): array
    {
        $roleId = $this->route('roleid');

        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('roles', 'name')->ignore($roleId),
            ],
            'guard_name'   => ['nullable', 'string', 'max:255'],
            'permissions'  => ['nullable', 'array'],
            'permissions.*'=> ['integer', 'exists:permissions,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'permissions.*.exists' => 'One or more selected permissions are invalid.',
        ];
    }
}
