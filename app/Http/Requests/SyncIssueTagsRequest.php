<?php


namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SyncIssueTagsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'tag_ids'   => ['array'],
            'tag_ids.*' => ['integer','exists:tags,id'],
        ];
    }
}

