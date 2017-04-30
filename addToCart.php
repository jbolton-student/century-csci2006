<?php

require_once('Products.class.php');
require_once('Cart.class.php');
require_once('common.php');

tryStartSession();

// if non-existing, create instance.
initCart();
$cart = getCart();

handleSubmit();
$_SESSION['Cart'] = $cart; // maybe redundant;

function handleSubmit() {
    $cart = getCart();

    // if ?add=id
    if(isset($_GET['add'])) {
        $id = $_GET['add'];
        $cart->addItem(getProductByID($id));
    }

}


?>