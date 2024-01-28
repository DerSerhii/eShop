<?php

namespace eShop\Domain\Product\Repository;

interface ProductRepositoryInterface
{
    public function retrieveById(array $productIds);
}
