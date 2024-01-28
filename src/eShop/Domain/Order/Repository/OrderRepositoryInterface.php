<?php

namespace eShop\Domain\Order\Repository;


use eShop\Domain\Common\ValueObject\Email;
use eShop\Domain\Order\ValueObject\OrderBonus;
use eShop\Domain\Order\ValueObject\OrderTotal;

interface OrderRepositoryInterface
{
    public function create(
        Email $email,
        OrderTotal $orderTotal,
        OrderBonus $orderBonus
    );
}
