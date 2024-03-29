<?php

namespace eShop\Domain\Cart\Entity;


use eShop\Domain\Common\ValueObject\Id;
use eShop\Domain\Common\ValueObject\OrderQuantity;
use eShop\Domain\Product\Entity\ProductStorage;

final class CartProduct
{
    private Id $id;
    private ProductStorage $product;
    private readonly OrderQuantity $orderQuantity;

    public function __construct(
        ProductStorage $product,
        OrderQuantity $orderQuantity)
    {
        $this->product = $product;
        $this->orderQuantity = $orderQuantity;
    }

    public function getId(): Id
    {
        return $this->id;
    }

    public function getProduct(): ProductStorage
    {
        return $this->product;
    }

    public function getOrderQuantity(): OrderQuantity
    {
        return $this->orderQuantity;
    }

    public function setId(Id $id): void
    {
        $this->id = $id;
    }

    public function getProductPrice(): float
    {
        return $this->product->getPrice()->getValue();
    }
}
