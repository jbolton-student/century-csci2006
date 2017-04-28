<?php
session_start();

require_once('common.php');
require_once('db.php');
require_once('header.inc.php');

?>

<html><body>
<h1>Home</h1>
<p>user: <b>
<?php
    echo getUsername();
?>
</b></p>


<p>Form here to search</p>
<p>results here. See Products.test.listProducts but modify function to compare search with form's input</p>

</body></html>


<?php

// something like:


require_once('Item.class.php');
require_once('Cart.class.php');


if (isset($_SESSION['shoppingCart'])) {
    $cart = $_SESSION['shoppingCart'];

    $items = $cart->getItems();

    foreach ($items as $item) {
        echo $item->__toString() . "<br>";
    }

    echo "Total: " . $cart->getSubtotal() . " <br>";
}

?>