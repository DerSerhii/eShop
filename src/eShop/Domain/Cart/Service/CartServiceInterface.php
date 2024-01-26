<?php

namespace eShop\Domain\Cart\Service;

use eShop\Domain\Customer\Entity\Customer;

interface CartServiceInterface
{
    public function add(
        Customer $customer,
        array $productLine
    );
}
