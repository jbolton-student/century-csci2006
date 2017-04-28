<?php

require_once("db.php");

function getProductByName($name) {
    $pdo = DBConnect();
    $sql = "select * from products where name=:name";
    $statement = $pdo->prepare($sql);
    $statement->bindValue(":name", $name);
    $statement->execute();

    if($statement->rowCount() == 0 ) {
        return null;
    } else {
        $row = $statement->fetch();
        $p = new Product($row);
        return $p;
    }
}

function getProductByID($id) {
    $pdo = DBConnect();
    $sql = "select * from products where id=:id";
    $statement = $pdo->prepare($sql);
    $statement->bindValue(":id", $id);
    $statement->execute();

    if($statement->rowCount() == 0 ) {
        return null;
    } else {
        $row = $statement->fetch();
        $product = new Product($row);
        return $product;
    }
}

class Product {
    private $cost;
    private $description;
    private $id;
    private $image;
    private $name;

    // function __construct($name, $cost, $image=NULL, $description=NULL) {
    function __construct($record) {
        $this->id = $record['id'];
        $this->name = $record['name'];
        $this->cost = $record['cost'];
        $this->image = $record['image'];
        $this->description = $record['description'];
    }

    public function getCost() {
        return $this->cost;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getID() {
        return $this->id;
    }

    public function getImage() {
        return $this->image;
    }

    public function getName() {
        return $this->name;
    }

    public function setCost($cost) {
        $this->cost = $cost;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function setID($id) {
        $this->$id = $id;
    }

    public function setImage($url) {
        $this->image = $url;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function __toString() {
        $productInfo = "<br>Product: " . $this->getID() . "<br>" . $this->getName() . "<br>" . $this->getCost() . "<br>" . $this->getDescription() . "<br>" . $this->getImage() . "<br>";
        return $productInfo;

    }
}


?>
