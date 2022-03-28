<?php

declare(strict_types = 1);

namespace App\Domain\Model\Basket\Offers;

use App\Domain\Model\Money;
use App\Domain\Model\Products\Product;
use App\Domain\Model\Products\Products;

final class FreeGreenWidgetsOffer implements Offer
{
    public function applyTo(Products $products): Products
    {
        $greenWidgets = $products
            ->filter(static fn(Product $product): bool => $product->code() === 'G01')
            ->map(static fn(Product $product): Product => $product->withDiscountedPrice(Money::usd(0.0)));

        return $products
            ->filter(static fn(Product $product): bool => $product->code() !== 'G01')
            ->merge($greenWidgets);
    }
}
