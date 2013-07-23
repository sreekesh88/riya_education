<?php 
include ("../include/validate.php"); 
include("../include/config.php");
error_reporting(0);
if(COOKIE_TYPE == "admin") $user_table = "admin";
elseif(COOKIE_TYPE == "employee")	$user_table = "employees";
$username = $_COOKIE[COOKIE_NAME];
$pass = $_COOKIE[COOKIE_PASS];
$check = mysql_query("SELECT * FROM ".$user_table." WHERE username = '$username'");
$info = mysql_fetch_array( $check );
$empID = $info['empID'];
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table">
  <tr>
    <th width="5%">No</th>
    <th width="10%">Reg. No.</th>
    <th width="25%" align="left" class="left_10">Name of the Student</th>
    <th width="30%" align="left" class="left_10">Program</th>
    <th width="15%">Country</th>
    <th width="15%" rowspan="1">Actions</th>
  </tr>
  <?php
  $counter = 1;
  $sql = "SELECT * FROM `students` WHERE empID = '$empID' AND delStatus = '0'";
 
  if(isset($_POST)){
  	if(!empty($_POST['reg_no'])){
  		$sql .= ' AND regNo LIKE "%'.$_POST['reg_no'].'%"';
  	}
  	if(!empty($_POST['name'])){
  		$sql .= ' AND (fname LIKE "%'.$_POST['name'].'%" OR lname LIKE "%'.$_POST['name'].'%")';
  	}
  	if(!empty($_POST['country']) && $_POST['country'] != 'all'){
  		$sql .= ' AND country = '.$_POST['country'];
  	}
  }

  $query = mysql_query($sql);
  
  if(mysql_num_rows($query) == 0){
	echo '<tr><td align="center" colspan="9" style="color:#D71616">-- No records found for current search criteria --</td></tr>';
  }
  while($array = mysql_fetch_array($query)) {
  $studID = $array['studID'];
  $qry1 = mysql_query("SELECT conCode,mobile FROM `stud_contact` WHERE studID = '$studID'");
  while($ary1 = mysql_fetch_array($qry1)) {
  $mobile = $ary1['conCode']." ".$ary1['mobile'];
  }
  
  $conID = $array['country'];
  $countries = mysql_query("SELECT * FROM `countries` WHERE conID = '$conID'");
  while($ary2 = mysql_fetch_array($countries)) {
  $country = $ary2['country'];
  }
  
  $regNo = $array['regNo'];
  $name = $array['fname']." ".$array['lname'];
  $pgmID = $array['program'];
  
  if($pgmID != '0') { 
	$subPgm = $array['program'];
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
    <td align="left" class="blue left_10"><?php echo $name; ?></td>
    <td align="left" class="left_10"><label><?php echo $program; ?></label></td>
    <td align="center"><?php echo $country; ?></td>
    <td align="center"  rowspan="1">
    <a href="student_profile.php?sid=<?php echo $array['studID']; ?>">
    <img src="../images/view.png" alt="view" title="view profile" class="blank" width="16" height="16"/></a>
    &nbsp;&nbsp;&nbsp;&nbsp;
    <a href="student_followup.php?sid=<?php echo $array['studID']; ?>">
    <img src="../images/followup.png" alt="edit" title="Follow Up" class="blank" width="16" height="16"/></a>
    &nbsp;&nbsp;&nbsp;&nbsp;
    <a href="offer_letter_request.php?sid=<?php echo $array['studID']; ?>">
    <img src="../images/request.png" alt="edit" title="Offer Letter Request" class="blank" width="19" height="16"/></a>
    </td>
  </tr>
  <?php
  }
  ?>
</table>
