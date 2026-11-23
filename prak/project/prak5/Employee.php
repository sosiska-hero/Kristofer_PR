<?php declare(strict_types=1);

class Employee
{
    public string $name;
    protected float $baseSalary;
    private string $passport;
    private array $salaryHistory = [];

    public function __construct(string $name, float $baseSalary, string $passport)
    {
        $this->name = $name;
        $this->baseSalary = $baseSalary;
        $this->passport = $passport;
    }

    public function getSalary(): float
    {
        return $this->baseSalary;
    }

    public function raiseSalary(float $percent): void
    {
        $this->validatePercent($percent);
        $old = $this->baseSalary;
        $this->baseSalary += $this->baseSalary * $percent / 100;
        $this->salaryHistory[] = [
            'old' => $old,
            'new' => $this->baseSalary,
            'percent' => $percent,
        ];
    }

    final public function getMaskedPassport(): string
    {
        $digits = preg_replace('/\D/', '', $this->passport);
        return '**** **' . substr($digits, -4);
    }

    public function getSalaryHistory(): array
    {
        return $this->salaryHistory;
    }
    protected function calculateTax(float $amount): float
    {
        return $amount * 0.13;
    }

    private function validatePercent(float $p): void
    {
        if ($p < 1 || $p > 50) {
            throw new InvalidArgumentException('Процент повышения должен быть от 1 до 50');
        }
    }
}