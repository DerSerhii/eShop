<?php

namespace eShop\Domain\Product\Repository;

interface ProductRepositoryInterface
{
    public function retrieve(array $productIds);
}
