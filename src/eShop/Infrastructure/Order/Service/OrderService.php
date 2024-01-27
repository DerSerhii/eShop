<?php

namespace eShop\Infrastructure\Order\Service;

use eShop\Domain\Cart\Entity\Cart;
use eShop\Domain\Customer\Entity\Customer;
use eShop\Domain\Order\Entity\Order;
use eShop\Domain\Order\Service\OrderServiceInterface;
use eShop\Infrastructure\Order\Repository\OrderRepository;
use eShop\Infrastructure\Order\Repository\ProductOrderRepository;

class OrderService implements OrderServiceInterface
{
    public function __construct(
        private readonly ProductOrderRepository $productOrderRepository,
        private readonly OrderRepository $orderRepository
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

        return $this->orderRepository->create($customer, $orderProductLine);
    }
}
