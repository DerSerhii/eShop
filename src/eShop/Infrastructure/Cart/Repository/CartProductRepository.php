<?php

namespace eShop\Infrastructure\Cart\Repository;

use eShop\Domain\Cart\Entity\CartProduct;
use eShop\Domain\Cart\Repository\CartProductRepositoryInterface;
use eShop\Domain\Common\ValueObject\OrderQuantity;
use eShop\Domain\Product\Entity\ProductStorage;

class CartProductRepository implements CartProductRepositoryInterface
{
    public function create(ProductStorage $storageProduct, int $quantity): CartProduct
    {
        $orderQuantityObj = new OrderQuantity($quantity);

        return new CartProduct($storageProduct, $orderQuantityObj);
    }
}
