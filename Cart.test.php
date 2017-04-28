<?php
session_start();

require_once('Products.class.php');
require_once('Cart.class.php');

$cart;

// todo: debug remove
if(isset($_SESSION['Cart'])) {
    unset($_SESSION["Cart"]);
}

if(!isset($_SESSION['Cart'])) {
    $_SESSION['Cart'] = new Cart();
}

$cart = $_SESSION['Cart'];
$product = getProductByID(1);
// echo $product;
$cart->addItem($product);
$cart->addItem(getProductByID(2));

echo("<h1>listing</h1>");
$cart->printCart();

$_SESSION['Cart'] = $cart; // maybe redundant;


//update shopping cart
// $_SESSION['Cart'] = $cart;

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

// function getCart() {}

// function printCart() {
//     echo "<h1>cart items:</h1>";

//     if (isset($_SESSION['Cart'])) {
//         $cart = $_SESSION['Cart'];

//         $items = $cart->getItems();

//         foreach ($items as $item) {
//             echo $item->__toString() . "<br>";
//         }

//         echo "Total: " . $cart->getSubtotal() . " <br>";
//     }
// }

?>



