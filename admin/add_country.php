<?php include ("../include/header.php"); 
include ("../include/validate.php"); 
include ("../include/menu.php"); ?>


<?php
if(isset($_POST['submit'])) {

	$country = $_POST['country'];
	
	if($country != '') {
		$qry = mysql_query("INSERT INTO `countries` (`country`) VALUES ('$country')");
		if($qry>0) {
			$success = "Country has been added succesfully";
			echo '<META HTTP-EQUIV=Refresh CONTENT="1; URL=add_country.php">';
			?>
			<script language='javascript'>
            setTimeout("$('#success').fadeOut('slow')", 1000);
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
<h2>Programs</h2>
<br />

<form action="" method="post" enctype="multipart/form-data" name="form">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="27%" height="40">Name of the Country</td>
    <td width="2%">:</td>
    <td width="71%">
    <input type="text" name="country" id="country" class="textbox width_200" tabindex="1" /></td>
  </tr>
  <tr>
    <td height="40">&nbsp;</td>
    <td>&nbsp;</td>
    <td><input type="submit" name="submit" id="submit" value="Submit" class="button width_200"/> 
	<span class="alert"><?php echo $success; ?></span></td>
  </tr>
</table>
</form>

</div> <!--end of main_col-->
</div> <!--end of wrapper-->

<?php include("../include/footer.php"); ?>

</div> <!--end of container-->
</body>
</html>
