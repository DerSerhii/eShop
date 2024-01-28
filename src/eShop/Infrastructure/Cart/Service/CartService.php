<?php

namespace eShop\Infrastructure\Cart\Service;


use eShop\Domain\Cart\Entity\CartProductCollection;
use eShop\Domain\Cart\Service\CartServiceInterface;
use eShop\Domain\Common\ValueObject\Email;
use eShop\Infrastructure\Cart\Repository\CartProductCollectionRepository;
use eShop\Infrastructure\Cart\Repository\CartRepository;

class CartService implements CartServiceInterface
{
    public function __construct(
        private readonly CartRepository $cartRepository,
        private readonly CartProductCollectionRepository $cartProductCollectionRepository
    ) {
    }
    public function makeCart(string $email, array $products): CartProductCollection
    {
        $email = new Email($email);
        $cart = $this->cartRepository->create($email);

        return $this->cartProductCollectionRepository->create($cart, $products);
    }
}
