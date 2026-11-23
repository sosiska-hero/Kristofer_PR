<?php declare(strict_types=1);

require __DIR__ . '/Book.php';
require __DIR__ . '/Library.php';

$lib = new Library();
$lib->addBook(new Book('Мастер и Маргарита', 'М. Булгаков', 1967, 480));
$lib->addBook(new Book('Преступление и наказание', 'Ф. Достоевский', 1866, 671));
$lib->addBook(new Book('Война и мир', 'Л. Толстой', 1869, 1274));
$lib->addBook(new Book('Собачье сердце', 'М. Булгаков', 1925, 160));
$lib->addBook(new Book('Евгений Онегин', 'А. Пушкин', 1833, 224));

echo "=== Все книги ===" . PHP_EOL;
$lib->printAll();

echo PHP_EOL . "Поиск по автору: М. Булгаков" . PHP_EOL;
foreach ($lib->findByAuthor('М. Булгаков') as $b) {
    echo $b->getInfo() . PHP_EOL;
}

echo PHP_EOL . "Количество книг: " . $lib->count() . PHP_EOL;

$oldest = $lib->getOldest();
echo "Самая старая книга: " . ($oldest === null ? 'нет книг' : $oldest->getInfo()) . PHP_EOL;


echo PHP_EOL . "Присваивание и клонирование" . PHP_EOL;
$b1 = new Book('Оригинал', 'Автор', 2000, 100);
$b2 = $b1;   
$b3 = clone $b1;  

$b1->title = 'Изменённое название';
echo "b1: " . $b1->getInfo() . PHP_EOL;
echo "b2: " . $b2->getInfo() . PHP_EOL;
echo "b3: " . $b3->getInfo() . PHP_EOL;