<?php

namespace eShop\Infrastructure\Cart\Repository;

use eShop\Domain\Cart\Entity\Cart;
use eShop\Domain\Cart\Entity\CartProductCollection;
use eShop\Domain\Cart\Repository\CartProductCollectionRepositoryInterface;
use eShop\Infrastructure\Product\Repository\ProductRepository;

class CartProductCollectionRepository implements CartProductCollectionRepositoryInterface
{
    public function __construct(
        private readonly ProductRepository $productRepository,
        private readonly CartProductRepository $cartProductRepository
    ) {
    }
    public function create(Cart $cart, array $products): CartProductCollection
    {
        $cartProductCollection = [];

        $productIds = array_column($products, 'id');
        $productsFromStorage = $this->productRepository->retrieveById($productIds);

        foreach ($products as $productData) {
            $productId = $productData['id'];

            $storageProduct = collect($productsFromStorage)->first(
                function ($storageProduct) use ($productId) {
                    return $storageProduct->getId()->getValue() == $productId;
                });

            if ($storageProduct) {
                $quantity = $productData['quantity'];
                $cartProduct = $this->cartProductRepository->create($cart, $storageProduct, $quantity);
                $cartProductCollection[] = $cartProduct;
            }
        }

        return new CartProductCollection($cartProductCollection);
    }
}
