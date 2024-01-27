<?php

namespace eShop\Infrastructure\Services;

use eShop\Domain\Order\Entity\Order;

class OrderTransformService
{
    public function toArray(Order $order): array
    {
        $productLineData = [];

        foreach ($order->getProductLine() as $productOrder) {
            $productLineData[] = [
                'id' => $productOrder->getProduct()->getId()->getValue(),
                'name' => $productOrder->getProduct()->getName()->getValue(),
                'price' => $productOrder->getProductPrice()->getValue(),
                'quantity' => $productOrder->getOrderQuantity()->getValue(),
            ];
        }
        return [
            'data' => [
                'customer' => $order->getCustomer()->getEmail()->getValue(),
                'productLine' => $productLineData,
                'orderTotal' => $order->getOrderTotal()->getValue(),
                'orderBonus' => $order->getOrderBonus()->getValue(),
            ]
        ];
    }
}

