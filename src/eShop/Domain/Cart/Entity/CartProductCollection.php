<?php

namespace eShop\Domain\Cart\Entity;

use eShop\Domain\Common\ValueObject\Email;

final class CartProductCollection
{
    private array $productCollection;

    public function __construct(array $cartProductCollection)
    {
        $this->productCollection = $cartProductCollection;
    }

    public function getCollection(): array
    {
        return $this->productCollection;
    }

    public function getEmail(): Email
    {
        return reset($this->productCollection)->getCart()->getEmail();
    }

}
