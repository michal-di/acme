<?php

declare(strict_types = 1);

namespace App\Infrastructure\Views\Cli;

use App\Domain\Model\Products\DiscountedProduct;
use App\Domain\Model\Products\Product;
use App\Domain\Model\Products\Products;
use App\Infrastructure\Views\View;
use function array_map;
use function implode;

final class CliProductsView implements View
{
    private readonly Products $products;

    public function __construct(Products $products)
    {
        $this->products = $products;
    }

    public function __toString(): string
    {
        return implode("\n", array_map(
            static fn(Product $product): View => $product instanceof DiscountedProduct
                ? new CliDiscountedProductView($product)
                : new CliRegularProductView($product),
            [...$this->products]
        ));
    }
}
