<?php include("../include/config.php") ?>
<link rel="stylesheet" type="text/css" href="<?php echo ROOT."/css/style.css"; ?>">
<link rel="stylesheet" type="text/css" href="<?php echo ROOT."/js/jquery-ui/css/base-theme/jquery-ui.css"; ?>">
<script type="text/javascript" src="<?php echo ROOT."/js/jquery-ui/js/jquery-1.8.3.js"; ?>"></script>
<script type="text/javascript" src="<?php echo ROOT."/js/jquery-ui/js/jquery-ui-1.9.2.custom.min.js"; ?>"></script>
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
	font-weight: bold;
	font: "sans-serif", Arial, Helvetica;
	font-size: 12px;
	color: #333;
}
</style>


<?php
require ("../include/validate.php");
$id = $_GET['id'];

//$check
 
$query = mysql_query("SELECT * FROM `advertisements` WHERE adID = '$id'");
while($ary = mysql_fetch_array($query))
{
	$location = $ary['location'];
	$news = $ary['npid'];
	$subject = $ary['subject'];
	$cols = $ary['cols'];
	$cms = $ary['cms'];
	if($ary['date'] != '0000-00-00') {	
	$date = date("d-m-Y",strtotime($ary['date']));
	} else {
	$date = '';
	}
	$rate = $ary['rate'];
	$article = $ary['article']; 
	$matter = $ary['matter'];	
}

