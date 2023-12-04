<?php
class dbCon
{
    private static $host = "localhost";
    private static $user = "root";
    private static $password = "";
    private static $dbName = "crowdfunding_db";

    private static $connection = null;

    static function getConnection()
    {
        try {
            if (dbCon::$connection == null) {

                dbCon::$connection = mysqli_connect(dbCon::$host, dbCon::$user, dbCon::$password, dbCon::$dbName);
                
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        return dbCon::$connection;
    }

    static public function getCon(){
        return dbCon::$connection;
    }
}
