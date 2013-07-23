<?php include ("../include/header.php"); 
include ("../include/validate.php"); 
include ("../include/menu.php"); ?>

<script type="text/javascript" src="../js/validate.js"></script>
<script>
$(function() {

var currentTime = new Date();
var year = currentTime.getFullYear();
		
	$("#dob").datepicker({
	changeMonth: true,
	changeYear: true,
	dateFormat: "dd-mm-yy",
	yearRange: 1950+':'+(year-18) 
	});

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
if(isset($_POST['submit'])) {

	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$gender = $_POST['gender'];
	$branchID = $_POST['branch'];
	$deptID = $_POST['deptID'];
	$desig = $_POST['desig'];
	$username = $_POST['username'];
	$password = md5($_POST['password']);
	$confirm = md5($_POST['confirm']);
	$dob = date("Y-m-d", strtotime($_POST['dob']));
	$conCode = $_POST['conCode'];
	$mobile = $_POST['mobile'];
	$areaCode = $_POST['areaCode'];
	$phone = $_POST['phone'];
	$email = $_POST['email'];
	$skype = $_POST['skype'];
	$gtalk = $_POST['gtalk'];
	$date = date("Y-m-d");
	
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
	
	if($fname != "firstname") {
		$qry = mysql_query("INSERT INTO `employees` (`date`, `branchID`, `deptID`, `designation`, `gender`, `fname`, `lname`, `username`, `password`, `confirm`, `dob`, `photo`, `areaCode`, `phone`, `conCode`, `mobile`, `email`, `skype`, `gtalk`) VALUES ('$date', '$branchID', '$deptID', '$desig', '$gender', '$fname', '$lname', '$username',   '$password', '$confirm', '$dob', '$photo', '$areaCode', '$phone', '$conCode', '$mobile', '$email', '$skype', '$gtalk')");
		if($qry>0) {
			$success = $fname." ".$lname." has been added succesfully";
			echo '<META HTTP-EQUIV=Refresh CONTENT="3; URL=add_employee.php">';
			?>    
			<script language='javascript'>
            setTimeout("$('#success').fadeOut('slow')", 3000);
            </script>
            <?php
		} 
	}

}
?>

<div id="wrapper_top"></div>
<div id="wrapper">

<?php include("../include/left.php"); ?>

<div class="main_col dotted_border">
<h2>Employee Registration</h2>

<form action="" method="post" enctype="multipart/form-data" name="empForm">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="6" height="5"></td>
  </tr>
  <tr>
    <td colspan="6" align="center" height="20">
    
	</td>
    </tr>
  <tr>
    <td width="15%" height="18" valign="top">Name</td>
    <td width="2%" valign="top">:</td>
    <td width="33%" align="left" valign="top">
    <span class="right_5">
    <input type="text" name="fname" id="fname" class="textbox width_95" placeholder="firstname"/></span>
    <span><input type="text" name="lname" id="lname" class="textbox width_95" placeholder="lastname" /></span>
    </td>
    <td colspan="3" rowspan="2" align="center" style="border-left: 1px solid #ccc;"><img id="imgPr1" src="<?php echo ROOT."/admin/photos/default-img.png" ?>" width="70" height="90" alt="preview" style="border: 5px solid #ccc;"/>        </td>
    </tr>
  <tr>
    <td width="15%" height="17">Gender</td>
    <td width="2%">:</td>
    <td align="left"><input name="gender" id="gender" type="radio" value="1" />
Male
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <input name="gender" id="gender" type="radio" value="2" />
Female </td>
  </tr>
  <tr>
    <td height="35" valign="top">Date of Birth</td>
    <td valign="top">:</td>
    <td valign="top"><input type="text" name="dob" id="dob" class="textbox textCenter width_200"/></td>
    <td colspan="3" align="center" style="border-left: 1px solid #ccc;"><div class="file-wrapper">
      <input type="file" name="photo" id="photo" onchange="readURL(this);"/>
      <span class="button">Upload Photo</span></div></td>
    </tr>
  <tr>
    <td colspan="6" height="60"><h6>Official Info</h6></td>
  </tr>
  <tr>
    <td height="35">Branch</td>
    <td>:</td>
    <td><select name="branch" id="branch" class="dropdown">
      <option value="" selected="selected" class="padding_2">Select</option>
      <?php
	$res = mysql_query("SELECT * FROM `branches` WHERE delStatus = '0'");
	while($arr = mysql_fetch_array($res)) {
	echo '<option value="'.$arr['branchID'].'" class="padding_2">'.$arr['branch'].'</option>';
	}
    ?>
    </select></td>
    <td width="18%">Skype Id</td>
    <td width="2%">:</td>
    <td width="30%"><input type="text" name="skype" id="skype" class="textbox width_200" /></td>
  </tr>
  <tr>
    <td height="35">Department</td>
    <td>:</td>
    <td>
    <select name="deptID" id="deptID" class="dropdown">
    <option value="" selected="selected" class="padding_2">Select</option>
    <?php
	$depts = mysql_query("SELECT * FROM `departments`");
	while($rows = mysql_fetch_array($depts)) {
		echo '<option value="'.$rows['deptID'].'" class="padding_2">'.$rows['department'].'</option>';
	}
	?>
    </select>
    </td>
    <td>Gtalk Id</td>
    <td>:</td>
    <td><input type="text" name="gtalk" id="gtalk" class="textbox width_200" /></td>
  </tr>
  <tr>
    <td height="35">Designation</td>
    <td>:</td>
    <td><input type="text" name="desig" id="desig" class="textbox width_200" /></td>
    <td colspan="3" bgcolor="#e1e1e1" class="red" style="border-bottom: 1px solid #F5F5F5;">&nbsp;&nbsp;
    <strong>Login Credentials</strong></td>
    </tr>
  <tr>
    <td height="30" valign="top">Mobile</td>
    <td valign="top">:</td>
    <td valign="top"><span class="right_5">
      <input type="text" name="conCode" id="conCode" class="textbox width_60" value="91" style="text-align:center"/>
    </span> <span>
    <input type="text" name="mobile" id="mobile" class="textbox" style="width:130px;" maxlength="10" />
    </span></td>
    <td bgcolor="#E1E1E1" class="blue">&nbsp;&nbsp;Login Name</td>
    <td bgcolor="#E1E1E1">:</td>
    <td bgcolor="#E1E1E1"><input type="text" name="username" id="username" class="textbox width_200"/></td>
  </tr>
  <tr>
    <td height="30" valign="top">Phone (Official)</td>
    <td valign="top">:</td>
    <td valign="top"><span class="right_5"><input type="text" name="areaCode" id="areaCode" class="textbox width_60" style="text-align:center" /></span>
      <span><input type="text" name="phone" id="phone" class="textbox" style="width:130px;"/></span></td>
    <td bgcolor="#E1E1E1" class="blue">&nbsp;&nbsp;Password</td>
    <td bgcolor="#E1E1E1">:</td>
    <td bgcolor="#E1E1E1"><input type="text" name="password" id="password" class="textbox width_200" /></td>
  </tr>
  <tr>
    <td height="30" valign="top">Email</td>
    <td valign="top">:</td>
    <td valign="top"><input type="text" name="email" id="email" class="textbox width_200" /></td>
    <td bgcolor="#E1E1E1" class="blue">&nbsp;&nbsp;Confirm Password</td>
    <td bgcolor="#E1E1E1">:</td>
    <td bgcolor="#E1E1E1"><input type="text" name="confirm" id="confirm" class="textbox width_200" /></td>
  </tr>
  <tr>
    <td height="80"></td>
    <td>&nbsp;</td>
    <td><input type="submit" name="submit" id="submit" value="Submit" class="button width_150"/>
	&nbsp;&nbsp; <span class="alert" id="success"><?php echo $success; ?></span></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</form>

</div>
</div>

<?php include("../include/footer.php"); ?>

</div> <!--end of container-->
</body>
</html>
