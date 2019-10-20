[![Build Status](https://travis-ci.org/mkakpabla/shoppingcart.svg?branch=master)](https://travis-ci.org/mkakpabla/shoppingcart)
# Shopping Cart


## Requirements

* PHP 7.2 or higher
* Composer for installation

## Quick Start

#### Installation
```bash
composer require "mkakpabla/shoppingcart"
```

#### Usage

```php
<?php

require 'vendor/autoload.php';

$cart = new Cart();

$cart->addItem(1, [
    'name' => 'item1',
    'price' => 'item2'
], 2);

// Return the list of the CartItems
$items = $cart->getItems();

// Return the price of the cart
$cartPrice = $items->totalPrice()

```



