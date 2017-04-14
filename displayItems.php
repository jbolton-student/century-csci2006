<?php

require_once('Item.class.php');
require_once('Cart.class.php');

session_start();

if (isset($_SESSION['shoppingCart'])) {
    $cart = $_SESSION['shoppingCart'];

    $items = $cart->getItems();

    foreach ($items as $item) {
        echo $item->__toString() . "<br>";
    }

    echo "Total: " . $cart->getSubtotal() . " <br>";
}




?>
