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
            'category_id' => 'required|exists:categories,id',
            'venue_id' => 'required|exists:venues,id',
            'name' => 'required|string|unique:classes|max:255',
            'short_description' => 'required|string|max:500',
            'description' => 'nullable|string|max:5000',
            'image' => 'nullable|image|max:2048',
            'image_description' => 'nullable|string|max:255',
            'start_date' => 'nullable|date|after_or_equal:now',
            'notes' => 'nullable|string|max:1000',
        ];
    }
}
