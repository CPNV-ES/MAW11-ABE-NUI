<?php

namespace App\Database;

use PDO;

class DBConnection {

    protected ?PDO $pdo;
    protected static string $dns;
    protected static string $user;
    protected static string $password;
    private static ?DBConnection $dbConnection = null;

    public static function setUp(string $dns, string $user, string $password): void
    {
        self::$dns = $dns;
        self::$user = $user;
        self::$password = $password;
        self::$dbConnection = new self();

    }

    public static function getInstance(): DBConnection {
        return self::$dbConnection;
    }

    public function getPDO(): PDO {
        // Return PDO logic here
        if (!isset($this->pdo)) {
            $this->open();
        }
        return $this->pdo;
    }

    private function open(): void {
        $this->pdo = new PDO(self::$dns, self::$user, self::$password);
    }

    public function close(): void {
        // Close connection logic here
        self::$dbConnection = null;
    }

    public function execute(string $sql, string $class, array $param = null, bool $single = false): object|bool|array
    {
        $request = $this->getPDO()->prepare($sql);

        $request->execute($param);

        if (str_starts_with($sql, 'SELECT')) {
            if ($single) {
                return $request->fetchObject($class);
            } else {
                return $request->fetchAll(PDO::FETCH_CLASS, $class);
            }
        } else {
            return $request->rowCount() > 0;
        }
    }

    public function getLastItemId(): int {
        // Return last inserted ID logic here
        return $this->getPDO()->lastInsertId();
    }
}