<?php
include("../include/config.php");
$id = $_GET['id'];
?>
<?php if($id == '2') { ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="28%" height="50">Select Supplier</td>
    <td width="2%">:</td>
    <td width="70%" class="blue">
    <select name="suppID" id="suppID" class="dropdown">
     <option value="" selected="selected">Select</option>
     <?php
	$query = mysql_query("SELECT * FROM `suppliers` WHERE delStatus = '0'");
	while($row = mysql_fetch_array($query)) {
		echo '<option value="'.$row['suppID'].'" class="padding_2">'.$row['supplier'].'</option>';
	}
	?>
    </select>
    </td>
  </tr>
  <tr>
    <td height="30">Assign to Employee</td>
    <td>:</td>
    <td>
    <select name="assignEmpID" id="assignEmpID" class="dropdown">
     <option value="" selected="selected" class="padding_2">Select</option>
    <?php
	$query = mysql_query("SELECT * FROM `employees` WHERE delStatus = '0'");
	while($row = mysql_fetch_array($query)) {
		echo '<option value="'.$row['empID'].'" class="padding_2">'.$row['fname']." ".$row['lname'].'</option>';
	}
	?>
    </select>
    </td>
  </tr>
</table>
<?php } else { ?>

<?php } ?>