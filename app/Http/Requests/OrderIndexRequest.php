<?php

namespace App\Http\Requests;

use App\Enums\Order\OrderStatusEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class OrderIndexRequest extends FormRequest
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
            'status' => ['nullable', 'string', Rule::in(OrderStatusEnum::values())],
            'min' => 'nullable|integer|min:' . config('rules.order.amount.min'),
            'max' => 'nullable|integer|max:' .  config('rules.order.amount.max'),
            'mobile_number' => 'nullable|numeric|max_digits:'  . config('rules.order.mobile_number.max_digits'),
            'national_code' => 'nullable|numeric|digits:'  . config('rules.order.national_code.digits'),
        ];
    }
}
