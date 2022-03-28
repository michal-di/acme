<?php

declare(strict_types = 1);

use App\Application\BasketService;

it('returns proper total price using add() method for basket 1')
    ->expect(BasketService::new()->add('G01')->add('B01')->total()->amount())
    ->toBe(37.85);

it('returns proper total price using add() method for basket 2')
    ->expect(BasketService::new()->add('R01')->add('R01')->total()->amount())
    ->toBe(54.37);

it('returns proper total price using add() method for basket 3')
    ->expect(BasketService::new()->add('R01')->add('G01')->total()->amount())
    ->toBe(60.85);

it('returns proper total price using add() method for basket 4')
    ->expect(
        BasketService::new()
            ->add('B01')
            ->add('B01')
            ->add('R01')
            ->add('R01')
            ->add('R01')
            ->total()
            ->amount()
    )
    ->toBe(98.27);
