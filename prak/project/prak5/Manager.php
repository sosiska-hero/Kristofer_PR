<?php declare(strict_types=1);

class Manager extends Employee
{
    private int $teamSize;

    public function __construct(string $name, float $baseSalary, string $passport, int $teamSize)
    {
        parent::__construct($name, $baseSalary, $passport);
        $this->teamSize = $teamSize;
    }

    public function getSalary(): float
    {
        return $this->baseSalary + 5000 * $this->teamSize;
    }
    public function tryReadPassport(): void
    {
        echo $this->passport; 
    }
}