<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ClientAddRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::user()->isEmployee();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'iin' => [
                'required',
                'digits:12',
                'unique:clients'
            ],
            'phone_number' => [
                'required',
                'regex:/^\+7\(\d{3}\)\d{3}-\d{2}-\d{2}$/'
            ],
            'surname' => [
                'required',
                'string'
            ],
            'name' => [
                'required',
                'string'
            ],
            'patronymic' => [
                'nullable',
                'string'
            ],
        ];
    }
}
