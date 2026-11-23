<?php declare(strict_types=1);

require __DIR__ . '/Student.php';
$students = [
    new Student(1001, 'Колесов', 'Никита', 1),
    new Student(1002, 'Ракова', 'Мария', 2),
    new Student(1003, 'Тинькофф', 'Олег', 3),
    new Student(1004, 'Кристофер', 'Светлана', 4),
];

$students[0]->email = 'kolesov@example.com';
$students[1]->email = 'rakova@example.com';
$students[2]->email = 'kristofer@example.com';

$students[0]->grades = [5, 4, 5];
$students[1]->grades = [4, 4, 3];
$students[2]->grades = [5, 5, 5];
$students[3]->grades = [3, 4, 4];
echo sprintf("%-6s %-20s %-5s %-25s %-8s", 'Билет', 'ФИО', 'Курс', 'Почта', 'Ср.балл') . PHP_EOL;
echo str_repeat('-', 70) . PHP_EOL;

foreach ($students as $s) {
    echo sprintf(
        "%-6d %-20s %-5d %-25s %-8.2f",
        $s->id,
        $s->getFullName(),
        $s->course,
        $s->email ?? 'не указана',
        $s->getAverageGrade()
    ) . PHP_EOL;
}

echo PHP_EOL . "Всего студентов: " . Student::$totalStudents . PHP_EOL;