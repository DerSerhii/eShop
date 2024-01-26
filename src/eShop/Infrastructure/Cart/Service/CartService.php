<?php

namespace eShop\Infrastructure\Cart\Service;


use eShop\Domain\Cart\Entity\Cart;
use eShop\Domain\Cart\Service\CartServiceInterface;
use eShop\Domain\Customer\Entity\Customer;
use eShop\Infrastructure\Cart\Repository\CartRepository;

class CartService implements CartServiceInterface
{
    public function __construct(
        private readonly CartRepository $cartRepository
    ) {
    }
    public function add(Customer $customer, array $productLine): Cart
    {
        return $this->cartRepository->create($customer, $productLine);
    }
}
