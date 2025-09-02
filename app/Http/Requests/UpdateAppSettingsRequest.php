<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAppSettingsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->can('settings.manage');
    }

    public function rules(): array
    {
        return [
            'footer_link_name' => ['required', 'string', 'max:255'],
            'footer_link_url'  => ['required', 'url', 'max:2048'],
            'footer_link_text' => ['required', 'string', 'max:2000'],
            'logo_dark_image'  => ['nullable', 'file', 'image', 'mimes:png,jpg,jpeg,webp,svg', 'max:2048'],
            'logo_light_image' => ['nullable', 'file', 'image', 'mimes:png,jpg,jpeg,webp,svg', 'max:2048'],
            'logo_dark_icon'   => ['nullable', 'file', 'image', 'mimes:png,jpg,jpeg,webp,svg', 'max:2048'],
            'logo_light_icon'  => ['nullable', 'file', 'image', 'mimes:png,jpg,jpeg,webp,svg', 'max:2048'],
        ];
    }

    public function attributes(): array
    {
        return [
            'footer_link_url' => 'footer link URL',
        ];
    }
}
