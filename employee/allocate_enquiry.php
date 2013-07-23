<?php
include ("../include/config.php");
$enqID = $_GET['id'];
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

.dropdown {
	border: 1px dotted #aaa;
	padding: 2px;
	width: 202px;
	color: #333;
	height: 25px;
	font-size: 11px;
}
</style>

<?php
if(isset($_POST['submit'])) {
	$allocatedStaff = $_POST['allocatedStaff'];
	$query = mysql_query("UPDATE `enquiries` SET `allocated` = '1',`allocatedStaff` = '$allocatedStaff' WHERE enqID = '$enqID'");
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
    <td height="25" colspan="3"><h4>Enquiry Allocation</h4></td>
  </tr>
  <tr>
    <td height="30"><h5><b>Allocate enquiry to</b></h5></td>
    <td><h5>:</h5></td>
    <td valign="top">
    <select name="allocatedStaff" id="allocatedStaff" class="dropdown">
    <option value="" selected="selected" class="padding_2">Select</option>
    <?php
	$employees = mysql_query("SELECT * FROM `employees` WHERE delStatus = '0'");
	while($row = mysql_fetch_array($employees)){
		echo '<option value="'.$row['empID'].'" class="padding_2">'.$row['fname'].' '.$row['lname'].'</option>';
	}
	?>
    </select>    </td>
  </tr>
  <tr>
    <td height="50">&nbsp;</td>
    <td>&nbsp;</td>
    <td><input name="submit" type="submit" value="Allocate" class="button"></td>
  </tr>
</table>
</form>
