<?php
    define('DB_HOST', 'your_host');
    define('DB_NAME', 'your_database');
    define('DB_USER', 'your_username');
    define('DB_PASS', 'your_password');

    function connectToDatabase($host = DB_HOST, $dbname = DB_NAME, $username = DB_USER, $password = DB_PASS) {
        try {
            $pdo = new PDO("mysql:host=".$host.";dbname=".$dbname, $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }
    $pdo = connectToDatabase();
?>