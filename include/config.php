<?php
/*** Sets the Root Folder and Title shown on all pages ***/
define('ROOT', 'http://'.$_SERVER['HTTP_HOST'].'/reep');
define('TITLE', 'RIYA :: Education Employment Portal ::');

/*** Sets the Cookies Name, Password and Type ***/
define('COOKIE_NAME', 'C_REEP');
define('COOKIE_PASS', 'Key_C_REEP');
define('COOKIE_TYPE', basename(dirname($_SERVER['PHP_SELF'])));

/*** Database Credentials ***/
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', 'root');
define('DB', 'education');

/*** Enable Database Connection ***/
$con = mysql_connect(DB_HOST,DB_USER,DB_PASS) or die('Could not connect: '.mysql_error());
mysql_select_db(DB) or die(mysql_error());

/*** Default Date Zone ***/
date_default_timezone_set("Asia/Kolkata");
?>
