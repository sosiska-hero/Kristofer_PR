<?php declare(strict_types=1);

require __DIR__ . '/QueryBuilder.php';

// Запрос 1
echo QueryBuilder::table('users')
    ->select('id', 'name', 'email')
    ->where('age', '>=', 18)
    ->where('city', '=', 'Москва')
    ->orderBy('name')
    ->limit(10) . PHP_EOL;

// Запрос 2
echo QueryBuilder::table('products')
    ->where('price', '<', 1000)
    ->orderBy('price', 'DESC') . PHP_EOL;

// Запрос 3
echo QueryBuilder::table('logs')
    ->select('created_at', 'message')
    ->where('level', 'LIKE', '%error%')
    ->limit(5) . PHP_EOL;

// Перехват исключений
try {
    QueryBuilder::table('users')->orderBy('name', 'UP');
} catch (InvalidArgumentException $e) {
    echo "orderBy: " . $e->getMessage() . PHP_EOL;
}

try {
    QueryBuilder::table('users')->limit(0);
} catch (InvalidArgumentException $e) {
    echo "limit: " . $e->getMessage() . PHP_EOL;
}

try {
    QueryBuilder::table('users')->where('age', '<>', 18);
} catch (InvalidArgumentException $e) {
    echo "where: " . $e->getMessage() . PHP_EOL;
}
echo QueryBuilder::table('users')->whereCity('Москва') . PHP_EOL;
// SELECT * FROM users WHERE city = 'Москва'