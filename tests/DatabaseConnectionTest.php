<?php

define('BASE_DIR', dirname(__FILE__) . '/..');

require_once BASE_DIR . '/vendor/autoload.php';

use App\Model\DatabaseConnection;
use PHPUnit\Framework\TestCase;

// Load environment variable
$dotenv = Dotenv\Dotenv::createImmutable(BASE_DIR);
$dotenv->load();

final class DatabaseConnectionTest extends TestCase
{
    public function testGreetsWithName(): void
    {
        $database = new DatabaseConnection($_ENV['DATABASE_HOST'], $_ENV['DATABASE_NAME'], $_ENV['DATABASE_USERNAME'], $_ENV['DATABASE_PASSWORD']);

        $result = $database->query('Alice');

        $this->assertSame('Hello, Alice!', $result);
    }
}
