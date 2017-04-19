<?php
session_start();

require_once('common.php');
?>

<html><body>
<h1>Home</h1>
<p>Hello user: <b>
<?php
    echo getUsername();
?>
</b></p>
<p>Will probably replace this file with a redirect to search_product.php</p>
</body></html>