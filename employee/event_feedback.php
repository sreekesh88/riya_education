<?php 
include ("../include/header.php"); 
include ("../include/validate.php"); 
include ("../include/menu.php"); 
$empID = $info['empID'];
$eventID = $_GET['id'];
?>

<script>
function disableMe(box) {
	if(box.name == "availOthers" && box.checked) {
		fields.trans_others.disabled = false;
		fields.otherCost.disabled = false;
	} else if(box.name == "availOthers" && box.checked == false) {
		fields.trans_others.disabled = true;
		fields.otherCost.disabled = true;
	}	
}

function carData(){
	if($('#car').is(':checked')) {
    	$("#carData").load("get_carData.php?id=2");
	} else {
		$("#carData").load("get_carData.php?id=0");
	}
}

$(document).on('click','.rating',function() { 
	var vr = $('[name=venue_rating]:checked').val(); 
	var er = $('[name=event_rating]:checked').val(); 
	var cr = $('[name=comment_rating]:checked').val(); 
	if(!isNaN(vr) && !isNaN(er) && !isNaN(cr)) {
		var tr = Number(vr) + Number(er) + Number(cr);
		var or = Math.round(((Number(tr)/30) * 10)*10)/10;
		$('#rating').val(or);
	}
});

</script>

<?php
$events = mysql_query("SELECT * FROM `events` WHERE eventID = '$eventID'");
while($row = mysql_fetch_array($events)) {
	$title = $row['title'];
}

$eventCost = mysql_query("SELECT * FROM `event_cost` WHERE eventID = '$eventID'");
while($row = mysql_fetch_array($eventCost)) {
	$basicCost = $row['basicCost'];
}


