<?php 
include ("../include/header.php"); 
$deptID = $_SESSION['is_user']; 

$departments = mysql_query("SELECT * FROM `departments` WHERE deptID = $deptID");
while($rows = mysql_fetch_array($departments)) {
	$department = $rows['department'];
}
include ("../include/validate.php"); 
include ("../include/menu.php"); 
$empID = $info['empID'];
?>


<script>
function enquiry_view(id) {
		$.ajax({  
		url: "enquiry_view.php?id="+id,
		success: function(data){
			$("#dialog").html(data);
		}   
	});
	
	$("#dialog").dialog(
		   {
			bgiframe: true,
			autoOpen: false,
			height: 300,
			width: 600,
			modal: true
		   }
	);
		$('#dialog').dialog('open'); 
		return false;
}
</script>

<body>

<div id="wrapper_top"></div>
<div id="wrapper">

<?php include("../include/left.php"); ?>

<div class="main_col dotted_border">
<div class="heading1" style="margin-bottom:10px;"><b>Welcome to <?php echo $department; ?> Dashboard</b></div>

<div class="fullWidth">
<?php if($deptID == '2') { ?>
<table width="300" border="0" cellspacing="0" cellpadding="0" class="table">
  <tr>
    <td bgcolor="#AFE2E2" class="padding_3 red" colspan="3">Pending Apporvals</td>
  </tr>
<?php
$counter = 1;
$pending_docs = mysql_query("SELECT DISTINCT (studID) FROM `stud_docs` WHERE uploads != '' AND verify = '0' AND delStatus = '0'");
while($row = mysql_fetch_array($pending_docs)) {
	$studIDs = $row['studID'];
	$students = mysql_query("SELECT fname,lname FROM `students` WHERE studID = '$studIDs' AND ddStatus = '1'");
	while($rows = mysql_fetch_array($students)) {
		$student = $rows['fname']." ".$rows['lname'];
	?>
      <tr>
        <td width="10%" height="25" align="center"><?php echo $counter++; ?></td>
        <td width="60%"><?php echo $student; ?></td>
        <td width="30%" align="center"><a href="dd_stud_docs.php?sid=<?php echo $studIDs; ?>">View</a></td>
      </tr>
	<?php }} ?>
</table>
<?php } else if($deptID == '1') { ?>
<table width="300" border="0" cellspacing="0" cellpadding="0" class="table">
  <tr>
    <td bgcolor="#CCC" class="padding_3 red" colspan="3">Pending Enquiries</td>
  </tr>
<?php
$counter = 1;
$enquiries = mysql_query("SELECT * FROM `enquiries` WHERE register = '0' AND allocatedStaff = '$empID' AND delStatus = '0'");
while($row = mysql_fetch_array($enquiries)) {
	$enqID = $row['enqID'];
	$student = $row['studName'];
	?>
      <tr>
        <td width="10%" height="25" align="center"><?php echo $counter++; ?></td>
        <td width="60%"><?php echo $student; ?></td>
        <td width="30%" align="center"><a href="#" onClick="enquiry_view(<?php echo $enqID; ?>)">View</a></td>
      </tr>
	<?php } ?>
</table>
<div id="dialog" title="Enquiry Details"></div>
<?php } ?>
</div>

</div>
</div>

<?php include("../include/footer.php"); ?>


</div> <!--end of container-->
</body>
</html>
