<?php include ("../include/header.php"); 
include ("../include/validate.php"); 
include ("../include/menu.php"); ?>

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

$(document).on('click','#ms2',function() {
	$("#spDetails").show();
});

$(document).on('click','#ms1',function() {
	$("#spDetails").hide();
});


$(function() {

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
	minDate: "0y",
	yearRange: (year)+':'+(year+5) 
	});

});

function addRowToTable(table, row) {
    table.append(row);
}

$(document).ready(function() {
    var index = 1;
	$('#addRow_comp').click(function() {
		index++;
		var row = "<tr><td colspan='2' height='30' align='left'><input type='text' name='delegates[]' id='delegates_"+index+"' class='textbox width_150'/></td></tr>";
		
		
		var row = "<tr><td align='center'>"+index+"</td><td align='center'><input type='text' name='company_"+index+"' id='company_"+index+"' class='textbox width_200' /></td><td align='center'><input type='text' name='desig_"+index+"' id='desig_"+index+"' class='textbox width_150' /></td><td align='center'><input type='text' name='wdFrom_"+index+"' id='wdFrom_"+index+"' class='textbox width_95 textCenter'/></td><td align='center'><input type='text' name='wdTo_"+index+"' id='wdTo_"+index+"' class='textbox width_95 textCenter' /></td></tr>";
		
        addRowToTable($('#generate_comp'), row);
		$('#lastRow').val(index);
    });
	
});

function getEduOthers(id)
{	
	$.ajax({
		url: "get_eduOthers.php?id="+id,
		success: function(data){
			$("#edu_others").html(data);
		}   
	});
}
function getPgmOthers(id)
{	
	$.ajax({
		url: "get_pgmOthers.php?id="+id,
		success: function(data){
			$("#pgmPref").html(data);
		}   
	});
}

</script>

<?php
if(isset($_POST['submit'])) {

	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$gender = $_POST['gender'];
	if($_POST['dob'] != '') { $dob = date("Y-m-d", strtotime($_POST['dob'])); }
	$married = $_POST['married'];	
	$spName = $_POST['spName'];	
	$spOccupation = $_POST['spOccupation'];	
	$gdName = $_POST['gdName'];	
	$gdOccupation = $_POST['gdOccupation'];	
	$program = $_POST['program'];
	$pgmOthers = $_POST['pgmOthers'];	
	$country = $_POST['country'];
	$photo = '';	
	
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
	
	$date = date("Y-m-d");	
    $branchID = $info['branchID'];
	$empCode = $info['empCode'];
	
	$result = mysql_query("SELECT lastInc FROM `students` ORDER BY lastInc DESC LIMIT 1");	
	while($ary = mysql_fetch_array($result)) {
	$lastInc = $ary['lastInc'];
	}
	if ($lastInc == '') { 
		$lastInc = 1; 
		$counter = $lastInc;
		$regNo = "RE".date("my").$counter;
	} else {
		$counter = $lastInc + 1;
		$regNo = "RE".date("my").$counter;
	}
	
	if($fname != "firstname") {	
		$students = mysql_query("INSERT INTO `students` (`empCode`, `regNo`, `branchID`, `date`, `gender`, `fname`, `lname`, `dob`, `photo`, `married`, `spName`, `spOccupation`, `gdName`, `gdOccupation`, `program`, `pgmOthers`, `country`, `lastInc`) VALUES ('$empCode', '$regNo', '$branchID', '$date', '$gender', '$fname', '$lname', '$dob', '$photo', '$married', '$spName', '$spOccupation', '$gdName', '$gdOccupation', '$program', '$pgmOthers', '$country', '$counter')");
		
		$studID = mysql_insert_id();
	}
		
	$conCode = $_POST['conCode'];
	$mobile = $_POST['mobile'];
	$areaCode = $_POST['areaCode'];
	$phone = $_POST['phone'];
	$email = $_POST['email'];
	$addr1 = $_POST['addr1'];
	$addr2 = $_POST['addr2'];
	$addr3 = $_POST['addr3'];
	$pincode = $_POST['pincode'];	
	$district = $_POST['district'];	
	$state = $_POST['state'];
	
	if($email != '') {
		$contact = mysql_query("INSERT INTO `stud_contact` (`studID`, `conCode`, `mobile`, `areaCode`, `phone`, `email`, `addr1`, `addr2`, `addr3`, `pincode`, `district`, `state`) VALUES ('$studID', '$conCode', '$mobile', '$areaCode', '$phone', '$email', '$addr1', '$addr2', '$addr3', '$pincode', '$district', '$state')");
	}
	
	$j = $_POST['lastRow']; 
	if($_POST['company_1'] != '') { 
		for($i=1;$i<=$j;$i++) {
			$companies = $_POST['company_'.$i];	
			$desig = $_POST['desig_'.$i];	
			$wdFrom = $_POST['wdFrom_'.$i];
			$wdTo = $_POST['wdTo_'.$i];	
			
			$employment = mysql_query("INSERT INTO `stud_employment` (`studID`, `companies`, `designation`, `wdFrom`, `wdTo`) VALUES ('$studID', '$companies', '$desig', '$wdFrom', '$wdTo')");
		}
	}
		
	$passNum = $_POST['passNum'];		
	if($_POST['expiry'] != '') { $expiry = date("Y-m-d", strtotime($_POST['expiry'])); }
	$visaNum = $_POST['visaNum'];	
	if($_POST['fromDate'] != '') { $fromDate = date("Y-m-d", strtotime($_POST['fromDate'])); }
	if($_POST['toDate'] != '') { $toDate = date("Y-m-d", strtotime($_POST['toDate'])); }	 
	
	if($passNum != '') {
		$details = mysql_query("INSERT INTO `stud_details` (`studID`, `passNum`, `expiry`, `visaNum`, `fromDate`, `toDate`) VALUES ('$studID', '$passNum', '$expiry', '$visaNum', '$fromDate', '$toDate')");
	}
	
	for($i=1;$i<=6;$i++) {
		if($_POST['passYear_'.$i] != '') {
			$qid = $_POST['qid_'.$i]; 
			$otherQlfn = $_POST['otherQlfn'];
			$passYear = $_POST['passYear_'.$i];
			$stream = $_POST['stream_'.$i];
			$institute = $_POST['institute_'.$i];
			$marks = $_POST['marks_'.$i];
			
			$qualification = mysql_query("INSERT INTO `stud_education` (`studID`, `qid`, `otherQlfn`, `year`, `stream`, `institution`, `marks`) VALUES ('$studID', '$qid', '$otherQlfn', '$passYear', '$stream', '$institute', '$marks')");
		}
	}
	
	if($students > 0) {
		$success = $fname." ".$lname." has been added succesfully";
		//echo '<META HTTP-EQUIV=Refresh CONTENT="3; URL=add_student.php">';
		?>    
		<script language='javascript'>
		setTimeout("$('#success').fadeOut('slow')", 3000);
		</script>
		<?php
	}
	
}
?>

