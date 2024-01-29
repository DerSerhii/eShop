<?php

namespace eShop\Infrastructure\Order\Service;

use eShop\Domain\Cart\Entity\Cart;
use eShop\Domain\Order\Entity\OrderProductCollection;
use eShop\Domain\Order\Service\OrderServiceInterface;
use eShop\Domain\Order\Settings\OrderSettings;
use eShop\Domain\Order\ValueObject\OrderBonus;
use eShop\Domain\Order\ValueObject\OrderTotal;
use eShop\Infrastructure\Order\Repository\OrderProductCollectionRepository;
use eShop\Infrastructure\Order\Repository\OrderRepository;

class OrderService implements OrderServiceInterface
{
    public function __construct(
        private readonly OrderRepository                  $orderRepository,
        private readonly OrderCalculatorService           $orderCalculatorService,
        private readonly OrderProductCollectionRepository $orderProductCollectionRepository,
        private readonly OrderSettings                    $orderSettings
    ) {
    }

    public function makeOrder(Cart $cart): OrderProductCollection
    {
        $bonusThreshold = $this->orderSettings->getBonusThreshold();
        $this->orderCalculatorService->setBonusThreshold($bonusThreshold);

        $discount = $this->orderSettings->getDiscount();
        $this->orderCalculatorService->setDiscount($discount);

        $cartProducts = $cart->getProductCollection();
        $this->orderCalculatorService->setProductList($cartProducts);

        $orderTotal = $this->orderCalculatorService->getOrderTotal();
        $orderBonus = $this->orderCalculatorService->getOrderBonus();

        $order = $this->orderRepository->create(
            $cart->getEmail(),
            new OrderTotal($orderTotal),
            new OrderBonus($orderBonus)
        );

        return $this->orderProductCollectionRepository->create($order, $cartProducts);
    }
}