if(isset($_POST['submit'])) {
	$date = date("Y-m-d");
	$attendees = $_POST['attendees'];
	$venueArrange = $_POST['venueArrange'];
	$venue_rating = $_POST['venue_rating'];
	$eventExpMet = $_POST['eventExpMet'];
	$event_rating = $_POST['event_rating'];
	$dbCollected = $_POST['dbCollected'];
	$overallCmnts = mysql_real_escape_string($_POST['overallCmnts']);
	$comment_rating = $_POST['comment_rating'];
	$availTrans = implode(',',$_POST['availTrans']);
	$availAmts = implode(',',$_POST['availAmts']); 
	$vehicle = $_POST['vehicle'];
	$carType = $_POST['carType'];
	$transOthers = $_POST['trans_others'];
	$otherCost  = $_POST['otherCost'];
	$availAcco = $_POST['availAcco'];
	$roomType = $_POST['roomType'];
	$food = $_POST['food'];
	$accoRate = $_POST['accoRate'];
	$grandTotal = $_POST['grandTotal'];
	$overallRating = $_POST['overallRating'];
	
	$feedback = mysql_query("INSERT INTO `event_feedback` (`date`, `eventID`, `attendees`, `venueArrange`, `venueRating`, `eventExpMet`, `eventRating`, `dbCollected`, `overallCmnts`, `comntRating`, `availTrans`, `availAmts`, `vehicle`, `carType`, `transOthers`, `otherCost`, `availAcco`, `roomType`, `food`, `accoRate`, `overallRating`, `grandTotal`) VALUES ('$date', '$eventID', '$attendees', '$venueArrange', '$venue_rating', '$eventExpMet', '$event_rating', '$dbCollected', '$overallCmnts', '$comment_rating', '$availTrans', '$availAmts', '$vehicle', '$carType', '$transOthers', '$otherCost', '$availAcco', '$roomType', '$food', '$accoRate', '$overallRating', '$grandTotal')");
	
	if($feedback > 0) {
		$success = "Your Event request has been submitted successfully!";
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
<h2>Event Feedback Form</h2>
<br />
<div class="fullWidth">
<form action="" method="post" enctype="multipart/form-data" name="fields">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="6"><div id="success" class="green"><?php echo $success; ?></div></td>
    </tr>
  <tr>
    <td width="28%" height="40">Event Title</td>
    <td width="1%">:</td>
    <td colspan="4" class="red"><strong><?php echo $title; ?></strong></td>
    </tr>
  <tr>
    <td height="40">No. of Participants attended</td>
    <td>:</td>
    <td colspan="4"><input type="text" name="attendees" id="attendees" class="textbox width_95" /></td>
    </tr>
  <tr>
    <td valign="top" class="blue">&nbsp;</td>
    <td valign="top">&nbsp;</td>
    <td colspan="3" valign="top">&nbsp;</td>
    <td valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td height="60" valign="top" class="blue">Arrangement of the venue adequate?</td>
    <td valign="top">:</td>
    <td colspan="3" valign="top">
    <input type="radio" name="venueArrange" value="1" /> Yes &nbsp;&nbsp;&nbsp;&nbsp;
	<input type="radio" name="venueArrange" value="0" /> No    </td>
    <td width="28%" valign="top"><table width="236" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="left" height="20"><img src="../images/4star.png" width="44" height="23" /></td>
        <td align="left"><img src="../images/3star.png" width="53" height="23" /></td>
        <td align="left"><img src="../images/2star.png" width="41" height="23" /></td>
        <td align="left"><img src="../images/1star.png" width="41" height="23" /></td>
      </tr>
      <tr>
        <td width="28%" height="25" align="left" class="red"><input type="radio" name="venue_rating" id="rr1" value="10" class="rating"/> 10</td>
        <td width="26%" align="left" class="red"><input type="radio" name="venue_rating" id="rr2" value="8" class="rating" /> 8</td>
        <td width="20%" align="left" class="red"><input type="radio" name="venue_rating" id="rr3" value="6" class="rating" /> 6</td>
        <td width="26%" align="left" class="red"><input type="radio" name="venue_rating" id="rr4" value="2" class="rating" /> 2</td>
      </tr>
      <tr> </tr>
    </table></td>
  </tr>
  <tr>
    <td valign="top" class="blue">Did your Event met your expectation?</td>
    <td valign="top">:</td>
    <td colspan="3" valign="top">
    <input type="radio" name="eventExpMet" value="1" /> Yes &nbsp;&nbsp;&nbsp;&nbsp;
    <input type="radio" name="eventExpMet" value="0" /> No</td>
    <td valign="top"><table width="236" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="left" height="20"><img src="../images/4star.png" width="44" height="23" /></td>
        <td align="left"><img src="../images/3star.png" width="53" height="23" /></td>
        <td align="left"><img src="../images/2star.png" width="41" height="23" /></td>
        <td align="left"><img src="../images/1star.png" width="41" height="23" /></td>
      </tr>
      <tr>
        <td width="28%" height="25" align="left" class="red"><input type="radio" name="event_rating" id="er1" value="10" class="rating"/> 10</td>
        <td width="26%" align="left" class="red"><input type="radio" name="event_rating" id="er2" value="8" class="rating"/> 8</td>
        <td width="20%" align="left" class="red"><input type="radio" name="event_rating" id="er3" value="6" class="rating"/> 6</td>
        <td width="26%" align="left" class="red"><input type="radio" name="event_rating" id="er4" value="2" class="rating"/> 2</td>
      </tr>
      <tr> </tr>
    </table></td>
  </tr>
  <tr>
    <td height="40">How many database collected?</td>
    <td>:</td>
    <td colspan="4"><input type="text" name="dbCollected" id="dbCollected" class="textbox width_95" /></td>
  </tr>
  <tr>
    <td colspan="6" class="blue">What is your overall comments?</td>
    </tr>
  <tr>
    <td colspan="5" valign="top"><textarea name="overallCmnts" id="overallCmnts" class="textarea width_440"></textarea></td>
    <td valign="top"><table width="236" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="left" height="20"><img src="../images/4star.png" width="44" height="23" /></td>
        <td align="left"><img src="../images/3star.png" width="53" height="23" /></td>
        <td align="left"><img src="../images/2star.png" alt="2star" width="41" height="23" /></td>
        <td align="left"><img src="../images/1star.png" width="41" height="23" /></td>
      </tr>
      <tr>
        <td width="28%" height="25" align="left" class="red"><input type="radio" name="comment_rating" id="cr1" value="10" class="rating" /> 10</td>
        <td width="26%" align="left" class="red"><input type="radio" name="comment_rating" id="cr2" value="8" class="rating" /> 8</td>
        <td width="20%" align="left" class="red"><input type="radio" name="comment_rating" id="cr3" value="6" class="rating" /> 6</td>
        <td width="26%" align="left" class="red"><input type="radio" name="comment_rating" id="cr4" value="2" class="rating" /> 2</td>
      </tr>
      <tr> </tr>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="4">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="6"><h6>Expenses</h6></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="4">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="6">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="18%" class="red">Expected Event Cost</td>
        <td width="2%">:</td>
        <td width="80%"><input type="text" name="eeCost" id="eeCost" class="textbox width_95 textCenter" value="<?php echo $basicCost; ?>" readonly="readonly"/> INR</td>
      </tr>
      <tr>
        <td height="40"><b>Expense Details</b></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td height="40" valign="top" class="blue">Transportation</td>
        <td valign="top">:</td>
        <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="13%" height="30"><input type="checkbox" name="availTrans[]" id="flight" value="1"/> Flight</td>
            <td width="14%"><input type="text" name="availAmts[]" class="textbox width_60 textCenter" /></td>
            <td width="13%"><input type="checkbox" name="availTrans[]" id="train" value="4"/> Train</td>
            <td width="14%"><input type="text" name="availAmts[]" class="textbox width_60 textCenter" /></td>
            <td width="10%"><input type="checkbox" name="availTrans[]" id="car" value="2" onclick=" return carData();"/> Car</td>                     
            <td width="36%" align="left"><span id="carData"></span></td>
          </tr>
          <tr>
            <td height="30"><input type="checkbox" name="availTrans[]" id="auto" value="6"/> Auto</td>
            <td><input type="text" name="availAmts[]" class="textbox width_60 textCenter" /></td>
            <td><input type="checkbox" name="availTrans[]" id="bus" value="5" /> Bus </td>
            <td><input type="text"  name="availAmts[]" class="textbox width_60 textCenter" /></td>
            <td><input type="checkbox" name="availOthers" id="trans_chkbx" onclick="disableMe(this)" value="0" /> Others</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td height="30"><input type="checkbox" name="availTrans[]" id="2wheeler" value="3"/> 2 Wheeler</td>
            <td height="30"><input type="text" name="availAmts[]" class="textbox width_60 textCenter" /></td>
            <td colspan="2">&nbsp;</td>
            <td colspan="2">
            <input type="text" name="trans_others" id="trans_others" class="textbox" disabled="disabled" />&nbsp;&nbsp;&nbsp; 
            <input type="text"  name="otherCost" id="otherCost" class="textbox width_60 textCenter" disabled="disabled" />            </td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td height="50" class="blue">Accomodation</td>
        <td>:</td>
        <td>
          <select name="availAcco" id="availAcco" class="dropdown" style="width:150px;">
            <option value="" selected="selected">Select</option>
            <option value="Single Room">Single Room</option>
            <option value="Double Room">Double Room</option>
            <option value="Twin Sharing">Twin Sharing</option>
            <option value="Suite Room">Suite Room</option>
          </select>
        
          &nbsp;&nbsp;&nbsp;
          <select name="roomType" id="roomType" class="dropdown" style="width:auto;">
            <option value="" selected="selected">Select</option>
            <option value="1">A/C</option>
            <option value="2">Non A/C</option>
          </select>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <input type="checkbox" name="food" id="food" /> 
          Including Food&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <input type="text" name="accoRate" id="accoRate" class="textbox width_95 textCenter"/> 
          INR</td>
      </tr>
      </table>    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="4">&nbsp;</td>
  </tr>
  <tr>
    <td height="50" bgcolor="#E1EEED" class="red left_10"><strong>Grant Total for the Seminar</strong></td>
    <td height="50" bgcolor="#E1EEED">:</td>
    <td width="24%" height="50" bgcolor="#E1EEED"><input type="text" name="grandTotal" id="grandTotal" class="textbox width_95 textCenter"/> 
      INR</td>
    <td width="18%" bgcolor="#E1EEED" class="green"><strong>Overall Rating</strong></td>
    <td width="1%" bgcolor="#E1EEED">:</td>
    <td height="50" bgcolor="#E1EEED"><input type="text" name="overallRating" id="rating" class="textbox width_40 textCenter" readonly="readonly"/> 
      out of 10</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="4">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="6" align="center"><input type="submit" name="submit" class="button width_200" value="Submit" /></td>
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