if(isset($_POST['update']))
{

	if($_POST['date'] != '') {
	$date = date("Y-m-d", strtotime($_POST['date']));
	} else {
	$date = '0000-00-00';
	}
	
	$file = $_FILES["article"]["name"]; 
	
	if($_FILES["article"]["name"] != '')
	{
	$allowedExts = array("jpg", "jpeg", "gif", "png", "pdf");
	$extension = end(explode(".", $_FILES["article"]["name"]));
		if ((($_FILES["article"]["type"] == "image/gif")
		|| ($_FILES["article"]["type"] == "image/jpeg")
		|| ($_FILES["article"]["type"] == "image/png")
		|| ($_FILES["article"]["type"] == "image/pjpeg")
		|| ($_FILES["article"]["type"] == "application/pdf"))
		&& ($_FILES["article"]["size"] < 256000) // file size in bytes -- 250 KB
		&& in_array($extension, $allowedExts))
		{
			$new_file = time()."_".$_FILES["article"]["name"];
			move_uploaded_file($_FILES["article"]["tmp_name"],"uploads/" . $new_file);
		}
	}
	if($file != ''){
	$article = $new_file; 
	}
	
	$query = mysql_query("UPDATE `advertisements` 
						SET `location` = '".$_POST['location']."', 
						`npID` = '".$_POST['news']."',
						`subject` = '".$_POST['subject']."',
						`cols` = '".$_POST['cols']."',
						`cms` = '".$_POST['cms']."',
						`date` = '".$date."',
						`rate` = '".$_POST['rate']."',
						`article` = '".$article."',						
						`matter` = '".$_POST['matter']."'
						
						WHERE adID = '$id'"); 
}
?>

<script type="text/javascript">
$(function() {

var currentTime = new Date();
var year = currentTime.getFullYear();
		
	$( "#date" ).datepicker({
	changeMonth: true,
	changeYear: true,
	dateFormat: "dd-mm-yy",
	yearRange: (year-1)+':'+(year+1)
	});
	
/************************** Restricting FILE SIZE $ TYPES **************************/
	$('#article').bind('change', function() {
		var fileName = this.files[0].name;
		var fileExtension = fileName.substring(fileName.lastIndexOf('.') + 1);
		
		if(!((fileExtension == 'jpg') 
		|| (fileExtension == 'jpeg') 
		|| (fileExtension == 'gif')
		|| (fileExtension == 'png')
		|| (fileExtension == 'pdf'))) { 
			alert("Please upload files of (jpg,gif,png or pdf) file type. The selected file cannot be uploaded.");
		}
		var size = this.files[0].size/1024/1024;		
		if(size > 0.244141) //maximum file size = 250kb
		{
			alert("Maximum Image size exceeded! The selected file cannot be uploaded.");
		}
	});
	
});

window.onunload = function()
{
	window.opener.location.reload();
	window.close();
};


/************************** Styling FILE UPLOAD Field **************************/
var SITE = SITE || {};        
 
SITE.fileInputs = function() {
  var $this = $(this),
      $val = $this.val(),
      valArray = $val.split('\\'),
      newVal = valArray[valArray.length-1],
      $button = $this.siblings('.button'),
      $fakeFile = $this.siblings('.file-holder');
  if(newVal !== '') {
    $button.text('Chosen File');
    if($fakeFile.length === 0) {
      $button.after('<span class="file-holder">' + newVal + '</span>');
    } else {
      $fakeFile.text(newVal);
    }
  }
};
 
$(document).ready(function() {
  $('.file-wrapper input[type=file]').bind('change focus click', SITE.fileInputs);
});

</script>


<form action="" method="post" enctype="multipart/form-data" name="form1">
  <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#eee">
    <tr>
      <td height="40" bgcolor="#1882A8" colspan="3" align="left"><h2>Edit Advertisement</h2></td>
    </tr>
    <tr><td colspan="3">&nbsp;</td></tr>
    <tr>
      <td width="28%" height="40" align="right"><h5>Location</h5></td>
      <td width="3%" align="center"><h5>:</h5></td>
      <td width="69%"><input name="location" type="text" class="textbox width_200" value="<?php echo $location; ?>"/></td>
    </tr>
    <tr>
      <td height="40" align="right"><h5>Newspaper</h5></td>
      <td align="center"><h5>:</h5></td>
      <td>
      <select name="news" id="news" class="dropdown">
      <?php
	  $qry = mysql_query("SELECT * FROM newspapers");
	  while($ary = mysql_fetch_array($qry)) {
	  	echo "<option value='".$ary['npid']."'";
        if ($ary['npid'] == $news)
        echo "selected = 'selected'";
		echo " class='padding_2'>".$ary['newspaper']."</option>";
	  } ?>
      </select></td>
    </tr>
    <tr>
      <td height="40" align="right"><h5>Subject</h5></td>
      <td align="center"><h5>:</h5></td>
      <td><input name="subject" type="text" class="textbox width_200" value="<?php echo $subject; ?>"/></td>
    </tr>
    <tr>
      <td height="40" align="right"><h5>Advertisement Size</h5></td>
      <td align="center"><h5>:</h5></td>
      <td><h5>
      <input name="cols" type="text" class="textbox width_95 textCenter" value="<?php echo $cols; ?>"/> 
        Cols&nbsp;&nbsp;X &nbsp; 
      <input name="cms" type="text" class="textbox width_95 textCenter" value="<?php echo $cms; ?>"/>
        Cms </h5></td>
    </tr>
    <tr>
      <td height="40" align="right"><h5>Date of Advertisement</h5></td>
      <td align="center"><h5>:</h5></td>
      <td><h5>
      <input name="date" id="date" type="text" class="textbox width_95 textCenter" value="<?php echo $date; ?>"/>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Rate: </b>
      <input name="rate" type="text" class="textbox width_95 textCenter" value="<?php echo $rate; ?>"/> INR </h5>      </td>
    </tr>
    <tr>
      <td height="40" align="right"><h5>Change article</h5></td>
      <td align="center"><h5>:</h5></td>
      <td>
        <div class="file-wrapper">
        <input type="file" name="article" id="article"/>
        <span class="button">Choose a file</span>        </div>      </td>
    </tr>
    <tr>
      <td height="80" align="right" valign="top"><h5>Matter</h5></td>
      <td align="center" valign="top"><h5>:</h5></td>
      <td><textarea name="matter" id="matter" class="textarea width_440"><?php echo $matter; ?></textarea></td>
    </tr>
    <tr>
      <td height="40" align="right">&nbsp;</td>
      <td align="center">&nbsp;</td>
      <td height="40">
      <input type="submit" name="update" value="Update Advertisement" class="button" /></td>
    </tr>
    <tr>
      <td height="40" align="right">&nbsp;</td>
      <td align="center">&nbsp;</td>
      <td height="40">&nbsp;</td>
    </tr>
  </table>
</form>
