<?php

namespace eShop\Infrastructure\Order\Repository;

use eShop\Domain\Common\ValueObject\OrderQuantity;
use eShop\Domain\Order\Entity\Order;
use eShop\Domain\Order\Entity\OrderProduct;
use eShop\Domain\Order\Repository\OrderProductRepositoryInterface;
use eShop\Domain\Product\Entity\ProductStorage;
use eShop\Domain\Product\ValueObject\Price;

class OrderProductRepository implements OrderProductRepositoryInterface
{
    public function create(
        Order $order,
        ProductStorage $product,
        OrderQuantity $orderQuantity,
        Price $productPrice
    ): OrderProduct
    {
        return new OrderProduct($order, $product, $orderQuantity, $productPrice);
    }
}
