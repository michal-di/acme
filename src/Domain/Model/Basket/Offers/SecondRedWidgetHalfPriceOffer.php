<?php

declare(strict_types = 1);

namespace App\Domain\Model\Basket\Offers;

use App\Domain\Model\Products\Product;
use App\Domain\Model\Products\Products;

final class SecondRedWidgetHalfPriceOffer implements Offer
{
    public function applyTo(Products $products): Products
    {
        $redWidgets = $products
            ->filter(static fn(Product $product): bool => $product->code() === 'R01');

        if ($redWidgets->count() < 2) {
            return $products;
        }

        $otherWidgets = $products
            ->filter(static fn(Product $product): bool => $product->code() !== 'R01');

        $discounted = $redWidgets
            ->even()
            ->map(static fn(Product $product): Product => $product->withDiscountedPrice(
                $product->price()->half())
            );

        return $otherWidgets
            ->merge($redWidgets->odd())
            ->merge($discounted);
    }
}
