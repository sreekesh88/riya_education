<?php ob_start(); 

include ("../include/header.php"); 
include ("../include/validate.php"); 
include ("../include/menu.php"); 
error_reporting(E_ALL); ini_set('display_errors', 'On');
$empID = $info['empID'];
$branchID = $info['branchID'];
$branches = mysql_query("SELECT branchCode FROM `branches` WHERE branchID = '$branchID'");
$res = mysql_fetch_array($branches);
$bCode = $res['branchCode'];
?>
<script type="text/javascript" src="../js/datepair.js"></script>
<script type="text/javascript" src="../js/jquery.timepicker.js"></script>
<link rel="stylesheet" type="text/css" href="../css/jquery.timepicker.css" />
<script>
function addressEntry(id) {	
	$('#firstDetail').html(id.value);
}
function venueDetails(id) {	
	if((id == '1') || (id == '4') || (id == '5')) {
	  	$('#remark_text').show();
		$('#confirmEvent').hide();
		$('#textEntry').hide();
		$('#venueEntry').hide();
		 $('#rejectReason').hide();
	} else if((id == '2') || (id == '3')){
		$('#confirmEvent').show();
		$('#remark_text').hide();
		$('#textEntry').hide();
	} else if(id == '0'){
		 $('#textEntry').show();
	  	 $('#remark_text').show();
		  $('#rejectReason').hide();
		 $('#venueEntry').hide();
		 $('#confirmEvent').hide();
	}
	
	
}
function getDetails(id) {	
	if(id == '1') {
	  $('#venueEntry').show();
	  $('#rejectReason').hide();
	  $('#remark_text').show();
	} else if(id == '2') {
	  $('#venueEntry').hide();
	  $('#rejectReason').show();
	  $('#remark_text').hide();
	}	
}

