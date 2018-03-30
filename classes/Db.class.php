<?php

class Db {
    private static $conn;

    public static function getInstance() {

        include_once("settings/db.php");


        if( self::$conn == null ){
            self::$conn = new PDO("mysql:host=".$db['host'].";dbname=".$db['dbname'], $db['username'], $db['password']);
            return self::$conn;

        }
        else {
            return self::$conn;
        }
    }

}