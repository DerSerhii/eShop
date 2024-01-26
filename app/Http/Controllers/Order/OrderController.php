<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Http\Requests\Order\OrderRequest;

class OrderController extends Controller
{
    public function store(
        OrderRequest $request
    ): array
    {
        $email = $request->input('email');
        $productLine = $request->input('products', []);

        return [
            'data' => [
                'email' => $email,
                'products' => $productLine,
                'total' => 0,
                'bonus' => 0
            ]
        ];
    }
}
