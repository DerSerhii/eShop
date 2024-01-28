<?php

namespace eShop\Domain\Cart\Service;

interface CartServiceInterface
{
    public function makeCart(string $email, array $products);
}
