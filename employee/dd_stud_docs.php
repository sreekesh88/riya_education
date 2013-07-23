<?php 
date_default_timezone_set("Asia/Kolkata");
include ("../include/header.php"); 
include ("../include/validate.php"); 
include ("../include/menu.php"); 
$empID = $info['empID'];
$studID = $_GET['sid'];

$students = mysql_query("SELECT fname,lname FROM `students` WHERE studID = '$studID'");
while($row = mysql_fetch_array($students)) {
	$student = $row['fname']." ".$row['lname'];
}
?>

<?php
$action = isset($_GET['action'])?$_GET['action'] :'';
$tbID = $_GET['tbID'];
$sid = $_GET['sid'];
$verifyDate = date("Y-m-d");
if($action == 'verify') {
$query = mysql_query("UPDATE `stud_docs` SET verify = '1', verifyDate = '$verifyDate' WHERE tbID = '$tbID'");
echo '<META HTTP-EQUIV=Refresh CONTENT="0; URL=dd_stud_docs.php?sid='.$sid.'">';
} else if($action == 'reject') {
$query = mysql_query("UPDATE `stud_docs` SET verify = '2' WHERE tbID = '$tbID'");
echo '<META HTTP-EQUIV=Refresh CONTENT="0; URL=dd_stud_docs.php?sid='.$sid.'">';
} 

?>

<script type="text/javascript" src="../js/validate.js"></script>
<script type="text/javascript">
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

function verify_doc(id,sid)
{	
	var dialog = $('<p>Verify this document?</p>').dialog({
                    modal: true,
					buttons: {
                        "Yes": function() {window.location = "dd_stud_docs.php?sid="+sid+"&tbID="+id+"&action=verify";},
                        "No":  function() {window.location = "dd_stud_docs.php?sid="+sid+"&tbID="+id+"&action=reject";},
                        "Cancel":  function() {
							window.location = "dd_stud_docs.php?sid="+sid;
                            dialog.dialog('close');
                        }
                    }
                });
}

function reject_reason(id) {
	
	$("#reason").dialog(
	   {
		bgiframe: true,
		autoOpen: false,
		height: 200,
		width: 400,
		modal: true,
		closeOnEscape: false
	   }
	);
	$('#reason').dialog('open'); 
    $("#reason_id").val(id);
}

function updateComment(){
	var comment = $('#comment').val();
	$.ajax({  
		url: "reject_reason.php",
        type: "POST",
		data: $("#form").serialize(),
		success: function(data){
			$("#reason").dialog('close');
		}
    });
}

</script>

<div id="wrapper_top"></div>
<div id="wrapper">
<?php include("../include/left.php"); ?>
<div class="main_col dotted_border">
<h2>Documents of <?php echo $student; ?></h2>
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
	if($ary['date'] != "0000-00-00") {
		$submitDate = date("d-m-Y",strtotime($ary['date']));
	} else {
		$submitDate = "--";
	}
	
	$verified = $ary['verify'];
	$verifyDate = date("d-m-Y",strtotime($ary['verifyDate']));
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
    <td align="center"><?php echo $submitDate; ?></td>
    <td align="center">
    <?php if($submitDate != "--") { if($verified == '0') { ?>
    <img src="../images/pending.png" alt="pending" title="Pending" class="border0" width="16" height="16" onclick="return verify_doc(<?php echo $tbID; ?>,<?php echo $studID; ?>)" style="cursor:pointer;"/>    
	<?php } else if($verified == '1') { ?>
    <img src="../images/complete.png" alt="verified" title="Verified" class="border0" width="16" height="16"/>
    <?php } else { ?>
    <img src="../images/not_complete.png" alt="not verified" title="Rejected" class="border0" width="16" height="16"/>
    <a href="#" onclick="reject_reason('<?php echo $tbID; ?>');">Reason?</a>
    <?php }} ?>
    </td>
  </tr>
<?php } } ?>  
</table>

</div>
<br>
<div id="reason" title="Reason for Rejection" style="display:none;">
    <form action="" method="post" enctype="multipart/form-data" name="form" id="form">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr><td colspan="3" height="10"></td></tr>
          <tr>
            <td class="blue" valign="top" height="80">Comment</td>
            <td class="blue" valign="top">:</td>
            <td>
                <textarea name="comment" id="comment" cols="30" rows="3" class="textarea"></textarea>
                <input type="hidden" name="reason_id" id="reason_id" value=""/>
            </td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td height="50">                
                <input type="button" name="submit" id="submit" value="Submit" class="button" onclick="updateComment()"/>
            </td>
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