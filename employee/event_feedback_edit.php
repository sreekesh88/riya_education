<?php 
include ("../include/header.php"); 
include ("../include/validate.php"); 
include ("../include/menu.php"); 
$empCode = $info['empCode'];
$fbID = $_GET['id'];
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
$feedback = mysql_query("SELECT * FROM `event_feedback` WHERE fbID = '$fbID'");
while($ary = mysql_fetch_array($feedback)) {
	$attendees = $ary['attendees'];
	$eventID = $ary['eventID'];
	$events = mysql_query("SELECT * FROM `events` WHERE eventID = '$eventID'");
	$row = mysql_fetch_array($events);
	$title = $row['title'];
	
	$venueArrange = $ary['venueArrange'];
	$eventExpMet = $ary['eventExpMet'];
	$dbCollected = $ary['dbCollected'];
	$overallCmnts = $ary['overallCmnts'];
	
	$availTrans = explode(',', $ary['availTrans']);
	$availAmts = explode(',', $ary['availAmts']);
	
	$vehicle = $ary['vehicle'];
	$carType = $ary['carType'];
	
	$availAcco = $ary['availAcco'];
	$roomType = $ary['roomType'];
	$food = $ary['food'];
	$accoRate = $ary['accoRate'];
	$grandTotal = $ary['grandTotal'];
	
	$venueRating = $ary['venueRating'];
	$eventRating = $ary['eventRating'];
	$comntRating = $ary['comntRating'];
	$overallRating = $ary['overallRating'];
	
}


$eventCost = mysql_query("SELECT * FROM `event_cost` WHERE eventID = '$eventID'");
while($row = mysql_fetch_array($eventCost)) {
	$basicCost = $row['basicCost'];
}


