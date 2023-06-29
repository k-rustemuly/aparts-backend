<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class BookingAddRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::user()->isAdmin() || Auth::user()->isManager();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'client_id' => [
                'required',
                'exists:clients,id'
            ],
            'transaction_id' => [
                'nullable',
                'exists:transactions,id'
            ],
            'price' => [
                'required',
                'decimal:2'
            ],
            'bank_id' => [
                'nullable',
                'exists:banks,id'
            ],
            'mortgage_sum' => [
                'required_with:bank_id',
                'decimal:2'
            ],
            'trade_in_sum' => [
                'nullable',
                'decimal:2'
            ],
            'installment_plan_sum' => [
                'nullable',
                'decimal:2'
            ],
            'cash_sum' => [
                'nullable',
                'decimal:2'
            ],
            'comment' => [
                'nullable',
                'max:255'
            ],
        ];
    }
}
