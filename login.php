<?php
session_start();

require_once('db.php');
require_once('common.php');
require_once('header.inc.php');

$error = false;
loginUser();

if(isLoggedIn()) {
    redirect("home.php");
} else {
    if(isset($_POST['email'])
        || isset($_POST['password'])
    ) {
        $error = true;
    }
}

// otherwise show login form

?>

<html>
<body>
<h1> Login Page </h1>
<?php

if($error) echo "<p>Error: Bad email or password</p>";

?>
    <form method="post" action="login.php">
        <table>
        <tr>
            <td>Email: </td>
            <td><input type="text" name="email"></td>
        </tr>
        <tr>
            <td>Password: </td>
            <td><input type="password" name="password"></td>
        </tr>
        <tr><td colspan="2" align="center">
        <input type="submit" value="Log in"></td></tr>
        </table>
    </form>
</body></html>
