<?php

declare(strict_types = 1);

use App\Application\BasketService;
use App\Infrastructure\Views\Cli\CliBasketView;

require_once __DIR__ . '/vendor/autoload.php';

$basketService = BasketService::new()
    ->add('B01')
    ->add('B01')
    ->add('R01')
    ->add('R01')
    ->add('R01');

echo new CliBasketView($basketService->basket());
