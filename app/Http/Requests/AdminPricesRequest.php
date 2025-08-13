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
        $priceType = request('type');

        return [
            'price' => 'required|numeric|min:0',
            'type' => 'required|string|in:payg,term',
            'classes' => ($priceType == 'payg') ? '' : 'required|integer|min:1',
            'period' => ($priceType == 'payg') ? '' : 'required|nullable|string',
            'notes' => 'nullable|string|max:255',
        ];
    }
}
