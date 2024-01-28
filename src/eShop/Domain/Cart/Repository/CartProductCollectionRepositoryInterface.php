<?php

namespace eShop\Domain\Cart\Repository;

use eShop\Domain\Cart\Entity\Cart;

interface CartProductCollectionRepositoryInterface
{
    public function create(Cart $cart, array $products);
}
