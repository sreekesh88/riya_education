<?php include ("../include/header.php"); 
include ("../include/validate.php"); 
include ("../include/menu.php"); 
$empID = $_GET['id'];
?>

<script type="text/javascript" src="../js/validate.js"></script>
<script>
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
$employees = mysql_query("SELECT * FROM `employees` WHERE empID = '$empID'");
while($rows = mysql_fetch_array($employees)) {
	$empCode = $rows['empCode'];
	$branchID = $rows['branchID'];
	$desig = $rows['designation'];
	$gender = $rows['gender'];
	$fname = $rows['fname'];
	$lname = $rows['lname'];
	$password = $rows['password'];
	$confirm = $rows['confirm'];
	$dob = date("d-m-Y", strtotime($rows['dob']));
	$photo = $rows['photo'];
	$areaCode = $rows['areaCode'];
	$phone = $rows['phone'];
	$conCode = $rows['conCode'];
	$mobile = $rows['mobile'];
	$email = $rows['email'];
	$addr1 = $rows['addr1'];
	$addr2 = $rows['addr2'];
	$addr3 = $rows['addr3'];
	
}

if(isset($_POST['update'])) { 

	echo "Pic: ".$file = $_FILES["photo"]["name"]; 
	
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
	if($file != ''){
	$photo = $photo2; 
	}
	
	echo $_POST['password'] = ($_POST['password'] != $password) ? md5($_POST['password']) : $password;
	echo "<br>".$_POST['confirm'] = ($_POST['confirm'] != $confirm) ? md5($_POST['confirm']) : $confirm; 
	$_POST['dob'] = date("Y-m-d", strtotime($_POST['dob']));
	

 	$query = mysql_query("UPDATE `employees` SET `empCode`='".$_POST['empCode']."',
									`branchID`='".$_POST['branch']."',
									`designation`='".$_POST['desig']."',
									`gender`='".$_POST['gender']."',
									`fname`='".$_POST['fname']."',
									`lname`='".$_POST['lname']."',
									`password`='".$_POST['password']."',
									`confirm`='".$_POST['confirm']."',
									`dob`='".$_POST['dob']."',
									`photo`='".$photo."',
									`areaCode`='".$_POST['areaCode']."',
									`phone`='".$_POST['phone']."',
									`conCode`='".$_POST['conCode']."',
									`mobile`='".$_POST['mobile']."',
									`email`='".$_POST['email']."',
									`addr1`='".$_POST['addr1']."',
									`addr2`='".$_POST['addr2']."',
									`addr3`='".$_POST['addr3']."'									
									 WHERE empID = '$empID'");
	
	if($query>0) {
		$success = $fname." ".$lname." has been updated succesfully";
		echo '<META HTTP-EQUIV=Refresh CONTENT="3; URL=view_employees.php">';
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
<h2>Employee Registration</h2>

<form action="" method="post" enctype="multipart/form-data" name="empForm">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="6" height="5"></td>
  </tr>
  <tr>
    <td colspan="6" align="center" height="20">
    <label id="errorFname" class="alert"></label>
    <label id="errorLname" class="alert"></label>
    <label id="errorEmpCode" class="alert"></label>
    <label id="errorGender" class="alert"></label>
    <label id="errorDesig" class="alert"></label>
    <label id="errorBranch" class="alert"></label>
    <label id="errorPassword" class="alert"></label>
    <label id="errorConfirm" class="alert"></label>    
    <label id="errorDob" class="alert"></label>
    <label id="errorEmail" class="alert"></label>
    <label id="errorMobile" class="alert"></label>
    <label id="errorAddress" class="alert"></label>
    
    <span style="float:right;color:#BC7E23;"><!--***All fields are mandatory--></span>    </td>
    </tr>
  <tr>
    <td width="15%" height="35">Name</td>
    <td width="2%">:</td>
    <td width="33%" align="left">
    <span class="right_5"><input type="text" name="fname" id="fname" class="textbox width_95" style="color:#1A7BB2;" value="<?php echo $fname; ?>"/>
    </span>
    <span><input type="text" name="lname" id="lname" class="textbox width_95" style="color:#1A7BB2;" value="<?php echo $lname; ?>" />
    </span></td>
    <td width="18%">Employee Code</td>
    <td width="2%">:</td>
    <td width="30%">
      <input type="text" name="empCode" id="empCode" class="textbox width_200" value="<?php echo $empCode; ?>" />    </td>
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
    <td>Password</td>
    <td>:</td>
    <td>
      <input type="password" name="password" id="password" class="textbox width_200" value="<?php echo $password; ?>"/>    </td>
  </tr>
  <tr>
    <td height="35">Designation</td>
    <td>:</td>
    <td>
      <input type="text" name="desig" id="desig" class="textbox width_200" value="<?php echo $desig; ?>" />    </td>
    <td>Confirm Password</td>
    <td>:</td>
    <td>
      <input type="password" name="confirm" id="confirm" class="textbox width_200" value="<?php echo $confirm; ?>" />    </td>
  </tr>
  <tr>
    <td height="35">Branch</td>
    <td>:</td>
    <td>
    <select name="branch" id="branch" class="dropdown">
    <option value="" selected="selected" class="padding_2">Select</option>
    <?php
	$res = mysql_query("SELECT * FROM `branches` WHERE delStatus = '0'");
	while($arr = mysql_fetch_array($res)) {
	echo '<option value="'.$arr['branchID'].'" class="padding_2"';
	if($arr['branchID'] == $branchID)
	echo 'selected = "selected"';
	echo '>'.$arr['branch'].'</option>';
	}
    ?>
    </select>    </td>
    <td>Date of Birth</td>
    <td>:</td>
    <td>
      <input type="text" name="dob" id="dob" class="textbox" style="text-align:center; width:120px;" value="<?php echo $dob; ?>" />&nbsp;&nbsp; [dd-mm-yyyy]    </td>
  </tr>
  <tr>
    <td colspan="6">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="6"><h6>Official Info</h6></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="35">Mobile</td>
    <td>:</td>
    <td>
      <span class="right_5"><input type="text" name="conCode" id="conCode" class="textbox width_40 textCenter" value="<?php echo $conCode; ?>" /></span>
      <span><input type="text" name="mobile" id="mobile" class="textbox width_150 textCenter" maxlength="10" value="<?php echo $mobile; ?>" /></span>    </td>
    <td>Phone</td>
    <td>:</td>
    <td>
      <span class="right_5"><input type="text" name="areaCode" id="areaCode" class="textbox width_40 textCenter" value="<?php echo $areaCode; ?>" /></span>
      <span><input type="text" name="phone" id="phone" class="textbox width_150 textCenter" value="<?php echo $phone; ?>" /></span>    </td>
  </tr>
  <tr>
    <td height="35">Email</td>
    <td>:</td>
    <td><input type="text" name="email" id="email" class="textbox width_200" value="<?php echo $email; ?>" /></td>
    <td>Upload Photo </td>
    <td>:</td>
    <td>
    <div class="file-wrapper">
    <input type="file" name="photo" id="photo" onchange="readURL(this);"/>
    <span class="button">Choose a file</span>    </div></td>
  </tr>
  <tr>
    <td valign="top">Address</td>
    <td valign="top">:</td>
    <td valign="top">
    <div class="addressBox">
    <input type="text" name="addr1" id="addr1" class="addrInput" value="<?php echo $addr1; ?>"/>
    <input type="text" name="addr2" id="addr2" class="addrInput" value="<?php echo $addr2; ?>"/>
    <input type="text" name="addr3" id="addr3" class="addrInput" value="<?php echo $addr3; ?>"/>
    </div>    </td>
    <td valign="top">&nbsp;</td>
    <td valign="top">:</td>
    <td valign="top">
    <img id="imgPr1" src="<?php echo ROOT."/admin/photos/".$photo ?>" width="70" height="90" alt="preview" style="border: 5px solid #ccc;" /></td>
  </tr>
  <tr>
    <td height="80" colspan="6" align="center"><input type="submit" name="update" id="update" value="Update" class="button width_150"/>
&nbsp;&nbsp; <span class="alert" id="success"><?php echo $success; ?></span></td>
    </tr>
</table>
</form>

</div>
</div>

<?php include("../include/footer.php"); ?>

</div> <!--end of container-->
</body>
</html>
