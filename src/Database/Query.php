<?php

namespace App\Database;

class Query {
    private $db;

    protected DBConnection $dbConnection;

    public function __construct() {
        $this->dbConnection = DBConnection::getInstance();
    }

    public function select(
        String $table,
        String $class,
        string $conditions = null,
        array $params = null,
        bool $single = false
    ): array|object {
        $sql = "SELECT * FROM {$table}";
        $sql .= $conditions ? " WHERE {$conditions}" : "";
        return $this->dbConnection->execute($sql, $class, $params, $single);
    }

    public function insert(string $table, string $class, array $data): int
    {
        $fieldList = implode(', ', array_keys($data)); 
        $placeholderList = implode(', ', array_map(fn($key) => ":{$key}", array_keys($data)));

        $this->dbConnection->execute(
            "INSERT INTO {$table} ({$fieldList}) VALUES ({$placeholderList})",
            $class,
            $data
        );
        return $this->dbConnection->getLastItemId();
    }

    public function update(string $table, string $class, string $conditions, array $params, array $data): bool
    {
        $updateList = implode(
            ', ',
            array_map(fn($key) => "{$key} = :{$key}", array_keys($data))
        );
        $data = array_merge($params, $data);

        return $this->dbConnection->execute(
            "UPDATE {$table} SET {$updateList} WHERE {$conditions}",
            $class,
            $data
        );
    }

    public function delete(String $table, String $conditions, String $class, Array $params): bool {
        return $this->dbConnection->execute("DELETE FROM {$table} WHERE {$conditions}", $class, $params);
    }
}