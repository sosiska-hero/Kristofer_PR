<?php declare(strict_types=1);

class Library
{
    private array $books = [];

    public function addBook(Book $book): void
    {
        $this->books[] = $book;
    }

    public function findByAuthor(string $author): array
    {
        $result = [];
        foreach ($this->books as $book) {
            if (mb_strtolower($book->author) === mb_strtolower($author)) {
                $result[] = $book;
            }
        }
        return $result;
    }

    public function count(): int
    {
        return count($this->books);
    }

    public function printAll(): void
    {
        foreach ($this->books as $book) {
            echo $book->getInfo() . PHP_EOL;
        }
    }

    public function getOldest(): ?Book
    {
        if (count($this->books) === 0) {
            return null;
        }
        $oldest = $this->books[0];
        foreach ($this->books as $book) {
            if ($book->year < $oldest->year) {
                $oldest = $book;
            }
        }
        return $oldest;
    }
}