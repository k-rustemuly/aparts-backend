<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class FlatAddRequest extends FormRequest
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
            'floor' => [
                'required',
                'integer',
            ],
            'number' => [
                'required',
                'integer',
                'min:1'
            ],
            'room' => [
                'required',
                'integer',
                'min:1'
            ],
            'area' => [
                'required',
                'decimal:2',
            ],
            'ceiling_height' => [
                'required',
                'decimal:2',
            ],
            'finishing_status_id' => [
                'required',
                'exists:finishing_statuses,id'
            ],
            'price' => [
                'required',
                'decimal:2',
            ],
        ];
    }
}
