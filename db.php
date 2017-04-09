<?php

require('config.php');

function db_connect() {
    try {
        $connString = "mysql:host=" . DBHOST . ";dbname=" . DBNAME;
        $user = DBUSER;
        $pass = DBPASS;

        $pdo = new PDO($connString, $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch(PDOException $e) {
        die($e->getMessage());
    }
}

?>