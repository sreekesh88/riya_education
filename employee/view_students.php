<?php include ("../include/header.php"); 
include ("../include/validate.php"); 
include ("../include/menu.php"); 
$empCode = $info['empCode'];
?>


<?php

?>

<div id="wrapper_top"></div>
<div id="wrapper">
<?php include("../include/left.php"); ?>
<div class="main_col dotted_border">
<h2>Student's List</h2>
<br />
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tablegeneral">
  <tr>
    <th width="5%">No</th>
    <th width="10%">Reg. No.</th>
    <th width="20%">Name of the Student</th>
    <th width="20%">Program</th>
    <th width="15%">Branch</th>
    <th width="15%">Employee</th>
    <th width="15%">Actions</th>
  </tr>
  <?php
  $counter = 1;
  $query = mysql_query("SELECT * FROM `students` WHERE delStatus = '0'");
  while($array = mysql_fetch_array($query)) {
  $studID = $array['studID'];
  $qry1 = mysql_query("SELECT conCode,mobile FROM `stud_contact` WHERE studID = '$studID'");
  while($ary1 = mysql_fetch_array($qry1)) {
  $mobile = $ary1['conCode']." ".$ary1['mobile'];
  }
  
  $empCode = $array['empCode'];
  $employees = mysql_query("SELECT fname,lname FROM `employees` WHERE empCode = '$empCode'");
  while($row = mysql_fetch_array($employees)) {
  	$employee = $row['fname']." ".$row['lname'];
  }
  
  $branchID = $array['branchID'];
  $branches = mysql_query("SELECT branch FROM `branches` WHERE branchID = '$branchID'"); 
  $branch_row = mysql_fetch_array($branches);
  $branch = $branch_row['branch'];
  
  $regNo = $array['regNo'];
  $name = $array['fname']." ".$array['lname'];
  $pgmID = $array['program'];
  $qry2 = mysql_query("SELECT program FROM `programs` WHERE pgmID = '$pgmID'");
  while($ary2 = mysql_fetch_array($qry2)) {
  	$program = $ary2['program'];
  }
  
  ?>
  <tr>
    <td align="center"><?php echo $counter++; ?></td>
    <td align="center"><?php echo $regNo; ?></td>
    <td align="left"><a href="view_followup.php?sid=<?php echo $studID; ?>"><?php echo $name; ?></a></td>
    <td align="left"><label><?php echo $program; ?></label></td>
    <td align="center"><?php echo $branch; ?></td>
    <td align="center"><?php echo $employee; ?></td>
    <td align="center">
    <a href="view_profile.php?sid=<?php echo $array['studID']; ?>">
    <img src="../images/view.png" alt="view" title="view profile" class="blank" width="16" height="16" /></a>
    &nbsp;&nbsp;&nbsp;&nbsp;
    <a href="update_student.php?sid=<?php echo $array['studID']; ?>">
    <img src="../images/edit.png" alt="edit" title="edit profile" class="blank" width="16" height="16" /></a>
    &nbsp;&nbsp;&nbsp;&nbsp;
    <img src="../images/delete.png" alt="delete" title="delete student" class="blank" width="16" height="16" onclick="return confirm_delete(<?php echo $array['studID']; ?>)"/>
    </td>
  </tr>
  <?php
  }
  ?>
</table>


</div>
</div>

<?php include("../include/footer.php"); ?>

</div> <!--end of container-->
</body>
</html>