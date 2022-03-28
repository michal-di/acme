<?php

declare(strict_types = 1);

namespace App\Infrastructure\Views\Cli;

use App\Domain\Model\Products\Product;
use function sprintf;

final class CliRegularProductView extends BaseView
{
    private readonly Product $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function __toString(): string
    {
        return sprintf(
            '%s $%s',
            $this->pad($this->product->name()),
            $this->pad($this->product->price(), 10)
        );
    }
}
