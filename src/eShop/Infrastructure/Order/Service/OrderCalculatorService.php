<?php

namespace eShop\Infrastructure\Order\Service;

class OrderCalculatorService
{
    private array $productList;
    private float $orderTotal;
    private float $orderBonus;
    private float $bonusThreshold;
    private float $discount;

    public function setBonusThreshold(float $bonusThreshold): void
    {
        $this->bonusThreshold = $bonusThreshold;
    }

    public function setDiscount(float $discount): void
    {
        $this->discount = $discount;
    }

    public function setProductList(array $productList): void
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
        foreach ($this->productList as $product) {
            $price = $product->getProductPrice();
            $quantity = $product->getOrderQuantity()->getValue();
            $orderTotal += $price  * $quantity;
        }

        $this->orderTotal = $orderTotal;
    }

    private function calculateOrderBonus(): void
    {
        $bonusCalculation = ($this->orderTotal - $this->bonusThreshold) * $this->discount/100;

        $this->orderBonus = $this->orderTotal > $this->bonusThreshold ? $bonusCalculation : 0;
    }
}
