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

function validateUser($email, $pass) {
    // check if user/pass are right
    $pdo = DBConnect();
    $sql = "select * from credentials where email=:email
        and password=:pass";

    $statement = $pdo->prepare($sql);
    $statement->bindValue(":email", $email);
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
    if (isset($_POST['email'])
        && isset($_POST['password'])
    ) {
        $username = $_POST['email'];
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

function registerUser() {

  if(isset($_POST['registerEmail']) && isset($_POST['registerPassword']) && isset($_POST['registerPassword'])){
    $username = $_POST['registerEmail'];
    $password = $_POST['registerPassword'];
    $confirm = $_POST['confirmPassword'];
    if($username == "" || $password == "" || $confirm == ""){
      return "Failed To Register: Please Try Again";
    }
    if($password != $confirm){
      return "Failed To Register: Please Try Again";
    }

    $pdo = DBConnect();

    $sql = "select * from credentials where email=:email";
    $statement = $pdo->prepare($sql);
    $statement->bindValue(":email", $username);
    $statement->execute();
    if($statement->rowCount() > 0) {
        return "Failed To Register: Please Try Again";
    }

    $sql = "insert into credentials(email, password) values (:email, :pass)";
    $statement = $pdo->prepare($sql);
    $statement->bindValue(":email", $username);
    $statement->bindValue(":pass", $password);
    $statement->execute();

    if($statement->rowCount() > 0) {
        return "Successful Registration: You Can Now Login";
    }
  }
  return "Failed To Register: Please Try Again";
}

// To display categories for product_update.php
function getCategories(){
  $pdo = DBConnect();
  $sql = "select * from categories";

  $statement = $pdo->prepare($sql);

  $statement->execute();

  return $statement;
}
// To add products to the DB (taken from products.text.php)
function addProduct($name, $cost, $description, $image){
    if($name == "" || $cost == "" || $image == "" || $description == ""){
        return;
    }

    $pdo = DBConnect();

    $sql = "insert into products(name, cost, description, image) values (:name, :cost, :description, :image)";
    $statement = $pdo->prepare($sql);
    $statement->bindValue(":name", $name);
    $statement->bindValue(":cost", $cost);
    $statement->bindValue(":description", $description);
    $statement->bindValue(":image", $image);
    //$statement->bindValue(":category", $category);

    $statement->execute();

    $x = "select * from products where ID=LAST_INSERT_ID()";
    $statement = $pdo->prepare($x);
    $statement->execute();
    if($statement->rowCount() > 0){
      $row = $statement->fetch();
      return $row;
    }
}
function updateProduct($id, $name, $cost, $description, $image){
  if($id =="" || $name == "" || $cost == "" || $image == "" || $description == ""){
    //print_r("I returned");
      return;
  }
  //print_r("in updateProduct");
  $pdo = DBConnect();

  $sql = "update products set name=:name, cost=:cost, description=:description, image=:image where ID=:id";
  $statement = $pdo->prepare($sql);
  $statement->bindValue(":name", $name);
  $statement->bindValue(":cost", $cost);
  $statement->bindValue(":description", $description);
  $statement->bindValue(":image", $image);
  //$statement->bindValue(":category", $category);
  $statement->bindValue(":id", $id);

  $statement->execute();

  $x = "select * from products where id=:id";
  $stmt = $pdo->prepare($x);
  $stmt->bindValue(":id", $id);

  $stmt->execute();

  if($stmt->rowCount() > 0){
    $row = $stmt->fetch();
    return $row;
  }

}

?>
