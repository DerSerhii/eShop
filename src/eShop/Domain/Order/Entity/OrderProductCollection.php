<?php

namespace eShop\Domain\Order\Entity;

final class OrderProductCollection
{
    private array $orderProductCollection;

    private Order $order;

    public function __construct(array $orderProductCollection)
    {
        $this->orderProductCollection = $orderProductCollection;
        $this->order = reset($this->orderProductCollection)->getOrder();
    }

    public function getOrderProductCollection(): array
    {
        return $this->orderProductCollection;
    }

    public function getEmail(): string
    {
        return $this->order->getEmail()->getValue();
    }

    public function getOrderTotal(): float
    {
        return $this->order->getOrderTotal()->getValue();
    }

    public function getOrderBonus(): float
    {
        return $this->order->getOrderBonus()->getValue();
    }
}
