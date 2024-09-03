<?php

namespace App\Model;

use PDOException;
use Exception;
use \PDO;

class DBConnection
{
    private $hostname;
    private $database;
    private $username;
    private $password;
    private $pdo;

    
    public function __construct($hostname, $database, $username, $password)
    {
        $this->hostname = $hostname;
        $this->database = $database;
        $this->username = $username;
        $this->password = $password;

        $dsn = 'mysql:dbname='.$database.';host='.$hostname;
        try 
        {
            $this->pdo = new PDO($dsn, $username, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            
            // Set Error Mode to Exception
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch (PDOException $e) 
        {
            throw new Exception("Could not connect to the database: " . $e->getMessage(), 500);
        }
    }

    public function closeConnection()
    {
        $this->pdo = null;
    }
    
    public function getPDO()
    {
        return $this->pdo;
    }
}