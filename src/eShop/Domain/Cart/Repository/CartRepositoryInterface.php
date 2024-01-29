<?php

namespace eShop\Domain\Cart\Repository;


use eShop\Domain\Cart\Entity\Cart;
use eShop\Domain\Cart\Entity\CartProductCollection;
use eShop\Domain\Common\ValueObject\Email;

interface CartRepositoryInterface
{
    public function create(
        Email $email,
        CartProductCollection $productCollection
    ): Cart;
}
