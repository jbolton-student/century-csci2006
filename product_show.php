<?php

require_once('common.php');
require_once('db.php');

tryStartSession();
?>

<html><body>
<h1>Home</h1>
<p>user: <b>
<?php
    echo getUsername();
?>
</b></p>


<p>show all columns on one specific product ID</p>


</body></html>