<?php

namespace eShop\Domain\Order\Service;

use eShop\Domain\Cart\Entity\CartProductCollection;

interface OrderServiceInterface
{
    public function makeOrder(CartProductCollection $cart);
}
