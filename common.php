<?php

function isLoggedIn() {
    // are you logged in?
    if(isset($_SESSION['valid_user'])) {
        return true;
    } else {
        return false;
    }
}

function getUsername() {
    // alias for current username
    if(isLoggedIn()) {
        return $_SESSION['valid_user'];
    } else {
        return "guest";
    }
}

function isAdmin() {
    if(isset($_SESSION['isAdmin'])) {
        return true;
    } else {
        return false;
    }
 }

function redirect($url) {
    // shortcut to redirecting with Location:
    header("Location: $url");
    die();
}

?>