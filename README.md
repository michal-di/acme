Requires PHP 8.1

### How to run it
    composer install
    php app.php

### How to run tests
    ./vendor/bin/pest

### How it works

The main object (aggregate) is the `src/Domain/Model/Basket/Basket.php` file. It takes four dependencies:
- Repository: access to all available products in the shop. It can be for example a Mysql repository.
- Delivery: a Strategy pattern to provide logic for counting the delivery cost
- Products: collection of selected products
- Offers: collection of available promos

Every product is a `RegularProduct` class. If there is an offer for it, then such object is wrapped inside `DiscountedProduct` where we have access to the new price, and to the regular price as well.

Domain layer doesn't contain any particular implementation of the storage. It contains only interfaces of the repositories (`ProductsRepository`), and the implementation is located in the `src/Infrastructure/Persistence` layer.

I wanted to keep this demo small, but in real app the `BasketService.php` in the `Application` layer should communicate with domain logic using some DTO.

- Every class is immutable
- No setter methods
- Every logic is provided as a dependency
- Instead of arrays and loops (imperative style), application uses collections and functional, 
declarative style. Best seen in `src/Domain/Model/Basket/Offers/SecondRedWidgetHalfPriceOffer.php`
- Instead of using `float` type for prices, it uses a `Money` class which also handles currency.

