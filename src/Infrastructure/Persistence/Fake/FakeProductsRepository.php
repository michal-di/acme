<?php

declare(strict_types = 1);

namespace App\Infrastructure\Persistence\Fake;

use App\Domain\Model\Money;
use App\Domain\Model\Products\Product;
use App\Domain\Model\Products\Products;
use App\Domain\Model\Products\ProductsRepository;
use App\Domain\Model\Products\RegularProduct;
use Exception;

final class FakeProductsRepository implements ProductsRepository
{
    private readonly Products $products;

    public function __construct()
    {
        $this->products = Products::new([
            new RegularProduct('Red Widget', 'R01', Money::usd(32.95)),
            new RegularProduct('Green Widget', 'G01', Money::usd(24.95)),
            new RegularProduct('Blue Widget', 'B01', Money::usd(7.95)),
        ]);
    }

    /**
     * @throws \Exception
     */
    public function byId(string $id): Product
    {
        $filtered = $this->products
            ->filter(static fn(Product $product): bool => $product->code() === $id);

        if ($filtered->isEmpty()) {
            throw new Exception("No product found for id: $id");
        }

        return $filtered->first();
    }
}
