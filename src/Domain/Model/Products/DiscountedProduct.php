<?php

declare(strict_types = 1);

namespace App\Domain\Model\Products;

use App\Domain\Model\Money;

final class DiscountedProduct implements Product, Discounted
{
    private readonly Product $product;
    private readonly Money   $price;

    public function __construct(Product $product, Money $price)
    {
        $this->product = $product;
        $this->price   = $price;
    }

    public function product(): Product
    {
        return $this->product;
    }

    public function discount(): Money
    {
        return $this->product->price()->subtract($this->price);
    }

    public function name(): string
    {
        return $this->product->name();
    }

    public function price(): Money
    {
        return $this->price;
    }

    public function code(): string
    {
        return $this->product->code();
    }

    public function withDiscountedPrice(Money $price): self
    {
        return new self($this->product, $price);
    }
}
