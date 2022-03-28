<?php

declare(strict_types = 1);

namespace App\Domain\Model\Products;

use App\Domain\Model\Money;
use InvalidArgumentException;

final class RegularProduct implements Product
{
    private readonly string $name;
    private readonly string $code;
    private readonly Money  $price;

    public function __construct(string $name, string $code, Money $price)
    {
        if ($price->amount() < 0) {
            throw new InvalidArgumentException(
                "Product's price cannot be negative. $price given"
            );
        }

        $this->name  = $name;
        $this->code  = $code;
        $this->price = $price;
    }

    public function withDiscountedPrice(Money $price): Product
    {
        return new DiscountedProduct($this, $price);
    }

    public static function new(string $name, string $code, float $price): self
    {
        return new self($name, $code, Money::usd($price));
    }

    public function name(): string
    {
        return $this->name;
    }

    public function code(): string
    {
        return $this->code;
    }

    public function price(): Money
    {
        return $this->price;
    }
}
