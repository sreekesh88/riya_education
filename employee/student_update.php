<?php include ("../include/header.php"); 
include ("../include/validate.php"); 
include ("../include/menu.php"); 
$studID = $_GET['sid'];
$empID = $info['empID'];
?>

<script type="text/javascript" src="../js/validate.js"></script>
<script>
/*********** File size restriction ***********/
$(function() {
	$('#photo').bind('change', function() {
		var fileName = this.files[0].name;
		var fileExtension = fileName.substring(fileName.lastIndexOf('.') + 1);
		
		if(!((fileExtension == 'jpg') 
		|| (fileExtension == 'jpeg') 
		|| (fileExtension == 'gif')
		|| (fileExtension == 'png'))) { 
			alert("Please upload files of jpg,gif or png type. The selected file cannot be uploaded.");
		}
		var size = this.files[0].size/1024/1024;		
		if(size > 0.244141) //maximum file size = 250kb
		{
			alert("Maximum Image size exceeded! The selected file cannot be uploaded.");
		}
	});
	
	var currentTime = new Date();
	var year = currentTime.getFullYear();
		
	$("#expiry").datepicker({
	changeMonth: true,
	changeYear: true,
	dateFormat: "dd-mm-yy",
	minDate: "0y",
	yearRange: (year)+':'+(year+15) 
	});
	
	$("#fromDate").datepicker({
	changeMonth: true,
	changeYear: true,
	dateFormat: "dd-mm-yy",
	yearRange: (year-5)+':'+(year+5) 
	});
	
	$("#toDate").datepicker({
	changeMonth: true,
	changeYear: true,
	dateFormat: "dd-mm-yy",
	yearRange: (year)+':'+(year+5) 
	});


});
</script>

<?php
$basicInfo = mysql_query("SELECT * FROM `students` WHERE studID = '$studID'");
while($res1 = mysql_fetch_array($basicInfo)) {	
	$regNo = $res1['regNo'];
	$branchID = $res1['branchID'];
	$fname = $res1['fname'];
	$lname = $res1['lname'];
	$gender = $res1['gender'];
	$photo1 = $res1['photo'];
	$dob = date("d-m-Y", strtotime($res1['dob'])); 
	$married = $res1['married'];	
	$spName = $res1['spName'];	
	$spOccupation = $res1['spOccupation'];	
	$gdName = $res1['gdName'];	
	$gdOccupation = $res1['gdOccupation'];	
	$pgmID = $res1['program'];	
	$conID = $res1['country'];
}

$contactInfo = mysql_query("SELECT * FROM `stud_contact` WHERE studID = '$studID'");
while($res2 = mysql_fetch_array($contactInfo)) {	
	$conCode = $res2['conCode'];
	$mobile = $res2['mobile'];
	$areaCode = $res2['areaCode'];
	$phone = $res2['phone'];
	$email = $res2['email'];
	$addr1 = $res2['addr1'];
	$addr2 = $res2['addr2'];
	$addr3 = $res2['addr3'];
	$pincode = $res2['pincode'];	
	$district = $res2['district'];	
	$stateID = $res2['state'];
}

$stud_emp = mysql_query("SELECT * FROM `stud_employment` WHERE studID = '$studID'"); 
$tot_rows = mysql_num_rows($stud_emp);

$passport = mysql_query("SELECT * FROM `stud_passport` WHERE studID = '$studID'");
while($res3 = mysql_fetch_array($passport)) {
	$passNum = $res3['passNum'];		
	$expiry = date("d-m-Y", strtotime($res3['expiry']));
	$visaNum = $res3['visaNum'];	
	if($res3['fromDate'] != '0000-00-00') { $fromDate = date("d-m-Y", strtotime($res3['fromDate'])); }	
	if($res3['toDate'] != '0000-00-00') { $toDate = date("d-m-Y", strtotime($res3['toDate'])); }
	$job = $res3['job'];	
	$expYrs = $res3['expYrs'];
}

$eduInfo = mysql_query("SELECT * FROM stud_education a RIGHT JOIN qualifications b ON a.qid = b.qid WHERE a.studID= '$studID';");
$rows = mysql_num_rows($eduInfo);

