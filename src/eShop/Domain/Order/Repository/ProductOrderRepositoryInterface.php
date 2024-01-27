<?php

namespace eShop\Domain\Order\Repository;

use eShop\Domain\Common\ValueObject\OrderQuantity;
use eShop\Domain\Product\Entity\ProductStorage;
use eShop\Domain\Product\ValueObject\Price;

interface ProductOrderRepositoryInterface
{
    public function create(
        ProductStorage $product,
        OrderQuantity $orderQuantity,
        Price $productPrice
    );
}
