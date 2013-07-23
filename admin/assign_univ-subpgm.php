<?php include ("../include/header.php"); 
include ("../include/validate.php"); 
include ("../include/menu.php"); 
$insID = $_GET['id'];
$query = mysql_query("SELECT * FROM `institutions` WHERE insID = '$insID'");
while($rows = mysql_fetch_array($query)) {
	$instn = $rows['institution'];
}
?>
<script>
$(document).ready(function(){

	function getParam(name) {
		name = name.replace(/[\[]/, "\\\[").replace(/[\]]/, "\\\]");
		var regexS = "[\\?&]" + name + "=([^&#]*)";
		var regex = new RegExp(regexS);
		var results = regex.exec(window.location.href);
		if (results == null)
			return "";
		else
			return results[1];
	}
	 
	var aid = getParam('id'); //assign ID
	//alert(aid);
	$("#program").change(function(){
		var id=$("#program").val();
		$("#subProgram").load("get_subprograms.php?id="+id+"&aid="+aid);
		$("#assigned").load("get_assigned_subpgms.php?id="+id+"&aid="+aid);
	});
		
});

$(document).on('click','.up',function(){ 
	$('#assigned').toggle( "blind", 1000 );  
});


</script>

<?php
if(isset($_POST['submit'])) {
	
	$pgmID = $_POST['program'];
	
	$s = isset($_POST['subpgm']) ? $_POST['subpgm'] : "";
		if(empty($s))
		$success = "No sub-programs selected";
		else
		{
			$N = count($s);
			for($i=0; $i < $N; $i++)
			{
			  $qry2 = mysql_query("INSERT INTO `instn-subpgm` (`insID`, `pgmID`, `spID`) VALUES ('$insID', '$pgmID' ,'$s[$i]')");
			}
			if($qry2>0) {
			$success = "You have assigned $N sub-program(s)";
			?>    
			<script language='javascript'>
            //setTimeout("$('#success').fadeOut('slow')", 3000);
			setTimeout(function() { window.close(); }, 1000);
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
<h2>Assign Sub-Programs to <?php echo $instn; ?></h2>
<br />

<form action="" method="post" enctype="multipart/form-data" name="form">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="27%" height="40" valign="top"><b>Programs</b></td>
    <td width="2%" valign="top"><b>:</b></td>
    <td width="71%" valign="top">
    <select name="program" id="program" class="dropdown">
    <option value="" selected="selected" class="padding_2">Select</option>
    <?php
	$qry = mysql_query("SELECT * FROM `programs` ORDER BY program ASC");
	while($res = mysql_fetch_assoc($qry)) {
		echo '<option value="'.$res['pgmID'].'" class="padding_2">'.$res['program'].'</option>';
	}
	?></select>    </td>
  </tr>
  <tr>
    <td colspan="3" valign="top">
    <h6>Sub-Programs already assigned<span class="up link" style="float:right;"><a href="#">Show/Hide</a>&nbsp;</span></h6>
    </td>
    </tr>
  <tr>
    <td height="20" colspan="3" valign="top"><div id="assigned"></div></td>
    </tr>
  <tr>
    <td height="40" colspan="3" valign="top"><h6>List of Sub-Programs</h6></td>
    </tr>
  <tr>
    <td height="40" colspan="3" valign="top"><div id="subProgram"></div></td>
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
