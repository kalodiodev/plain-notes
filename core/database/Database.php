<?php

namespace App\Core\Database;

use PDO;
use PDOException;

/**
 * Class responsible for database connection
 *
 * @package App\Core\Database
 */
class Database {

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
     * Connect to database
     *
     * @return null|PDO
     */
    public function connect()
    {
        $dsn = 'mysql:dbname=' . $this->database . ';host=' . $this->host;
        $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;

        try {
            return new PDO($dsn, $this->username, $this->password, $pdo_options);
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }

        return null;
    }
}