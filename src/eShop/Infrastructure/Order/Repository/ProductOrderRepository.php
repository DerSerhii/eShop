<?php

namespace eShop\Infrastructure\Order\Repository;

use eShop\Domain\Common\ValueObject\OrderQuantity;
use eShop\Domain\Order\Entity\ProductOrder;
use eShop\Domain\Order\Repository\ProductOrderRepositoryInterface;
use eShop\Domain\Product\Entity\ProductStorage;
use eShop\Domain\Product\ValueObject\Price;

class ProductOrderRepository implements ProductOrderRepositoryInterface
{

    public function create(
        ProductStorage $product,
        OrderQuantity $orderQuantity,
        Price $productPrice
    ): ProductOrder
    {
        return new ProductOrder($product, $orderQuantity, $productPrice);
    }
}
