<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Http\Requests\Order\OrderRequest;
use eShop\Infrastructure\Customer\Service\CustomerService;

class OrderController extends Controller
{
    public function store(
        OrderRequest $request,
        CustomerService $customerService
    ): array
    {
        $email = $request->input('email');
        $productLine = $request->input('products', []);

        $customer = $customerService->add($email);

        return [
            'data' => [
                'email' => $customer->getEmail()->getValue(),
                'products' => $productLine,
                'total' => 0,
                'bonus' => 0
            ]
        ];
    }
}
