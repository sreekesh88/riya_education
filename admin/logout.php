<?php
require_once "../include/config.php";

$past = time() - 100; 
//this makes the time in the past to destroy the cookie 
setcookie(COOKIE_NAME, gone, $past); 
setcookie(COOKIE_PASS, gone, $past); 

session_start();
$unset = session_unset($_SESSION['logged_in']);
session_destroy();

header("Location: ".ROOT."/admin/login.php?response=1");
?>
