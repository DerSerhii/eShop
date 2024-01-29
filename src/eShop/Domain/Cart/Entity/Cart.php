<?php

namespace eShop\Domain\Cart\Entity;

use eShop\Domain\Common\ValueObject\Email;
use eShop\Domain\Common\ValueObject\Id;

final class Cart
{
    private Id $id;
    private Email $email;
    private CartProductCollection $productCollection;

    public function __construct(
        Email $email,
        CartProductCollection $productCollection
    )
    {
        $this->email = $email;
        $this->productCollection = $productCollection;
    }

    public function getId(): Id
    {
        return $this->id;
    }

    public function getEmail(): Email
    {
        return $this->email;
    }

    public function getProductCollection(): array
    {
        return $this->productCollection->getCollection();
    }

    public function setId(Id $id): void
    {
        $this->id = $id;
    }

}
