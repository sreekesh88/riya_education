<?php 
date_default_timezone_set("Asia/Kolkata");
include ("../include/header.php"); 
include ("../include/validate.php"); 
include ("../include/menu.php"); 
$empCode = $info['empCode'];
$studID = $_GET['sid'];

?>

<script type="text/javascript" src="../js/validate.js"></script>
<script type="text/javascript">
/*********** Ajax Function ***********/
$(document).ready(function(){
  $("#docID").change(function(){ 
	var id=$("#docID").val();
    $("#getDoc").load("get_doc.php?id="+id);
  });
});

/*********** File size restriction ***********/
$(function() {
$('#uploads').bind('change', function() {
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
			alert("Maximum File size exceeded! The selected file cannot be uploaded.");
		}
	});
});

</script>

<div id="wrapper_top"></div>
<div id="wrapper">
<?php include("../include/left_stud.php"); ?>
<div class="main_col dotted_border">
<h2>Documents</h2>
<br />

<div class="fullWidth">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tablegeneral">
  <tr>
    <th width="10%">No</th>
    <th width="50%">Document</th>
    <th width="20%">Submitted on</th>
    <th width="20%">Actions</th>
  </tr>
<?php
$counter = 1;
$result = mysql_query("SELECT * FROM `stud_docs` WHERE studID = '$studID' AND delStatus = '0'");
$rows = mysql_num_rows($result);
if($rows == '0') {
  echo '<tr><td colspan="4" align="center" class="alert" height="30">No Documents collected yet!</td></tr>';	
} else {
while($ary = mysql_fetch_array($result)) {
	$tbID = $ary['tbID'];
	$docID = $ary['docID'];
	$otherDoc = $ary['otherDoc'];
	$uploads = $ary['uploads'];
	$date = date("d-m-Y",strtotime($ary['date']));
?>  
  <tr>
    <td align="center"><?php echo $counter++; ?></td>
    <td>
    <?php
	if($docID == '0') { echo '<a href="'.ROOT.'/employee/documents/'.$uploads.'" target="blank">'.$otherDoc.'</a>'; }
	else {
		$res = mysql_query("SELECT document FROM `document_list` WHERE docID = '$docID'");
		$ary = mysql_fetch_array($res);
		echo '<a href="'.ROOT.'/employee/documents/'.$uploads.'" target="blank">'.$ary['document'].'</a>';
	}
	?>
    </td>
    <td align="center"><?php echo $date; ?></td>
    <td align="center">
    <a href="edit_document.php?id=<?php echo $array['tbID']; ?>">
    <img src="../images/edit.png" alt="edit" title="edit" class="blank" width="16" height="16" /></a>
    &nbsp;&nbsp;&nbsp;&nbsp;
    <img src="../images/delete.png" alt="delete" title="delete student" class="blank" width="16" height="16" onclick="return confirm_delete(<?php echo $array['tbID']; ?>)"/>
    </td>
  </tr>
<?php } } ?>  
</table>

</div>
<br>

<?php
if(isset($_POST['submit'])) {
	$docID = $_POST['docID'];
	$newDoc = $_POST['newDoc'];
	$date = date("Y-m-d",strtotime($_POST['date']));
	
	$uploads = '';	
	
	if($_FILES["uploads"]["name"] != '') {
		$allowedExts = array("jpg", "jpeg", "gif", "png");
		$extension = end(explode(".", $_FILES["uploads"]["name"]));
		if ((($_FILES["uploads"]["type"] == "image/gif")
		|| ($_FILES["uploads"]["type"] == "image/jpeg")
		|| ($_FILES["uploads"]["type"] == "image/png")
		|| ($_FILES["uploads"]["type"] == "image/pjpeg"))
		&& ($_FILES["uploads"]["size"] < 256000) // file size in bytes -- 250 KB
		&& in_array($extension, $allowedExts))
		{
		  $uploads = time()."_".$_FILES["uploads"]["name"];	
		  move_uploaded_file($_FILES["uploads"]["tmp_name"],"documents/" . $uploads);
		}
	}
	
	if($docID != '') {
		$query = mysql_query("INSERT INTO `stud_docs` (`studID`, `docID`, `otherDoc`, `uploads`, `date`) VALUES ('$studID', '$docID', '$newDoc ', '$uploads', '$date')");
	}
	echo '<META HTTP-EQUIV=Refresh CONTENT="1; URL=view_documents.php?sid='.$studID.'">';
}
?>

<h2>Add Documents</h2>
<br />
<div class="fullWidth">
<form action="" method="post" enctype="multipart/form-data" name="docForm">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="20%" height="30" align="left">Document</td>
    <td width="2%" align="center">:</td>
    <td width="78%">
    <select name="docID" id="docID" class="dropdown">
    <option value="" selected="selected" class="padding_2">Select</option>
    <?php
	$res = mysql_query("SELECT * FROM `document_list` WHERE delStatus = '0'");
	while($arr = mysql_fetch_array($res)) {
	echo '<option value="'.$arr['docID'].'" class="padding_2">'.$arr['document'].'</option>';
	}
    ?>
    <option value="0" class="padding_2">Any other documents (if any)</option>
    </select></td>
  </tr>
  <tr>
    <td colspan="3" align="left"><div id="getDoc"></div></td>
  </tr>
  <tr>
    <td height="50" align="left">Upload Document <br><label class="alert">Max. file size = 250KB</label></td>
    <td align="center">:</td>
    <td>
    <div class="file-wrapper">
        <input type="file" name="uploads" id="uploads"/>
        <span class="button">Choose file</span>
    </div></td>
  </tr>
  <tr>
    <td height="30" align="left">Collected on</td>
    <td align="center">:</td>
    <td><input type="text" name="date" id="date" value="<?php echo date("d-m-Y"); ?>" class="textbox width_200 textCenter" readonly="readonly"></td>
  </tr>
  <tr>
    <td height="50" align="left">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td><input type="submit" name="submit" value="Add Document" class="button width_200"/></td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td>&nbsp;</td>
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