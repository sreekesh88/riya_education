<?php 
date_default_timezone_set("Asia/Kolkata");
include ("../include/header.php"); 
include ("../include/validate.php"); 
include ("../include/menu.php"); 
$empCode = $info['empCode'];
$studID = $_GET['sid'];

$query = mysql_query("SELECT * FROM `students` WHERE studID = '$studID'");
while($array = mysql_fetch_array($query)) {
	
	$photo = ((!empty($array['photo'])) && (file_exists("photos/".$array['photo']))) ? "photos/".$array['photo'] : "photos/default-img.png";
	$name = $array['fname']." ".$array['lname'];
	$regNo = $array['regNo'];
	$gen = $array['gender']; 
	if($gen == '1') { $gender = "Male"; } else { $gender = "Female"; }
	$dob = date("d-m-Y",strtotime($array['dob']));
	$married = $array['married']; 
	if($married == '0') { $marrStatus = "Single"; } else if($married == '1') { $marrStatus = "Married"; }
	$spName = $array['spName']; 
	$spOccupation = $array['spOccupation']; 
	$gdName = $array['gdName']; 
	$gdOccupation = $array['gdOccupation']; 
	
	$studID = $array['studID'];
	$pgmID = $array['program'];
	$subPgm = $array['subProgram'];
	 $subPgms = mysql_query("SELECT * FROM `subprograms` WHERE spID = '$subPgm'");
	 $arr = mysql_fetch_array($subPgms);
	 $subProgram = $arr['subpgm'];
	$conID = $array['country'];


$qry1 = mysql_query("SELECT * FROM `stud_contact` WHERE studID = '$studID'");
while($ary1 = mysql_fetch_array($qry1)) {
	$mobile = $ary1['conCode']." ".$ary1['mobile'];
	$phone = $ary1['areaCode']." ".$ary1['phone'];
	$email = $ary1['email'];
	$address = $ary1['addr1']."<br>".$ary1['addr2']."<br>".$ary1['addr3'];
}
	
if($pgmID != '0') {
$qry2 = mysql_query("SELECT program FROM `programs` WHERE pgmID = '$pgmID'");
	$ary2 = mysql_fetch_array($qry2);
	$program = $ary2['program'];
} else {
	$program = $array['pgmOthers'];
}
$qry3 = mysql_query("SELECT country FROM `countries` WHERE conID = '$conID'");
	$ary3 = mysql_fetch_array($qry3);
	$country = $ary3['country'];

$qry4 = mysql_query("SELECT qid,otherQlfn FROM `stud_education` WHERE studID = '$studID'");
	while($ary4 = mysql_fetch_array($qry4)) {
	$qid = $ary4['qid'];

	if($qid != '0') {
	$qry5 = mysql_query("SELECT qualification FROM `qualifications` WHERE qid = '$qid'");
		$ary5 = mysql_fetch_array($qry5);
		$hi_qlfn = $ary5['qualification'];
	} else {
		$hi_qlfn = $ary4['otherQlfn'];
	}
}
$qry6 = mysql_query("SELECT * FROM `stud_passport` WHERE studID = '$studID'");
while($ary6 = mysql_fetch_array($qry6)) {
	
	if($ary6['passNum'] != '') {
	$passNum = $ary6['passNum'];
	} else {
	$passNum = 'Nil';
	}
	
	if($ary6['expiry'] != '0000-00-00') {
	$expDate = date("d-m-Y",strtotime($ary6['expiry']));
	} else {
	$expDate = 'Nil';
	}
	
	if($ary6['visaNum'] != '') {
	$visaNum = $ary6['visaNum'];
	} else {
	$visaNum = 'Nil';
	}
	if($ary6['fromDate'] != '0000-00-00') { $fromDate = date("d-m-Y", strtotime($ary6['fromDate'])); }	
	if($ary6['toDate'] != '0000-00-00') { $toDate = date("d-m-Y", strtotime($ary6['toDate'])); }
	if($fromDate != ''){
	$duration = $fromDate." to ".$toDate;
	} else {
	$duration = 'Nil';
	}
	
	if($ary6['job'] != '') {
	$job = $ary6['job'];
	} else {
	$job = 'Nil';
	}
	
	if($ary6['expYrs'] != '0') {
	$expYrs = $ary6['expYrs']." Years";
	} else {
	$expYrs = 'Nil';
	}
}
}

$stud_others = mysql_query("SELECT * FROM `stud_others` WHERE studID = '$studID'");
while ($row = mysql_fetch_array($stud_others)) {
	
	$engTest = $row['engTest'];
	$iScore = $row['iScore'];
	$listen = $row['listen'];
	$read = $row['read'];
	$write = $row['write'];
	$speak = $row['speak'];
	if($row['iDate'] != '0000-00-00') { $iDate = date("d-m-Y", strtotime($row['iDate'])); }	else { $iDate = ""; }
	
	if($row['proBy'] == 1) { $processedBy = "Riya Education"; } 
	else { 
	$suppID = $row['suppID']; 
	$suppliers = mysql_query("SELECT * FROM `suppliers` WHERE suppID = '$suppID'");
	$sup = mysql_fetch_array($suppliers);
	$processedBy = $sup['supplier'];
	}
	$assignEmpID = $row['assignEmpID'];
	$emps = mysql_query("SELECT fname,lname FROM `employees` WHERE empID = '$assignEmpID'");
	$emp = mysql_fetch_array($emps);
	$employee = $emp['fname']." ".$emp['lname'];
}
?>


