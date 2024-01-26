<?php

namespace eShop\Domain\Product\Entity;

use eShop\Domain\Common\ValueObject\Id;
use eShop\Domain\Common\ValueObject\Name;
use eShop\Domain\Product\ValueObject\Price;
use eShop\Domain\Product\ValueObject\ProductQuantity;

final class ProductStorage
{
    private Id $id;
    private Name $name;
    private Price $price;
    private ProductQuantity $quantity;

    public function __construct(
        Id              $id,
        Name            $name,
        Price           $price,
        ProductQuantity $quantity)
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->quantity = $quantity;
    }

    public function getId(): Id
    {
        return $this->id;
    }

    public function getName(): Name
    {
        return $this->name;
    }

    public function getPrice(): Price
    {
        return $this->price;
    }

    public function getQuantity(): ProductQuantity
    {
        return $this->quantity;
    }
}
