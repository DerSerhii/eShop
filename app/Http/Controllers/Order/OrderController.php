<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function store(): array
    {
        return [
            'data' => [
                'email' => 'example@gmail.com',
                'products' => [
                    'productLine'
                ],
                'total' => 0,
                'bonus' => 0
            ]
        ];
    }
}
