<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Http\Requests\Order\OrderRequest;
use eShop\Infrastructure\Cart\Service\CartService;
use eShop\Infrastructure\Customer\Service\CustomerService;
use eShop\Infrastructure\Order\Service\OrderService;
use eShop\Infrastructure\Services\OrderTransformService;
use eShop\Infrastructure\Services\ProductLineService;
use Illuminate\Http\JsonResponse;

class OrderController extends Controller
{
    public function store(
        OrderRequest          $request,
        CustomerService       $customerService,
        ProductLineService    $productLineService,
        CartService           $cartService,
        OrderService          $orderService,
        OrderTransformService $orderTransformService
    ): array|JsonResponse
    {
        $email = $request->input('email');
        $products = $request->input('products', []);

        $productLineService->setProducts($products);

        $missingIds = $productLineService->validateIds();

        if (!empty($missingIds)) {
            $message = 'Product(s) with ID(s): ' .
                implode(', ', $missingIds) . ' do not exist';
            $errorData = [
                'message' => $message
            ];
            return response()->json($errorData, 400);
        }

        $duplicateIds = $productLineService->validateDuplicateIds();

        if(!empty($duplicateIds)) {
            $message = 'The products has duplicates Ids: ' .
                implode(', ', $duplicateIds) . '.';
            $errorData = [
                'message' => $message
            ];
            return response()->json($errorData, 400);
        }

        $productWithInsufficientQuantity = $productLineService->validateQuantities();

        if (!empty($productWithInsufficientQuantity)) {
            $errorMessages = [];
            foreach ($productWithInsufficientQuantity as $invalidProduct) {
                $errorMessage = "Product with Id {$invalidProduct['id']} ordered in quantity " .
                    "{$invalidProduct['quantityInProductLine']}," .
                    " only {$invalidProduct['quantityInProductStorage']} in storage";
                $errorMessages[] = $errorMessage;
            }
            $errorData = [
                'message' => $errorMessages
            ];
            return response()->json($errorData, 400);
        }

        $productLine = $productLineService->getProductLine();

        $customer = $customerService->add($email);

        $cart = $cartService->add($customer, $productLine);

        $order = $orderService->createOrder($cart);

        return $orderTransformService->toArray($order);
    }
}
