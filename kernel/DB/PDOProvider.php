<?php


namespace kernel\DB;


use kernel\App;
use PDO;

/**
 * Class PDOProvider
 *
 * @package kernel\DB
 */
class PDOProvider
{
    private static $instance = null;
    private        $dbh      = null;

    /**
     * PDOProvider constructor.
     */
    private function __construct()
    {
        $dbConfig = App::getInstance()->getConfig('db');

        $this->dbh = new PDO($dbConfig['driver'] . ":host=" . $dbConfig['host'] . ";dbname=" . $dbConfig['database'] . ";charset=" . $dbConfig['charset'] . "", $dbConfig['user'], $dbConfig['password'], [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES " . $dbConfig['charset'] . ""]);
    }

    /**
     * Clone method
     */
    private function __clone() { }

    /**
     * Wakeup method
     */
    private function __wakeup() { }

    /**
     * @return PDO
     */
    public static function getInstance(): PDO
    {
        if (!self::$instance) {
            self::$instance = new self();
        }

        return self::$instance->dbh;
    }
}