<div id="wrapper_top"></div>
<div id="wrapper">
<?php include("../include/left_stud.php"); ?>
<div class="main_col dotted_border">
<h2>Basic Info</h2>
<br />
<div class="fullWidth">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="pad">
  <tr>
    <td width="20%" rowspan="9" align="center" valign="top"><img src="<?php echo $photo; ?>" alt="picture" width="99" height="128" style="border: 4px solid #777;" /></td>
    <td width="16%">Full Name</td>
    <td width="2%">:</td>
    <td width="22%"><h4><?php echo $name; ?></h4></td>
    <td width="18%" align="left">Register No.</td>
    <td width="2%" align="center">:</td>
    <td width="20%" align="left"><h4><?php echo $regNo; ?></h4></td>
  </tr>
  <tr>
    <td>Gender</td>
    <td>:</td>
    <td><b><?php echo $gender; ?></b></td>
    <td align="left">Preferred Program</td>
    <td align="center">:</td>
    <td align="left"><b><?php echo $subProgram; ?></b></td>
  </tr>
  <tr>
    <td>Date of Birth</td>
    <td>:</td>
    <td><b><?php echo $dob; ?></b></td>
    <td align="left">Preferred Country</td>
    <td align="center">:</td>
    <td align="left"><b><?php echo $country; ?></b></td>
  </tr>
  <tr>
    <td>Marital Status.</td>
    <td>:</td>
    <td><b><?php echo $marrStatus; ?></b></td>
    <td align="left">Highest Qualification</td>
    <td align="center">:</td>
    <td align="left"><b><?php echo $hi_qlfn; ?></b></td>
  </tr>
  <tr>
    <td>Guardian Name</td>
    <td>:</td>
    <td><b><?php echo $gdName; ?></b></td>
    <td align="left">Guardian Occupation</td>
    <td align="center">:</td>
    <td align="left"><b><?php echo $gdOccupation; ?></b></td>
  </tr>
  <?php if($spName != '') { ?>
  <tr>
    <td>Spouse Name</td>
    <td>:</td>
    <td><b><?php echo $spName; ?></b></td>
    <td align="left">Spouse Occupation</td>
    <td align="center">:</td>
    <td align="left"><b><?php echo $spOccupation; ?></b></td>
  </tr>
  <?php } ?>
</table>
</div>
<br />
<h6>Contact Info</h6>
<br />
<div class="fullWidth">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="pad">
  <tr>
    <td width="15%">Mobile</td>
    <td width="2%" align="center">:</td>
    <td width="33%"><b>+<?php echo $mobile; ?></b></td>
    <td width="18%">Address</td>
    <td width="2%" align="center">:</td>
    <td width="30%" rowspan="3" valign="top"><b><?php echo $address; ?></b></td>
  </tr>
  <tr>
    <td>Phone</td>
    <td align="center">:</td>
    <td><b><?php echo $phone; ?></b></td>
    <td>&nbsp;</td>
    <td align="center">&nbsp;</td>
    </tr>
  <tr>
    <td>Email</td>
    <td align="center">:</td>
    <td><b><?php echo $email; ?></b></td>
    <td>&nbsp;</td>
    <td align="center">&nbsp;</td>
    </tr>
</table>
</div>
<?php 
$employment = mysql_query("SELECT * FROM `stud_employment` WHERE studID = '$studID'"); 
if(mysql_num_rows($employment) != '0') {  
?>
<br />
<h6>Employment History</h6>
<br />
<div class="fullWidth">
  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table" id="generate_comp">
    <tr>
      <th width="5%">No</th>
      <th>Company</th>
      <th>Designation</th>
      <th>Date of Working from</th>
      <th>To</th>
    </tr>
<?php
$counter = 1;
while($row = mysql_fetch_array($employment)) {
		$companies = $row['companies'];	
		$designation = $row['designation'];	
		$wdFrom = $row['wdFrom'];	
		$wdTo = $row['wdTo'];	
	
?>    
    <tr>
      <td align="center"><?php echo $counter++; ?></td>
      <td align="center"><?php echo $companies; ?></td>
      <td align="center"><?php echo $designation; ?></td>
      <td align="center"><?php echo $wdFrom; ?></td>
      <td align="center"><?php echo $wdTo; ?></td>
    </tr>
<?php } ?>
  </table>
</div>
<?php } ?>
<br />
<h6>Passport Info</h6>
<br />
<div class="fullWidth">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="pad">
  <tr>
    <td width="15%">Passport Number</td>
    <td width="2%" align="center">:</td>
    <td width="33%"><b><?php echo $passNum; ?></b></td>
    <td width="18%">Date of Expiry</td>
    <td width="2%" align="center">:</td>
    <td width="30%" valign="top"><b><?php echo $expDate; ?></b></td>
  </tr>
  <tr>
    <td>Visa Number</td>
    <td align="center">:</td>
    <td><b><?php echo $visaNum; ?></b></td>
    <td>Duration</td>
    <td align="center">:</td>
    <td width="30%" valign="top"><b><?php echo $duration; ?></b></td>
  </tr>
