<?php

namespace eShop\Domain\Order\Service;

use eShop\Domain\Cart\Entity\Cart;

interface OrderServiceInterface
{
    public function createOrder(Cart $cart);
}
