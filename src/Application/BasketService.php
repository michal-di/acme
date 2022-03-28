<?php

declare(strict_types = 1);

namespace App\Application;

use App\Domain\Model\Basket\Basket;
use App\Domain\Model\Basket\Offers\FreeGreenWidgetsOffer;
use App\Domain\Model\Basket\Offers\SecondRedWidgetHalfPriceOffer;
use App\Domain\Model\Money;
use App\Infrastructure\Persistence\Fake\FakeProductsRepository;

final class BasketService
{
    private readonly Basket $basket;

    public function __construct(Basket $basket)
    {
        $this->basket = $basket;
    }

    public static function new(): self
    {
        return new self(
            Basket::new(new FakeProductsRepository())
                  ->withOffer(new SecondRedWidgetHalfPriceOffer())
                  // ->withOffer(new FreeGreenWidgetsOffer())
        );
    }

    public function add(string $productId): self
    {
        return new self(
            $this->basket->add($productId)
        );
    }

    public function total(): Money
    {
        return $this->basket()->total();
    }

    public function basket(): Basket
    {
        return $this->basket->withDiscountedProducts();
    }
}
