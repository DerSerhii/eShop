<?php

namespace App\Http\Requests\Order;


use eShop\Infrastructure\Product\Repository\ProductRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderValidator
{
    private array $orderRules = [
        'email' => 'required|email',
        'products' => 'required|array',
        'products.*.id' => 'required|integer|min:1',
        'products.*.quantity' => 'required|integer|min:1',
    ];

    public function __construct(
        private readonly ProductRepository $productRepository
    ) {
    }

    public function validate(Request $request): array
    {
        $validator = Validator::make($request->all(), $this->orderRules);

        $validateData = [];
        if ($validator->fails()) {
            $validateData = $validator->errors()->toArray();
        }

        $productDataFromRequest = $request->get('products');
        $productIds = array_column($productDataFromRequest, 'id');
        $productsFromStorage = $this->productRepository->retrieveById($productIds);

        $nonExistIds = $this->validateExistId($productIds, $productsFromStorage);
        if (!empty($nonExistIds)) {
            $errorMessages = [];
            foreach ($nonExistIds as $nonExistId) {
                $errorMessages[] = "The product with Id {$nonExistId} does not exist.";
            }
            $validateData = array_merge(
                $validateData,
                ['non-existent product ids' => $errorMessages],
            );
        }

        $duplicateIds = $this->validateDuplicateId($productIds);
        if (!empty($duplicateIds)) {
            $errorMessages = [];
            foreach ($duplicateIds as $duplicateId) {
                $errorMessages[] = "The product with ID {$duplicateId} has a duplicate";
            }
            $validateData = array_merge(
                $validateData,
                ['duplicate ID in the product set' => $errorMessages]);
        }

        $productsWithInsufficientQuantity = $this->validateQuantities(
            $productDataFromRequest, $productsFromStorage);
        if (!empty($productsWithInsufficientQuantity)) {
            $errorMessages = [];
            foreach ($productsWithInsufficientQuantity as $product) {
                $errorMessages[] = "The product with Id {$product['id']} has an order quantity:" .
                "{$product['quantityInOrder']} but {$product['quantityInStorage']} are in the storage.";
            }
            $validateData = array_merge(
                $validateData,
                ['insufficient quantity of products in storage' => $errorMessages]);
        }

        return $validateData;
    }

    private function validateExistId($productIds, $productsFromStorage): array
    {
        $productIdsFromProducts = collect($productsFromStorage)->map(
            fn($product) => $product->getId()->getValue())->all();

        return array_diff($productIds, $productIdsFromProducts);
    }

    public function validateDuplicateId($productIds): array
    {
        $uniqueProductIds = array_unique($productIds);
        $duplicateIds = array_diff_assoc($productIds, $uniqueProductIds);

        return array_values($duplicateIds);
    }

    public function validateQuantities($productDataFromRequest, $productsFromStorage): array
    {
        $invalidProductIds = [];

        foreach ($productDataFromRequest as $productItem) {
            $productId = $productItem['id'];
            $productQuantity = $productItem['quantity'];

            $product = collect($productsFromStorage)->first(
                function ($product) use ($productId) {
                    return $product->getId()->getValue() == $productId;
                });

            if ($product !== null) {
                $quantityInProductStorage = $product->getQuantity()->getValue();

                if ($productQuantity > $quantityInProductStorage) {
                    $invalidProductIds[] = [
                        'id' => $productId,
                        'quantityInOrder' => $productQuantity,
                        'quantityInStorage' => $quantityInProductStorage,
                    ];
                }
            }
        }

        return $invalidProductIds;
    }
}

