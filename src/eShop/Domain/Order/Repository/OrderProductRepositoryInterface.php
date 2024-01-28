<?php

namespace eShop\Domain\Order\Repository;

use eShop\Domain\Common\ValueObject\OrderQuantity;
use eShop\Domain\Order\Entity\Order;
use eShop\Domain\Product\Entity\ProductStorage;
use eShop\Domain\Product\ValueObject\Price;

interface OrderProductRepositoryInterface
{
    public function create(
        Order $order,
        ProductStorage $product,
        OrderQuantity $orderQuantity,
        Price $productPrice
    );
}
