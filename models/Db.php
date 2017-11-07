<?php
/**
 * Created by PhpStorm.
 * User: Jirka
 * Date: 6.11.2017
 * Time: 11:02
 */

class Db
{
    private static $connection;
    private static $settings = array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        PDO::ATTR_EMULATE_PREPARES => false,
    );

    public static function connect($host, $user, $password, $database)
    {
        if (!isset(self::$connection)) {
            self::$connection = @new PDO(
                "mysql:host=$host;dbname=$database",
                $user,
                $password,
                self::$settings
            );
        }
    }

    public static function queryOneRow($query, $params = array())
    {
        $row = self::$connection->prepare($query);
        $row->execute($params);
        return $row->fetch();
    }

    public static function queryFewRows($query, $params = array())
    {
        $rows = self::$connection->prepare($query);
        $rows->execute($params);
        return $rows->fetchAll();
    }

    public static function queryOneField($query, $params = array())
    {
        $field = self::queryOneRow($query, $params);
        return $field[0];
    }

    public static function countChanges($query, $params = array())
    {
        $rows = self::$connection->prepare($query);
        $rows->execute($params);
        return $rows->rowCount();
    }

    public static function update($query, $params = array())
    {
        $db = self::$connection->prepare($query);
        $db->execute($params);
    }
}