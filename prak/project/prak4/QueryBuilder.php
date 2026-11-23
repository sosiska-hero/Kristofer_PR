<?php declare(strict_types=1);

class QueryBuilder
{
    private const ALLOWED_OPERATORS = ['=', '!=', '>', '<', '>=', '<=', 'LIKE'];
    private const ALLOWED_DIRECTIONS = ['ASC', 'DESC'];

    private string $table = '';
    private array $columns = ['*'];
    private array $wheres = [];
    private array $orders = [];
    private ?int $limit = null;

    private function __construct() {}
    public static function table(string $name): static
    {
        $obj = new static();
        $obj->table = $name;
        return $obj;
    }

    public function select(string ...$columns): static
    {
        if (count($columns) > 0) {
            $this->columns = $columns;
        }
        return $this;
    }
    public function where(string $column, string $operator, string|int $value): static
    {
        if (!in_array($operator, self::ALLOWED_OPERATORS, true)) {
            throw new InvalidArgumentException("Недопустимый оператор: {$operator}");
        }
        $this->wheres[] = "{$column} {$operator} " . $this->quote($value);
        return $this;
    }
    public function orderBy(string $column, string $direction = 'ASC'): static
    {
        if (!in_array($direction, self::ALLOWED_DIRECTIONS, true)) {
            throw new InvalidArgumentException("Направление сортировки: только ASC или DESC");
        }
        $this->orders[] = "{$column} {$direction}";
        return $this;
    }

    public function limit(int $count): static
    {
        if ($count <= 0) {
            throw new InvalidArgumentException('LIMIT должен быть больше 0');
        }
        $this->limit = $count;
        return $this;
    }

    public function toSql(): string
    {
        $sql = 'SELECT ' . implode(', ', $this->columns) . ' FROM ' . $this->table;

        if (count($this->wheres) > 0) {
            $sql .= ' WHERE ' . implode(' AND ', $this->wheres);
        }
        if (count($this->orders) > 0) {
            $sql .= ' ORDER BY ' . implode(', ', $this->orders);
        }
        if ($this->limit !== null) {
            $sql .= ' LIMIT ' . $this->limit;
        }
        return $sql;
    }
    public function __toString(): string
    {
        return $this->toSql();
    }

    private function quote(string|int $value): string
    {
        if (is_int($value)) {
            return (string)$value;
        }
        return "'" . $value . "'";
    }
    public function __call(string $name, array $args): static
    {
        if (str_starts_with($name, 'where') && strlen($name) > 5) {
            $column = lcfirst(substr($name, 5));
            $value = $args[0] ?? '';
            return $this->where($column, '=', $value);
        }
        throw new BadMethodCallException("Метод {$name} не существует");
    }
}