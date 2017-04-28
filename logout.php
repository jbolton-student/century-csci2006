<?php
session_start();

require_once('common.php');

unset($_SESSION['valid_user']);
session_destroy();

redirect("login.php");

?>