if(isset($_POST['submit'])) {
	
	$overallCmnts = mysql_real_escape_string($_POST['overallCmnts']);
	$availTrans = implode(',',$_POST['availTrans']);
	$availAmts = implode(',',$_POST['availAmts']); 


	$update_feedback = mysql_query("UPDATE `event_feedback` 
									SET `attendees` = '".$_POST['attendees']."',
									`venueArrange` = '".$_POST['venueArrange']."',
									`venueRating` = '".$_POST['venue_rating']."',
									`eventExpMet` = '".$_POST['eventExpMet']."',
									`eventRating` = '".$_POST['event_rating']."',
									`dbCollected` = '".$_POST['dbCollected']."',
									`overallCmnts` = '".$overallCmnts."',
									`comntRating` = '".$_POST['comment_rating']."',
									`availTrans` = '".$availTrans."',
									`availAmts` = '".$availAmts."',
									`vehicle` = '".$_POST['vehicle']."',
									`carType` = '".$_POST['carType']."',
									`transOthers` = '".$_POST['transOthers']."',
									`otherCost` = '".$_POST['otherCost']."',
									`availAcco` = '".$_POST['availAcco']."',
									`roomType` = '".$_POST['roomType']."',
									`food` = '".$_POST['food']."',
									`accoRate` = '".$_POST['accoRate']."',
									`grandTotal` = '".$_POST['grandTotal']."',
									`overallRating` = '".$_POST['overallRating']."'
									
									WHERE fbID = '$fbID'");
	
	if($update_feedback > 0) {
		$success = "Your feedback updated successfully!";
		echo '<META HTTP-EQUIV=Refresh CONTENT="0; URL=event_feedback_edit.php?id='.$fbID.'">';
		?>    
		<script language='javascript'>
		setTimeout("$('#success').fadeOut('slow')", fast);
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
    <td colspan="6" align="center"><div id="success" class="red"><?php echo $success; ?></div></td>
    </tr>
  <tr>
    <td width="28%" height="40">Event Title</td>
    <td width="1%">:</td>
    <td colspan="4" class="red font-14"><strong><?php echo $title; ?></strong></td>
    </tr>
  <tr>
    <td height="40">No. of Participants attended</td>
    <td>:</td>
    <td colspan="4"><input type="text" name="attendees" id="attendees" class="textbox width_95 textCenter" value="<?php echo $attendees; ?>"/></td>
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
    <?php if($venueArrange == '1') { $sel1 = 'checked="checked"'; } else { $sel2 = 'checked="checked"'; } ?>
    <input type="radio" name="venueArrange" value="1" <?php echo $sel1; ?>/> Yes &nbsp;&nbsp;&nbsp;&nbsp;
	<input type="radio" name="venueArrange" value="0" <?php echo $sel2; ?>/> No    </td>
    <td width="28%" valign="top"><table width="236" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="left" height="20"><img src="../images/4star.png" width="44" height="23" /></td>
        <td align="left"><img src="../images/3star.png" width="53" height="23" /></td>
        <td align="left"><img src="../images/2star.png" width="41" height="23" /></td>
        <td align="left"><img src="../images/1star.png" width="41" height="23" /></td>
      </tr>
      <?php
	  if($venueRating == '10') { $vr1 = 'checked="checked"'; }
	  else if($venueRating == '8') { $vr2 = 'checked="checked"'; }
	  else if($venueRating == '6') { $vr3 = 'checked="checked"'; }
	  else if($venueRating == '2') { $vr4 = 'checked="checked"'; }
	  ?>
      <tr>
        <td width="28%" height="25" align="left" class="red"><input type="radio" name="venue_rating" id="rr1" value="10" class="rating" <?php echo $vr1; ?>/> 10</td>
        <td width="26%" align="left" class="red"><input type="radio" name="venue_rating" id="rr2" value="8" class="rating" <?php echo $vr2; ?> /> 8</td>
        <td width="20%" align="left" class="red"><input type="radio" name="venue_rating" id="rr3" value="6" class="rating" <?php echo $vr3; ?> /> 6</td>
        <td width="26%" align="left" class="red"><input type="radio" name="venue_rating" id="rr4" value="2" class="rating" <?php echo $vr4; ?> /> 2</td>
      </tr>
      <tr> </tr>
    </table></td>
  </tr>
  <tr>
    <td valign="top" class="blue">Did your Event met your expectation?</td>
    <td valign="top">:</td>
    <td colspan="3" valign="top">
    <?php if($eventExpMet == '1') { $exp1 = 'checked="checked"'; } else { $exp2 = 'checked="checked"'; } ?>
    <input type="radio" name="eventExpMet" value="1" <?php echo $exp1; ?>/> Yes &nbsp;&nbsp;&nbsp;&nbsp;
    <input type="radio" name="eventExpMet" value="0" <?php echo $exp2; ?>/> No</td>
    <td valign="top"><table width="236" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="left" height="20"><img src="../images/4star.png" width="44" height="23" /></td>
        <td align="left"><img src="../images/3star.png" width="53" height="23" /></td>
        <td align="left"><img src="../images/2star.png" width="41" height="23" /></td>
        <td align="left"><img src="../images/1star.png" width="41" height="23" /></td>
      </tr>
      <?php
	  if($eventRating == '10') { $er1 = 'checked="checked"'; }
	  else if($eventRating == '8') { $er2 = 'checked="checked"'; }
	  else if($eventRating == '6') { $er3 = 'checked="checked"'; }
	  else if($eventRating == '2') { $er4 = 'checked="checked"'; }
	  ?>
      <tr>
        <td width="28%" height="25" align="left" class="red"><input type="radio" name="event_rating" id="er1" value="10" class="rating" <?php echo $er1; ?>/> 10</td>
        <td width="26%" align="left" class="red"><input type="radio" name="event_rating" id="er2" value="8" class="rating" <?php echo $er2; ?>/> 8</td>
        <td width="20%" align="left" class="red"><input type="radio" name="event_rating" id="er3" value="6" class="rating" <?php echo $er3; ?>/> 6</td>
        <td width="26%" align="left" class="red"><input type="radio" name="event_rating" id="er4" value="2" class="rating" <?php echo $er4; ?>/> 2</td>
      </tr>
      <tr> </tr>
    </table></td>
  </tr>
  <tr>
    <td height="40">How many database collected?</td>
    <td>:</td>
    <td colspan="4"><input type="text" name="dbCollected" id="dbCollected" class="textbox width_95 textCenter" value="<?php echo $dbCollected; ?>" /></td>
  </tr>
  <tr>
    <td colspan="6" class="blue">What is your overall comments?</td>
    </tr>
  <tr>
    <td colspan="5" valign="top"><textarea name="overallCmnts" id="overallCmnts" class="textarea width_440"><?php echo $overallCmnts; ?></textarea></td>
    <td valign="top"><table width="236" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="left" height="20"><img src="../images/4star.png" width="44" height="23" /></td>
        <td align="left"><img src="../images/3star.png" width="53" height="23" /></td>
        <td align="left"><img src="../images/2star.png" alt="2star" width="41" height="23" /></td>
        <td align="left"><img src="../images/1star.png" width="41" height="23" /></td>
      </tr>
      <?php
	  if($comntRating == '10') { $cr1 = 'checked="checked"'; }
	  else if($comntRating == '8') { $cr2 = 'checked="checked"'; }
	  else if($comntRating == '6') { $cr3 = 'checked="checked"'; }
	  else if($comntRating == '2') { $cr4 = 'checked="checked"'; }
	  ?>
      <tr>
        <td width="28%" height="25" align="left" class="red"><input type="radio" name="comment_rating" id="cr1" value="10" class="rating" <?php echo $cr1; ?> /> 10</td>
        <td width="26%" align="left" class="red"><input type="radio" name="comment_rating" id="cr2" value="8" class="rating" <?php echo $cr2; ?> /> 8</td>
        <td width="20%" align="left" class="red"><input type="radio" name="comment_rating" id="cr3" value="6" class="rating" <?php echo $cr3; ?> /> 6</td>
        <td width="26%" align="left" class="red"><input type="radio" name="comment_rating" id="cr4" value="2" class="rating" <?php echo $cr4; ?> /> 2</td>
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
        <td class="red">&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td height="40" valign="top" class="blue">Transportation</td>
        <td valign="top">:</td>
        <td valign="top">
        <?php
		foreach($availTrans as $trs) { 
			if($trs == '1') { $t1 = 'checked="checked"'; }
			else if($trs == '2') { $t2 = 'checked="checked"'; $car = 1;}
			else if($trs == '3') { $t3 = 'checked="checked"'; }
			else if($trs == '4') { $t4 = 'checked="checked"'; }
			else if($trs == '5') { $t5 = 'checked="checked"'; }
			else if($trs == '6') { $t6 = 'checked="checked"'; }
		}
		
		$am1 = $availAmts[0];
		$am2 = $availAmts[1];
		$am3 = $availAmts[2];
		$am4 = $availAmts[3];
		$am5 = $availAmts[4];

		?>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="13%" height="30"><input type="checkbox" name="availTrans[]" id="flight" value="1" <?php echo $t1; ?>/> Flight</td>
            <td width="14%"><input type="text" name="availAmts[]" class="textbox width_60 textCenter" value="<?php echo $am1; ?>"/></td>
            <td width="13%"><input type="checkbox" name="availTrans[]" id="train" value="4" <?php echo $t4; ?>/> Train</td>
            <td width="14%"><input type="text" name="availAmts[]" class="textbox width_60 textCenter" value="<?php echo $am4; ?>"/></td>
            <td width="10%"><input type="checkbox" name="availTrans[]" id="car" value="2" onclick=" return carData();" <?php echo $t2; ?>/> Car</td>                     
            <td width="36%" align="left">
                <?php if($car != '1') { ?> 
					<div id="carData"></div>
				<?php } else { ?>
                <table width="34%" border="0" cellpadding="0" cellspacing="0" align="left">
                <tr>
                    <td width="18%" align="left">
                    <?php if($vehicle == "Owned") { $veh1 = 'selected="selected"'; } else { $veh2 = 'selected="selected"'; } ?>
                      <select name="vehicle" id="vehicle" class="dropdown" style="width:auto;">
                        <option value="" class="padding_2" selected="selected">Select</option>
                        <option value="Owned" class="padding_2" <?php echo $veh1; ?>>Owned</option>
                        <option value="Rented" class="padding_2" <?php echo $veh2; ?>>Rented</option>
                      </select>                    </td>
                    <td width="16%" align="left">
                    <?php if($carType == "Petrol") { $ct1 = 'selected="selected"'; } else { $ct2 = 'selected="selected"'; } ?>
                      <select name="carType" id="carType" class="dropdown" style="width:auto;">
                        <option value="" class="padding_2" selected="selected">Select</option>
                        <option value="Petrol" class="padding_2" <?php echo $ct1; ?>>Petrol</option>
                        <option value="Diesel" class="padding_2" <?php echo $ct2; ?>>Diesel</option>
                      </select></td>
                    <td width="66%" align="left"><input id="carCost" name="availAmts[]" type="text" class="textbox width_60 textCenter" value="<?php echo $am3; ?>"/></td>
                </tr>
                </table>
                <?php } ?>            </td>
          </tr>
          <tr>
            <td height="30"><input type="checkbox" name="availTrans[]" id="auto" value="6" <?php echo $t6; ?>/> Auto</td>
            <td><input type="text" name="availAmts[]" class="textbox width_60 textCenter" value="<?php echo $am6; ?>"/></td>
            <td><input type="checkbox" name="availTrans[]" id="bus" value="5" <?php echo $t5; ?> /> Bus </td>
            <td><input type="text"  name="availAmts[]" class="textbox width_60 textCenter" value="<?php echo $am5; ?>"/></td>
            <td><input type="checkbox" name="availOthers" id="trans_chkbx" onclick="disableMe(this)" value="0" /> Others</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td height="30"><input type="checkbox" name="availTrans[]" id="2wheeler" value="3" <?php echo $t3; ?>/> 2 Wheeler</td>
            <td height="30"><input type="text" name="availAmts[]" class="textbox width_60 textCenter" value="<?php echo $am2; ?>"/></td>
            <td colspan="2">&nbsp;</td>
            <td colspan="2">
            <input type="text" name="trans_others" id="trans_others" class="textbox" disabled="disabled" />&nbsp;&nbsp;&nbsp; 
            <input type="text"  name="otherCost" id="otherCost" class="textbox width_60 textCenter" disabled="disabled" /></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td class="blue">&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td height="50" class="blue">Accomodation</td>
        <td>:</td>
        <td>
          <?php 
		  if($availAcco == "Single Room") { $r1 = 'selected="selected"'; } 
		  else if($availAcco == "Double Room") { $r2 = 'selected="selected"'; } 
		  else if($availAcco == "Twin Sharing") { $r3 = 'selected="selected"'; } 
		  else if($availAcco == "Suite Room") { $r4 = 'selected="selected"'; }
		  
		  if($roomType == '1') { $rt1 = 'selected="selected"'; } 
		  else if($roomType == '2') { $rt2 = 'selected="selected"'; }  

		  if($food == '1') { $chk = 'checked="checked"'; } 
		  ?>
          <select name="availAcco" id="availAcco" class="dropdown" style="width:150px;">
            <option value="" selected="selected">Select</option>
            <option value="Single Room" <?php echo $r1; ?>>Single Room</option>
            <option value="Double Room" <?php echo $r2; ?>>Double Room</option>
            <option value="Twin Sharing" <?php echo $r3; ?>>Twin Sharing</option>
            <option value="Suite Room" <?php echo $r4; ?>>Suite Room</option>
          </select>
        
          &nbsp;&nbsp;&nbsp;
          <select name="roomType" id="roomType" class="dropdown" style="width:auto;">
            <option value="" selected="selected">Select</option>
            <option value="1" <?php echo $rt1; ?>>A/C</option>
            <option value="2" <?php echo $rt2; ?>>Non A/C</option>
          </select>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <input type="checkbox" name="food" id="food" value="1" <?php echo $chk; ?>/> 
          Including Food&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <input type="text" name="accoRate" id="accoRate" class="textbox width_95 textCenter" value="<?php echo $accoRate; ?>"/> 
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
    <td width="24%" height="50" bgcolor="#E1EEED"><input type="text" name="grandTotal" id="grandTotal" class="textbox width_95 textCenter" value="<?php echo $grandTotal; ?>"/> 
      INR</td>
    <td width="18%" bgcolor="#E1EEED" class="green"><strong>Overall Rating</strong></td>
    <td width="1%" bgcolor="#E1EEED">:</td>
    <td height="50" bgcolor="#E1EEED"><input type="text" name="overallRating" id="rating" class="textbox width_40 textCenter" readonly="readonly" value="<?php echo $overallRating; ?>"/> 
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