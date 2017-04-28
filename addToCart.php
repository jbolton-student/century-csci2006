<?php


require_once('Products.class.php');
require_once('Cart.class.php');

session_start();
// if non-existing, create instance.
initCart();
handleSubmit();

function handleSubmit() {
    $cart = getCart();

    // if ?add=id
    if(isset($_GET['add'])) {
        $id = $_GET['add'];
        $cart->addItem(getProductByID($id));
        $_SESSION['Cart'] = $cart; // maybe redundant;
    }

}


?>