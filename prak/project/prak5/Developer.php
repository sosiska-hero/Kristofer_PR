<?php declare(strict_types=1);

class Developer extends Employee
{
    private string $level;

    public function __construct(string $name, float $baseSalary, string $passport, string $level)
    {
        parent::__construct($name, $baseSalary, $passport);
        $this->level = $level;
    }

    public function getSalary(): float
    {
        if ($this->level === 'junior') {
            $coef = 1.0;
        } elseif ($this->level === 'middle') {
            $coef = 1.5;
        } else {
            $coef = 2.0;
        }
        return $this->baseSalary * $coef;
    }

    // для 7
    public function tryCallValidatePercent(): void
    {
        $this->validatePercent(10); 
    }
}