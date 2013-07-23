<?php
include("../include/config.php");
$svdID = $_POST['reason_id'];
$reason = mysql_real_escape_string($_POST['comment']);
if($reason != '') {
$query = mysql_query("UPDATE `stud_visa_docs` SET `reason` = '$reason' WHERE svdID = '$svdID'");
}
?>
