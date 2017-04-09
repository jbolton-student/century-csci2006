<?php

require('db.php');
require('products.class.php');

function list_products($pdo) {
    // using classes
    $sql = "select * from products";
    $statement = $pdo->prepare($sql);
    $statement->execute();

    // todo: Not sure how to iterate all items if using classes
    $p = new Product($statement->fetch());
    print($p);
}

function add_product($pdo, $name, $cost, $image, $description) {

}

function product_exists($pdo, $name) {

}

function list_products_manual($pdo) {
    // manual method. Not used.
    $sql = "select * from products";
    $result = $pdo->query($sql);

    while($row = $result->fetch()) {
        print("<br>" . $row['name']);
    }
}

function test() {
    $pdo = db_connect();
    try {
        list_products($pdo);

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

// add user

// query user

?>