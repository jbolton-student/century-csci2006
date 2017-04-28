<?php
session_start();

require_once('common.php');
require_once('header.inc.php');
?>

<html><body>
<h1>Home</h1>
<p>Hello user: <b>
<?php
    echo getUsername();
    redirect("product_search.php");
?>
</b></p>

</body></html>