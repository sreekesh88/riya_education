<?php include ("../include/header.php"); 
include ("../include/validate.php"); 
include ("../include/menu.php"); 
$studID = $_GET['sid'];
$empID = $info['empID'];

$students = mysql_query("SELECT fname,lname FROM `students` WHERE studID = '$studID'");
while($ary = mysql_fetch_array($students)) {
	$name = $ary['fname'].' '.$ary['lname'];
}

?>

<div id="wrapper_top"></div>
<div id="wrapper">
<?php include("../include/left_stud.php"); ?>
<div class="main_col dotted_border">
<h2>Offer Letter Request</h2>
<br />

<?php
$offer_letters = mysql_query("SELECT * FROM `offer_letters` WHERE studID = '$studID'");
while($rows = mysql_fetch_array($offer_letters)) {
	$subPgmID = $rows['subPgmID'];
	if($subPgmID != '0') {
	 $subPgms = mysql_query("SELECT * FROM `subprograms` WHERE spID = '$subPgmID'");
	 $arr = mysql_fetch_array($subPgms);
	 $program = $arr['subpgm'];	
	} else {
	 $program = $rows['pgmOthers'];
	}
	$conID = $rows['conID'];
	$qry = mysql_query("SELECT country FROM `countries` WHERE conID = '$conID'");
	$res = mysql_fetch_array($qry);
	$country = $res['country'];
	
	$offerMode = $rows['offerMode'];
	 if($offerMode == '1') { $mode = "Conditional"; }
	 else if($offerMode == '2') { $mode = "Unconditional"; }
	
	$insID = $rows['insID'];
	 $institutions = mysql_query("SELECT * FROM `institutions` WHERE insID = '$insID'");
	 $row = mysql_fetch_array($institutions);
	 $instn = $row['institution'];
	 
	$payment = $rows['payment'];
	if($payment == '2') {
	  $amount = $rows['amount'];
	} else {
	  $amount = "Nil";
	}
	
	$assignedTo = $rows['assignedTo'];
	$assignedBy = $rows['assignedBy'];
	
	$employees = mysql_query("SELECT fname,lname FROM `employees` WHERE empID = '$assignedTo'");
		while($ary1 = mysql_fetch_array($employees)) {
		$assignedToStaff = $ary1['fname'].' '.$ary1['lname'];
	}
	$employees = mysql_query("SELECT fname,lname FROM `employees` WHERE empID = '$assignedBy'");
		while($ary2 = mysql_fetch_array($employees)) {
		$assignedByStaff = $ary2['fname'].' '.$ary2['lname'];
	}

?>

  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="35">Payment received</td>
      <td>:</td>
      <td><b><?php echo $amount; ?></b></td>
    </tr>
    <tr>
      <td width="24%" height="35">Name of the Student</td>
      <td width="2%">:</td>
      <td width="74%"><b><?php echo $name; ?></b></td>
    </tr>
    <tr>
      <td height="35">Preferred Program</td>
      <td>:</td>
      <td><b><?php echo $program; ?></b></td>
    </tr>
    <tr>
      <td height="35">Preferred Country</td>
      <td>:</td>
      <td><b><?php echo $country; ?></b></td>
    </tr>
    <tr>
      <td height="35">Mode of Offer Letter</td>
      <td>:</td>
      <td><b><?php echo $mode; ?></b></td>
    </tr>
    <tr>
      <td height="35">Institution</td>
      <td>:</td>
      <td><b><?php echo $instn; ?></b></td>
    </tr>
    <tr>
      <td height="35">Assigned by</td>
      <td>:</td>
      <td><b><?php echo $assignedByStaff; ?></b></td>
    </tr>
    <tr>
      <td height="35">Assigned to</td>
      <td>:</td>
      <td><b><?php echo $assignedToStaff; ?></b></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td height="60">
      <input name="back" type="button" value="<< Go Back" onclick="history.back(0);" class="button">
      </td>
    </tr>
  </table>
<?php } ?>

</div> <!--end of main_col-->
</div> <!--end of wrapper-->

<?php include("../include/footer.php"); ?>

</div> <!--end of container-->
</body>
</html>
