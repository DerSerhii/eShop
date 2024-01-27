<?php

namespace Tests\Unit;

use eShop\Domain\Common\ValueObject\Id;
use eShop\Domain\Common\ValueObject\Name;
use eShop\Domain\Common\ValueObject\OrderQuantity;
use eShop\Domain\Order\Entity\ProductOrder;
use eShop\Domain\Product\Entity\ProductStorage;
use eShop\Domain\Product\ValueObject\Price;
use eShop\Domain\Product\ValueObject\ProductQuantity;
use eShop\Infrastructure\Services\OrderCalculatorService;
use Tests\TestCase;

class OrderCalculatorServiceTest extends TestCase
{
    private OrderCalculatorService $calculator;
    private array $productList;

    protected function setUp(): void
    {
        parent::setUp();

        $this->bonusThreshold = 100;
        $this->calculator = new OrderCalculatorService();
        $this->calculator->setBonusThreshold($this->bonusThreshold);

        $storageProduct1 = new ProductStorage(
            new Id(1),
            new Name('Product 1'),
            new Price(100.0),
            new ProductQuantity(20)
        );
        $productOrder1 = new ProductOrder(
            $storageProduct1,
            new OrderQuantity(2),
            new Price(50)
        );

        $storageProduct2 = new ProductStorage(
            new Id(2),
            new Name('Product 2'),
            new Price(5.0),
            new ProductQuantity(15)
        );
        $productOrder2 = new ProductOrder(
            $storageProduct2,
            new OrderQuantity(2),
            new Price(50)
        );

        $this->productList = [$productOrder1, $productOrder2];
    }

    public function testCalculateOrderTotal(): void
    {
        $this->calculator->setProductLine($this->productList);

        $expectedTotal = (50 * 2) + (50 * 2);
        $this->assertEquals($expectedTotal, $this->calculator->getOrderTotal());
    }

    public function testCalculateOrderBonus(): void
    {
        $this->calculator->setProductLine($this->productList);

        $this->assertEquals(
            ((50 * 2) + (50 * 2) - $this->bonusThreshold) * 0.05,
            $this->calculator->getOrderBonus()
        );
    }

    public function testCalculateOrderBonusEqualZero(): void
    {
        $this->calculator->setBonusThreshold(200);
        $this->calculator->setProductLine($this->productList);

        $this->assertEquals(0, $this->calculator->getOrderBonus());
    }
}