$stud_others = mysql_query("SELECT * FROM `stud_others` WHERE studID = '$studID'");

if(isset($_POST['update'])) {
	
	$_POST['dob'] = date("Y-m-d", strtotime($_POST['dob']));
		
	if($_FILES["photo"]["name"] != '') {
		$allowedExts = array("jpg", "jpeg", "gif", "png");
		$extension = end(explode(".", $_FILES["photo"]["name"]));
		if ((($_FILES["photo"]["type"] == "image/gif")
		|| ($_FILES["photo"]["type"] == "image/jpeg")
		|| ($_FILES["photo"]["type"] == "image/png")
		|| ($_FILES["photo"]["type"] == "image/pjpeg"))
		&& ($_FILES["photo"]["size"] < 256000) // file size in bytes -- 250 KB
		&& in_array($extension, $allowedExts))
		{
		  $photo2 = time()."_".$_FILES["photo"]["name"];	
		  move_uploaded_file($_FILES["photo"]["tmp_name"],"photos/" . $photo2);
		}
	}
	
	if($photo2 != '') { $photo = $photo2; } else { $photo = $photo1; }
	
	$students = mysql_query("UPDATE `students` SET `gender`='".$_POST['gender']."',
								`fname`='".$_POST['fname']."',
								`lname`='".$_POST['lname']."',
								`dob`='".$_POST['dob']."',
								`photo`='".$photo."',
								`spName`='".$_POST['spName']."',
								`spOccupation`='".$_POST['spOccupation']."',
								`gdName`='".$_POST['gdName']."',
								`gdOccupation`='".$_POST['gdOccupation']."',
								`program`='".$_POST['program']."',
								`pgmOthers`='".$_POST['pgmOthers']."',
								`country`='".$_POST['country']."'
								
								WHERE studID = '$studID'");

								
	$contact = mysql_query("UPDATE `stud_contact` SET `conCode`='".$_POST['conCode']."',
								`mobile`='".$_POST['mobile']."',
								`areaCode`='".$_POST['areaCode']."',
								`phone`='".$_POST['phone']."',
								`email`='".$_POST['email']."',
								`addr1`='".$_POST['addr1']."',
								`addr2`='".$_POST['addr2']."',
								`addr3`='".$_POST['addr3']."',
								`pincode`='".$_POST['pincode']."',
								`district`='".$_POST['district']."',
								`state`='".$_POST['state']."' 
								
								WHERE studID = '$studID'");
	$i=0;
	while($rows = mysql_fetch_array($stud_emp)) {
	$i++;
		$emID = $rows['emID'];
		$companies = $_POST['company_'.$i];	
		$desig = $_POST['desig_'.$i];	
		$wdFrom = $_POST['wdFrom_'.$i];
		$wdTo = $_POST['wdTo_'.$i];					
		$employment = mysql_query("UPDATE `stud_employment` SET `companies`='".$companies."',
								`designation`='".$desig."',
								`wdFrom`='".$wdFrom."',
								`wdTo`='".$wdTo."'
								
								WHERE emID = '$emID'");
	}
	
	
	
	if($_POST['expiry'] != '') { $_POST['expiry'] = date("Y-m-d", strtotime($_POST['expiry'])); }
	if($_POST['fromDate'] != '') { $_POST['fromDate'] = date("Y-m-d", strtotime($_POST['fromDate'])); }
	if($_POST['toDate'] != '') { $_POST['toDate'] = date("Y-m-d", strtotime($_POST['toDate'])); }
	
	$stud_pass = mysql_query("UPDATE `stud_passport` SET `passNum`='".$_POST['passNum']."',
								`expiry`='".$_POST['expiry']."',
								`visaNum`='".$_POST['visaNum']."',
								`fromDate`='".$_POST['fromDate']."',
								`toDate`='".$_POST['toDate']."'
								
								WHERE studID = '$studID'"); 
								
	
	
								
	for($i=1;$i<=6;$i++) {
		if($_POST['passYear_'.$i] != '') {
			$qid = $_POST['qid_'.$i];
			$passYear = $_POST['passYear_'.$i]."<br>";
			$stream = $_POST['stream_'.$i];
			$institute = $_POST['institute_'.$i];
			$marks = $_POST['marks_'.$i];
			
			$stud_edu = mysql_query("UPDATE `stud_education` SET `year`='".$passYear."',
								`stream`='".$stream."',
								`institution`='".$institute."',
								`marks`='".$marks."'
								
								WHERE studID = '$studID' AND qid = '$qid'");
		
		}
	}
	
	$_POST['iDate'] = date("Y-m-d", strtotime($_POST['iDate']));

	$otherInfos = mysql_query("UPDATE `stud_others` SET `iScore`='".$_POST['iScore']."',
								`listen`='".$_POST['listen']."',
								`read`='".$_POST['read']."',
								`write`='".$_POST['write']."',
								`speak`='".$_POST['speak']."',
								`iDate`='".$_POST['iDate']."'
								
								WHERE studID = '$studID'");
	

	$success = $fname." ".$lname." has been updated succesfully";
	echo '<META HTTP-EQUIV=Refresh CONTENT="0; URL=student_update.php?sid='.$studID.'">';
	?>    
	<script language='javascript'>
	setTimeout("$('#success').fadeOut('slow')", 1000);
	</script>
	<?php
	
}
?>


<div id="wrapper_top"></div>
<div id="wrapper">
<?php include("../include/left_stud.php"); ?>
<div class="main_col dotted_border">
<h2>Profile Updation</h2>

<form action="" method="post" enctype="multipart/form-data" name="studForm">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="6" height="35" align="center">
    <span class="alert" id="success"><?php echo $success; ?></span></td>
    </tr>
  <tr>
    <td width="15%" height="35">Name</td>
    <td width="2%">:</td>
    <td width="33%">
    <span class="right_5"><input type="text" name="fname" id="fname" class="textbox width_95" style="color:#1A7BB2;" value="<?php echo $fname; ?>"/></span>
    <span><input type="text" name="lname" id="lname" class="textbox width_95" style="color:#1A7BB2;" value="<?php echo $lname; ?>" /></span>    </td>
    <td width="18%">Upload Photograph</td>
    <td width="2%">:</td>
    <td width="30%" valign="top">
    <div class="file-wrapper">
        <input type="file" name="photo" id="photo" onchange="readURL(this);"/>
        <span class="button">Choose a file</span>    </div></td>
  </tr>
  <tr>
    <td height="35">Gender</td>
    <td>:</td>
    <td>
    <?php 
	if($gender == '1') { $checked1 = 'checked="checked"'; }
	else if($gender == '2') { $checked2 = 'checked="checked"'; } 
	?>
    <input name="gender" id="gender" type="radio" value="1" <?php echo $checked1; ?> /> Male
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <input name="gender" id="gender" type="radio" value="2" <?php echo $checked2; ?> /> Female    </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td width="30%" rowspan="3" valign="top">
    <img id="imgPr1" src="<?php echo ROOT."/employee/photos/".$photo1 ?>" width="70" height="90" alt="preview" style="border: 5px solid #ccc;" />    </td>
  </tr>
  <tr>
    <td height="35">Date of Birth</td>
    <td>:</td>
    <td><input type="text" name="dob" id="dob" class="textbox" style="text-align:center; width:120px;" value="<?php echo $dob; ?>" />&nbsp;&nbsp; [dd-mm-yyyy]</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
  <tr>
    <td height="35">Marital Status</td>
    <td>:</td>
    <td>
    <?php 
	if($married == '0') { $checked3 = 'checked="checked"'; }
	else if($married == '1') { $checked4 = 'checked="checked"'; } 
	?>
    <input name="married" id="ms1" type="radio" value="0" <?php echo $checked3; ?> /> No
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <input name="married" id="ms2" type="radio" value="1" <?php echo $checked4; ?> /> Yes    </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <?php if($married == '1') { ?>
  <tr>
    <td height="35">Spouse Name</td>
    <td>:</td>
    <td><input type="text" name="spName" id="spName" class="textbox width_200" value="<?php echo $spName ;?>"/></td>
    <td>Occupation</td>
    <td>:</td>
    <td><input type="text" name="spOccupation" id="spOccupation" class="textbox width_200" value="<?php echo $spOccupation ;?>" /></td>
  </tr>
  <?php } ?>
  <tr>
    <td height="35">Guardian Name</td>
    <td>:</td>
    <td><input type="text" name="gdName" id="gdName" class="textbox width_200" value="<?php echo $gdName ;?>" /></td>
    <td>Occupation</td>
    <td>:</td>
    <td><input type="text" name="gdOccupation" id="gdOccupation" class="textbox width_200" value="<?php echo $gdOccupation ;?>" /></td>
  </tr>
  <tr>
    <td height="35"><strong>Preferred Program</strong></td>
    <td>:</td>
    <td>
    <select name="program" id="program" class="dropdown">
    <?php
	$res1 = mysql_query("SELECT * FROM `programs`");
	while($arr1 = mysql_fetch_array($res1)) {
		echo '<option value="'.$arr1['pgmID'].'" class="padding_2"';
		if($arr1['pgmID'] == $pgmID)
		echo 'selected="selected"';
		echo '>'.$arr1['program'].'</option>';	
	}
    ?>
    </select>    </td>
    <td><strong>Preferred Country</strong></td>
    <td>:</td>
    <td>
    <select name="country" id="country" class="dropdown">
    <option value="" selected="selected" class="padding_2">Select</option>
    <?php
	$res2 = mysql_query("SELECT * FROM `countries` WHERE delStatus = '0'");
	while($arr2 = mysql_fetch_array($res2)) {
	echo '<option value="'.$arr2['conID'].'" class="padding_2"';
	if($arr2['conID'] == $conID)
	echo 'selected="selected"';
	echo '>'.$arr2['country'].'</option>';
	}
    ?>
    </select>    </td>
  </tr>
  <tr>
    <td height="60" colspan="6"><h6>Contact Info</h6></td>
    </tr>
  <tr>
    <td height="35" valign="top">Mobile</td>
    <td valign="top">:</td>
    <td valign="top">
      <span class="right_5"><input type="text" name="conCode" id="conCode" class="textbox width_40" value="<?php echo $conCode; ?>" style="text-align:center"/></span>
      <span><input type="text" name="mobile" id="mobile" class="textbox width_150" maxlength="10" value="<?php echo $mobile; ?>" /></span>    </td>
    <td valign="top">Address</td>
    <td valign="top">:</td>
    <td rowspan="2" valign="top"><div class="addressBox">
      <input type="text" name="addr1" id="addr1" class="addrInput" value="<?php echo $addr1; ?>"/>
      <input type="text" name="addr2" id="addr2" class="addrInput" value="<?php echo $addr2; ?>"/>
      <input type="text" name="addr3" id="addr3" class="addrInput" value="<?php echo $addr3; ?>"/>
    </div></td>
  </tr>
  <tr>
    <td height="35" valign="top">Phone</td>
    <td valign="top">:</td>
    <td valign="top"><span class="right_5"><input type="text" name="areaCode" id="areaCode" class="textbox width_40" style="text-align:center" value="<?php echo $areaCode ;?>" /></span>
      <span><input type="text" name="phone" id="phone" class="textbox width_150" value="<?php echo $phone; ?>" /></span> </td>
    <td valign="top">&nbsp;</td>
    <td valign="top">&nbsp;</td>
    </tr>
  <tr>
    <td height="35" valign="top">Email</td>
    <td valign="top">:</td>
    <td valign="top"><input type="text" name="email" id="email" class="textbox width_200" value="<?php echo $email; ;?>" /></td>
    <td valign="top">District</td>
    <td valign="top">:</td>
    <td valign="top"><input type="text" name="district" id="district" class="textbox width_200" value="<?php echo $district; ?>"/></td>
  </tr>
  <tr>
    <td height="35" valign="top">Pincode</td>
    <td valign="top">:</td>
    <td valign="top"><input type="text" name="pincode" id="pincode" class="textbox width_200" value="<?php echo $pincode; ?>" /></td>
    <td valign="top">State</td>
    <td valign="top">:</td>
    <td valign="top"><select name="state" id="state" class="dropdown">
      <option value="" selected="selected" class="padding_2">Select</option>
      <?php
	$res3 = mysql_query("SELECT * FROM `states`");
	while($arr3 = mysql_fetch_array($res3)) {
	echo '<option value="'.$arr3['stateID'].'" class="padding_2"';
	if($arr3['stateID'] == $stateID)
	echo 'selected="selected"';
	echo '>'.$arr3['state'].'</option>';
	}
    ?>
    </select></td>
  </tr>
  <tr>
    <td height="60" colspan="6"><h6>Employment  History</h6></td>
  </tr>
  <tr>
    <td colspan="6">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table">
      <tr>
        <th width="5%">No</th>
        <th>Company</th>
        <th>Designation</th>
        <th>Date of Working from</th>
        <th>To</th>
      </tr>
      <?php 
	  $c = 0;
	  while($emp = mysql_fetch_array($stud_emp)) {
	  	$c++;
	  	$company = $emp['companies'];
		$designation = $emp['designation'];
		$wdFrom = date("d-m-Y",strtotime($emp['wdFrom']));
		$wdTo = date("d-m-Y",strtotime($emp['wdTo']));
	  ?>
      <tr>
        <td align="center"><?php echo $c; ?></td>
        <td align="center"><input type="text" name="company_<?php echo $c; ?>" id="company_<?php echo $c; ?>" class="textbox width_200 textCenter" value="<?php echo $company; ?>" /></td>
        <td align="center"><input type="text" name="desig_<?php echo $c; ?>" id="desig_<?php echo $c; ?>" class="textbox width_150 textCenter" value="<?php echo $designation; ?>" /></td>
        <td align="center"><input type="text" name="wdFrom_<?php echo $c; ?>" id="wdFrom_<?php echo $c; ?>" class="textbox width_95 textCenter" value="<?php echo $wdFrom; ?>"/></td>
        <td align="center"><input type="text" name="wdTo_<?php echo $c; ?>" id="wdTo_<?php echo $c; ?>" class="textbox width_95 textCenter" value="<?php echo $wdTo; ?>"/></td>
      </tr>
	  <?php } ?>
    </table>
    </td>
  </tr>
  <tr>
    <td height="60" colspan="6"><h6>Passport  Info</h6></td>
  </tr>
  <tr>
    <td height="35">Passport Number</td>
    <td>:</td>
    <td><input type="text" name="passNum" id="passNum" class="textbox width_200" value="<?php echo $passNum; ?>" /></td>
    <td>Date of Expiry</td>
    <td>:</td>
    <td><input type="text" name="expiry" id="expiry" class="textbox width_200 textCenter" value="<?php echo $expiry; ?>"/></td>
  </tr>
  <tr>
    <td height="35">Visa Number</td>
    <td>:</td>
    <td><input type="text" name="visaNum" id="visaNum" class="textbox width_200" value="<?php echo $visaNum; ?>" /></td>
    <td>Duration Dates</td>
    <td>:</td>
    <td>
    <span class="right_5"><input type="text" name="fromDate" id="fromDate" class="textbox width_95 textCenter" value="<?php echo $fromDate; ?>" /></span>
    <span><input type="text" name="toDate" id="toDate" class="textbox width_95 textCenter" value="<?php echo $toDate; ?>" /></span></td>
  </tr>
  <tr>
    <td height="60" colspan="6"><h6>Academic Info</h6></td>
  </tr>
  <tr>
    <td colspan="6">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tablegeneral">
      <tr>
        <th>Qualification</th>
        <th>Passing Year</th>
        <th>Stream</th>
        <th>Institution</th>
        <th>Marks (%)</th>
      </tr>
    
	<?php		
	$i = 1;
	$qids = array();
	while($res4 = mysql_fetch_array($eduInfo)) {
		$qids[] = $res4['qid'];
	?>
            
    <tr>
        <td align="center"><?php echo $res4['qualification'];?>
        <input type="hidden" name="qid_<?php echo $i;?>" value="<?php echo $res4['qid']; ?>"  />
        </td>
        <td align="center"><input type="text" name="passYear_<?php echo $i;?>" id="passYear_<?php echo $i;?>" class="textbox width_95 textCenter" value="<?php echo $res4['year'];?>" /></td>
        <td align="center"><input type="text" name="stream_<?php echo $i;?>" id="stream_<?php echo $i;?>" class="textbox width_150" value="<?php echo $res4['stream'];?>" /></td>
        <td align="center"><input type="text" name="institute_<?php echo $i;?>" id="institute_<?php echo $i;?>" class="textbox width_150" value="<?php echo $res4['institution'];?>" /></td>
        <td align="center"><input type="text" name="marks_<?php echo $i;?>" id="marks_<?php echo $i;?>" class="textbox width_95 textCenter" value="<?php echo $res4['marks'];?>" /></td>
    </tr>
            
	<?php
    $i++;
}

$qualIDs = implode(",",$qids);
$qualInfo = mysql_query("SELECT * FROM qualifications WHERE qid NOT IN ({$qualIDs})");

while($res5 = mysql_fetch_array($qualInfo)) {
    ?>
    
    <tr>
        <td align="center">
            <input type="hidden" name="qid_<?php echo $i;?>" value="<?php echo $res5['qid']; ?>"  />
            <?php echo $res5['qualification'];?>                </td>
        <td align="center"><input type="text" name="passYear_<?php echo $i;?>" id="passYear_<?php echo $i;?>" class="textbox width_95 textCenter" /></td>
        <td align="center"><input type="text" name="stream_<?php echo $i;?>" id="stream_<?php echo $i;?>" class="textbox width_150" /></td>
        <td align="center"><input type="text" name="institute_<?php echo $i;?>" id="institute_<?php echo $i;?>" class="textbox width_150" /></td>
        <td align="center"><input type="text" name="marks_<?php echo $i;?>" id="marks_<?php echo $i;?>" class="textbox width_95 textCenter" /></td>
    </tr>
    
    <?php
    $i++;
}
?>
    </table></td>
  </tr>
    <?php
	while ($row = mysql_fetch_array($stud_others)) {
	
	$engTest = $row['engTest'];
	$iScore = $row['iScore'];
	$listen = $row['listen'];
	$read = $row['read'];
	$write = $row['write'];
	$speak = $row['speak'];
	if($row['iDate'] != '') { $iDate = date("d-m-Y", strtotime($row['iDate'])); }
	
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
  <?php if($engTest != '') { ?>
  <tr>
    <td colspan="6"><br />
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="pad">
        <tr>
          <td width="21%">Your Band score</td>
          <td width="2%">:</td>
          <td width="77%">Overall 
            <input type="text" name="iScore" id="iScore" class="textbox width_60 textCenter" value="<?php echo $iScore; ?>"/> 
            &nbsp; L &nbsp;
            <input type="text" name="listen" id="listen" class="textbox width_60 textCenter" value="<?php echo $listen; ?>"/>
            &nbsp; R &nbsp;
            <input type="text" name="read" id="read" class="textbox width_60 textCenter" value="<?php echo $read; ?>"/>
            &nbsp; W &nbsp;
            <input type="text" name="write" id="write" class="textbox width_60 textCenter" value="<?php echo $write; ?>"/>
            &nbsp; S &nbsp;
            <input type="text" name="speak" id="speak" class="textbox width_60 textCenter" value="<?php echo $speak; ?>"/>
          </td>
        </tr>
        <tr>
          <td>Date of Examination</td>
          <td>:</td>
          <td><input type="text" name="iDate" id="iDate" class="textbox textCenter" value="<?php echo $iDate; ?>"/></td>
        </tr>
        <tr><td colspan="3">&nbsp;</td></tr>
      </table>
    </td>
  </tr>
  <?php } ?>
  <tr>
    <td colspan="6" align="center" height="80"><input type="submit" name="update" id="update" value="Update" class="button width_150"/></td>
  </tr>
</table>

</form>

</div>
</div>

<?php include("../include/footer.php"); ?>

</div> <!--end of container-->
</body>
</html>