<?php

declare(strict_types = 1);

namespace App\Domain\Model\Products;

use App\Domain\Model\Money;

interface Product
{
    public function name(): string;

    public function price(): Money;

    public function code(): string;

    public function withDiscountedPrice(Money $price): Product;
}
