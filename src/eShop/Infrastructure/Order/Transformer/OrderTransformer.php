<?php

namespace eShop\Infrastructure\Order\Transformer;

use eShop\Domain\Order\Entity\OrderProductCollection;
use Illuminate\Http\JsonResponse;

class OrderTransformer
{
    public function transform(OrderProductCollection $orderProducts): JsonResponse
    {
        $productLineData = [];
        foreach ($orderProducts->getOrderProductCollection() as $orderProduct) {
            $productLineData[] = [
                'id' => $orderProduct->getProduct()->getId()->getValue(),
                'name' => $orderProduct->getProduct()->getName()->getValue(),
                'price' => $orderProduct->getProductPrice()->getValue(),
                'quantity' => $orderProduct->getOrderQuantity()->getValue(),
            ];
        }

        $responseData = [
            'data' => [
                'email' => $orderProducts->getEmail(),
                'productLine' => $productLineData,
                'orderTotal' => $orderProducts->getOrderTotal(),
                'orderBonus' => $orderProducts->getOrderBonus(),
            ]
        ];

        return response()->json($responseData);
    }
}
