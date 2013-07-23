<?php 
include ("../include/header.php"); 
include ("../include/validate.php"); 
include ("../include/menu.php"); 
$empID = $info['empID'];
$studID = $_GET['sid'];
?>
<?php
if(isset($_POST['submit'])) {
	$newEmpCode = $_POST['newEmpCode'];
	$newBranch = $_POST['newBranch'];
	
	$assign = mysql_query("UPDATE `students` SET `empID` = '$newEmpCode', `branchID` = '$newBranch' WHERE studID = '$studID'");
	if($assign>0) {
		$success = "The student has been aassigned to new employee succesfully";
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
<?php include("../include/left_stud.php"); ?>
<div class="main_col dotted_border">
<h2>Assign student to another Employee</h2>
<br />
<div class="fullWidth">
<form action="" method="post" enctype="multipart/form-data" name="form">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="17%" height="35">New Employee</td>
    <td width="2%">:</td>
    <td width="81%">
    <select name="newEmpCode" id="newEmpCode" class="dropdown">
    <option value="" selected="selected" class="padding_2">Select</option>
    <?php
	$res = mysql_query("SELECT * FROM `employees` WHERE delStatus = '0'");
	while($row = mysql_fetch_array($res)) {
	echo '<option value="'.$row['empID'].'" class="padding_2">'.$row['fname']." ".$row['lname'].'</option>';
	}
    ?>
    </select>
    </td>
  </tr>
  <tr>
    <td height="35">Branch</td>
    <td>:</td>
    <td>
    <select name="newBranch" id="newBranch" class="dropdown">
    <option value="" selected="selected" class="padding_2">Select</option>
    <?php
	$res = mysql_query("SELECT * FROM `branches` WHERE delStatus = '0'");
	while($arr = mysql_fetch_array($res)) {
	echo '<option value="'.$arr['branchID'].'" class="padding_2">'.$arr['branch'].'</option>';
	}
    ?>
    </select>
    </td>
  </tr>
  <tr>
    <td height="60">&nbsp;</td>
    <td>&nbsp;</td>
    <td><input type="submit" name="submit" id="submit" value="Assign" class="button width_200"/>
    &nbsp;&nbsp; <span class="alert" id="success"><?php echo $success; ?></span></td>
  </tr>
</table>
</form>

</div>

</div>
</div>

<?php include("../include/footer.php"); ?>

</div> <!--end of container-->
</body>
</html>