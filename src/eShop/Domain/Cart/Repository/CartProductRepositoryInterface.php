<?php

namespace eShop\Domain\Cart\Repository;

use eShop\Domain\Product\Entity\ProductStorage;

interface CartProductRepositoryInterface
{
    public function create(
        ProductStorage $storageProduct,
        int $quantity
    );
}
