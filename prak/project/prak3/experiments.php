<?php declare(strict_types=1);

require __DIR__ . '/Student.php';

echo "Эксперименты" . PHP_EOL;

try {
    $s = new Student(1, 'Тест', 'Тест', 1);
    $s->id = 999;
} catch (Error $e) {
    echo "1) id: " . $e->getMessage() . PHP_EOL;
}
try {
    $s = new Student(2, 'Тест', 'Тест', 1);
    $s->course = 'два';
} catch (TypeError $e) {
    echo "2) course: " . $e->getMessage() . PHP_EOL;
}
try {
    new Student(3, 'Тест', 'Тест', 7);
} catch (InvalidArgumentException $e) {
    echo "3) курс 7: " . $e->getMessage() . PHP_EOL;
}

$s1 = new Student(4, 'Первый', 'Студент', 1);
$s2 = new Student(5, 'Второй', 'Студент', 2);
Student::$university = 'СПбГУ';
echo "4) university у s1: " . Student::$university . PHP_EOL;
echo "4) university у s2: " . Student::$university . PHP_EOL;
$s = new Student(6, 'Дамп', 'Объект', 1);
$s->email = 'dump@example.com';
$s->grades = [5, 5];

echo "5) var_dump:" . PHP_EOL;
var_dump($s);

echo "5) get_object_vars:" . PHP_EOL;
print_r(get_object_vars($s));