<?php

require('db.php');
require('products.class.php');

function listProducts($pdo) {
    // using classes
    $sql = "select * from products";
    $statement = $pdo->prepare($sql);
    $statement->execute();

    $data = $statement->fetchAll();
    foreach($data as $i => $row) {
        $p = new Product($row);
        echo($p);
    }
}

function addProduct($pdo, $name, $cost, $image, $description) {
    if(productExists($pdo, $name)) {
        return;
    }

    $sql = "insert into products(name, cost, description, image) values (:name, :cost, :description, :image)";
    $statement = $pdo->prepare($sql);
    $statement->bindValue(":name", $name);
    $statement->bindValue(":cost", $cost);
    $statement->bindValue(":description", $description);
    $statement->bindValue(":image", $image);

    $statement->execute();
}

function productExists($pdo, $name) {
    $sql = "select * from products where name=:name";
    $statement = $pdo->prepare($sql);
    $statement->bindValue(":name", $name);
    $statement->execute();

    if($statement->rowCount() > 0 ) {
        return True;
    } else {
        return False;
    }
}

function test() {
    $pdo = DBConnect();
    try {

        echo("<h2>product by name('Logitech M510 mouse')</h2>");
        $product = getProductByName($pdo, "Logitech M510 mouse");
        echo($product);

        echo("<h2>list</h2>");
        listProducts($pdo);

        echo("<h2>productExists</h2>");
        productExists($pdo, "Ballcap Hat");
        productExists($pdo, "fake");

        echo("<h2>addProduct</h2><br>");
        addProduct($pdo, "test", 2.99, "description", "https://images-na.ssl-images-amazon.com/images/I/41GjoODyC0L._AC_US160_.jpg");

    } catch (PDOException $e) {
        die( $e->getMessage() );
    }

    print("done");
    $pdo = null;
}

test();

/*create table

    create table products(
        id int not null auto_increment,
        cost decimal(18, 2) not null,
        name varchar(128),
        image varchar(256),
        description text,

        primary key(id)
    );

insert products:
    insert into products(name, cost, description, image) values ("Logitech M510 mouse", 19.99, "Basic wireless mouse", "https://images-na.ssl-images-amazon.com/images/I/41GjoODyC0L._AC_US160_.jpg");
    insert into products(name, cost, description, image) values ("Ballcap Hat", 6.95, "Plain without logo.", "https://images-na.ssl-images-amazon.com/images/I/41sy4v0RaoL._AC_US200_.jpg");

*/

?>