<?php

namespace eShop\Infrastructure\Cart\Repository;

use eShop\Domain\Cart\Entity\Cart;
use eShop\Domain\Cart\Repository\CartRepositoryInterface;
use eShop\Domain\Common\ValueObject\Email;

class CartRepository implements CartRepositoryInterface
{
    public function create(Email $email): Cart
    {
        return new Cart($email);
    }
}
