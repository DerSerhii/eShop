<?php

namespace eShop\Infrastructure\Order\Repository;

use eShop\Domain\Order\Entity\Order;
use eShop\Domain\Order\Entity\OrderProductCollection;
use eShop\Domain\Order\Repository\OrderProductCollectionRepositoryInterface;

class OrderProductCollectionRepository implements OrderProductCollectionRepositoryInterface
{
    public function __construct(
        private readonly OrderProductRepository $orderProductRepository,
    ) {
    }

    public function create(Order $order, array $products): OrderProductCollection
    {
        $orderProducts = [];

        foreach ($products as $product) {
            $productStorage = $product->getProduct();
            $orderQuantity = $product->getOrderQuantity();
            $productPrice = $productStorage->getPrice();

            $productOrder = $this->orderProductRepository->create(
                $order,
                $productStorage,
                $orderQuantity,
                $productPrice
            );

            $orderProducts[] = $productOrder;
        }

        return new OrderProductCollection($orderProducts);
    }
}
