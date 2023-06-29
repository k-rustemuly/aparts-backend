<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ObjectAddRequest extends FormRequest
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
            'city_id' => [
                'required',
                'exists:cities,id'
            ],
            'name_kk' => [
                'required',
                'max:255'
            ],
            'name_ru' => [
                'required',
                'max:255'
            ],
            'description_kk' => [
                'nullable',
                'string'
            ],
            'description_ru' => [
                'nullable',
                'string'
            ],
            'class_id' => [
                'required',
                'exists:object_classes,id'
            ],
            'technology_id' => [
                'required',
                'exists:construction_technologies,id'
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'city_id.required' => __('validation.required', ['attribute' => __('city')]),
            'city_id.exists' => __('validation.exists', ['attribute' => __('city')]),
            'name_kk.required' => __('validation.required', ['attribute' => __('name_kk')]),
            'name_kk.max' => __('validation.max.string', ['attribute' => __('name_kk')]),
            'name_ru.required' => __('validation.required', ['attribute' => __('name_ru')]),
            'name_ru.max' => __('validation.max.string', ['attribute' => __('name_ru')]),
            'class_id.required' => __('validation.required', ['attribute' => __('class')]),
            'class_id.exists' => __('validation.exists', ['attribute' => __('class')]),
            'technology_id.required' => __('validation.required', ['attribute' => __('technology')]),
            'technology_id.exists' => __('validation.exists', ['attribute' => __('technology')]),
        ];
    }
}
