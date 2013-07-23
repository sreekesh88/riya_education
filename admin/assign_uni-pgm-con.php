<?php include ("../include/header.php"); 
include ("../include/validate.php"); 
include ("../include/menu.php"); 
$conID = $_GET['con'];
$insID = $_GET['id'];

$query1 = mysql_query("SELECT * FROM `countries` WHERE conID = '$conID'");
while($rows = mysql_fetch_array($query1)) {
	$country = $rows['country'];
}
$query2 = mysql_query("SELECT * FROM `institutions` WHERE insID = '$insID'");
while($rows = mysql_fetch_array($query2)) {
	$instn = $rows['institution'];
}
?>


<?php
if(isset($_POST['submit'])) {

	$s = isset($_POST['programs']) ? $_POST['programs'] : "";
		if(empty($s))
		$success = "No programs selected";
		else
		{
			$N = count($s);
			for($i=0; $i < $N; $i++)
			{
			  $qry2 = mysql_query("INSERT INTO `pgm-con-ins` (`insID`, `conID`, `pgmID`) VALUES ('$insID', '$conID' ,'$s[$i]')");
			}
			$success = "You have assigned $N program(s) to ".$country;
			?>    
			<script language='javascript'>
            setTimeout("$('#success').fadeOut('slow')", 3000);
            </script>
            <?php
		}

}
?>

<div id="wrapper_top"></div>
<div id="wrapper">
<?php include("../include/left.php"); ?>
<div class="main_col dotted_border">
<h2>Assign Programs to <?php echo $instn; ?> in <?php echo $country; ?></h2>
<br />

<form action="" method="post" enctype="multipart/form-data" name="form">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="40" valign="top"><strong>Programs already assigned</strong></td>
    <td valign="top"><strong>:</strong></td>
    <td valign="top" style="padding-bottom: 20px;" class="blue">
    <?php
	$result = mysql_query("SELECT DISTINCT pgmID FROM `instn-subpgm` WHERE insID = '$insID'");
	while($ary = mysql_fetch_array($result)) {
		$pgmID = $ary['pgmID'];
		$programs = mysql_query("SELECT * FROM `programs` WHERE pgmID = '$pgmID'");
		$ary_pgm = mysql_fetch_array($programs);
		echo $ary_pgm['program']."<br>";
	}
	?>
    </td>
  </tr>
  <tr>
    <td width="27%" height="40" valign="top"><b>List of Programs</b></td>
    <td width="2%" valign="top"><b>:</b></td>
    <td width="71%" valign="top">
    
<table width="100%">
<tr>
<?php 
$count = 0;
$query = mysql_query("SELECT * FROM `programs` ORDER BY program ASC");
while($result = mysql_fetch_assoc($query))
{
	$count++;
	echo  "<td><input type=checkbox name ='programs[]' value ='".$result['pgmID']."'/>&nbsp;&nbsp;".$result['program']."</td>";
	if($count==3)
	{
		echo "</tr><tr>";
		$count=0;
	}
}
?>
</tr>
</table>    </td>
  </tr>
  <tr>
    <td height="40">&nbsp;</td>
    <td>&nbsp;</td>
    <td height="80">
    <input type="submit" name="submit" id="submit" value="Assign" class="button"/> 
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <input type="button" onclick="history.back()" value="<< Back" class="button"/>
	<span id="success" class="alert"><?php echo $success; ?></span></td>
  </tr>
</table>
</form>

</div> <!--end of main_col-->
</div> <!--end of wrapper-->

<?php include("../include/footer.php"); ?>

</div> <!--end of container-->
</body>
</html>
