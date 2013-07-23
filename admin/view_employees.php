<?php include ("../include/header.php"); 
include ("../include/validate.php"); 
include ("../include/menu.php"); ?>

<div id="wrapper_top"></div>
<div id="wrapper">

<?php include("../include/left.php"); ?>

<div class="main_col dotted_border">
<h2>Employee List</h2>
<br />

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tablegeneral">
<tr>
    <th width="5%">No</th>
    <th width="25%">Name of the Employee</th>
    <th width="20%">Branch</th>
    <th width="20%">Department</th>
    <th width="20%">Designation</th>
    <th width="15%">Actions</th>
</tr>

<?php
$counter = 1;
$query = mysql_query("SELECT * FROM `employees` WHERE holdStatus = '0' AND delStatus = '0'");
while($rows = mysql_fetch_array($query)) {
	$empID = $rows['empID'];
	$name = $rows['fname']." ".$rows['lname'];
	$mobile = $rows['conCode']." ".$rows['mobile'];
	
	$branchID = $rows['branchID'];
	$qry1 = mysql_query("SELECT branch FROM `branches` WHERE branchID = '$branchID'");
	$row1 = mysql_fetch_array($qry1);
	$branch = $row1['branch'];
	
	$deptID = $rows['deptID'];
	$qry2 = mysql_query("SELECT department FROM `departments` WHERE deptID = '$deptID'");
	$row2 = mysql_fetch_array($qry2);
	$department = $row2['department'];
	
	$desig = $rows['designation'];

?>
<tr>
	<td align="center"><?php echo $counter++; ?></td>
    <td align="left"><?php echo $name; ?></td>
    <td align="center"><?php echo $branch; ?></td>
    <td align="center"><?php echo $department; ?></td>
    <td align="center"><?php echo $desig; ?></td>
    <td align="center">
    <a href="update_employee.php?id=<?php echo $empID; ?>">
    <img src="../images/edit.png" alt="edit" title="edit" class="blank" width="16" height="16" /></a>
    &nbsp;&nbsp;&nbsp;&nbsp;
    <img src="../images/delete.png" alt="delete" title="delete" class="blank" width="16" height="16" onclick="return confirm_delete(<?php echo $empID; ?>)"/>
    </td>
</tr>  
<?php } ?>  
  
</table>

</div>
</div>

<?php include("../include/footer.php"); ?>

</div> <!--end of container-->
</body>
</html>