$(function() {

var currentTime = new Date();
var year = currentTime.getFullYear();
		
	$("#date").datepicker({
	changeMonth: true,
	changeYear: true,
	dateFormat: "dd-mm-yy",
	yearRange: (year-1)+':'+(year+1) 
	});
	
	$("#followDate").datepicker({
	changeMonth: true,
	changeYear: true,
	dateFormat: "dd-mm-yy",
	yearRange: (year-1)+':'+(year+1) 
	});
	
	$('#followTime').timepicker({ 
	timeFormat: 'h:i A', 
	'scrollDefaultNow': true
	});
	
});	
</script>
<?php
$success = '';
if(isset($_POST['submit'])) {
	$date = date("Y-m-d", strtotime($_POST['date']));
	$visit_place = $_POST['visit_place'];
	$instnName = $_POST['instnName'];
	$email = $_POST['email'];
	$contPerson = $_POST['contPerson'];
	$addr1 = $_POST['addr1'];
	$addr2 = $_POST['addr2'];
	$addr3 = $_POST['addr3'];
	$mobile = $_POST['mobile'];
	$phone = $_POST['phone'];
	$visit_purpose = $_POST['visit_purpose'];
	
	$other_visit_purpose = "";
	if($_POST['other_visit_purpose'] != '') { $other_visit_purpose = $_POST['other_visit_purpose']; }
	
	$confirm = (isset($_POST['confirm']) ? $_POST['confirm'] : "");
	$venue = $_POST['venue'];
	$remarks = $_POST['remarks'];
	$reason = $_POST['reason'];
	$data = $_POST['data'];
	$followDate = date("Y-m-d", strtotime($_POST['followDate']));
	$followTime = $_POST['followTime'];
	
	$result = mysql_query("SELECT lastInc FROM `sales_activity` ORDER BY lastInc DESC LIMIT 1");	
	while($ary = mysql_fetch_array($result)) {
		$lastInc = $ary['lastInc'];
	}
	if ($lastInc == '') { 
		$lastInc = sprintf("%04d",1); 
		$counter = $lastInc;
		$salesID = "SA".$bCode.$counter;
	} else {
		$counter = sprintf("%04d",$lastInc+1);
		$salesID = "SA".$bCode.$counter;
	}
	
	if($instnName != '') {
	$sales_activity = mysql_query("INSERT INTO `sales_activity` (`date`, `salesID`, `visit_place`, `instnName`, `contPerson`, `mobile`, `phone`, `email`, `addr1`, `addr2`, `addr3`, `visit_purpose`, `other_visit_purpose`, `confirm`, `venue_detail`, `remarks`, `reason`, `data_collected`, `followupDate`, `followupTime`, `lastInc`) VALUES ('$date', '$salesID', '$visit_place', '$instnName', '$contPerson', '$mobile', '$phone', '$email', '$addr1', '$addr2', '$addr3', '$visit_purpose', '$other_visit_purpose', '$confirm', '$venue', '$remarks', '$reason', '$data', '$followDate', '$followTime', '$counter')");
	}
		
	if((isset($sales_activity)) && ($sales_activity > 0)) { 
		$success = "Sales activity has been submitted succesfully";
		header("Location: sales_registration_list.php");
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
<div class="main_col dotted_border" style="min-height:500px;">
<h2>Sales Activity</h2>
<br />
<div class="fullWidth">
<form action="" method="post" enctype="multipart/form-data" name="form">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="23%" height="30" valign="top">Date</td>
    <td width="2%" valign="top">:</td>
    <td width="75%" valign="top">
    <input type="text" name="date" id="date" class="textbox textCenter" placeholder="dd-mm-yyyy" readonly="readonly"/>
    </td>
    </tr>
  <tr>
    <td height="60" valign="top">Place of Visit</td>
    <td valign="top">:</td>
    <td valign="top">
    	<table width="300" border="0" cellspacing="0" cellpadding="0" class="pad">
          <tr>
            <td><input name="visit_place" type="radio" value="Company" onclick="addressEntry(this)" checked="checked"/> &nbsp; Company</td>
            <td><input name="visit_place" type="radio" value="College" onclick="addressEntry(this)"/> &nbsp; College</td>
          </tr>
          <tr>
            <td><input name="visit_place" type="radio" value="University" onclick="addressEntry(this)"/> &nbsp; University</td>
            <td><input name="visit_place" type="radio" value="IELTS Centre" onclick="addressEntry(this)"/> &nbsp; IELTS</td>
          </tr>
        </table></td>
    </tr>
  <tr>
    <td colspan="3" valign="top">
        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="pad">
          <tr>
            <td rowspan="4" valign="top" width="23%">
            <span id="firstDetail">Company</span><span> Details </span>    </td>
            <td valign="top" width="2%">:</td>
            <td valign="top" width="25%"><input type="text" name="instnName" id="instnName" class="textbox" placeholder="Name"/></td>
            <td valign="top" width="50%"><input type="text" name="email" id="email" class="textbox" placeholder="Email"/></td>
          </tr>
          <tr>
            <td rowspan="3" align="left" valign="top">        </td>
            <td align="left" valign="top"><input type="text" name="contPerson" id="contPerson" class="textbox" placeholder="Contact Person"/></td>
            <td rowspan="3" align="left" valign="top">
            <div class="addressBox">
            <input type="text" name="addr1" id="addr1" class="addrInput" placeholder="Address1"/>
            <input type="text" name="addr2" id="addr2" class="addrInput" placeholder="Address2"/>
            <input type="text" name="addr3" id="addr3" class="addrInput" placeholder="Address3"/>
            </div></td>
          </tr>
          <tr>
            <td align="left" valign="top"><input type="text" name="mobile" id="mobile" class="textbox" placeholder="Mobile"/></td>
          </tr>
          <tr>
            <td align="left" valign="top"><input type="text" name="phone" id="phone" class="textbox" placeholder="Phone"/></td>
          </tr>
          <tr><td colspan="4">&nbsp;</td></tr>
        </table>    </td>
  </tr>
  <tr>
    <td valign="top">Purpose of Visit</td>
    <td valign="top">:</td>
    <td valign="top">
    <select name="visit_purpose" class="dropdown" style="width:150px;margin-bottom:10px;" onchange="venueDetails(this.value)">
        <option value="" class="padding_2" selected="selected">Select</option>
        <?php
		$sales_visit_purpose = mysql_query("SELECT * FROM `sales_visit_purpose` WHERE delStatus = '0'");
		while($ary = mysql_fetch_array($sales_visit_purpose)) {
			echo '<option value="'.$ary['svpID'].'" class="padding_2">'.$ary['purpose'].'</option>';
		}
		?>
        <option value="0" class="padding_2">Any other</option>
    </select>
	
    <span id="textEntry" style="display:none;"><input name="other_visit_purpose" id="other_visit_purpose" type="text" class="textbox" placeholder="Purpose?"/></span>
    
    <div id="confirmEvent" style="display:none;">
    	<input name="confirm" type="radio" value="1" id="confirm" onclick="getDetails(this.value)"/> <label>Confirmed</label>
        &nbsp;&nbsp;&nbsp;
        <input name="confirm" type="radio" value="2" id="notConfirm" onclick="getDetails(this.value)"/> <label>Not Confirmed</label>
    </div>
    <div id="venueEntry" style="display:none;">
    	<span style="float:left;"><textarea name="venue" id="venue" class="textarea_dotted" placeholder="Venue Details"></textarea></span>
    </div>
    <div id="rejectReason" style="display:none;">
    	<span style="float:left;"><textarea name="reason" id="reason" class="textarea_dotted" placeholder="Reason for Rejection"></textarea></span>
    </div>
    <div id="remark_text" style="display:none;">
    	<span style="float:left;"><textarea name="remarks" id="remarks" class="textarea_dotted" placeholder="Remarks if any"></textarea></span>
    </div>    
    </td>
  </tr>
  <tr>
    <td height="30">No. of data collected</td>
    <td>:</td>
    <td><input type="text" name="data" id="data" class="textbox width_60 textCenter"/></td>
    </tr>
  <tr>
    <td height="30">Follow up on</td>
    <td>:</td>
    <td>
    <input type="text" name="followDate" id="followDate" placeholder="dd-mm-yyyy" class="textbox width_95 textCenter" readonly="readonly"/>
    <input type="text" name="followTime" id="followTime" placeholder="00:00 AM" class="textbox width_95 textCenter" />    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td height="60">
      <input type="submit" name="submit" id="submit" value="Submit" class="button width_150"/>
      <?php if($success != '') { ?>
      <span class="alert" id="success"><?php echo $success; ?></span>
      <?php } ?>
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

<?php ob_end_flush(); ?>