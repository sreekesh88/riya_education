<?php include ("../include/header.php"); 
include ("../include/validate.php"); 
include ("../include/menu.php"); 
$studID = $_GET['sid'];
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
	$photo = $res1['photo'];
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

$otherInfo = mysql_query("SELECT * FROM `stud_details` WHERE studID = '$studID'");
while($res3 = mysql_fetch_array($otherInfo)) {
	$passNum = $res3['passNum'];		
	$expiry = date("d-m-Y", strtotime($res3['expiry']));
	$visaNum = $res3['visaNum'];	
	if($res3['fromDate'] != '0000-00-00') { $fromDate = date("d-m-Y", strtotime($res3['fromDate'])); }	
	if($res3['toDate'] != '0000-00-00') { $toDate = date("d-m-Y", strtotime($res3['toDate'])); }
	$job = $res3['job'];	
	$expYrs = $res3['expYrs'];
}



if(isset($_POST['update'])) {
	
		
	
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
		  $photo = time()."_".$_FILES["photo"]["name"];	
		  move_uploaded_file($_FILES["photo"]["tmp_name"],"photos/" . $photo);
		}
	}
	
		
	
	
	if($email != '') {
		$qry2 = mysql_query("");
	}
		
	
	
	if($studID != '') {
		$qry3 = mysql_query("");
	}
	
	for($i=1;$i<=5;$i++) {
		if($_POST['passYear_'.$i] != '') {
		$qid = $_POST['qid_'.$i];
		$passYear = $_POST['passYear_'.$i];
		$stream = $_POST['stream_'.$i];
		$institute = $_POST['institute_'.$i];
		$marks = $_POST['marks_'.$i];
		
		$qry4 = mysql_query("");
		
		}
	}
	/*
	if($qry1>0) {
		$success = $fname." ".$lname." has been added succesfully";
		echo '<META HTTP-EQUIV=Refresh CONTENT="3; URL=add_student.php">';
		?>    
		<script language='javascript'>
		setTimeout("$('#success').fadeOut('slow')", 3000);
		</script>
		<?php
	}*/
	
}
?>


<div id="wrapper_top"></div>
<div id="wrapper">
<?php include("../include/left_stud.php"); ?>
<div class="main_col dotted_border">
<h2>Student Registration</h2>

