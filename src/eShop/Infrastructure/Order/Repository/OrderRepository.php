<?php

namespace eShop\Infrastructure\Order\Repository;

use eShop\Domain\Customer\Entity\Customer;
use eShop\Domain\Order\Entity\Order;
use eShop\Domain\Order\Repository\OrderRepositoryInterface;

class OrderRepository implements OrderRepositoryInterface
{
    public function create(Customer $customer, array $productLine)
    {
        $order = new Order($customer, $productLine);

        return $order;
    }
}
