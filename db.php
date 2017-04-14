<?php

require('config.php');

function DBConnect() {
    $pdo = null;
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

function validateUser($user, $pass) {
    $pdo = DBConnect();
    $sql = "select * from users where username=:user
        and password=:pass";

    $statement = $pdo->prepare($sql);
    $statement->bindValue(":user", $user);
    $statement->bindValue(":pass", $pass);

    $statement->execute();
    if($statement->rowCount() > 0) {
        return True;
    }
    return False;
}

?>