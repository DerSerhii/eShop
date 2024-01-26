<?php

namespace eShop\Domain\Cart\Repository;


use eShop\Domain\Customer\Entity\Customer;

interface CartRepositoryInterface
{
    public function create(
        Customer $customer,
        array $productLine
    );
}
