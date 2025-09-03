<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SyncIssueUsersRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'user_ids'   => ['array'],          
            'user_ids.*' => ['integer','exists:users,id'],
        ];
    }
}