<div id="wrapper_top"></div>
<div id="wrapper">
<?php include("../include/left.php"); ?>
<div class="main_col dotted_border">
<h2>Student Registration</h2>

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
    <span class="right_5"><input type="text" name="fname" id="fname" class="textbox width_95" style="color:#1A7BB2;" value="firstname"  onblur="if(this.value == '') { this.value='firstname'}" onfocus="if (this.value == 'firstname') {this.value=''}" /></span>
    <span><input type="text" name="lname" id="lname" class="textbox width_95" style="color:#1A7BB2;" value="lastname" onblur="if(this.value == '') { this.value='lastname'}" onfocus="if (this.value == 'lastname') {this.value=''}"/></span>    </td>
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
    <input name="gender" id="gender" type="radio" value="1" /> Male
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <input name="gender" id="gender" type="radio" value="2" /> Female    </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td width="30%" rowspan="3" valign="top">
    <img id="imgPr1" src="<?php echo ROOT."/employee/photos/default-img.png" ?>" width="70" height="90" alt="preview" style="border: 5px solid #ccc;" />    </td>
  </tr>
  <tr>
    <td height="35">Date of Birth</td>
    <td>:</td>
    <td><input type="text" name="dob" id="dob" class="textbox" style="text-align:center; width:120px;" />&nbsp;&nbsp; [dd-mm-yyyy]</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
  <tr>
    <td height="35">Marital Status</td>
    <td>:</td>
    <td>
    <input name="married" id="ms1" type="radio" value="1" checked="checked" /> No
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <input name="married" id="ms2" type="radio" value="2" /> Yes    </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="6">
        <div id="spDetails" style="display:none;">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="15%" height="35">Spouse Name</td>
            <td width="2%">:</td>
            <td width="33%"><input type="text" name="spName" id="spName" class="textbox width_200" /></td>
            <td width="18%">Occupation</td>
            <td width="2%">:</td>
            <td width="30%"><input type="text" name="spOccupation" id="spOccupation" class="textbox width_200" /></td>
          </tr>
        </table>
        </div>    </td>
  </tr>
  <tr>
    <td height="35">Guardian Name</td>
    <td>:</td>
    <td><input type="text" name="gdName" id="gdName" class="textbox width_200" /></td>
    <td>Occupation</td>
    <td>:</td>
    <td><input type="text" name="gdOccupation" id="gdOccupation" class="textbox width_200" /></td>
  </tr>
  <tr>
    <td height="35">Preferred Program</td>
    <td>:</td>
    <td>
    <select name="program" id="program" class="dropdown" onchange="return getPgmOthers(this.value)">;
    <option value="" selected="selected" class="padding_2">Select</option>
    <?php
	$res1 = mysql_query("SELECT * FROM `programs` WHERE delStatus = '0'");
	while($arr1 = mysql_fetch_array($res1)) {
	echo '<option value="'.$arr1['pgmID'].'" class="padding_2">'.$arr1['program'].'</option>';
	}
    ?>
    <option value="0" class="padding_2">Others</option>
    </select> </td>
    <td>Preferred Country</td>
    <td>:</td>
    <td>
    <select name="country" id="country" class="dropdown">
    <option value="" selected="selected" class="padding_2">Select</option>
    <?php
	$res2 = mysql_query("SELECT * FROM `countries` WHERE delStatus = '0'");
	while($arr2 = mysql_fetch_array($res2)) {
	echo '<option value="'.$arr2['conID'].'" class="padding_2">'.$arr2['country'].'</option>';
	}
    ?>
    </select></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><div id="pgmPref"></div></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="60" colspan="6"><h6>Contact Info</h6></td>
    </tr>
  <tr>
    <td height="35">Mobile</td>
    <td>:</td>
    <td>
      <span class="right_5"><input type="text" name="conCode" id="conCode" class="textbox width_40" value="91" style="text-align:center"/></span>
      <span><input type="text" name="mobile" id="mobile" class="textbox width_150" maxlength="10" /></span>    </td>
    <td>Phone</td>
    <td>:</td>
    <td>
      <span class="right_5"><input type="text" name="areaCode" id="areaCode" class="textbox width_40" style="text-align:center" /></span>
      <span><input type="text" name="phone" id="phone" class="textbox width_150" /></span>    </td>
  </tr>
  <tr>
    <td height="35">Email</td>
    <td>:</td>
    <td><input type="text" name="email" id="email" class="textbox width_200" /></td>
    <td>Address</td>
    <td>:</td>
    <td rowspan="4">
    <div class="addressBox">
    <input type="text" name="addr1" id="addr1" class="addrInput"/>
    <input type="text" name="addr2" id="addr2" class="addrInput"/>
    <input type="text" name="addr3" id="addr3" class="addrInput"/>
    </div>    </td>
  </tr>
  <tr>
    <td height="35">Pincode</td>
    <td>:</td>
    <td><input type="text" name="pincode" id="pincode" class="textbox width_200" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
  <tr>
    <td height="35">District</td>
    <td>:</td>
    <td><input type="text" name="district" id="district" class="textbox width_200" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
  <tr>
    <td height="35">State</td>
    <td>:</td>
    <td>
    <select name="state" id="state" class="dropdown">
    <option value="" selected="selected" class="padding_2">Select</option>
    <?php
	$res3 = mysql_query("SELECT * FROM `states`");
	while($arr3 = mysql_fetch_array($res3)) {
	echo '<option value="'.$arr3['stateID'].'" class="padding_2"';
	if($arr3['stateID'] == '10')
	echo 'selected="selected"';
	echo '>'.$arr3['state'].'</option>';
	}
    ?>
    </select>    </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
  <tr>
    <td height="60" colspan="6"><h6>Employment History  <span id="addRow_comp" class="anchor" title="Add Company" style="float:right">Add another Company [+]</span></h6></td>
  </tr>
  <tr>
    <td colspan="6"><input name="lastRow" id="lastRow" type="hidden" value="" />
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table" id="generate_comp">
      <tr>
        <th width="5%">No</th>
        <th>Company</th>
        <th>Designation</th>
        <th>Date of Working from</th>
        <th>To</th>
      </tr>
      <tr>
        <td align="center">1</td>
        <td align="center"><input type="text" name="company_1" id="company_1" class="textbox width_200" /></td>
        <td align="center"><input type="text" name="desig_1" id="desig_1" class="textbox width_150" /></td>
        <td align="center"><input type="text" name="wdFrom_1" id="wdFrom_1" class="textbox width_95 textCenter"/></td>
        <td align="center"><input type="text" name="wdTo_1" id="wdTo_1" class="textbox width_95 textCenter" /></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="60" colspan="6"><h6>Passport Info</h6></td>
  </tr>
  <tr>
    <td height="35">Passport Number</td>
    <td>:</td>
    <td><input type="text" name="passNum" id="passNum" class="textbox width_200" /></td>
    <td>Date of Expiry</td>
    <td>:</td>
    <td><input type="text" name="expiry" id="expiry" class="textbox width_200 textCenter" /></td>
  </tr>
  <tr>
    <td height="35">Visa Number</td>
    <td>:</td>
    <td><input type="text" name="visaNum" id="visaNum" class="textbox width_200" /></td>
    <td>Duration Dates</td>
    <td>:</td>
    <td>
    <span class="right_5"><input type="text" name="fromDate" id="fromDate" class="textbox width_95 textCenter" /></span>
    <span><input type="text" name="toDate" id="toDate" class="textbox width_95 textCenter" /></span></td>
  </tr>
  <tr>
    <td height="60" colspan="6"><h6>Academic Info</h6></td>
  </tr>
  <tr>
    <td colspan="6">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tablegeneral">
      <tr>
        <th width="20%">Qualification</th>
        <th>Passing Year</th>
        <th>Stream</th>
        <th>Institution</th>
        <th>Marks (%)</th>
      </tr>
      <tr>
        <td align="center">Xth<input type="hidden" name="qid_1" value="1" /></td>
        <td align="center">
        <select name="passYear_1" id="passYear_1" class="dropdown" style="width:75px;">
         <option value="" class="padding_2" selected="selected">Select</option>
         <?php
		 $current = date(Y);
		 for($i=1990;$i<=$current;$i++) {
         	echo '<option value="'.$i.'" class="padding_2">'.$i.'</option>';
		 }
		 ?>
        </select>        </td>
        <td align="center"><input type="text" name="stream_1" id="stream_1" class="textbox width_150" /></td>
        <td align="center"><input type="text" name="institute_1" id="institute_1" class="textbox width_150" /></td>
        <td align="center"><input type="text" name="marks_1" id="marks_1" class="textbox width_60 textCenter" /></td>
      </tr>
      <tr>
        <td align="center">XIIth<input type="hidden" name="qid_2" value="2" /></td>
        <td align="center">
        <select name="passYear_2" id="passYear_2" class="dropdown" style="width:75px;">
         <option value="" class="padding_2" selected="selected">Select</option>
         <?php
		 $current = date(Y);
		 for($i=1990;$i<=$current;$i++) {
         	echo '<option value="'.$i.'" class="padding_2">'.$i.'</option>';
		 }
		 ?>
        </select>        </td>
        <td align="center"><input type="text" name="stream_2" id="stream_2" class="textbox width_150" /></td>
        <td align="center"><input type="text" name="institute_2" id="institute_2" class="textbox width_150" /></td>
        <td align="center"><input type="text" name="marks_2" id="marks_2" class="textbox width_60 textCenter" /></td>
      </tr>
      <tr>
        <td align="center">Diploma
          <input type="hidden" name="qid_3" value="3" /></td>
        <td align="center">
        <select name="passYear_3" id="passYear_3" class="dropdown" style="width:75px;">
         <option value="" class="padding_2" selected="selected">Select</option>
         <?php
		 $current = date(Y);
		 for($i=1990;$i<=$current;$i++) {
         	echo '<option value="'.$i.'" class="padding_2">'.$i.'</option>';
		 }
		 ?>
        </select>        </td>
        <td align="center"><input type="text" name="stream_3" id="stream_3" class="textbox width_150" /></td>
        <td align="center"><input type="text" name="institute_3" id="institute_3" class="textbox width_150" /></td>
        <td align="center"><input type="text" name="marks_3" id="marks_3" class="textbox width_60 textCenter" /></td>
      </tr>
      <tr>
        <td align="center">Degree
          <input type="hidden" name="qid_4" value="4" /></td>
        <td align="center">
        <select name="passYear_4" id="passYear_4" class="dropdown" style="width:75px;">
         <option value="" class="padding_2" selected="selected">Select</option>
         <?php
		 $current = date(Y);
		 for($i=1990;$i<=$current;$i++) {
         	echo '<option value="'.$i.'" class="padding_2">'.$i.'</option>';
		 }
		 ?>
        </select>        </td>
        <td align="center"><input type="text" name="stream_4" id="stream_4" class="textbox width_150" /></td>
        <td align="center"><input type="text" name="institute_4" id="institute_4" class="textbox width_150" /></td>
        <td align="center"><input type="text" name="marks_4" id="marks_4" class="textbox width_60 textCenter" /></td>
      </tr>
      <tr>
        <td align="center">Masters<input type="hidden" name="qid_5" value="5" /></td>
        <td align="center">
        <select name="passYear_5" id="passYear_5" class="dropdown" style="width:75px;">
         <option value="" class="padding_2" selected="selected">Select</option>
         <?php
		 $current = date(Y);
		 for($i=1990;$i<=$current;$i++) {
         	echo '<option value="'.$i.'" class="padding_2">'.$i.'</option>';
		 }
		 ?>
        </select>        </td>
        <td align="center"><input type="text" name="stream_5" id="stream_5" class="textbox width_150" /></td>
        <td align="center"><input type="text" name="institute_5" id="institute_5" class="textbox width_150" /></td>
        <td align="center"><input type="text" name="marks_5" id="marks_5" class="textbox width_60 textCenter" /></td>
      </tr>
      <tr>
        <td align="center"><input name="eduOthers" id="eduOthers" type="checkbox" value="6" onclick="return getEduOthers(this.value);"/> 
        <span id="edu_others"> Others</span>        </td>
        <td align="center">
        <select name="passYear_6" id="passYear_6" class="dropdown" style="width:75px;">
         <option value="" class="padding_2" selected="selected">Select</option>
         <?php
		 $current = date(Y);
		 for($i=1990;$i<=$current;$i++) {
         	echo '<option value="'.$i.'" class="padding_2">'.$i.'</option>';
		 }
		 ?>
        </select>        </td>
        <td align="center"><input type="text" name="stream_6" id="stream_6" class="textbox width_150" /></td>
        <td align="center"><input type="text" name="institute_6" id="institute_6" class="textbox width_150" /></td>
        <td align="center"><input type="text" name="marks_6" id="marks_6" class="textbox width_60 textCenter" /></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="6">&nbsp;</td>
  </tr>
  <tr>
    <td height="60" colspan="6" class="red">Q. How did you know about Riya Education?</td>
  </tr>
  <tr>
    <td colspan="6"><table width="80%" border="0" cellspacing="0" cellpadding="0" class="pad">
      <tr>
        <td width="37%"><input type="radio" name="radio" id="radio" value="radio" />
          Tele-calling</td>
        <td width="63%"><input type="radio" name="radio4" id="radio4" value="radio4" /> 
          Newspaper</td>
      </tr>
      <tr>
        <td><input type="radio" name="radio2" id="radio2" value="radio2" /> 
          Friends/Family</td>
        <td><input type="radio" name="radio5" id="radio5" value="radio5" /> 
          IELTS Centre</td>
      </tr>
      <tr>
        <td><input type="radio" name="radio3" id="radio3" value="radio3" /> 
          Riya Employee</td>
        <td><input type="radio" name="radio6" id="radio6" value="radio6" /> 
        Others 
          <input type="text" name="textfield" id="textfield" /></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="60" colspan="6"><span class="red">Q. Have you ever taken an English language test?</span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <input type="radio" name="radio7" id="radio7" value="radio7" />
      Yes&nbsp;&nbsp;&nbsp;
      <input type="radio" name="radio8" id="radio8" value="radio8" /> 
      No</td>
  </tr>
  <tr>
    <td colspan="6"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="32%">What was your band score? </td>
          <td width="2%">:</td>
          <td width="66%">Overall 
            <input type="text" name="textfield2" id="textfield2" /> 
            &nbsp;S&nbsp;
            <input type="text" name="textfield3" id="textfield3" />
            &nbsp;R&nbsp;
            <input type="text" name="textfield4" id="textfield4" /></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>W&nbsp;
            <input type="text" name="textfield5" id="textfield5" />
            &nbsp;L&nbsp;
            <input type="text" name="textfield6" id="textfield6" /></td>
        </tr>
        <tr>
          <td>Date of Examination</td>
          <td>:</td>
          <td><input type="text" name="textfield7" id="textfield7" /></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td colspan="6" align="center" height="90">
    <input type="submit" name="submit" id="submit" value="Register" class="button width_150"/>	</td>
    </tr>
</table>

</form>

</div>
</div>

<?php include("../include/footer.php"); ?>

</div> <!--end of container-->
</body>
</html>