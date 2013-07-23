<?php
include("../include/config.php");
$id = $_GET['id'];
if($id == '0') {
?>
<input name="pgmOthers" id="pgmOthers" type="text" class="textbox width_200"/>
<?php } else { ?>
<select name="subPgm" id="subPgm" class="dropdown">
<?php
	echo '<option value="" selected="selected" class="padding_2">Select</option>';
    $qry = mysql_query("SELECT * FROM `subprograms` WHERE pgmID = '$id' AND delStatus = '0'");
	while($arr = mysql_fetch_array($qry)) {
	echo '<option value="'.$arr['spID'].'" class="padding_2">'.$arr['subpgm'].'</option>';
	}
?>
</select>
<?php } ?>