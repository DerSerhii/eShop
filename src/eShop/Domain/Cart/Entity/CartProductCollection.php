<?php

namespace eShop\Domain\Cart\Entity;

use eShop\Domain\Common\ValueObject\Email;

final class CartProductCollection
{
    private array $cartProductCollection;

    public function __construct(array $cartProductCollection)
    {
        $this->cartProductCollection = $cartProductCollection;
    }

    public function getCartProductCollection(): array
    {
        return $this->cartProductCollection;
    }

    public function getEmail(): Email
    {
        return reset($this->cartProductCollection)->getCart()->getEmail();
    }

}
