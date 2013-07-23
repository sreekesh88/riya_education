<?php
include ("../include/config.php");
$studID = $_GET['id'];
?>
<style>
body {
	background-color: #eee;
	font-family: "sans-serif", Arial, Helvetica;
	font-size: 12px;
	color: #333;
	line-height: 20px;
}
h4 {
	background-color: #1882A8;
	padding: 5px;
	color: #fff;
}
h5 {
	font-weight: normal;
	font: "sans-serif", Arial, Helvetica;
	font-size: 12px;
}
.button {
	background-color: #1882A8;
	border: 1px solid #1882A8;
	font-size: 11px;
	font-weight: normal;
	color: #fff;
	padding: 5px 20px;	
}

.button:hover {
	background-color: #D8A039;
	border: 1px solid #D8A039;
	cursor: pointer;
}
</style>

<?php
if(isset($_POST['submit'])) {
	$status = $_POST['status'];
	
	$query = mysql_query("UPDATE `students` SET convertStatus = '$status' WHERE studID = '$studID'");
}
?>

<script>
window.onunload = function()
{
	window.opener.location.reload();
	window.close();
};
</script>
<form action="" method="post" enctype="multipart/form-data" name="form">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="25" colspan="3"><h4>Status change</h4></td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td height="30"><h5><b>Change status to</b></h5></td>
    <td><h5>:</h5></td>
    <td><h5>
    <input name="status" type="radio" value="1"> Positive
    <input name="status" type="radio" value="2"> Negative
    <input name="status" type="radio" value="0"> No change </h5>  </td>
  </tr>
  <tr>
    <td height="50">&nbsp;</td>
    <td>&nbsp;</td>
    <td><input name="submit" type="submit" value="Apply" class="button"></td>
  </tr>
</table>
</form>
