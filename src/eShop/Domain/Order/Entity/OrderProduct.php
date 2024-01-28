<?php

namespace eShop\Domain\Order\Entity;

use eShop\Domain\Common\ValueObject\Id;
use eShop\Domain\Common\ValueObject\OrderQuantity;
use eShop\Domain\Product\Entity\ProductStorage;
use eShop\Domain\Product\ValueObject\Price;

final class OrderProduct
{
    private Id $id;
    private Order $order;
    private ProductStorage $product;
    private OrderQuantity $orderQuantity;
    private Price $productPrice;

    public function __construct(
        Order $order,
        ProductStorage $product,
        OrderQuantity $orderQuantity,
        Price $productPrice
    )
    {
        $this->order = $order;
        $this->product = $product;
        $this->orderQuantity = $orderQuantity;
        $this->productPrice = $productPrice;
    }

    public function getId(): Id
    {
        return $this->id;
    }

    public function getOrder(): Order
    {
        return $this->order;
    }

    public function getProduct(): ProductStorage
    {
        return $this->product;
    }

    public function getOrderQuantity(): OrderQuantity
    {
        return $this->orderQuantity;
    }

    public function getProductPrice(): Price
    {
        return $this->productPrice;
    }

    public function setId(Id $id): void
    {
        $this->id = $id;
    }

}
