<?php

namespace eShop\Infrastructure\Services;


use eShop\Infrastructure\Cart\Repository\CartProductRepository;
use eShop\Infrastructure\Product\Repository\ProductRepository;

class ProductLineService
{
    private array $products;
    private array $storageProducts;
    private array $productIds;

    public function __construct(
        private readonly ProductRepository $productRepository,
        private readonly CartProductRepository $cartProductRepository
    )
    {
    }

    public function setProducts(array $products): void
    {
        $this->products = $products;
        $this->productIds = $this->getProductIds();
        $this->storageProducts = $this->loadStorageProducts();
    }

    public function getProductLine(): array
    {
        $missingIds = $this->validateIds();
        $invalidQuantities = $this->validateQuantities();

        if (!empty($missingIds) || !empty($invalidQuantities)) {
            return [];
        }

        $productLine = [];

        foreach ($this->products as $productData) {
            $productId = $productData['id'];

            $storageProduct = collect($this->storageProducts)->first(
                function ($storageProduct) use ($productId) {
                    return $storageProduct->getId()->getValue() == $productId;
                });

            if ($storageProduct) {
                $quantity = $productData['quantity'];

                $cartProduct = $this->cartProductRepository->create($storageProduct, $quantity);

                $productLine[] = $cartProduct;
            }
        }

        return $productLine;
    }

    private function getProductIds(): array
    {
        return array_column($this->products, 'id');
    }

    private function loadStorageProducts(): array
    {
        return $this->productRepository->retrieve($this->productIds);
    }

    public function validateIds(): array
    {
        $productIdsFromProducts = collect($this->storageProducts)->map(
            fn($product) => $product->getId()->getValue()
        )->all();

        return array_diff($this->productIds, $productIdsFromProducts);
    }

    public function validateDuplicateIds(): array
    {
        $duplicateIds = [];
        $seenIds = [];

        foreach ($this->products as $productData) {
            $productId = $productData['id'];

            if (in_array($productId, $seenIds)) {
                $duplicateIds[] = $productId;
            } else {
                $seenIds[] = $productId;
            }
        }

        return $duplicateIds;
    }
    public function validateQuantities(): array
    {
        $invalidProductIds = [];

        foreach ($this->products as $productLineItem) {
            $productId = $productLineItem['id'];
            $quantityInProductLine = $productLineItem['quantity'];

            $product = collect($this->storageProducts)->first(
                function ($product) use ($productId) {
                    return $product !== null && $product->getId()->getValue() == $productId;
                });

            if ($product !== null) {
                $quantityInProductStorage = $product->getQuantity()->getValue();

                if ($quantityInProductLine > $quantityInProductStorage) {
                    $invalidProductIds[] = [
                        'id' => $productId,
                        'quantityInProductLine' => $quantityInProductLine,
                        'quantityInProductStorage' => $quantityInProductStorage,
                    ];
                }
            }
        }

        return $invalidProductIds;
    }
}

