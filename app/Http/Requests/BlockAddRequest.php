<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class BlockAddRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::user()->isAdmin();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'max:255'
            ],
            'cadastral_number' => [
                'nullable',
                'string'
            ],
            'start' => [
                'nullable',
                'date_format:d.m.Y'
            ],
            'end' => [
                'nullable',
                'after_or_equal:start'
            ],
            'storeys_number' => [
                'nullable',
                'integer',
                'min:1'
            ],
            'heating_type_id' => [
                'required',
                'exists:heating_types,id'
            ],
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'name.required' => __('validation.required', ['attribute' => __('name')]),
            'name.max' => __('validation.max.string', ['attribute' => __('name')]),
        ];
    }
}
