<?php include ("../include/header.php"); 
include ("../include/validate.php"); 
include ("../include/menu.php"); 
$pgmID = $_GET['id'];
$qry = mysql_query("SELECT * FROM `programs` WHERE pgmID = '$pgmID'");
while($rows = mysql_fetch_array($qry)) {
	$program = $rows['program'];
}
?>


<?php
if(isset($_POST['submit'])) {

	$subpgm = $_POST['subpgm'];
	
	if($subpgm != '') {
		$qry = mysql_query("INSERT INTO `subprograms` (`pgmID`, `subpgm`) VALUES ('$pgmID', '$subpgm')");
		if($qry>0) {
			$success = "Sub Program has been added succesfully";
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
<h2>Add Sub Programs/Specialization for <?php echo $program; ?></h2>
<br />
<form action="" method="post" enctype="multipart/form-data" name="form">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="27%" valign="top"><strong>Already assigned sub-programs</strong></td>
    <td width="2%" valign="top">&nbsp;</td>
    <td width="71%" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" valign="top" class="green" style="padding:10px 20px;">
        <table width="100%">
        <tr>
        <?php 
        $count = 0;
        $subpgms = mysql_query("SELECT * FROM `subprograms` WHERE pgmID = '$pgmID' ORDER BY subpgm ASC");
		$total_rows = mysql_num_rows($subpgms);
		if($total_rows > 0) {
			while($rows = mysql_fetch_array($subpgms))
			{
				$count++;
				echo "<td>".$rows['subpgm']."</td>";
				if($count==2)
				{
					echo "</tr><tr>";
					$count=0;
				}
			}
		} else {
			echo "<td class='red'>No sub-programs assigned!!!</td>";
		}
        ?>
        </tr>
        </table>    </td>
    </tr>
  <tr>
    <td height="40" valign="top"><strong>Specialization</strong></td>
    <td valign="top">:</td>
    <td valign="top"><input type="text" name="subpgm" id="subpgm" class="textbox width_200" /></td>
  </tr>
  <tr>
    <td height="40" valign="top">&nbsp;</td>
    <td valign="top">&nbsp;</td>
    <td valign="top">
    <table width="300" border="0" cellspacing="0" cellpadding="0" class="pad">
      <tr>
        <td><input name="level" type="radio" value="1" /> Diploma</td>
        <td><input name="level" type="radio" value="2" /> Under-Graduate</td>
      </tr>
      <tr>
        <td><input name="level" type="radio" value="3" /> Post-Graduate</td>
        <td><input name="level" type="radio" value="4" /> Teaching</td>
      </tr>
    </table></td>
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
