<?php

declare(strict_types = 1);

namespace App\Infrastructure\Views\Cli;

use App\Domain\Model\Products\Product;
use App\Domain\Model\Products\Discounted;
use function sprintf;

final class CliDiscountedProductView extends BaseView
{
    private readonly Product&Discounted $product;

    public function __construct(Product&Discounted $product)
    {
        $this->product = $product;
    }

    public function __toString(): string
    {
        return sprintf(
            '%s $%s $%s',
            $this->pad($this->product->name()),
            $this->pad($this->product->price(), 10),
            $this->pad($this->product->discount(), 10)
        );
    }
}
