<?php

namespace eShop\Domain\Cart\Entity;

use eShop\Domain\Common\ValueObject\Id;
use eShop\Domain\Customer\Entity\Customer;

final class Cart
{
    private Id $id;
    private Customer $customer;
    private array $productLine;

    public function __construct(Customer $customer, array $productLine)
    {
        $this->customer = $customer;
        $this->productLine = $productLine;
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

    public function setId(Id $id): void
    {
        $this->id = $id;
    }

}
