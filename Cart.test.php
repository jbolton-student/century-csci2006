<?php

require_once('Products.class.php');
require_once('Cart.class.php');
require_once('common.php');

tryStartSession();

// handle_events();

// if non-existing, create instance.
initCart();
$cart = getCart();
// $product = getProductByID(1);
// // can add either using Product() instance
// // or by the ID number alone.
// $cart->addItem($product);
// $cart->addItem(getProductByID(2));
// $cart->addItem(getProductByID(2));

handleSubmit();

$_SESSION['Cart'] = $cart; // maybe redundant;


    echo "<a href='" . $_SERVER['PHP_SELF'] . "?action=empty'>Empty Cart</a>";
    echo "<br><a href='" . $_SERVER['PHP_SELF'] . "?add=1'>Buy ID=1</a>";
    echo "<br><a href='" . $_SERVER['PHP_SELF'] . "?add=2'>Buy ID=2</a>";

    echo("<br>Total: $" . $cart->getSubtotal());
    echo(" Count: " . $cart->count());


    echo("<h1>listing</h1>");
    foreach($cart->getItems() as $item) {
        $link = " <a href='" . $_SERVER['PHP_SELF'] . "?remove=" . $item->getID() . "'>remove item</a>";
        echo "<br>Item: " . $item->getName() . $link;
    }

    echo "<pre>";
    print_r($cart->getItems());
    echo "</pre>";

// $cart->printCart();

function handleSubmit() {
    $cart = getCart();

    // if ?action=empty
    // then delete all $cart->items
    if(isset($_GET['action'])) {
        if($_GET['action'] == "empty") {
            $cart->clear();
        }
    }

    // if ?remove=id
    // then remove one item with id=id
    if(isset($_GET['remove'])) {
        $id = $_GET['remove'];
        $cart->removeItem($id);
    }

    // if ?add=id
    if(isset($_GET['add'])) {
        $id = $_GET['add'];
        $product = getProductByID($id);
        if($product)
            $cart->addItem($product);
    }

}


?>