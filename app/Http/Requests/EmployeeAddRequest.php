<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class EmployeeAddRequest extends FormRequest
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
            'email' => [
                'required',
                'email',
                'unique:users'
            ],
            'password' => [
                'required',
                'regex:/^[A-Za-z0-9\-\_\.\@]+$/'
            ],
            'role_id' => [
                'required',
                'exists:roles,id',
                function ($attribute, $value, $fail) {
                    // Проверка наличия роли "Пользователь" или "Администратор"
                    if ($value === 1 || $value === 3) {
                        $fail(__('Error added new employee by admin'));
                    }
                }
            ]
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => __('validation.required', ['attribute' => __('full_name')]),
            'name.max' => __('validation.max.string', ['attribute' => __('full_name')]),
            'email.required' => __('validation.required', ['attribute' => __('email')]),
            'email.email' => __('validation.email', ['attribute' => __('email')]),
            'email.unique' => __('validation.unique', ['attribute' => __('email2')]),
            'password.required' => __('validation.required', ['attribute' => __('password')]),
            'password.regex' => __('validation.regex', ['attribute' => __('password')]),
            'role_id.required' => __('validation.required', ['attribute' => __('position')]),
            'role_id.exists' => __('validation.exists', ['attribute' => __('position')]),
        ];
    }

}
