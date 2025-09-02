<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateMailSettingsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->can('settings.manage');
    }

    public function rules(): array
    {
        return [
            'mail_mailer'       => ['required', Rule::in(['smtp','mail','log','array','ses','postmark','mailgun'])],
            'mail_from_address' => ['required', 'email:rfc,dns'],
            'mail_host'         => ['required_if:mail_mailer,smtp', 'string', 'max:255'],
            'mail_port'         => ['required_if:mail_mailer,smtp', 'integer', 'between:1,65535'],
            'mail_username'     => ['required_if:mail_mailer,smtp', 'string', 'max:255'],
            'mail_password'     => ['required_if:mail_mailer,smtp', 'string', 'max:1024'],
            'mail_encryption'   => ['nullable', Rule::in(['tls','ssl'])],
            'mail_from_name'    => ['nullable', 'string', 'max:255'],
        ];
    }

    public function messages(): array
    {
        return [
            'mail_port.between' => 'The mail port must be between 1 and 65535.',
        ];
    }
}
