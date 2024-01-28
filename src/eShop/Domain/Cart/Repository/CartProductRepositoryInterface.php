<?php

namespace eShop\Domain\Cart\Repository;

use eShop\Domain\Cart\Entity\Cart;
use eShop\Domain\Product\Entity\ProductStorage;

interface CartProductRepositoryInterface
{
    public function create(
        Cart $cart,
        ProductStorage $storageProduct,
        int $quantity
    );
}
