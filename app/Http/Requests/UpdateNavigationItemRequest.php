<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateNavigationItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->isAdmin();
    }

    public function rules(): array
    {
        return [
            'parent_id' => 'nullable|exists:navigation_items,id',
            'label' => 'required|string|max:255',
            'url' => 'nullable|url|max:2000',
            'route_name' => 'nullable|string|max:255',
            'icon' => 'nullable|string|max:255',
            'is_external' => 'boolean',
            'target_attribute' => 'in:_self,_blank,_parent,_top',
            'is_visible' => 'boolean',
            'order' => 'integer|min:0',
            'attributes' => 'nullable|json',
        ];
    }

    public function messages(): array
    {
        return [
            'label.required' => 'Menu item label is required.',
            'url.url' => 'Please enter a valid URL.',
        ];
    }
}
