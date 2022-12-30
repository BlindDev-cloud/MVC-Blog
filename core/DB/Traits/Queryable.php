<?php

declare(strict_types=1);

namespace Core\DB\Traits;

use Core\DB\Connection;
use PDO;

trait Queryable
{
    protected static string $table;
    protected static string $query;
    protected string $type;
    protected array $where = [];

    protected function reset(): void
    {
        static::$query = '';
        $this->type = '';
        $this->where = [];
    }

    public function update(array $data): object
    {
        if($this->type !== ''){
            exit('UPDATE can`t be used here');
        }

        if(!isset($this->id)){
            return $this;
        }

        $query = 'UPDATE ' . static::$table . ' SET ' . static::buildPlaceholders($data) . ' WHERE id=:id';
        $statement = Connection::connect()->prepare($query);

        $statement->execute([
            'id' => $this->id,
            ...$data
        ]);

        return static::find($this->id);
    }

    public static function delete(int $id): bool
    {
        $query = 'DELETE FROM ' . static::$table . ' WHERE id=:id';
        $statement = Connection::connect()->prepare($query);

        return $statement->execute(compact('id'));
    }

    public function destroy(): object|bool
    {
        if(!isset($this->id)){
            return $this;
        }

        return static::delete($this->id);
    }

    protected static function buildPlaceholders(array $data): string
    {
        $placeholders = [];

        foreach ($data as $key => $value){
            $placeholders[] = $key . '=:' . $key;
        }

        return implode(', ', $placeholders);
    }

    public static function select(array $columns = ['*']): static
    {
        $model = new static();
        $model->reset();
        static::$query = 'SELECT ' . implode(', ', $columns) . ' FROM ' . static::$table;
        $model->type = 'select';

        return $model;
    }

    public static function all(): static
    {
        $model = new static();
        $model->reset();
        static::$query = 'SELECT * FROM ' . static::$table;
        $model->type = 'select';

        return $model;
    }

    public function where(string $field, mixed $value, string $condition = '='): static
    {
        if (!in_array($this->type, ['select', 'where'])) {
            exit('WHERE can not be used in this query');
        }

        $this->where[] = $field . $condition . $value;

        return $this;
    }

    public function get(): array
    {
        if (!empty($this->where)) {
            static::$query .= ' WHERE ' . implode(' AND ', $this->where);
        }

        return Connection::connect()->query(static::$query)->fetchAll(PDO::FETCH_CLASS, class: static::class);
    }

    public static function create(array $fields): int
    {
        $parameters = static::prepareFields($fields);

        $query = 'INSERT INTO ' . static::$table
            . ' (' . $parameters['names'] . ') VALUES'
            . ' (' . $parameters['placeholders'] . ')';

        $statement = Connection::connect()->prepare($query);
        $statement->execute($fields);

        return (int)Connection::connect()->lastInsertId();
    }

    protected static function prepareFields(array $fields): array
    {
        $names = array_keys($fields);
        $placeholders = preg_filter('/^/', ':', $names);

        return [
            'names' => implode(', ', $names),
            'placeholders' => implode(', ', $placeholders)
        ];
    }

    public static function find(int $id): object
    {
        $query = 'SELECT * FROM ' . static::$table . ' WHERE id=:id';

        $statement = Connection::connect()->prepare($query);

        $statement->execute(compact('id'));

        return $statement->fetchObject(static::class);
    }

    public static function findBy(string $field, string $value): object
    {
        $query = 'SELECT * FROM ' . static::$table
            . ' WHERE ' . $field . '=:' . $value;

        $statement = Connection::connect()->prepare($query);

        $statement->execute([
            $field => $value
        ]);

        return $statement->fetchObject(static::class);
    }
}