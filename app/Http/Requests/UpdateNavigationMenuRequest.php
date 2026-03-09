<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateNavigationMenuRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->isAdmin();
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255|unique:navigation_menus,name,' . $this->menu->id,
            'slug' => 'required|string|max:255|unique:navigation_menus,slug,' . $this->menu->id . '|regex:/^[a-z0-9\-]+$/',
            'description' => 'nullable|string|max:1000',
            'position' => 'required|in:header,footer,mobile,custom',
            'is_active' => 'boolean',
            'order' => 'integer|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'slug.regex' => 'Slug must contain only lowercase letters, numbers, and hyphens.',
        ];
    }
}
