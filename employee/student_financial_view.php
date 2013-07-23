<?php include ("../include/header.php"); 
include ("../include/validate.php"); 
include ("../include/menu.php"); 
$empID = $info['empID'];
$branchID = $info['branchID'];
$studID = $_GET['sid'];
?>

<script type="text/javascript" src="../js/validate.js"></script>
<script>
function openImagePopup(img, obj){
var title = $.trim(obj.parentNode.parentNode.children[1].innerHTML);
var imgSrc = "../employee/checklist/"+img;
$('#modal').html('<img src="'+imgSrc+'">');
$('#modal').dialog({
		modal: true,
		width: 'auto',
		height: 'auto',
		closeOnEscape: false,
		resizable: true,
		title : title
	});
}

function changeFile(id, obj) {
	var otherFiles = $.trim(obj.parentNode.parentNode.children[1].id);
	if(otherFiles){
		document.getElementById('docName').disabled = '';
	} else {
		document.getElementById('docName').disabled = 'disabled';
	}
	$('#changeFile').dialog({
		modal: true,
		width: 'auto',
		height: 'auto',
		closeOnEscape: false,
		resizable: true
	});
	$('#docName').val(obj.parentNode.parentNode.children[1].innerHTML.trim());
	$('#svdID').val(id);
}
</script>

<div id="wrapper_top"></div>
<div id="wrapper">
<?php include("../include/left_stud.php"); ?>
<div class="main_col dotted_border">
<h2>Documents for Finance & Visa</h2>
<br />
<?php
$stud_visa = mysql_query("SELECT * FROM `stud_visa` WHERE studID = '$studID'");
while($sv_row = mysql_fetch_array($stud_visa)) {
	$svID = $sv_row['svID'];
	$assignedBy = $sv_row['assignedBy'];
	$assignedTo = $sv_row['assignedTo'];
	$date = date("d-m-Y",strtotime($sv_row['date']));
	$branchID = $sv_row['branchID'];
	$finMode = $sv_row['finMode'];
	$dType = $sv_row['dType'];
}	
?>


<div class="fullWidth">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="pad">
  <tr>
    <td colspan="3" class="heading1">Financial Details</td>
  </tr>
  <tr><td height="10" colspan="3"></td></tr>
  <tr>
    <td width="23%" height="30">Mode of Payment</td>
    <td width="2%">:</td>
    <td width="75%" class="red ">
    <?php
	$finModes = array("1" => "Loan",
					 "2" => "Fixed Deposit",
					 "3" => "Savings",
					 "4" => "LIC",
					 "5" => "Provident Fund",
					 "6" => "Gold Loan",
					 "7" => "Other Financial Source"						 
					 );
	echo $finModes[$finMode];
	?>    </td>
  </tr>
  <tr>
    <td valign="top">Documents</td>
    <td valign="top">:</td>
    <td valign="top">
    <table width="400" border="0" cellspacing="0" cellpadding="0" class="table">
      <tr>
        <th width="10%">No</th>
        <th width="60%" align="left" class="left_5">Document</th>
        <th width="30%" colspan="3">Action</th>
      </tr>      
<?php
$counter1 = 1;
$stud_visa_docs = mysql_query("SELECT * FROM `stud_visa_docs` WHERE svID = '$svID' AND type = '$finMode'");
while($row1 = mysql_fetch_array($stud_visa_docs)) {
	$svdID = $row1['svdID'];
	$verified = $row1['verify'];
	$reason = $row1['reason'];	
?>
      <tr>
        <td align="center"><?php echo $counter1++; ?></td>
        <?php
        $chkID = $row1['chkID'];
		$chklist = mysql_query("SELECT document,name FROM `visa_checklist` WHERE chkID = '$chkID'");
		while($ary = mysql_fetch_array($chklist)) {
			$fieldName = $ary['name'];
			if($row1['docName'] != ""){
				echo '<td id="'.$fieldName.'">'.$row1['docName'].'</td>';
			}else{
				echo '<td>'.$ary['document'].'</td>';
			}
		}
		?>
        <td align="center">
        <?php $img = $row1['attachment'];?>
          <a onclick="openImagePopup('<?php echo $img;?>',this,'<?php echo $chkID; ?>');" href="javascript:void(0)"><img src="../images/view.png" alt="view" /></a>
        </td> 
        <td align="center">
        <a href="javascript:void(0)" onclick="changeFile('<?php echo $svdID; ?>',this);"><img src="../images/edit.png" alt="edit" /></a>
        </td>
        <td align="center">
    <?php if($verified == '0') { ?>
    <img src="../images/pending.png" alt="pending" title="Pending" class="border0" width="16" height="16" onclick="return verify_doc(<?php echo $tbID; ?>,<?php echo $studID; ?>)" style="cursor:pointer;"/>    
	<?php } else if($verified == '1') { ?>
    <img src="../images/complete.png" alt="verified" title="Verified" class="border0" width="16" height="16"/>
    <?php } else { ?>
    <img src="../images/not_complete.png" alt="not verified" class="border0" width="16" height="16" title="<?php echo $reason; ?>"/>
    <?php } ?></td></tr>
<?php
}
?>
    </table>

    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" class="heading1">Visa Documents</td>
  </tr>
  <tr><td height="10" colspan="3"></td></tr>
  <tr>
    <td width="23%" height="30">Document Type</td>
    <td width="2%">:</td>
    <td width="75%" class="red ">
    <?php
	$documentTypes = array("8" => "Income Proof ",
					 "9" => "Business",
					 "10" => "Rental",
					 "11" => "Rental"						 
					 );
	echo $documentTypes[$dType];
	?>    </td>
  </tr>
  <tr>
    <td valign="top">Documents</td>
    <td valign="top">:</td>
    <td valign="top">
    <table width="400" border="0" cellspacing="0" cellpadding="0" class="table">
      <tr>
        <th width="10%">No</th>
        <th width="60%" align="left" class="left_5">Document</th>
        <th width="30%" colspan="3">Action</th>
      </tr>      
