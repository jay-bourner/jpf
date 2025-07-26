<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminClassRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:5000',
            'category_id' => 'required|exists:categories,id',
            'venue_id' => 'required|exists:venues,id',
            'short_description' => 'required|string|max:500',
            'image' => 'nullable|image|max:2048',
            'image_description' => 'nullable|string|max:255',
            // 'notes' => 'nullable|string|max:1000',
        ];
    }
}
