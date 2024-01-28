<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Http\Requests\Order\OrderValidator;
use eShop\Infrastructure\Cart\Service\CartService;
use eShop\Infrastructure\Order\Service\OrderService;
use eShop\Infrastructure\Order\Transformer\OrderTransformer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function store(
        Request          $request,
        OrderValidator   $orderValidator,
        CartService      $cartService,
        OrderService     $orderService,
        OrderTransformer $orderTransformer,

    ): JsonResponse
    {
        $validateData = $orderValidator->validate($request);

        if (!empty($validateData)) {
            return response()->json(['errors' => $validateData], 422);
        }

        $email = $request->input('email');
        $products = $request->input('products', []);

        $cart = $cartService->makeCart($email, $products);

        $order = $orderService->makeOrder($cart);

        return $orderTransformer->transform($order);
    }
}
