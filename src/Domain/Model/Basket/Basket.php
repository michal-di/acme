<?php

declare(strict_types = 1);

namespace App\Domain\Model\Basket;

use App\Domain\Model\Basket\Delivery\BasicDeliveryCost;
use App\Domain\Model\Basket\Delivery\Delivery;
use App\Domain\Model\Basket\Offers\Offer;
use App\Domain\Model\Basket\Offers\Offers;
use App\Domain\Model\Money;
use App\Domain\Model\Products\Products;
use App\Domain\Model\Products\ProductsRepository as Repository;

final class Basket
{
    public function __construct(
        private readonly Repository $repository,
        private readonly Delivery $delivery,
        private readonly Products $products,
        private readonly Offers $offers
    )
    {
    }

    public static function new(Repository $repository, array $products = [], array $offers = []): self
    {
        return new self(
            $repository,
            new BasicDeliveryCost(),
            Products::new($products),
            Offers::new($offers)
        );
    }

    public function add(string $productId): self
    {
        return new self(
            $this->repository,
            $this->delivery,
            $this->products->withProduct($this->repository->byId($productId)),
            $this->offers
        );
    }

    public function withOffer(Offer $offer): self
    {
        return new self(
            $this->repository,
            $this->delivery,
            $this->products,
            $this->offers->withOffer($offer)
        );
    }

    public function total(): Money
    {
        return $this->delivery->total($this->products->total());
    }

    public function withDiscountedProducts(): self
    {
        return new self(
            $this->repository,
            $this->delivery,
            $this->offers->applyTo($this->products),
            $this->offers
        );
    }

    public function products(): Products
    {
        return $this->products;
    }
}
