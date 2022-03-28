<?php

declare(strict_types = 1);

namespace App\Domain\Model\Products;

interface ProductsRepository
{
    public function byId(string $id): Product;
}
