<?php

namespace eShop\Domain\Order\Repository;

use eShop\Domain\Order\Entity\Order;

interface OrderProductCollectionRepositoryInterface
{
    public function create(Order $order, array $products);
}

