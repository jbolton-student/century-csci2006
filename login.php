<?php
    session_start();
    require_once('dab.php');
    if (isset($_POST['username']) && isset($_POST['password']))
    {
        $username = $_POST['username'];
        $password = $_POST['password'];

        if( validateUser($username, $password) )
        {
            $_SESSION['valid_user'] = $username;

        }
    }
?>

<html>
<body>
<h1> Home </h1>
<?php
    if (isset($_SESSION['valid_user']))
    {
        echo 'You are logged in as: ' . $_SESSION['valid_user'] . '<br>';
        echo '<a href="logout.php"> Log out </a><br>';
    }
    else
    {

?>
    <form method="post" action="login.php">
        <table>
        <tr>
            <td>User ID: </td>
            <td><input type="text" name="username"></td>
        </tr>
        <tr>
            <td>Password: </td>
            <td><input type="password" name="password"></td>
        </tr>
        <tr><td colspan="2" align="center">
        <input type="submit" value="Log in"></td></tr>
        </table>
    </form>
<?php
    }
?>









