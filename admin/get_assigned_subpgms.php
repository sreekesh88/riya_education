<?php
include ("../include/config.php");
$pgmID = $_GET['id'];
$insID = $_GET['aid'];
?>
<table width="100%">
<tr>
<td style="padding: 20px 0px;" class="blue">
<table width="100%">
<tr>
<?php 
$count = 0;
$query = mysql_query("SELECT * FROM `instn-subpgm` WHERE insID = '$insID' AND pgmID = '$pgmID '");
while($res = mysql_fetch_array($query)) {
	$spID = $res['spID'];
	$subpgms = mysql_query("SELECT subpgm FROM `subprograms` WHERE spID = '$spID'");
	$getRes = mysql_fetch_array($subpgms);
	//echo $getRes['subpgm']."<br>";
	$count++;
	echo  "<td>".$getRes['subpgm']."</td>";
	if($count==2)
	{
		echo "</tr><tr>";
		$count=0;
	}
}

?>
</tr>
</table>
</td>
</tr>
</table>