</table>
</div>

<br />
<h6>Academic Info</h6>
<br />
<div class="fullWidth">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tablegeneral">
  <tr>
    <th>Qualification</th>
    <th>Passing Year</th>
    <th>Stream</th>
    <th>Institution</th>
    <th>Marks (%)</th>
  </tr>
<?php
$qry7 = mysql_query("SELECT * FROM `stud_education` WHERE studID ='$studID'");
while($ary7 = mysql_fetch_array($qry7)) {
	$qid = $ary7['qid'];	
	$year = $ary7['year'];
	$stream = $ary7['stream'];
	$institution = $ary7['institution'];
	$marks = $ary7['marks'];	
	
	if($qid != '6') {
	$qry8 = mysql_query("SELECT qualification FROM `qualifications` WHERE qid = '$qid'");
	$ary8 = mysql_fetch_array($qry8);
	$qlfn = $ary8['qualification'];
	} else {
	$qlfn = $ary7['otherQlfn'];
	}
?>
  <tr>
    <td align="center"><?php echo $qlfn; ?></td>
    <td align="center"><?php echo $year; ?></td>
    <td align="center"><?php echo $stream; ?></td>
    <td align="center"><?php echo $institution; ?></td>
    <td align="center"><?php echo $marks; ?></td>
  </tr>
<?php } ?>  
</table>
<?php if($engTest != '2') { ?>
<br />
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="18%" height="30" align="left">Band Score</td>
    <td width="2%">:</td>
    <td width="8%"><strong>Overall</strong></td>
    <td width="8%" class="red"><b><?php echo $iScore; ?></b></td>
    <td align="left">
    <table width="400" border="0" cellspacing="0" cellpadding="0" class="table">
      <tr>
        <th width="30" align="center" class="blue"><b>L</b></th>
        <td width="70" align="center" bgcolor="#FCEBEB"><b><?php echo $listen; ?></b></td>
        <th width="30" align="center" class="blue"><b>R</b></th>
        <td width="70" align="center" bgcolor="#FCEBEB"><b><?php echo $read; ?></b></td>
        <th width="30" align="center" class="blue"><b>W</b></th>
        <td width="70" align="center" bgcolor="#FCEBEB"><b><?php echo $write; ?></b></td>
        <th width="30" align="center" class="blue"><b>S</b></th>
        <td width="70" align="center" bgcolor="#FCEBEB"><b><?php echo $speak; ?></b></td>
      </tr>
    </table></td>
    </tr>
  <tr>
    <td height="30" align="left">Exam Date</td>
    <td>:</td>
    <td colspan="3"><b><?php echo $iDate; ?></b></td>
  </tr>
</table>
<?php } ?>
</div>
<?php /*?>
<br />
<h6>Documents Info</h6>
<br />
<div class="fullWidth">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tablegeneral">
  <tr>
    <th width="10%">No</th>
    <th width="50%" align="left" style="padding-left: 22px;">Documents</th>
    <th width="25%">Submitted Date</th>
    <th width="15%">Action</th>
  </tr>
<?php
$num = 1;
$stud_docs = mysql_query("SELECT * FROM `stud_docs` WHERE studID ='$studID'");
while($sd = mysql_fetch_array($stud_docs)) {  
	$docID = $sd['docID'];
	$docs = mysql_query("SELECT * FROM `document_list` WHERE docID = '$docID'");
	$docName = mysql_fetch_array($docs);
	$document = $docName['document'];
	
	if($sd['date'] != "0000-00-00") {
		$submitDate = date("d-m-Y",strtotime($sd['date']));
	} else {
		$submitDate = "Not yet submitted";
	}
?>
  <tr>
    <td align="center"><?php echo $num++; ?></td>
    <td align="left" style="padding-left: 20px;"><?php echo $document; ?></td>
    <td align="center"><?php echo $submitDate; ?></td>
    <td align="center"><a href="#">
    <img src="../images/view.png" alt="view" title="view profile" class="blank" width="16" height="16" /></a></td>
  </tr>
<?php } ?>    
</table></div>  
<?php */?>
<br />
<h6>Processing Info</h6>
<br />
<div class="fullWidth">
<?php

?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="15%">Processing by</td>
    <td width="2%">:</td>
    <td width="33%"><b><?php echo $processedBy; ?></b></td>
    <td width="18%">Employee in charge</td>
    <td width="2%">:</td>
    <td width="30%"><b><?php echo $employee; ?></b></td>
  </tr>
  <tr>
    <td colspan="6" height="60">&nbsp;</td>
  </tr>
</table>

</div>


</div>
</div>

<?php include("../include/footer.php"); ?>

</div> <!--end of container-->
</body>
</html>