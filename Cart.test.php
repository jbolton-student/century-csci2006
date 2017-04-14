<?php
require_once('Item.class.php');
require_once('Cart.class.php');

    todo: finish...

session_start();
$cart;

if(!isset($_SESSION['shoppingCart'])) {
    $_SESSION['shoppingCart'] = new Cart();
}

$cart = $_SESSION['shoppingCart'];
$item = new Product();

//update shopping cart
$_SESSION['shoppingCart'] = $cart;

/* from class:

$cart = $_SESSION['shoppingCart'];
$item1 = new Item("iphone" , "smart phone", 799, 2);
$cart->addItem($item1, "iphone");
echo "iphone added successfully...<br>";

$item2 = new Item("tv" , "smart tv",1229, 1);
    $cart->addItem($item2, "tv");
    echo "tv added successfully...<br>";

//update shopping cart
$_SESSION['shoppingCart'] = $cart;

*/

?>
