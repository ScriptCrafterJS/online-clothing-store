<?php 

    define("DBHOST", "localhost");
    define("DBNAME","shippify-clothes");
    define("DBUSER","MotasemAli");
    define("DBPASS","Simon1110");

    function db_connect($dbhost = DBHOST,$dbname = DBNAME, $dbuser = DBUSER, $dbpass = DBPASS){
        $connectionString = "mysql:host=$dbhost;dbname=$dbname";

        try{
            $pdo = new PDO($connectionString, $dbuser, $dbpass);
        return $pdo;
        }catch(PDOException $e){
            die($e->getMessage());
        }
    }
?>