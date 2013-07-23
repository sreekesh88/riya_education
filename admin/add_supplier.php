<?php include ("../include/header.php"); 
include ("../include/validate.php"); 
include ("../include/menu.php"); ?>


<?php
if(isset($_POST['submit'])) {

	$supplier = $_POST['supplier'];
	$conPerson = $_POST['conPerson'];
	$conNumber = $_POST['conNumber'];
	$email = $_POST['email'];
	$chatID = $_POST['chatID'];
	$addr1 = $_POST['addr1'];
	$addr2 = $_POST['addr2'];
	$addr3 = $_POST['addr3'];
	
	if($supplier != '') {
		$qry = mysql_query("INSERT INTO `suppliers` (`supplier`, `conPerson`, `conNumber`, `email`, `chatID`, `addr1`, `addr2`, `addr3`) VALUES ('$supplier', '$conPerson', '$conNumber', '$email', '$chatID', '$addr1', '$addr2', '$addr3')");
		if($qry>0) {
			$success = "Supplier has been added succesfully";
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
<h2>Add Supplier</h2>
<br />
<form action="" method="post" enctype="multipart/form-data" name="form">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="27%" height="30">Supplier Name</td>
    <td width="2%">:</td>
    <td width="71%"><input type="text" name="supplier" id="supplier" class="textbox width_200"/></td>
  </tr>
  <tr>
    <td height="30">Contact Person</td>
    <td>:</td>
    <td><input type="text" name="conPerson" id="conPerson" class="textbox width_200" /></td>
  </tr>
  <tr>
    <td height="30">Contact Number</td>
    <td>:</td>
    <td><input type="text" name="conNumber" id="conNumber" class="textbox width_200" /></td>
  </tr>
  <tr>
    <td height="30">Email Id</td>
    <td>:</td>
    <td><input type="text" name="email" id="email" class="textbox width_200" /></td>
  </tr>
  <tr>
    <td height="30">Skype/Chat Id</td>
    <td>:</td>
    <td><input type="text" name="chatID" id="chatID" class="textbox width_200" /></td>
  </tr>
  <tr>
    <td height="30" valign="top">Address</td>
    <td valign="top">:</td>
    <td valign="top">
    <div class="addressBox">
    <input type="text" name="addr1" id="addr1" class="addrInput"/>
    <input type="text" name="addr2" id="addr2" class="addrInput"/>
    <input type="text" name="addr3" id="addr3" class="addrInput"/>
    </div>    </td>
  </tr>
  <tr>
    <td height="60" colspan="3"><h6>Services Offered</h6></td>
    </tr>
  <tr>
    <td height="30" valign="top">Country/College/Universities</td>
    <td valign="top">&nbsp;</td>
    <td valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
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
