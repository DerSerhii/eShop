<?php

namespace eShop\Infrastructure\Product\Repository;

use eShop\Domain\Common\ValueObject\Id;
use eShop\Domain\Common\ValueObject\Name;
use eShop\Domain\Product\Entity\ProductStorage;
use eShop\Domain\Product\Repository\ProductRepositoryInterface;
use eShop\Domain\Product\ValueObject\Price;
use eShop\Domain\Product\ValueObject\ProductQuantity;

class ProductRepository implements ProductRepositoryInterface
{
    protected array $productStorage;

    public function __construct()
    {
        $this->productStorage = config('product_storage');
    }

    public function retrieve(array $productIds): array
    {
        return collect($this->productStorage)
            ->whereIn('id', $productIds)
            ->map(function ($item) {
                return new ProductStorage(
                    new Id($item['id']),
                    new Name($item['name']),
                    new Price($item['price']),
                    new ProductQuantity($item['quantity'])
                );
            })
            ->all();
    }
}
