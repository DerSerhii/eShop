<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'products' => 'required|array',
            'products.*.id' => 'required|integer|min:1',
            'products.*.quantity' => 'required|integer|min:1',
        ];
    }
}
