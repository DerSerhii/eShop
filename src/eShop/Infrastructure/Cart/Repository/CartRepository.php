<?php

namespace eShop\Infrastructure\Cart\Repository;

use eShop\Domain\Cart\Entity\Cart;
use eShop\Domain\Cart\Repository\CartRepositoryInterface;
use eShop\Domain\Customer\Entity\Customer;

class CartRepository implements CartRepositoryInterface
{
    public function create(Customer $customer, array $productLine): Cart
    {
        return new Cart($customer, $productLine);
    }
}
