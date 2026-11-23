<?php declare(strict_types=1);

require __DIR__ . '/Employee.php';
require __DIR__ . '/Manager.php';
require __DIR__ . '/Developer.php';

// ==========================================
// ПУНКТ 7: ТАБЛИЦА ЭКСПЕРИМЕНТОВ
// ==========================================
echo "=== Таблица экспериментов ===" . PHP_EOL;

$e = new Employee('Тест', 50000, '1234 567890');
$m = new Manager('Менеджер', 80000, '2345 678901', 3);
$d = new Developer('Разработчик', 100000, '3456 789012', 'senior');

echo "1) name снаружи: " . $e->name . PHP_EOL;

try {
    echo $e->baseSalary;
} catch (Error $err) {
    echo "2) baseSalary снаружи: " . $err->getMessage() . PHP_EOL;
}

echo "3) baseSalary в Manager (через getSalary): " . $m->getSalary() . PHP_EOL;

try {
    $m->tryReadPassport();
} catch (Error $err) {
    echo "4) passport в Manager: " . $err->getMessage() . PHP_EOL;
}

try {
    $e->calculateTax(1000);
} catch (Error $err) {
    echo "5) calculateTax снаружи: " . $err->getMessage() . PHP_EOL;
}

try {
    $d->tryCallValidatePercent();
} catch (Error $err) {
    echo "6) validatePercent в Developer: " . $err->getMessage() . PHP_EOL;
}


echo PHP_EOL . " Расчет зарплат" . PHP_EOL;

$employees = [
    new Employee('Колесов Никита', 60000, '1111 222222'),
    new Manager('Иванов Егор', 80000, '3333 444444', 4),
    new Developer('Ракова Мария', 100000, '5555 666666', 'senior'),
    new Developer('Тинькофф Олег', 70000, '7777 888888', 'middle'),
];

echo "Имя | Тип | Зарплата | Налог | На руки\n";
echo "------------------------------------------------------\n";

foreach ($employees as $emp) {
    $salary = $emp->getSalary();
    $tax = $salary * 0.13; // нналог считаем снаружи
    $net = $salary - $tax;
    
    $type = get_class($emp); // имя класса

    echo $emp->name . " | " . $type . " | " . $salary . " | " . $tax . " | " . $net . "\n";
}