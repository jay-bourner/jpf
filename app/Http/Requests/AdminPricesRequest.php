<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminPricesRequest extends FormRequest
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
            'price' => 'required|numeric|min:0',
            'type' => 'required|string|in:payg,term',
            'classes' => 'required|integer|min:1',
            'amount' => 'nullable|numeric|min:0',
            'period' => 'nullable|string',
            'notes' => 'nullable|string|max:255',
        ];
    }
}
