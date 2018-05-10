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

    private static $instance = null;


    /**
     * Database constructor.
     */
    private function __construct()
    {

    }

    /**
     * Get database instance
     */
    public static function getInstance() {

        if (!isset(self::$instance)) {
            global $config;

            $database = $config['database_name'];
            $username = $config['database_username'];
            $password = $config['database_password'];
            $host = $config['database_host'];

            $dsn = 'mysql:dbname=' . $database . ';host=' . $host;
            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;

            try {
                self::$instance = new PDO($dsn, $username, $password, $pdo_options);
            } catch (PDOException $e) {
                echo 'Connection failed: ' . $e->getMessage();
            }
        }
        return self::$instance;
    }
}