<?php

require_once('common.php');

tryStartSession();

unset($_SESSION['valid_user']);
session_destroy();

redirect("login.php");

?>
