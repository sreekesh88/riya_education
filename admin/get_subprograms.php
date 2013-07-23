<?php
include ("../include/config.php");
error_reporting(0);
$pgmID = $_GET['id'];
$insID = $_GET['aid'];
$spID = array();
$query = mysql_query("SELECT * FROM `instn-subpgm` WHERE insID = '$insID' AND pgmID = '$pgmID'");
while($res = mysql_fetch_array($query)) {
	$spID[] = $res['spID'];
}

$theList = implode(",",$spID);

?>
<table width="100%">
<tr>
<?php 
$count = 0;
$query = mysql_query("SELECT * FROM `subprograms` WHERE pgmID = '$pgmID' AND spID NOT IN ($theList)");
$totalRows = mysql_num_rows($query);
if($totalRows != '') {
	while($result = mysql_fetch_assoc($query))
	{
		$count++;
		echo  "<td><input type=checkbox name ='subpgm[]' value ='".$result['spID']."'/>&nbsp;&nbsp;".$result['subpgm']."</td>";
		if($count==2)
		{
			echo "</tr><tr>";
			$count=0;
		}
	}
} else { echo "<div align='center' class='red'>Sorry, No results!</div>"; }
?>
</tr>
</table>
