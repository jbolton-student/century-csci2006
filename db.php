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
        return $statement;
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
        // Checking for valid_user & isAdmin
        if($user = validateUser($username, $password) ) {
            $row = $user->fetch();
            $_SESSION['valid_user'] = $username;
            $_SESSION['isAdmin'] = $row['isAdmin'];
        }
    } else {
        return;
    }
}
// To give? admin privledges for product_update.php
function isAdmin(){

}
// To display categories for product_update.php
function getCategories(){
  $pdo = DBConnect();
  $sql = "select * from categories";

  $statement = $pdo->prepare($sql);

  $statement->execute();

  return $statement;
}

}
?>
