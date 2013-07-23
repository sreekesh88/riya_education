<?php include ("../include/header.php"); 
include ("../include/validate.php"); 
include ("../include/menu.php"); ?>


<?php
if(isset($_POST['submit'])) {

	$conID = $_POST['country'];
	$instn = $_POST['instn'];
	$insType = $_POST['insType']; 
	
	if($instn != '') {
		$qry = mysql_query("INSERT INTO `institutions` (`conID`, `institution`, `insType`) VALUES ('$conID', '$instn', '$insType')");
		if($qry>0) {
			$success = "Institution has been added succesfully";
			//echo '<META HTTP-EQUIV=Refresh CONTENT="3; URL=add_institution.php">';
			?>    
			<script language='javascript'>
            setTimeout("$('#success').fadeOut('slow')", 3000);
            </script>
            <?php
		} 
	}

}
?>

<div id="wrapper_top"></div>
<div id="wrapper">
<?php include("../include/left.php"); ?>
<div class="main_col dotted_border">
<h2>Institutions</h2>
<br />
<form action="" method="post" enctype="multipart/form-data" name="form">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="27%" height="40">Select Country</td>
    <td width="2%">:</td>
    <td width="71%">
    <select name="country" id="country" class="dropdown">
    <option value="" selected="selected" class="padding_2">Select</option>
    <?php
	$con = mysql_query("SELECT * FROM `countries` WHERE delStatus = '0'");
	while($row = mysql_fetch_array($con)) {
		echo '<option value="'.$row['conID'].'" class="padding_2"';
		if($row['conID'] == $conID)
		echo 'selected="selected"';
		echo '>'.$row['country'].'</option>';
	}
	?>
    </select>    </td>
  </tr>
  <tr>
    <td height="40">Institution Type</td>
    <td>:</td>
    <td>
    <?php
	if($insType == '1') { $checked1 = 'checked="checked"'; }
	else if($insType == '2') { $checked2 = 'checked="checked"'; }
	else if($insType == '3') { $checked3 = 'checked="checked"'; }
	?>
      <input type="radio" name="insType" id="insType1" value="1" <?php echo $checked1; ?> /> University &nbsp; 
      <input type="radio" name="insType" id="insType2" value="2" <?php echo $checked2; ?> /> College &nbsp;
      <input type="radio" name="insType" id="insType3" value="3" <?php echo $checked3; ?> /> Institute</td>
  </tr>
  <tr>
    <td height="40">Institution Name</td>
    <td>:</td>
    <td><input type="text" name="instn" id="instn" class="textbox width_200" /></td>
  </tr>
  <tr>
    <td height="40">&nbsp;</td>
    <td>&nbsp;</td>
    <td><input type="submit" name="submit" id="submit" value="Submit" class="button width_200"/> 
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
