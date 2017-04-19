<?php

require('db.php');
require('products.class.php');

function list_products($pdo) {
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

function get_product_by_name($pdo, $name) {
    $item = null;
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

function test() {
    $pdo = DBConnect();
    try {

        echo("<h2>product by name('Logitech M510 mouse')</h2>");
        $item = get_product_by_name($pdo, "Logitech M510 mouse");
        echo($item);

        echo("<h2>list</h2>");
        list_products($pdo);

        echo("<h2>product_exists</h2>");
        product_exists($pdo, "Ballcap Hat");
        product_exists($pdo, "fake");

        echo("<h2>add_product</h2><br>");
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