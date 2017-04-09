<?php

require('db.php');
require('products.class.php');

function list_products($pdo) {
    // using classes
    $sql = "select * from products";
    $statement = $pdo->prepare($sql);
    $statement->execute();

    // todo: Not sure how to iterate all items if using classes, only when  using associative array
    $p = new Product($statement->fetch());
    print($p);
}

function add_product($pdo, $name, $cost, $image, $description) {
    if(product_exists($pdo, $name)) {
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

function product_exists($pdo, $name) {
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
    $pdo = db_connect();
    try {
        list_products($pdo);

        product_exists($pdo, "Ballcap Hat");
        product_exists($pdo, "fake");

        add_product($pdo, "test", 2.99, "description", "https://images-na.ssl-images-amazon.com/images/I/41GjoODyC0L._AC_US160_.jpg");

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