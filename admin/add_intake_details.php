<?php 
include("../include/config.php");
$isID = $_POST['instn_id']; 
$intake = $_POST['intake']; 
$fees = $_POST['fees']; 

if($isID != '') {	
	$proDetails = mysql_query("INSERT INTO `proDetails` (`isID`, `intake`, `fees`) VALUES ('$isID', '$intake', '$fees')");
}
?>
