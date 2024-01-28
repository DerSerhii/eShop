<?php

namespace eShop\Infrastructure\Order\Repository;

use eShop\Domain\Common\ValueObject\Email;
use eShop\Domain\Order\Entity\Order;
use eShop\Domain\Order\Repository\OrderRepositoryInterface;
use eShop\Domain\Order\ValueObject\OrderBonus;
use eShop\Domain\Order\ValueObject\OrderTotal;

class OrderRepository implements OrderRepositoryInterface
{
    public function create(
        Email      $email,
        OrderTotal $orderTotal,
        OrderBonus $orderBonus
    ): Order
    {
        return new Order($email, $orderTotal, $orderBonus);
    }
}
