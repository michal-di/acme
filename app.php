<?php

declare(strict_types = 1);

use App\Domain\Model\Basket\Basket;
use App\Domain\Model\Basket\Delivery\BasicDeliveryCost;
use App\Domain\Model\Basket\Offers\FreeGreenWidgetsOffer;
use App\Domain\Model\Basket\Offers\Offers;
use App\Domain\Model\Basket\Offers\SecondRedWidgetHalfPriceOffer;
use App\Domain\Model\Products\RegularProduct;
use App\Domain\Model\Products\Products;
use App\Infrastructure\Persistence\Fake\FakeProductsRepository;
use App\Infrastructure\Views\Cli\CliBasketView;
use App\Application\BasketService;

require_once __DIR__ . '/vendor/autoload.php';

// $basketProducts1 = [
//     RegularProduct::new('Green Widget', 'G01', 24.95),
//     RegularProduct::new('Blue Widget', 'B01', 7.95),
// ];
//
// $basketProducts2 = [
//     RegularProduct::new('Red Widget', 'R01', 32.95),
//     RegularProduct::new('Red Widget', 'R01', 32.95),
// ];
//
// $basketProducts4 = [
//     RegularProduct::new('Blue Widget', 'B01', 7.95),
//     RegularProduct::new('Blue Widget', 'B01', 7.95),
//     RegularProduct::new('Red Widget', 'R01', 32.95),
//     RegularProduct::new('Red Widget', 'R01', 32.95),
//     RegularProduct::new('Red Widget', 'R01', 32.95),
// ];
//
// $basket = new Basket(
//     new FakeProductsRepository(),
//     new BasicDeliveryCost(),
//     Products::new($basketProducts1),
//     Offers::new([
//         new SecondRedWidgetHalfPriceOffer(),
//         new FreeGreenWidgetsOffer()
//     ])
// );

// $basket = Basket::new(new FakeProductsRepository())
//     ->withOffer(new SecondRedWidgetHalfPriceOffer())
//     ->withOffer(new FreeGreenWidgetsOffer())
//     ->add('B01')
//     ->add('B01')
//     ->add('R01')
//     ->add('R01')
//     ->add('R01');

$basketService = BasketService::new()
    ->add('B01')
    ->add('B01')
    ->add('R01')
    ->add('R01')
    ->add('R01');

echo new CliBasketView($basketService->basket());