<?php
$counter1 = 1;
$stud_visa_docs = mysql_query("SELECT * FROM `stud_visa_docs` WHERE svID = '$svID' AND type = '$dType'");
while($row2 = mysql_fetch_array($stud_visa_docs)) {
	$svdID = $row2['svdID'];	 
	$verified = $row2['verify'];
	$reason = $row2['reason'];		
?>
      <tr>
        <td align="center"><?php echo $counter1++; ?></td>
        <td>
        <?php
        $chkID = $row2['chkID'];
		$chklist = mysql_query("SELECT document,name FROM `visa_checklist` WHERE chkID = '$chkID'");
		while($ary = mysql_fetch_array($chklist)) {
			$fieldName = $ary['name'];
			if($row2['docName'] != ""){
				echo $row2['docName'];
			}else{
				echo $ary['document'];
			}
		}
		?>
        </td>
        <td align="center">
        <?php $img = $row2['attachment'];?>
          <a onclick="openImagePopup('<?php echo $img;?>',this);" href="javascript:void(0)"><img src="../images/view.png" alt="view"/></a>
        </td> 
        <td align="center">
        <a href="javascript:void(0)" onclick="changeFile('<?php echo $svdID; ?>',this,'<?php echo $chkID; ?>');"><img src="../images/edit.png" alt="edit" /></a>
        </td>
        <td align="center">
        <?php if($verified == '0') { ?>
    <img src="../images/pending.png" alt="pending" title="Pending" class="border0" width="16" height="16" onclick="return verify_doc(<?php echo $tbID; ?>,<?php echo $studID; ?>)" style="cursor:pointer;"/>    
	<?php } else if($verified == '1') { ?>
    <img src="../images/complete.png" alt="verified" title="Verified" class="border0" width="16" height="16"/>
    <?php } else { ?>
    <img src="../images/not_complete.png" alt="not verified" class="border0" width="16" height="16"/ title="<?php echo $reason; ?>">
    <?php } ?>
         </td>
      </tr>
<?php
}
?>
    </table>
    </td>
  </tr>
  <tr>
    <td height="40" colspan="3" valign="top">&nbsp;</td>
  </tr>
</table>
<div id="modal" title="Document Viewer"></div>

<?php
if(isset($_POST['submit'])) {
	$svdID = $_POST['svdID']; 
	 $attached_file = '';  
	  if($_FILES['docAttach']["name"] != '') {
	   $allowedExts = array("jpg", "jpeg", "gif", "png");
	   $extension = end(explode(".", $_FILES['docAttach']["name"]));
	   if ((($_FILES['docAttach']["type"] == "image/gif")
	   || ($_FILES['docAttach']["type"] == "image/jpeg")
	   || ($_FILES['docAttach']["type"] == "image/png")
	   || ($_FILES['docAttach']["type"] == "image/pjpeg"))
	   && ($_FILES['docAttach']["size"] < 256000) // file size in bytes -- 250 KB
	   && in_array($extension, $allowedExts))
	   {
		 $attached_file = time()."_".$_FILES['docAttach']["name"]; 
		 move_uploaded_file($_FILES['docAttach']["tmp_name"],"checklist/" . $attached_file);
	   }
	 }
	if($attached_file != ""){
		$query = mysql_query("UPDATE `stud_visa_docs` SET `docName` = '".$_POST['docName']."',`attachment` = '".$attached_file."',`verify` = '0',`verifyDate` = '0000-00-00' WHERE svdID = '$svdID'");	
	} else { 
		$query = mysql_query("UPDATE `stud_visa_docs` SET `docName` = '".$_POST['docName']."',`verify` = '0',`verifyDate` = '0000-00-00' WHERE svdID = '$svdID'");	
	}
	?>
	<script language='javascript'>
		window.location.href=window.location.href;
	</script>
<?php
}
?>
 
<div id="changeFile" title="Document Change" style="display:none">
<form action="" method="post" enctype="multipart/form-data" name="uploadFile">
<table width="500" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="165" height="40">Document Name</td>
    <td width="10">:</td>
    <td width="325">
	<input name="docName" id="docName" type="text" value="" class="textbox width_200"/>
    <input type="hidden" name="svdID" id="svdID" value=""/>
	</td>
  </tr>
  <tr>
    <td height="40">Upload Document</td>
    <td>:</td>
    <td><div class="file-wrapper">
     <input type="file" class="fileSize" onchange="checkUpload(this);" name="docAttach" id="docAttach"/>
     <span class="button">Choose the file</span>
    </div></td>
  </tr>
  <tr>
    <td height="60">&nbsp;</td>
    <td>&nbsp;</td>
    <td><input name="submit" type="submit" value="Submit" class="button_orange width_150"/></td>
  </tr>
</table>
</form>
</div>

</div>


</div> <!--end of main_col-->
</div> <!--end of wrapper-->

<?php include("../include/footer.php"); ?>

</div> <!--end of container-->
</body>
</html>




