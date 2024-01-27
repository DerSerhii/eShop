<?php

namespace eShop\Domain\Order\Repository;

use eShop\Domain\Customer\Entity\Customer;

interface OrderRepositoryInterface
{
    public function create(
        Customer $customer,
        array $productLine
    );
}
