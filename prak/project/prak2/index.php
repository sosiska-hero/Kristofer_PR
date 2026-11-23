<?php declare(strict_types=1);

require __DIR__ . '/autoload.php';

use Shop\Models\Product;
use Shop\Models\Customer;
use Shop\Services\Cart;
use Shop\Helpers\PriceFormatter;

$customer = new Customer('Владимир Горбатенко', 'vovun@gmail.com');

$cart = new Cart($customer);
$cart->add(new Product('Клавиатура', 2500.00), 1);
$cart->add(new Product('Мышь', 1200.50), 2);
$cart->add(new Product('Монитор', 15000.00), 1);

echo "Итого: " . PriceFormatter::format($cart->getTotal()) . PHP_EOL;