<?php

namespace eShop\Infrastructure\Services;

class OrderCalculatorService
{
    private array $productList;
    private float $orderTotal;

    private float $bonusThreshold;
    private float $orderBonus;

    public function __construct()
    {
        $this->bonusThreshold = config('shop.bonus_threshold', 100);
    }

    public function setProductLine(array $productList): void
    {
        $this->productList = $productList;
        $this->calculateOrderTotal();
        $this->calculateOrderBonus();
    }

    public function getOrderTotal(): float
    {
        return $this->orderTotal;
    }

    public function getOrderBonus(): float
    {
        return $this->orderBonus;
    }

    private function calculateOrderTotal(): void
    {
        $orderTotal = 0;
        foreach ($this->productList as $item) {
            $orderTotal += $item->getProductPrice()->getValue() * $item->getOrderQuantity()->getValue();
        }

        $this->orderTotal = $orderTotal;
    }

    private function calculateOrderBonus(): void
    {
        $this->orderBonus =
            $this->orderTotal > $this->bonusThreshold
                ? ($this->orderTotal - $this->bonusThreshold) * 0.05 : 0;
    }
}
