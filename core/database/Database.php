<?php

namespace App\Core\Database;

use PDO;
use PDOException;

/**
 * Class Database
 *
 * @package App\Core\Database
 */
class Database {

    private $connection;

    private $username;
    private $password;
    private $database;
    private $host;

    /**
     * Database constructor.
     */
    public function __construct()
    {
        global $config;

        $this->database = $config['database_name'];
        $this->username = $config['database_username'];
        $this->password = $config['database_password'];
        $this->host = $config['database_host'];
    }

    /**
     * Connect to databse
     */
    public function connect()
    {
        $dsn = 'mysql:dbname=' . $this->database . ';host=' . $this->host;

        try {
            $this->connection = new PDO($dsn, $this->username, $this->password);
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }

        return $this->connection;
    }
    
    /**
     * Disconnect database
     */
    public function disconnect()
    {
        $this->connection = null;
    }

}