<?php

require_once('config.php');

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
    // check if user/pass are right
    $pdo = DBConnect();
    $sql = "select * from users where username=:user
        and password=:pass";

    $statement = $pdo->prepare($sql);
    $statement->bindValue(":user", $user);
    $statement->bindValue(":pass", $pass);

    $statement->execute();

    if($statement->rowCount() == 1) {
        return True;
    }
    return False;
}

function loginUser() {
    // Login if possible
    // if POST, attempt to login
    if (isset($_POST['username'])
        && isset($_POST['password'])
    ) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        if(validateUser($username, $password) ) {
            $_SESSION['valid_user'] = $username;
        }
    } else {
        return;
    }
}

?>