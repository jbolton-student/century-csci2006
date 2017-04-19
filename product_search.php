<?php
session_start();

require_once('common.php');
require_once('db.php');

?>

<html><body>
<h1>Home</h1>
<p>user: <b>
<?php
    echo getUsername();
?>
</b></p>

<p>Form here to search</p>
<p>results here. See Products.test.php's listProducts() but modify function to compare search with form's input</p>
<p>Button for "add to Cart". See: Cart.test.php</p>

</body></html>