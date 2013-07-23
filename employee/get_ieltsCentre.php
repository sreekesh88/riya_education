<?php
include("../include/config.php");
$id = $_GET['id'];
?>
<?php if($id == '3') { ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="28%">
    <select name="centre" id="centre" class="dropdown" style="width:auto;">
    <option value="" selected="selected" class="padding_2">Select Centre</option>
    <?php
	$query = mysql_query("SELECT * FROM `ielts_centres`");
	while($row = mysql_fetch_array($query)) {
		echo '<option value="'.$row['centreID'].'" class="padding_2">'.$row['centreName'].'</option>';
	}
	?>
    </select></td>
    <td width="2%">&nbsp;</td>
    <td width="70%">
    <select name="referrer" id="referrer" class="dropdown" style="width:auto;">
    <option value="" selected="selected" class="padding_2">Select Referrer</option>
    <?php
	$query = mysql_query("SELECT * FROM `employees` WHERE delStatus = '0'");
	while($row = mysql_fetch_array($query)) {
		echo '<option value="'.$row['fname']." ".$row['lname'].'" class="padding_2">'.$row['fname']." ".$row['lname'].'</option>';
	}
	?>
    </select></td>
  </tr>
</table>
<?php } else { }?>
