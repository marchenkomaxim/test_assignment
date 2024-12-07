<?php

namespace App\Http\Requests\Purchase;

use Illuminate\Foundation\Http\FormRequest;

class PurchaseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'products' => 'required|array',
            'products.*.id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
        ];
    }

    public function messages(): array
    {
        return [
            'products.*.id.required' => 'ID продукта обязателен.',
            'products.*.id.exists' => 'Продукт с указанным ID не найден.',
            'products.*.quantity.required' => 'Количество продукта обязательно.',
            'products.*.quantity.integer' => 'Количество должно быть числом.',
            'products.*.quantity.min' => 'Минимальное количество продукта - 1.',
        ];
    }
}
