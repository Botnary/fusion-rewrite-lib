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
    public static function getPdo()
    {
        return self::$_pdo;
    }

}