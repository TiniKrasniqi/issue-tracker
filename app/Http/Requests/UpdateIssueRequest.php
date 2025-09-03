<?php

// app/Http/Requests/UpdateIssueRequest.php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateIssueRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'project_id'  => ['required','exists:projects,id'],
            'title'       => ['required','string','max:255'],
            'description' => ['nullable','string'],
            'status'      => ['required','in:open,in_progress,closed'],
            'priority'    => ['required','in:low,medium,high'],
            'due_date'    => ['nullable','date'],
        ];
    }
}
