<?php include ("../include/header.php"); 
include ("../include/validate.php"); 
include ("../include/menu.php"); 
$empID = $info['empID'];
$branchID = $info['branchID'];
$studID = $_GET['sid'];
?>

<?php
$action = isset($_GET['action'])?$_GET['action'] :'';
$svdID = $_GET['svdID'];
$sid = $_GET['sid'];
$verifyDate = date("Y-m-d");
if($action == 'accept') {
$query = mysql_query("UPDATE `stud_visa_docs` SET verify = '1', verifyDate = '$verifyDate' WHERE svdID = '$svdID'");
echo '<META HTTP-EQUIV=Refresh CONTENT="0; URL=vd_student_financial_view.php?sid='.$sid.'">';
} else if($action == 'reject') {
$query = mysql_query("UPDATE `stud_visa_docs` SET verify = '2' WHERE svdID = '$svdID'");
echo '<META HTTP-EQUIV=Refresh CONTENT="0; URL=vd_student_financial_view.php?sid='.$sid.'">';
} 

?>

<script>

function verify_doc(id,sid)
{	
	//var rowID = domObj.parentNode.parentNode.id;
	//alert('id: '+id+'sid: '+sid+'rowID:' +rowID); return false;
	var dialog = $('<p>Verify this document?</p>').dialog({
                    modal: true,
					buttons: {
                        "Yes": function() {window.location = "vd_student_financial_view.php?sid="+sid+"&svdID="+id+"&action=accept";},
                        "No":  function() {window.location = "vd_student_financial_view.php?sid="+sid+"&svdID="+id+"&action=reject";},
                        "Cancel":  function() {
							window.location = "vd_student_financial_view.php?sid="+sid;
                            dialog.dialog('close');
                        }
                    }
                });
}

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
		url: "reject_reason_visa.php",
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
  <tr><td height="10"></td></tr>
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
	?>    
    </td>
  </tr>
  <tr>
    <td valign="top">Documents</td>
    <td valign="top">:</td>
    <td valign="top">
    <table width="400" border="0" cellspacing="0" cellpadding="0" class="table">
      <tr>
        <th width="10%">No</th>
        <th width="60%" align="left" class="left_5">Document</th>
        <th width="30%" colspan="2">Action</th>
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
        <td>
        <?php
        $chkID = $row1['chkID'];
		$chklist = mysql_query("SELECT document FROM `visa_checklist` WHERE chkID = '$chkID'");
		while($ary = mysql_fetch_array($chklist)) {
			if($row1['docName'] != ""){
				echo $row1['docName'];
			}else{
				echo $ary['document'];
			}
		}
		?>
        </td>
        <td align="center">
        <?php $img = $row1['attachment'];?>
          <a onclick="openImagePopup('<?php echo $img;?>', this);" href="javascript:void(0)"><img src="../images/view.png" alt="view" /></a>
         </td> 
         <td align="center">
    <?php if($verified == '0') { ?>
    <img src="../images/pending.png" alt="pending" title="Pending" class="border0" width="16" height="16" onclick="return verify_doc(<?php echo $svdID; ?>,<?php echo $studID; ?>)" style="cursor:pointer;"/>    
	<?php } else if($verified == '1') { ?>
    <img src="../images/complete.png" alt="verified" title="Verified" class="border0" width="16" height="16"onclick="return verify_doc(<?php echo $svdID; ?>,<?php echo $studID; ?>)"/>
    <?php } else { ?>
    <img src="../images/not_complete.png" alt="not verified" title="Rejected" class="border0" width="16" height="16"onclick="return verify_doc(<?php echo $svdID; ?>,<?php echo $studID; ?>)"/>
    <a href="javascript:void(0);" onclick="reject_reason('<?php echo $svdID; ?>');" title="<?php echo $reason; ?>">Reason?</a>
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
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" class="heading1">Visa Documents</td>
  </tr>
  <tr><td height="10"></td></tr>
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
	?>    
    </td>
  </tr>
  <tr>
    <td valign="top">Documents</td>
    <td valign="top">:</td>
    <td valign="top">
    <table width="400" border="0" cellspacing="0" cellpadding="0" class="table">
      <tr>
        <th width="10%">No</th>
        <th width="60%" align="left" class="left_5">Document</th>
        <th width="30%" colspan="2">Action</th>
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
		$chklist = mysql_query("SELECT document FROM `visa_checklist` WHERE chkID = '$chkID'");
		while($ary = mysql_fetch_array($chklist)) {
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
        <?php if($verified == '0') { ?>
    <img src="../images/pending.png" alt="pending" title="Pending" class="border0" width="16" height="16" onclick="return verify_doc(<?php echo $svdID; ?>,<?php echo $studID; ?>)" style="cursor:pointer;"/>    
	<?php } else if($verified == '1') { ?>
    <img src="../images/complete.png" alt="verified" title="Verified" class="border0" width="16" height="16"onclick="return verify_doc(<?php echo $svdID; ?>,<?php echo $studID; ?>)"/>
    <?php } else { ?>
    <img src="../images/not_complete.png" alt="not verified" title="Rejected" class="border0" width="16" height="16"onclick="return verify_doc(<?php echo $svdID; ?>,<?php echo $studID; ?>)"/>
    <a href="javascript:void(0);"onclick="reject_reason('<?php echo $svdID; ?>');" title="<?php echo $reason; ?>">Reason?</a>
    <?php } ?>
        
        </td>
      </tr>
<?php
}
?>
    </table>

    </td>
  </tr>
</table>
<div class="dotted_border" id="modal" title="Document Viewer"></div>
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


</div> <!--end of main_col-->
</div> <!--end of wrapper-->

<?php include("../include/footer.php"); ?>

</div> <!--end of container-->
</body>
</html>




