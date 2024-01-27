<?php

namespace eShop\Domain\Order\Entity;


use eShop\Domain\Common\ValueObject\Id;
use eShop\Domain\Customer\Entity\Customer;
use eShop\Domain\Order\ValueObject\OrderBonus;
use eShop\Domain\Order\ValueObject\OrderTotal;

final class Order
{
    private Id $id;
    private Customer $customer;
    private array $productLine;
    private OrderTotal $orderTotal;
    private OrderBonus $orderBonus;

    public function __construct(Customer $customer, array $productLine)
    {
        $this->customer = $customer;
        $this->productLine = $productLine;
    }

    public function setOrderTotal(OrderTotal $orderTotal): void
    {
        $this->orderTotal = $orderTotal;
    }

    public function setOrderBonus(OrderBonus $orderBonus): void
    {
        $this->orderBonus = $orderBonus;
    }

    public function getId(): Id
    {
        return $this->id;
    }

    public function getCustomer(): Customer
    {
        return $this->customer;
    }

    public function getProductLine(): array
    {
        return $this->productLine;
    }

    public function getOrderTotal(): OrderTotal
    {
        return $this->orderTotal;
    }

    public function getOrderBonus(): OrderBonus
    {
        return $this->orderBonus;
    }

    public function setId(Id $id): void
    {
        $this->id = $id;
    }

}
