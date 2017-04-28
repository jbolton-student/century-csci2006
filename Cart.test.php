<?php
session_start();

require_once('Products.class.php');
require_once('Cart.class.php');

// $cart;

// debug: enable to always delete cart for testing
if(isset($_SESSION['Cart'])) {
    unset($_SESSION["Cart"]);
}

// if non-existing, create instance.
initCart();

$cart = getCart();
$product = getProductByID(1);

// can add either using Product() instance
// or by the ID number alone.
$cart->addItem($product);
$cart->addItem(getProductByID(2));
$cart->addItem(getProductByID(2));
$cart->addItem(getProductByID(2));

echo("<h1>listing</h1>");
$cart->printCart();

$_SESSION['Cart'] = $cart; // maybe redundant;

?>



