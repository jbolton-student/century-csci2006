<?php

function tryStartSession() {
    if(!isset($_SESSION))  {
        session_start();
    }
}

function getPostOrGet($key) {
    if(isset($_POST[$key]))
        return $_POST[$key];
    if(isset($_GET[$key]))
        return $_GET[$key];

    return null;
}

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