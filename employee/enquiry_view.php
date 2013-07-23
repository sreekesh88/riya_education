<?php
include ("../include/config.php");
$enqID = $_GET['id'];
?>
<style>
body {
	background-color: #eee;
	font-family: "sans-serif", Arial, Helvetica;
	font-size: 12px;
	color: #333;
	line-height: 20px;
}
h4 {
	background-color: #1882A8;
	padding: 5px;
	color: #fff;
}
h5 {
	font-weight: normal;
	font: "sans-serif", Arial, Helvetica;
	font-size: 12px;
}
.button {
	background-color: #1882A8;
	border: 1px solid #1882A8;
	font-size: 11px;
	font-weight: normal;
	color: #fff;
	padding: 5px 20px;	
}

.button:hover {
	background-color: #D8A039;
	border: 1px solid #D8A039;
	cursor: pointer;
}
</style>

<?php
$enquiry = mysql_query("SELECT * FROM `enquiries` WHERE enqID = '$enqID'");
while($row = mysql_fetch_array($enquiry)) {
	$empID = $row['empID'];
	 $employees = mysql_query("SELECT fname,lname FROM `employees` WHERE empID = '$empID'");
     $res1 = mysql_fetch_array($employees);
	 $forward_by = $res1['fname'].' '.$res1['lname'];
	$allocatedStaff = $row['allocatedStaff'];
	 $alloc_emps = mysql_query("SELECT fname,lname FROM `employees` WHERE empID = '$allocatedStaff'");
     $res2 = mysql_fetch_array($alloc_emps);
	 $alloc_to = $res2['fname'].' '.$res2['lname'];
	$student = $row['studName'];
	$contact = $row['contact'];
	$level = $row['level'];
	$bScore = $row['bScore'];
	$conID = $row['country'];
	 $countries = mysql_query("SELECT * FROM `countries` WHERE conID = '$conID'");
     $ary = mysql_fetch_array($countries);
	 $country = $ary['country'];
	$program = $row['program'];
	if($row['class'] == '1') { $class = "10th"; }
	else if($row['class'] == '2') { $class = "12th"; }
	else { $class = ""; }
	$marks = $row['marks'];
	$remarks = $row['remarks'];
}
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="18%" height="30">Forwarded by</td>
    <td width="2%">:</td>
    <td width="30%" class="green"><?php echo $forward_by; ?></td>
    <td width="18%">Allocated to</td>
    <td width="2%">:</td>
    <td width="30%" class="green"><?php echo $alloc_to; ?></td>
  </tr>
  <tr>
    <td width="18%" height="30">Student</td>
    <td width="2%">:</td>
    <td width="30%" class="red"><?php echo $student; ?></td>
    <td width="18%">Contact</td>
    <td width="2%">:</td>
    <td width="30%" class="red"><?php echo $contact; ?></td>
  </tr>
  <tr>
    <td height="30">Level</td>
    <td>:</td>
    <td class="blue"><?php echo $level; ?></td>
    <td>Band Score</td>
    <td>:</td>
    <td class="blue"><?php echo $bScore; ?></td>
  </tr>
  <tr>
    <td height="30">Country</td>
    <td>:</td>
    <td class="blue"><?php echo $country; ?></td>
    <td>Program</td>
    <td>:</td>
    <td class="blue"><?php echo $program; ?></td>
  </tr>
  <?php if($class != '') { ?>
  <tr>
    <td height="30">Class chosen</td>
    <td>:</td>
    <td class="blue"><?php echo $class; ?></td>
    <td>% in English</td>
    <td>:</td>
    <td class="blue"><?php echo $marks; ?></td>
  </tr>
  <?php } ?>
  <tr>
    <td height="30">Remarks</td>
    <td>:</td>
    <td colspan="4" class="blue"><?php echo $remarks; ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="4">&nbsp;</td>
  </tr>
</table>

