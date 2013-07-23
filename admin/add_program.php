<?php include ("../include/header.php"); 
include ("../include/validate.php"); 
include ("../include/menu.php"); ?>


<?php
if(isset($_POST['submit'])) {

	$program = $_POST['program'];
	
	if($program != '') {
		$qry = mysql_query("INSERT INTO `programs` (`program`) VALUES ('$program')");
		if($qry>0) {
			$success = "Program has been added succesfully";
			echo '<META HTTP-EQUIV=Refresh CONTENT="1; URL=add_program.php">';
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
<div class="fullWidth">
<form action="" method="post" enctype="multipart/form-data" name="form">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="27%" height="40">Name of the Program</td>
    <td width="2%">:</td>
    <td width="71%">
    <input type="text" name="program" id="program" class="textbox width_200" tabindex="1" /></td>
  </tr>
  <tr>
    <td height="40">&nbsp;</td>
    <td>&nbsp;</td>
    <td><input type="submit" name="submit" id="submit" value="Submit" class="button width_200"/> 
	<span class="alert"><?php echo $success; ?></span></td>
  </tr>
</table>
</form>
</div>
<br /><h6>Program List</h6><br />
<div class="fullWidth">
<table width="60%" border="0" cellspacing="0" cellpadding="0" class="tablegeneral">
<tr>
    <th width="10%">No</th>
    <td width="60%" align="left" bgcolor="#DDDDDD"><b>Name of the Program</b></td>
    <th width="30%">Actions</th>
</tr>
<?php
$counter = 1;	
$qry = mysql_query("SELECT * FROM `programs` WHERE delStatus = '0'");
while($rows = mysql_fetch_array($qry)) {
	$pgmID = $rows['pgmID'];
	$program = $rows['program'];
	
?>
    <tr>
    <td align="center"><?php echo $counter++; ?></td>
    <td><?php echo $program; ?></td>
    <td align="center">
    <a href="add_subprogram.php?id=<?php echo $pgmID; ?>">
    <img src="../images/add.png" alt="assign" title="Add Sub Programs" class="blank" width="16" height="16" /></a>
    &nbsp;&nbsp;&nbsp;&nbsp;
    <a href="update_program.php?id=<?php echo $insID; ?>">
    <img src="../images/edit.png" alt="edit" title="edit" class="blank" width="16" height="16" /></a>
    &nbsp;&nbsp;&nbsp;&nbsp;
    <img src="../images/delete.png" alt="delete" title="delete student" class="blank" width="16" height="16" onclick="return confirm_delete(<?php echo $insID; ?>)"/>    </td>
    </tr>
<?php } ?>
</table>
</div>
<br /><br />

</div> <!--end of main_col-->
</div> <!--end of wrapper-->

<?php include("../include/footer.php"); ?>

</div> <!--end of container-->
</body>
</html>
