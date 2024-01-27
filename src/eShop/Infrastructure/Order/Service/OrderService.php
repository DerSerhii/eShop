<?php

namespace eShop\Infrastructure\Order\Service;

use eShop\Domain\Cart\Entity\Cart;
use eShop\Domain\Order\Entity\Order;
use eShop\Domain\Order\Service\OrderServiceInterface;
use eShop\Domain\Order\ValueObject\OrderBonus;
use eShop\Domain\Order\ValueObject\OrderTotal;
use eShop\Infrastructure\Order\Repository\OrderRepository;
use eShop\Infrastructure\Order\Repository\ProductOrderRepository;
use eShop\Infrastructure\Services\OrderCalculatorService;

class OrderService implements OrderServiceInterface
{
    public function __construct(
        private readonly ProductOrderRepository $productOrderRepository,
        private readonly OrderRepository $orderRepository,
        private readonly OrderCalculatorService $orderCalculatorService
    ) {
    }

    public function createOrder(Cart $cart): Order
    {
        $customer = $cart->getCustomer();
        $productLine = $cart->getProductLine();

        $orderProductLine = [];

        foreach ($productLine as $cartProduct) {
            $productStorage = $cartProduct->getProduct();
            $orderQuantity = $cartProduct->getOrderQuantity();
            $productPrice = $productStorage->getPrice();

            $productOrder = $this->productOrderRepository->create(
                $productStorage,
                $orderQuantity,
                $productPrice
            );

            $orderProductLine[] = $productOrder;
        }

        $order = $this->orderRepository->create($customer, $orderProductLine);

        $this->orderCalculatorService->setProductLine($orderProductLine);

        $orderTotal = $this->orderCalculatorService->getOrderTotal();
        $orderBonus = $this->orderCalculatorService->getOrderBonus();

        $order->setOrderTotal(new OrderTotal($orderTotal));
        $order->setOrderBonus(new OrderBonus($orderBonus));

        return $order;
    }
}
