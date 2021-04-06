<?php
session_start();

// if logged in
if (isset($_SESSION['Email'])) {
    // log out
    unset($_SESSION['Email']);
}

// whatever happens, redirect user to login.php
header("Location: login.php");
die;
?>