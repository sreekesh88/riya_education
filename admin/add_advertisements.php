<?php include ("../include/header.php"); 
//echo $_SESSION['is_admin'];
include ("../include/validate.php"); 
include ("../include/menu.php"); ?>

<script type="text/javascript" src="../js/validate.js"></script>

<?php
$action = isset($_REQUEST['action'])?$_REQUEST['action'] :'';
if($action == 'delete')
{
$query = mysql_query("UPDATE `advertisements` SET delStatus = '1' WHERE adID =".$_REQUEST['id']);
header("location: advertisements.php");
}

$success = '';

if(isset($_POST['submit']))
{
	$loc = $_POST['loc'];
	$npID = $_POST['news'];
	$subject = $_POST['subject'];
	$cols = $_POST['cols'];
	$cms = $_POST['cms'];	
	if($_POST['date'] != '') { $date = date("Y-m-d", strtotime($_POST['date'])); } 
	else { $date = '0000-00-00'; }
	$rate = $_POST['rate'];
	$matter = $_POST['matter'];
	
	$article = '';
	
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
	 	$article = time()."_".$_FILES["article"]["name"];
		move_uploaded_file($_FILES["article"]["tmp_name"],"uploads/" . $article);
	}
	}	
	if($subject != '') {
		$query = mysql_query("INSERT INTO `advertisements` (`location`, `npID`, `subject`, `cols`, `cms`, `date`, `rate`, `article`, `matter`) VALUES ('$loc', '$npID', '$subject', '$cols', '$cms', '$date',  '$rate', '$article', '$matter')");
		if($query>0) {
		$success = "Advertisement added succesfully";
		echo '<META HTTP-EQUIV=Refresh CONTENT="0; URL=add_advertisements.php">';
		//header("refresh:1; url=advertisements.php");
		}
	}
}

?>

<script type="text/javascript">

function edit_advert(id) {
	var left = (screen.width/2)-(650/2);
	var top = (screen.height/2)-(400/2);
	var pop_win = window.open('edit_advert.php?id='+id, '','left='+left+',top='+top+',toolbar=no,menubar=no,scrollbars=yes,width=700,height=440'); 
	
}

function confirm_delete(id)
{
	//alert(id);
	var r=confirm("Are you sure to delete this Seminar?")
	if (r==true)
 	{
  		window.location = "advertisements.php?id="+id+"&action=delete";
  	}
	else
	{
		window.location = "advertisements.php";
	}
}

