<?php

namespace eShop\Domain\Order\Entity;


use eShop\Domain\Common\ValueObject\Email;
use eShop\Domain\Common\ValueObject\Id;
use eShop\Domain\Order\ValueObject\OrderBonus;
use eShop\Domain\Order\ValueObject\OrderTotal;

final class Order
{
    private Id $id;
    private Email $email;
    private OrderTotal $orderTotal;
    private OrderBonus $orderBonus;

    public function __construct(
        Email $email,
        OrderTotal $orderTotal,
        OrderBonus $orderBonus)
    {
        $this->email = $email;
        $this->orderTotal = $orderTotal;
        $this->orderBonus = $orderBonus;
    }

    public function getId(): Id
    {
        return $this->id;
    }

    public function getEmail(): Email
    {
        return $this->email;
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
