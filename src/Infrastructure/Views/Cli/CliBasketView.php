<?php

declare(strict_types = 1);

namespace App\Infrastructure\Views\Cli;

use App\Domain\Model\Basket\Basket;
use App\Infrastructure\Views\View;
use function implode;
use function sprintf;

final class CliBasketView implements View
{
    private readonly Basket $basket;

    public function __construct(Basket $basket)
    {
        $this->basket = $basket;
    }

    public function __toString(): string
    {
        $format = [
            'BASKET (%s)',
            '',
            'Product         Price       Discount',
            '------------------------------------',
            '%s',
            '------------------------------------',
            '         Total: $%s',
        ];

        return sprintf(
            implode("\n", $format),
            $this->basket->products()->count(),
            new CliProductsView($this->basket->products()),
            $this->basket->total()
        ) . "\n";
    }
}
