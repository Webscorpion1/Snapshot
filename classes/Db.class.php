<?php

class Db {
    private static $conn;
    public static function getInstance() {

        if( self::$conn == null ){
            self::$conn = new PDO('mysql:host=localhost; dbname=snapshot', 'root', 'root');
            //self::$conn = new PDO('mysql:host=localhost; dbname=lucassg244_snapshot', 'lucassg244_snapshotdbuser', 'iH56EjEyr3hHtGqc7d8fVOTNtqeYJJSkYH4zxRRyeFqmLtO9dPZ7P');

            return self::$conn;

        }
        else {
            return self::$conn;
        }
    }

}