$(function() {
$.noConflict();
var currentTime = new Date();
var year = currentTime.getFullYear();
		
	$( "#date" ).datepicker({
	changeMonth: true,
	changeYear: true,
	dateFormat: "dd-mm-yy",
	minDate: "0y",
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
 
</script>


<div id="wrapper_top"></div>
<div id="wrapper">

<?php include("../include/left.php"); ?>

<div class="main_col dotted_border">
<div class="fullWidth">
<h2>Advertisements</h2>
<br>       
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tablegeneral">
  <tr>
    <th width="5%">No</th>
    <th width="35%">Title/Subject</th>
    <th width="20%">Newspaper</th>
    <th width="8%">Location</th>
    <th width="12%">Date</th>
    <th width="10%">Rate</th>
    <th width="10%">Actions</th>
  </tr>
  <?php
  $counter = 1;
  $res = mysql_query("SELECT * FROM `advertisements` WHERE delStatus = '0'");
  while($arr = mysql_fetch_array($res)) {
  $id = $arr['adID'];
  if($arr['date'] != '0000-00-00') {	
	$date = date("d-m-Y",strtotime($arr['date']));
	} else {
	$date = '';
	}
  $npID = $arr['npID'];
  $qry1 = mysql_query("SELECT newspaper FROM `newspapers` WHERE npID = '$npID'");
  $ary1 = mysql_fetch_array($qry1);
  $location = $arr['location'];
  ?>	  	
  <tr>
    <td align="center"><?php echo $counter++; ?></td>
    <td align="left" class="padding10">
	<a href="view_advertisements.php?id=<?php echo $id; ?>" title="View Article"><?php echo $arr['subject']; ?></a>
    </td>
    <td align="center"><?php echo $ary1['newspaper']; ?></td>
    <td align="center"><?php echo $location; ?></td>
    <td align="center"><?php echo $date; ?></td>
    <td align="center"><?php echo $arr['rate']; ?></td>
    <td align="center">
    	<a href='#'><img src='../images/edit.png' alt='edit' title='Edit' 
		onclick='return edit_advert(<?php echo $id; ?>)' /></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<a href='#'><img src='../images/delete.png' alt='delete' title='Delete' 
		onclick='return confirm_delete(<?php echo $id; ?>)'/></a>
    </td>
  </tr>
  <?php } ?>
</table>
</div>
<br>
<h6>Add new Advertisement</h6>
<br>
<div class="fullWidth">
<form action="" method="post" enctype="multipart/form-data" name="form1">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="17%" height="50" align="right"><b>Location</b></td>
      <td width="2%" align="center"><b>:</b></td>
      <td width="81%"><input name="loc" type="text" class="textbox width_200"/></td>
    </tr>
    <tr>
      <td height="50" align="right"><b>Newspaper</b></td>
      <td align="center"><b>:</b></td>
      <td>
      <select name="news" id="news" class="dropdown">
      <option value="" selected="selected" class="padding_2">Select One</option>
      <?php
	  $qry = mysql_query("SELECT * FROM newspapers");
	  while($ary = mysql_fetch_array($qry)) {
	  echo "<option value=".$ary['npid']." class='padding_2'>".$ary['newspaper']."</option>";
	  } ?>
      </select></td>
    </tr>
    <tr>
      <td height="50" align="right"><b>Title/Subject</b></td>
      <td align="center"><b>:</b></td>
      <td><input name="subject" type="text" class="textbox width_200"/></td>
    </tr>
    <tr>
      <td height="50" align="right"><b>Advertisement Size </b></td>
      <td align="center"><b>:</b></td>
      <td>
      <input name="cols" type="text" class="textbox width_95 textCenter"/> 
      Cols&nbsp;&nbsp;X &nbsp; 
      <input name="cms" type="text" class="textbox width_95 textCenter"/>
      Cms</td>
    </tr>
    <tr>
      <td height="50" align="right"><b>Date of Ad</b></td>
      <td align="center"><b>:</b></td>
      <td>
      <input name="date" id="date" type="text" class="textbox width_95" /> &nbsp;&nbsp; 
      <b>Rate: </b> <input name="rate" type="text" class="textbox width_95"/> INR      </td>
    </tr>
    <tr>
      <td height="50" align="right">
      <b>Upload the article</b>
      <label style="color:#FF0000;"><br />[File size upto 1MB]</label>      </td>
      <td align="center"><b>:</b></td>
      <td>
        <div class="file-wrapper">
        <input type="file" name="article" id="article"/>
        <span class="button">Choose a file</span>        </div>    </td>
    </tr>
    <tr>
      <td height="50" align="right" valign="top"><b>Matter</b></td>
      <td align="center" valign="top"><b>:</b></td>
      <td><textarea name="matter" id="matter" class="textarea width_440"></textarea></td>
    </tr>
    <tr>
      <td height="100" align="right">&nbsp;</td>
      <td align="center">&nbsp;</td>
      <td height="40">
      <input type="submit" name="submit" id="submit" value="Add Advertisement" class="button width_200" />
      &nbsp;&nbsp;&nbsp;&nbsp;
      <span style="color:#be0000;"><?php echo $success; ?></span></td>
    </tr>
  </table>
</form>
</div>


</div>
</div>

<?php include("../include/footer.php"); ?>

</div> <!--end of container-->
</body>
</html>