<form action="" method="post" enctype="multipart/form-data" name="studForm">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="6" height="35" align="center">
    <span class="alert" id="success"><?php echo $success; ?></span>
    <span style="float:right;color:#be0000;">Date format: dd-mm-yyyy</span>    </td>
    </tr>
  <tr>
    <td width="15%" height="35"><strong>Name</strong></td>
    <td width="2%">:</td>
    <td width="33%">
    <span class="right_5"><input type="text" name="fname" id="fname" class="textbox width_95" style="color:#1A7BB2;" value="<?php echo $fname; ?>"/></span>
    <span><input type="text" name="lname" id="lname" class="textbox width_95" style="color:#1A7BB2;" value="<?php echo $lname; ?>" /></span>    </td>
    <td width="18%"><strong>Upload Photograph</strong></td>
    <td width="2%">:</td>
    <td width="30%" valign="top">
    <div class="file-wrapper">
        <input type="file" name="photo" id="photo" onchange="readURL(this);"/>
        <span class="button">Choose a file</span>    </div></td>
  </tr>
  <tr>
    <td height="35"><strong>Gender</strong></td>
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
    <img id="imgPr1" src="<?php echo ROOT."/employee/photos/".$photo ?>" width="70" height="90" alt="preview" style="border: 5px solid #ccc;" />    </td>
  </tr>
  <tr>
    <td height="35"><strong>Date of Birth</strong></td>
    <td>:</td>
    <td><input type="text" name="dob" id="dob" class="textbox" style="text-align:center; width:120px;" value="<?php echo $dob; ?>" />&nbsp;&nbsp; [dd-mm-yyyy]</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
  <tr>
    <td height="35"><strong>Marital Status</strong></td>
    <td>:</td>
    <td>
    <?php 
	if($married == '1') { $checked3 = 'checked="checked"'; }
	else if($married == '2') { $checked4 = 'checked="checked"'; } 
	?>
    <input name="married" id="married" type="radio" value="1" <?php echo $checked3; ?> /> No
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <input name="married" id="married" type="radio" value="2" <?php echo $checked4; ?> /> Yes    </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
  <tr>
    <td height="35"><strong>Spouse Name</strong></td>
    <td>:</td>
    <td><input type="text" name="spName" id="spName" class="textbox width_200" value="<?php echo $spName ;?>"/></td>
    <td><strong>Spouse Occupation</strong></td>
    <td>:</td>
    <td><input type="text" name="spOccupation" id="spOccupation" class="textbox width_200" value="<?php echo $spOccupation ;?>" /></td>
  </tr>
  <tr>
    <td height="35"><strong>Guardian Name</strong></td>
    <td>:</td>
    <td><input type="text" name="gdName" id="gdName" class="textbox width_200" value="<?php echo $gdName ;?>" /></td>
    <td><strong>Guardian Occupation</strong></td>
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
    <td height="35"><strong>Mobile</strong></td>
    <td>:</td>
    <td>
      <span class="right_5"><input type="text" name="conCode" id="conCode" class="textbox width_40" value="<?php echo $conCode; ?>" style="text-align:center"/></span>
      <span><input type="text" name="mobile" id="mobile" class="textbox width_150" maxlength="10" value="<?php echo $mobile; ?>" /></span>    </td>
    <td><strong>Phone</strong></td>
    <td>:</td>
    <td>
      <span class="right_5"><input type="text" name="areaCode" id="areaCode" class="textbox width_40" style="text-align:center" value="<?php echo $areaCode ;?>" /></span>
      <span><input type="text" name="phone" id="phone" class="textbox width_150" value="<?php echo $phone; ?>" /></span>    </td>
  </tr>
  <tr>
    <td height="35"><strong>Email</strong></td>
    <td>:</td>
    <td><input type="text" name="email" id="email" class="textbox width_200" value="<?php echo $email; ;?>" /></td>
    <td><strong>Address</strong></td>
    <td>:</td>
    <td rowspan="4">
    <div class="addressBox">
    <input type="text" name="addr1" id="addr1" class="addrInput" value="<?php echo $addr1; ?>"/>
    <input type="text" name="addr2" id="addr2" class="addrInput" value="<?php echo $addr2; ?>"/>
    <input type="text" name="addr3" id="addr3" class="addrInput" value="<?php echo $addr3; ?>"/>
    </div>    </td>
  </tr>
  <tr>
    <td height="35"><strong>Pincode</strong></td>
    <td>:</td>
    <td><input type="text" name="pincode" id="pincode" class="textbox width_200" value="<?php echo $pincode; ?>" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
  <tr>
    <td height="35"><strong>District</strong></td>
    <td>:</td>
    <td><input type="text" name="district" id="district" class="textbox width_200" value="<?php echo $district; ?>"/></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
  <tr>
    <td height="35"><strong>State</strong></td>
    <td>:</td>
    <td>
    <select name="state" id="state" class="dropdown">
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
    </select>    </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
  <tr>
    <td height="60" colspan="6"><h6>Other Info</h6></td>
  </tr>
  <tr>
    <td height="35"><strong>Passport Number</strong></td>
    <td>:</td>
    <td><input type="text" name="passNum" id="passNum" class="textbox width_200" value="<?php echo $passNum; ?>" /></td>
    <td><strong>Date of Expiry</strong></td>
    <td>:</td>
    <td><input type="text" name="expiry" id="expiry" class="textbox width_200"  value="<?php echo $expiry; ?>"/></td>
  </tr>
  <tr>
    <td height="35"><strong>Visa Number</strong></td>
    <td>:</td>
    <td><input type="text" name="visaNum" id="visaNum" class="textbox width_200" value="<?php echo $visaNum; ?>" /></td>
    <td><strong>Duration Dates</strong></td>
    <td>:</td>
    <td>
    <span class="right_5"><input type="text" name="fromDate" id="fromDate" class="textbox width_95" value="<?php echo $fromDate; ?>" /></span>
    <span><input type="text" name="toDate" id="toDate" class="textbox width_95" value="<?php echo $toDate; ?>" /></span></td>
  </tr>
  <tr>
    <td height="35"><strong>Employment</strong></td>
    <td>:</td>
    <td><input type="text" name="job" id="job" class="textbox width_200" value="<?php echo $job; ?>" /></td>
    <td><strong>Years of Experience</strong></td>
    <td>:</td>
    <td><input type="text" name="expYrs" id="expYrs" class="textbox width_200" value="<?php echo $expYrs; ?>" /></td>
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
<?php /*
$eduInfo = mysql_query("SELECT * FROM `stud_education` WHERE studID = '$studID'");
$rows = mysql_num_rows($eduInfo);
while($res4 = mysql_fetch_array($eduInfo)) {
	echo $passYear = $res4['year'];
}
?>
      
      <tr>
        <td align="center">Xth<input type="hidden" name="qid_1" value="1" /></td>
        <td align="center"><input type="text" value="<?php echo $passYear; ?>" name="passYear_1" id="passYear_1" class="textbox width_95 textCenter" /></td>
        <td align="center"><input type="text" name="stream_1" id="stream_1" class="textbox width_150" /></td>
        <td align="center"><input type="text" name="institute_1" id="institute_1" class="textbox width_150" /></td>
        <td align="center"><input type="text" name="marks_1" id="marks_1" class="textbox width_95 textCenter" /></td>
      </tr>
      <tr>
        <td align="center">XIIth<input type="hidden" name="qid_2" value="2" /></td>
        <td align="center"><input type="text" name="passYear_2" id="passYear_2" class="textbox width_95 textCenter" /></td>
        <td align="center"><input type="text" name="stream_2" id="stream_2" class="textbox width_150" /></td>
        <td align="center"><input type="text" name="institute_2" id="institute_2" class="textbox width_150" /></td>
        <td align="center"><input type="text" name="marks_2" id="marks_2" class="textbox width_95 textCenter" /></td>
      </tr>
      <tr>
        <td align="center">Diploma
          <input type="hidden" name="qid_3" value="3" /></td>
        <td align="center"><input type="text" name="passYear_3" id="passYear_3" class="textbox width_95 textCenter" /></td>
        <td align="center"><input type="text" name="stream_3" id="stream_3" class="textbox width_150" /></td>
        <td align="center"><input type="text" name="institute_3" id="institute_3" class="textbox width_150" /></td>
        <td align="center"><input type="text" name="marks_3" id="marks_3" class="textbox width_95 textCenter" /></td>
      </tr>
      <tr>
        <td align="center">Degree
          <input type="hidden" name="qid_4" value="4" /></td>
        <td align="center"><input type="text" name="passYear_4" id="passYear_4" class="textbox width_95 textCenter" /></td>
        <td align="center"><input type="text" name="stream_4" id="stream_4" class="textbox width_150" /></td>
        <td align="center"><input type="text" name="institute_4" id="institute_4" class="textbox width_150" /></td>
        <td align="center"><input type="text" name="marks_4" id="marks_4" class="textbox width_95 textCenter" /></td>
      </tr>
      <tr>
        <td align="center">Masters<input type="hidden" name="qid_5" value="5" /></td>
        <td align="center"><input type="text" name="passYear_5" id="passYear_5" class="textbox width_95 textCenter" /></td>
        <td align="center"><input type="text" name="stream_5" id="stream_5" class="textbox width_150" /></td>
        <td align="center"><input type="text" name="institute_5" id="institute_5" class="textbox width_150" /></td>
        <td align="center"><input type="text" name="marks_5" id="marks_5" class="textbox width_95 textCenter" /></td>
      </tr>
    </table></td>
    </tr>
	
	*/?>
    
 <?php $eduInfo = mysql_query("SELECT * FROM stud_education a RIGHT JOIN qualifications b ON a.qid = b.qid WHERE a.studID=1;");
		$rows = mysql_num_rows($eduInfo);
		$i = 1;
		$qids = array();
		while($res4 = mysql_fetch_array($eduInfo)) {
			$qids[] = $res4['qid'];
			?>
            
            <tr>
        		<td align="center">
					<input type="hidden" name="qid_<?php echo $i;?>" value="<?php echo $res4['qid']; ?>"  />
					<?php echo $res4['qualification'];?></td>
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
					<?php echo $res5['qualification'];?>
                </td>
        		<td align="center"><input type="text" name="passYear_<?php echo $i;?>" id="passYear_<?php echo $i;?>" class="textbox width_95 textCenter" /></td>
        		<td align="center"><input type="text" name="stream_<?php echo $i;?>" id="stream_<?php echo $i;?>" class="textbox width_150" /></td>
        		<td align="center"><input type="text" name="institute_<?php echo $i;?>" id="institute_<?php echo $i;?>" class="textbox width_150" /></td>
        		<td align="center"><input type="text" name="marks_<?php echo $i;?>" id="marks_<?php echo $i;?>" class="textbox width_95 textCenter" /></td>
      		</tr>
            
            <?php
			$i++;
		}
		?>
  <tr>
    <td colspan="6" align="center" height="80"><input type="submit" name="update" id="update" value="Update" class="button width_150"/></td>
  </tr>
    </table>
</td>
    </tr>
</table>

</form>

</div>
</div>

<?php include("../include/footer.php"); ?>

</div> <!--end of container-->
</body>
</html>