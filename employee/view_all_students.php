<?php include ("../include/header.php"); 
include ("../include/validate.php"); 
include ("../include/menu.php"); 
$empID = $info['empID'];
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
  
  $empID = $array['empID'];
  $employees = mysql_query("SELECT fname,lname FROM `employees` WHERE empID = '$empID'");
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
  if($pgmID != '0') {
	$subPgm = $array['subProgram'];
	$subPgms = mysql_query("SELECT * FROM `subprograms` WHERE spID = '$subPgm'");
	$arr = mysql_fetch_array($subPgms);
	$program = $arr['subpgm'];
  } else {
  	$program = $array['pgmOthers'];
  }
  ?>
  <tr>
    <td align="center"><?php echo $counter++; ?></td>
    <td align="center"><?php echo $regNo; ?></td>
    <td align="left" class="blue"><?php echo $name; ?></td>
    <td align="left"><label><?php echo $program; ?></label></td>
    <td align="center"><?php echo $branch; ?></td>
    <td align="center"><?php echo $employee; ?></td>
    <td align="center">
    <a href="student_profile.php?sid=<?php echo $array['studID']; ?>">
    <img src="../images/view.png" alt="view" title="view profile" class="blank" width="16" height="16" /></a>
    &nbsp;&nbsp;&nbsp;&nbsp;
    <a href="student_followup.php?sid=<?php echo $array['studID']; ?>">
    <img src="../images/followup.png" alt="edit" title="Follow Up" class="blank" width="16" height="16" /></a>
    &nbsp;&nbsp;&nbsp;&nbsp;
    <a href="offer_letter_request.php?sid=<?php echo $array['studID']; ?>">
    <img src="../images/request.png" alt="edit" title="Offer Letter Request" class="blank" width="19" height="16" /></a>
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