<?php
include("../include/config.php");
$id = $_GET['id'];
?>
<select name="subPgm" id="subPgm" class="dropdown" onchange="getProgramName(this.value)">
<?php
if($id != '') {
	echo '<option value="" selected="selected" class="padding_2">Select</option>';
    $qry = mysql_query("SELECT * FROM `subprograms` WHERE pgmID = '$id' AND delStatus = '0'");
	while($arr = mysql_fetch_array($qry)) {
	echo '<option value="'.$arr['spID'].'" class="padding_2">'.$arr['subpgm'].'</option>';
	}

} ?>
</select>
