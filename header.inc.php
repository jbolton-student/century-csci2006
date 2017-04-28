<?php
require_once('common.php');
?>
<style>#header {
    background-color: lightgray;
}

a, a:visited {
    color: blue;

}
a:hover {
    color:darkblue;
}
</style>
<div id="header">
    Hello: <?php echo getUsername(); ?>
    <?php if(isLoggedIn()) {
        echo("<a href='logout.php'>Logout</a>");
    } else {
        echo("<a href='login.php'>Login</a>");
    }
    ?>

</div>
