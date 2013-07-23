<?php include ("../include/header.php"); 
include ("../include/validate.php"); 
include ("../include/menu.php"); ?>

<script>
$(document).ready(function(){
  $("#country").change(function(){
	var id=$("#country").val();
    $("#institution").load("get_instns.php?id="+id);
  });
});
</script>

<div id="wrapper_top"></div>
<div id="wrapper">
<?php include("../include/left.php"); ?>
<div class="main_col dotted_border">
<h2>Institutions</h2>
<br />
<div class="fullWidth">
<table width="95%" border="0" cellpadding="0" cellspacing="0" class="boxShadow">
  <tr>
    <td width="24%" height="50" align="center"><strong>Select Country</strong></td>
    <td width="1%"><strong>:</strong></td>
    <td width="75%">
    <select name="country" id="country" class="dropdown">
    <option value="" selected="selected" class="padding_2">Select</option>
    <?php
	$con = mysql_query("SELECT * FROM `countries` WHERE delStatus = '0'");
	while($row = mysql_fetch_array($con)) {
		echo '<option value="'.$row['conID'].'" class="padding_2"';
		if($row['conID'] == '1')
		echo 'selected = "selected"';
		echo '>'.$row['country'].'</option>';
	}
	?>
    </select>
    </td>
  </tr>
</table>
</div>
<br />
<div id="institution">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tablegeneral">
<tr>
    <th width="8%">No</th>
    <td width="45%" align="left" bgcolor="#DDDDDD"><b>Name of the Institution</b></td>
    <th width="14%">Country</th>
    <th width="11%">Institution</th>
    <th width="22%">Actions</th>
</tr>
<?php
$counter = 1;
$qry = mysql_query("SELECT * FROM `institutions` WHERE conID = '1' AND delStatus = '0' ORDER BY institution ASC");
while($rows = mysql_fetch_array($qry)) {
	$insID = $rows['insID'];
	$instn = $rows['institution'];
	$insType = $rows['insType'];
	if($insType == '1') { $institution = "University"; }
	else if($insType == '2') { $institution = "College"; }
	else if($insType == '3') { $institution = "Institute"; }
	$conID = $rows['conID'];
	$res = mysql_query("SELECT country FROM `countries` WHERE conID = '1'");
	$row = mysql_fetch_array($res);
	$country = $row['country'];
	
?>
    <tr>
    <td align="center"><?php echo $counter++; ?></td>
    <td><a href="view_instn_details.php?id=<?php echo $insID; ?>" target="_blank"><?php echo $instn; ?></a></td>
    <td align="center"><?php echo $country; ?></td>
    <td align="center"><?php echo $institution; ?></td>
    <td align="center">
    <?php /*?><a href="assign_uni-pgm-con.php?id=<?php echo $insID; ?>&con=<?php echo $conID; ?>" target="_blank">
    <img src="../images/assign.png" alt="assign" title="Assign Programs" class="blank" width="16" height="16" /></a>
    &nbsp;&nbsp;&nbsp;&nbsp;<?php */?>
    <a href="assign_univ-subpgm.php?id=<?php echo $insID; ?>" target="_blank">
    <img src="../images/add.png" alt="assign" title="Add Sub Programs" class="blank" width="16" height="16" /></a>
    &nbsp;&nbsp;&nbsp;&nbsp;
    <a href="update_institution.php?id=<?php echo $insID; ?>">
    <img src="../images/edit.png" alt="edit" title="edit" class="blank" width="16" height="16" /></a>
    &nbsp;&nbsp;&nbsp;&nbsp;
    <img src="../images/delete.png" alt="delete" title="delete" class="blank" width="16" height="16" onclick="return confirm_delete(<?php echo $insID; ?>)"/>    </td>
    </tr>
    <?php } ?>
</table>
</div>


</div> <!--end of main_col-->
</div> <!--end of wrapper-->

<?php include("../include/footer.php"); ?>

</div> <!--end of container-->
</body>
</html>
