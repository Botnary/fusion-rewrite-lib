<?php
/**
 * Created by IntelliJ IDEA.
 * User: botnari
 * Date: 15-03-31
 * Time: 4:32 PM
 */

namespace Fusion\Rewrite;


class Database
{
    private static $_pdo;
    private static $_instance;

    /**
     * Database constructor.
     */
    public function __construct()
    {
        global $myDbHost, $myDbDatabase, $myDbUser, $myDbPassword;
        self::$_pdo = new \PDO(sprintf('mysql:host=%s;dbname=%s', $myDbHost, $myDbDatabase), $myDbUser, $myDbPassword);
    }

    /**
     * @return \PDO
     */
    public function getPdo()
    {
        return self::$_pdo;
    }

    public static function getInstance()
    {
        if (!self::$_instance) {
            self::$_instance = new self;
        }
        return self::$_instance;
    }
}