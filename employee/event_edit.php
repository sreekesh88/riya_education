<?php 
error_reporting(0);
include ("../include/header.php"); 
session_start();
if(!isset($_SESSION['logged_in']) || $_SESSION['is_user'] != 1)
{
   header("Location:login.php");
}

include ("../include/validate.php"); 
include ("../include/menu.php"); 
$empID = $info['empID'];
$branchID = $info['branchID'];
$eventID = $_GET['id'];

?>

<script type="text/javascript" src="../js/datepair.js"></script>
<script type="text/javascript" src="../js/jquery.timepicker.js"></script>
<link rel="stylesheet" type="text/css" href="../css/jquery.timepicker.css" />

<script>


$(function() {

var currentTime = new Date();
var year = currentTime.getFullYear();
		
	$("#eventDate").datepicker({
	changeMonth: true,
	changeYear: true,
	dateFormat: "dd-mm-yy",
	minDate: "0y",
	yearRange: (year)+':'+(year+1) 
	});
	
	$('#startTime').timepicker({ 
	timeFormat: 'h:i A', 
	'scrollDefaultNow': true
	});
	$('#endTime').timepicker({ 
	timeFormat: 'h:i A',
	'scrollDefaultNow': true 
	});

});

function addRowToTable(table, row) {
    table.append(row);
}

$(document).ready(function() {
	var index = $('#lastDelegate').val();
	$('#addRow_delegate').click(function() {
		index++;
		var row = "<tr><td height='30' align='left'><input type='text' name='delegates[]' id='delegates_"+index+"' class='textbox width_150'/></td></tr>";
        addRowToTable($('#generate_delegate'), row);
    });
	
	var num = $('#lastStaff').val();
	$('#addRow_staff').click(function() {
		num++;
		var row = "<tr><td colspan='2' height='30' align='left'><input type='text' name='staffs[]' id='staffs_"+num+"' class='textbox width_150'/></td></tr>";
        addRowToTable($('#generate_staff'), row);
    });
	
	var ind = 1;
	$('#addRow_cost').click(function() {
		ind++;
		var row = "<tr><td width='12%' align='center'>"+ind+"</td><td width='31%' align='center'><input type='text' name='amounts[]' id='textfield_"+ind+"' class='textbox textCenter width_95'/></td><td colspan='2' align='center'><select name='particulars[]' id='particulars_"+ind+"' class='dropdown' style='width:160px;'><option value='' selected='selected' class='padding_2'>Select</option><option value='Venue' class='padding_2'>Venue</option><option value='Student Database' class='padding_2'>Student Database</option><option value='Flex' class='padding_2'>Flex</option><option value='Others' class='padding_2'>Others</option></select></td></tr>";
        addRowToTable($('#generate_cost'), row);
    });
	
		
});

function disableMe(box) {
  if(box.name == "av_chkbx" && box.checked) {
    fields.av_others.disabled = false;
  } else if(box.name == "av_chkbx" && box.checked == false) {
      fields.av_others.disabled = true;
  }
  
  if(box.name == "trans_chkbx" && box.checked) {
    fields.trans_others.disabled = false;
  } else if(box.name == "trans_chkbx" && box.checked == false) {
      fields.trans_others.disabled = true;
  }
}

$(document).on('keyup','#basicCost',function() {
	var amt = $('#basicCost').val();
	$('#totalCost').val(amt);
});

$(document).on('click','#radio2',function() {
	$("#org").show();
});

$(document).on('click','#radio1',function() {
	$("#org").hide();
});

</script>

<?php
$events = mysql_query("SELECT * FROM `events` WHERE eventID = '$eventID'");
$event_centre = mysql_query("SELECT * FROM `event_centre` WHERE eventID = '$eventID'");
$event_cost = mysql_query("SELECT * FROM `event_cost` WHERE eventID = '$eventID'");

if(isset($_POST['submit'])) {
	
	$update_centre = mysql_query("UPDATE `event_centre` 
								SET `eventCentre` = '".$_POST['eventCentre']."',
								`organizer` = '".$_POST['organizer']."',
								`conPerson` = '".$_POST['conPerson']."',
								`conEmail` = '".$_POST['conEmail']."',
								`conNumber` = '".$_POST['conNumber']."',
								`pincode` = '".$_POST['pincode']."',
								`addr1` = '".$_POST['addr1']."',
								`addr2` = '".$_POST['addr2']."',
								`city` = '".$_POST['city']."',
								`state` = '".$_POST['state']."'
								WHERE eventID = '$eventID'");
	
	$_POST['eventDate'] = date("Y-m-d", strtotime($_POST['eventDate']));
	$_POST['eventTime'] = $_POST['startTime']." - ".$_POST['endTime'];
	$delegates = implode(',',$_POST['delegates']);
	$staffs = implode(',',$_POST['staffs']);
	$quest1 = mysql_real_escape_string($_POST['quest1']);
	$quest2 = mysql_real_escape_string($_POST['quest2']);
	$quest3 = mysql_real_escape_string($_POST['quest3']);
	$quest4 = mysql_real_escape_string($_POST['quest4']);
	$remarks = mysql_real_escape_string($_POST['remarks']);
	
	$update_event = mysql_query("UPDATE `events` 
								SET `title` = '".$_POST['title']."',
								`eventDate` = '".$_POST['eventDate']."',
								`eventTime` = '".$_POST['eventTime']."',
								`delegates` = '".$delegates."',
								`staffID` = '".$_POST['staffID']."',
								`staffs` = '".$staffs."',
								`session` = '".$_POST['session']."',
								`duration` = '".$_POST['duration']."',
								`expNum` = '".$_POST['expNum']."',
								`quest1` = '".$quest1."',
								`quest2` = '".$quest2."',
								`quest3` = '".$quest3."',
								`quest4` = '".$quest4."',
								`remarks` = '".$remarks."'
								WHERE eventID = '$eventID'");
	

	$amounts = implode(',',$_POST['amounts']);
	$particulars = implode(',',$_POST['particulars']);
	$avUnits = implode(',',$_POST['avUnits']);
	$meals = implode(',',$_POST['meals']);
	$accomodation = implode(',',$_POST['accomodation']);
	$transportation = implode(',',$_POST['transportation']);
	
	$update_cost = mysql_query("UPDATE `event_cost` 
								SET `basicCost` = '".$_POST['basicCost']."',
								`avUnits` = '".$avUnits."',
								`avOthers` = '".$_POST['av_others']."',
								`meals` = '".$meals."',
								`accomodation` = '".$accomodation."',
								`transportation` = '".$transportation."',
								`transOthers` = '".$_POST['trans_others']."'
								WHERE eventID = '$eventID'");
	
	if($update_cost > 0) {
		$success = "The Event updated successfully!";
		echo '<META HTTP-EQUIV=Refresh CONTENT="0; URL=event_edit.php?id='.$eventID.'">';
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
<h2>Seminar/Fair Request Form</h2>
<br />        
<div class="fullWidth">
<form action="" method="post" enctype="multipart/form-data" name="fields">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="6" valign="top" align="center"><div id="success" class="green"><?php echo $success; ?></div></td>
  </tr>
  <tr>
    <td>
    <?php
    while($evt = mysql_fetch_array($events)) {
        $eventType = $evt['eventType'];
        $date = date("d-m-Y",strtotime($evt['date']));
        $empID = $evt['empID'];
        $title = $evt['title'];
        $eventDate = date("d-m-Y",strtotime($evt['eventDate']));
		$times = explode(' - ', $evt['eventTime']);
		$startTime = $times[0];
		$endTime = $times[1];
        $branchID = $evt['branchID'];
		
		$delegates = explode(',', $evt['delegates']);
		$staffID = $evt['staffID'];
		$staffs = explode(',', $evt['staffs']);
		
        $session = $evt['session'];		
        $duration = $evt['duration'];
		$expNum = $evt['expNum'];
		
		$quest1 = mysql_real_escape_string($evt['quest1']);
		$quest2 = mysql_real_escape_string($evt['quest2']);
		$quest3 = mysql_real_escape_string($evt['quest3']);
		$quest4 = mysql_real_escape_string($evt['quest4']);
		$remarks = mysql_real_escape_string($evt['remarks']);
	} ?>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="50" valign="top" class="blue"><strong>Type of Event</strong></td>
        <td height="30" valign="top">:</td>
        <td height="30" colspan="4" valign="top" class="green">
        <?php if($eventType == '0') { $sel1 = 'checked="checked"'; } else { $sel2 = 'checked="checked"'; } ?>
		    <input type="radio" id="radio1" name="eventType" value="0" <?php echo $sel1; ?> /> &nbsp;&nbsp;<strong>Seminar</strong> &nbsp;&nbsp;&nbsp;&nbsp;
            <input type="radio" id="radio2" name="eventType" value="1" <?php echo $sel2; ?> /> &nbsp;&nbsp;<strong>Fair</strong>
        </td>
      </tr>
		<?php
        while($ec = mysql_fetch_array($event_centre)) {
            $eventCentre = $ec['eventCentre'];
            $organizer = $ec['organizer'];
            $conPerson = $ec['conPerson'];
            $conEmail = $ec['conEmail'];
            $conNumber = $ec['conNumber'];
            $pincode = $ec['pincode'];
            $addr1 = $ec['addr1'];
            $addr2 = $ec['addr2'];
            $city = $ec['city'];
            $state = $ec['state'];
        }
        ?>	
      <tr>
        <td height="40" valign="top" class="red"><strong>Centre of Event</strong>&nbsp;&nbsp;&nbsp;</td>
        <td valign="top">:</td>
        <td valign="top"><input type="text" name="eventCentre" id="eventCentre" class="textbox width_200" value="<?php echo $eventCentre; ?>"/></td>
        <td valign="top" colspan="3">
        <?php if($organizer != '') { ?>
          	<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="36" class="blue">Organized by </td>
                <td width="4%">:</td>
                <td width="60%"><input type="text" name="organizer" id="organizer" class="textbox width_200" value="<?php echo $organizer; ?>"/></td>
              </tr>
            </table>          
        <?php } ?>
        </td>
      </tr>
      <tr>
        <td height="40" valign="top">Contact Person</td>
        <td valign="top">:</td>
        <td valign="top"><input type="text" name="conPerson" id="conPerson" class="textbox width_200" value="<?php echo $conPerson; ?>"/></td>
        <td rowspan="2" valign="top">Address</td>
        <td rowspan="2" valign="top">:</td>
        <td rowspan="2" valign="top"><div class="addressBox">
          <input type="text" name="addr1" id="addr1" class="addrInput" value="<?php echo $addr1; ?>"/>
          <input type="text" name="addr2" id="addr2" class="addrInput" value="<?php echo $addr2; ?>"/>
        </div></td>
      </tr>
      <tr>
        <td width="15%" height="40" valign="top">Contact Number</td>
        <td width="2%" valign="top">:</td>
        <td width="33%" valign="top"><input type="text" name="conNumber" id="conNumber" class="textbox width_200" value="<?php echo $conNumber; ?>" /></td>
        </tr>
      <tr>
        <td width="15%">Email Id</td>
        <td width="2%">:</td>
        <td width="33%"><input type="text" name="conEmail" id="conEmail" class="textbox width_200" value="<?php echo $conEmail; ?>"/></td>
        <td width="18%">City / Area</td>
        <td width="2%">:</td>
        <td width="30%"><input type="text" name="city" id="city" class="textbox width_200" value="<?php echo $city; ?>" /></td>
      </tr>
      <tr>
        <td height="40">Pincode</td>
        <td>:</td>
        <td><input type="text" name="pincode" id="pincode" class="textbox width_200" maxlength="6" value="<?php echo $pincode; ?>"/>        </td>
        <td>State</td>
        <td>:</td>
        <td>
        <select name="state" id="state" class="dropdown" >
            <option value="" selected="selected" class="padding_2">Select</option>
            <?php
            $states = mysql_query("SELECT * FROM `states`");
            while($rows = mysql_fetch_array($states)) {
            echo "<option value='".$rows['stateID']."' class='padding_2'";
            if($rows['stateID'] == $state)
            echo "selected='selected'";
            echo ">".$rows['state']."</option>";
            }
            ?>
        </select>
        </td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="60"><h6>Event Information</h6></td>
  </tr>
  <tr>
    <td>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="40" valign="top"><strong class="red">Title of the Event</strong> &nbsp;&nbsp;</td>
        <td height="40" valign="top">:</td>
        <td height="40" colspan="4" valign="top"><input type="text" name="title" id="title" class="textboxLarge" value="<?php echo $title; ?>"/></td>
        </tr>
      <tr>
        <td width="15%" height="35" valign="top">Date of Event</td>
        <td width="2%" valign="top">:</td>
        <td width="33%" valign="top"><input type="text" name="eventDate" id="eventDate" class="textbox width_200 textCenter" value="<?php echo $eventDate; ?>"/></td>
        <td width="18%" valign="top">Time</td>
        <td width="2%" valign="top">:</td>
        <td width="30%" valign="top">
        <input type="text" id="startTime" name="startTime" class="time width_95 textbox textCenter" value="<?php echo $startTime; ?>"/> -
  		<input type="text" id="endTime" name="endTime" class="time width_95 textbox textCenter" value="<?php echo $endTime; ?>"/></td>
      </tr>
      <tr>
        <td height="35" valign="top">Delegate (s)</td>
        <td valign="top">:</td>
        <td valign="top">
        
        <table width="160" border="0" cellspacing="0" cellpadding="0" id="generate_delegate">
            <?php
			$lastKey = sizeof($delegates)-1;
			for($i=0;$i<=$lastKey;$i++)
			{
			 $j = $i+1;
			?>
            <input type="hidden" id="lastDelegate" value="<?php echo sizeof($delegates); ?>" />
            <tr>
              <td height="30" align="left">
              <input type="text" name="delegates[]" id="delegate_<?php echo $j; ?>" class="textbox width_150" value="<?php echo $delegates[$i]; ?>"/></td>
            </tr>
            <?php } ?>            
        </table><span id="addRow_delegate" class="anchor" title="Add Delegates">Add more[+]</span>
        
        </td>
        <td valign="top">Staff (s)</td>
        <td valign="top">:</td>
        <td valign="top">
        <table width="230" border="0" cellspacing="0" cellpadding="0" id="generate_staff">
          <tr>
            <td width="180" align="left" height="30"><select name="staffID" id="staffID" class="dropdown" style="width:170px;">
              <option value="" selected="selected" class="padding_2">Select</option>
              <?php
				$employees = mysql_query("SELECT * FROM `employees` WHERE delStatus = '0'");
				while($row = mysql_fetch_array($employees)) {
					//echo '<option value="'.$row['empID'].'" class="padding_2">'.$row['fname'].' '.$row['lname'].'</option>';
					echo "<option value='".$row['empID']."' class='padding_2'";
					if($row['empID'] == $staffID)
					echo "selected='selected'";
					echo ">".$row['fname']." ".$row['lname']."</option>";;
				}
				?>
              </select></td>
            <td width="50" align="left"><span id="addRow_staff" class="anchor" title="Add Staffs">[+]</span></td>
          </tr>
          <?php
			$lastStaff = sizeof($staffs)-1;
			for($i=0;$i<=$lastStaff;$i++)
			{
			 $j = $i+1;
		  ?>
          <input type="hidden" id="lastStaff" value="<?php echo sizeof($staffs); ?>" />
          <tr>
          <td colspan='2' height='30' align='left'>
          <input type='text' name='staffs[]' id='staffs_<?php echo $j; ?>' class='textbox width_150' value="<?php echo $staffs[$i]; ?>"/></td>
          </tr>
          <?php } ?> 
        </table></td>
      </tr>
    </table>    </td>
  </tr>
  <tr>
    <td height="60"><h6>Target Audience</h6></td>
  </tr>
  <tr>
    <td>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="15%" height="40">No. of Sessions</td>
        <td width="2%">:</td>
        <td width="15%"><input type="text" name="session" id="session" class="textbox width_60" value="<?php echo $session; ?>"/></td>
        <td width="18%">Length of Session</td>
        <td width="2%">:</td>
        <td width="48%"><input type="text" name="duration" id="duration" class="textbox width_60" value="<?php echo $duration; ?>"/> hrs</td>
      </tr>
      <tr>
        <td height="35" colspan="6" class="blue"><strong>No. of Participants Expected:</strong></td>
      </tr>
      <tr>
        <td colspan="6" valign="top">
        <?php 
		if($expNum == "Not Sure") { $val1 = 'checked="checked"'; }
		else if($expNum == "1-10") { $val2 = 'checked="checked"'; }
		else if($expNum == "11-25") { $val3 = 'checked="checked"'; }
		else if($expNum == "26-50") { $val4 = 'checked="checked"'; }
		else if($expNum == "51-100") { $val5 = 'checked="checked"'; }
		else if($expNum == "Above 100") { $val6 = 'checked="checked"'; }
		?>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="17%">&nbsp;</td>
            <td width="16%" height="35"><input type="radio" name="expNum" value="Not Sure" <?php echo $val1; ?>/> Not Sure</td>
            <td width="16%"><input type="radio" name="expNum" value="1-10" <?php echo $val2; ?> /> 1-10</td>
            <td width="51%"><input type="radio" name="expNum" value="11-25" <?php echo $val3; ?> /> 11-25</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td height="35"><input type="radio" name="expNum" value="26-50" <?php echo $val4; ?> /> 26-50</td>
            <td><input type="radio" name="expNum" value="51-100" <?php echo $val5; ?> /> 51-100</td>
            <td><input type="radio" name="expNum" value="Above 100" <?php echo $val6; ?> /> Above 100</td>
          </tr>
        </table></td>
        </tr>
    </table>    </td>
  </tr>
    <td height="60"><h6>General Information</h6></td>
  </tr>
  <tr>
    <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td valign="top" class="green">1. Describe your target audience. Who is likely to attend?</td>
          </tr>
        <tr>
          <td height="100" valign="top"><textarea name="quest1" class="textarea width_440"><?php echo $quest1; ?></textarea></td>
          </tr>
        <tr>
          <td valign="top" class="green">2. Is there any specific topic you would like to address in the Seminar?</td>
          </tr>
        <tr>
          <td height="100" valign="top"><textarea name="quest2" class="textarea width_440"><?php echo $quest2; ?></textarea></td>
          </tr>
        <tr>
          <td valign="top" class="green">3. What are your hope for this Seminar?</td>
          </tr>
        <tr>
          <td height="100" valign="top"><textarea name="quest3" class="textarea width_440"><?php echo $quest3; ?></textarea></td>
          </tr>
        <tr>
          <td valign="top" class="green">4. What type of publicity will you use?</td>
          </tr>
        <tr>
          <td height="100" valign="top"><textarea name="quest4" class="textarea width_440"><?php echo $quest4; ?></textarea></td>
          </tr>
        <tr>
          <td valign="top">Remarks <span class="green">(if any)</span></td>
          </tr>
        <tr>
          <td height="100" valign="top"><textarea name="remarks" class="textarea width_440"><?php echo $remarks; ?></textarea></td>
          </tr>
      </table></td>
  </tr>
  <tr>
    <td height="60"><h6>Additional Requirements</h6></td>
  </tr>
  <?php
  while($ev = mysql_fetch_array($event_cost)) {
  	$avUnits = explode(',',$ev['avUnits']);
	foreach($avUnits as $avs) {
		if($avs == '1') { $a1 = 'checked="checked"'; }
		else if($avs == '2') { $a2 = 'checked="checked"'; }
		else if($avs == '3') { $a3 = 'checked="checked"'; }
		else if($avs == '4') { $a4 = 'checked="checked"'; }
		else if($avs == '5') { $a5 = 'checked="checked"'; }
		else if($avs == '6') { $a6 = 'checked="checked"'; }
		else if($avs == '7') { $a7 = 'checked="checked"'; }
	}
	$avOthers = $ev['avOthers'];
	if($avOthers != '') {
		$a0 = 'checked="checked"';
	}
	
	$meals = explode(',',$ev['meals']);
	foreach($meals as $mls) {
		if($mls == '1') { $m1 = 'checked="checked"'; }
		else if($mls == '2') { $m2 = 'checked="checked"'; }
		else if($mls == '3') { $m3 = 'checked="checked"'; }
		else if($mls == '4') { $m4 = 'checked="checked"'; }
	}
	
	$acco = explode(',',$ev['accomodation']);
	foreach($acco as $acc) {
		if($acc == '1') { $ac1 = 'checked="checked"'; }
		else if($acc == '2') { $ac2 = 'checked="checked"'; }
		else if($acc == '3') { $ac3 = 'checked="checked"'; }
		else if($acc == '4') { $ac4 = 'checked="checked"'; }
	}
	
	$trans = explode(',',$ev['transportation']);
	foreach($trans as $trs) {
		if($trs == '1') { $t1 = 'checked="checked"'; }
		else if($trs == '2') { $t2 = 'checked="checked"'; }
		else if($trs == '3') { $t3 = 'checked="checked"'; }
		else if($trs == '4') { $t4 = 'checked="checked"'; }
		else if($trs == '5') { $t5 = 'checked="checked"'; }
		else if($trs == '6') { $t6 = 'checked="checked"'; }
	}
	$transOthers = $ev['transOthers'];
	if($transOthers != '') {
		$t0 = 'checked="checked"';
	}
	
	$basicCost = $ev['basicCost'];
	$amounts = explode(',',$ev['amounts']);
	$particulars = explode(',',$ev['particulars']);
				
  }
  ?>
  <tr>
    <td>
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="pad">
      <tr>
        <td width="18%" height="60" valign="top" class="green">Audio/Visual units</td>
        <td width="2%" valign="top">:</td>
        <td width="80%" valign="top">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="30%" height="30"><input type="checkbox" name="avUnits[]" id="avProj" value="1" <?php echo $a1; ?>> LCD Projector</td>
            <td width="30%"><input type="checkbox" name="avUnits[]" id="avPinboard" value="4" <?php echo $a4; ?>> Pinboard</td>
            <td width="40%"><input type="checkbox" name="avUnits" id="avTv" value="7" <?php echo $a7; ?>> TV</td>
          </tr>
          <tr>
            <td height="30"><input type="checkbox" name="avUnits[]" id="avLap" value="2" <?php echo $a2; ?>> Laptop</td>
            <td><input type="checkbox" name="avUnits[]" id="avFlex" value="5" <?php echo $a5; ?>> Flex</td>
            <td><input type="checkbox" name="av_chkbx" id="av_chkbx" onclick="disableMe(this)" value="0" <?php echo $a0; ?>/> Others</td>
          </tr>
          <tr>
            <td height="30"><input type="checkbox" name="avUnits[]" id="avMobile" value="3" <?php echo $a3; ?>> Mobile</td>
            <td><input type="checkbox" name="avUnits[]" id="avComputer" value="6" <?php echo $a6; ?>> Computer</td>
            <td><input type="text" name="av_others" id="av_others" class="textbox width_200" <?php if($avOthers == '') { ?> disabled="disabled" <?php } ?> value="<?php echo $avOthers; ?>"></td>
          </tr>
          </table>
        </td>
      </tr>
      <tr>
        <td height="40" valign="top" bgcolor="#eee" class="green">Meals</td>
        <td valign="top" bgcolor="#eee">:</td>
        <td bgcolor="#eee"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="30%" height="30"><input type="checkbox" name="meals[]" id="drinks" value="1" <?php echo $m1; ?> > Coffee/Tea</td>
            <td width="30%"><input type="checkbox" name="meals[]" id="lunch" value="3" <?php echo $m3; ?> /> Lunch</td>
            <td width="40%">&nbsp;</td>
            </tr>
          <tr>
            <td height="30"><input type="checkbox" name="meals[]" id="brkfst" value="2" <?php echo $m2; ?> /> Breakfast </td>
            <td><input type="checkbox" name="meals[]" id="dinner" value="4" <?php echo $m4; ?>/> Dinner</td>
            <td>&nbsp;</td>
            </tr>
        </table></td>
      </tr>
      <tr>
        <td height="40" class="green">Accomodation</td>
        <td>:</td>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="25%"><input type="checkbox" name="accomodation[]" id="single" value="1" <?php echo $ac1; ?>> Single Room</td>
    <td width="25%"><input type="checkbox" name="accomodation[]" id="double" value="2" <?php echo $ac2; ?>> Double Room</td>
    <td width="25%"><input type="checkbox" name="accomodation[]" id="twin" value="3" <?php echo $ac3; ?>/> Twin Sharing</td>
    <td width="25%"><input type="checkbox" name="accomodation[]" id="suite" value="4" <?php echo $ac4; ?>/> Suite Room</td>
  </tr>
</table></td>
      </tr>
      <tr>
        <td valign="top" bgcolor="#eee" class="green">Transportation</td>
        <td valign="top" bgcolor="#eee">:</td>
        <td valign="top" bgcolor="#eee"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="30%" height="30"><input type="checkbox" name="transportation[]" id="flight" value="1" <?php echo $t1; ?> > Flight</td>
            <td width="30%"><input type="checkbox" name="transportation[]" id="train" value="4" <?php echo $t4; ?>> Train</td>
            <td width="40%"><input type="checkbox" name="trans_chkbx" id="trans_chkbx" onClick="disableMe(this)" value="0" <?php echo $t0; ?>> Others</td>
          </tr>
          <tr>
            <td height="30"><input type="checkbox" name="transportation[]" id="car" value="2" <?php echo $t2; ?>> Car</td>
            <td><input type="checkbox" name="transportation[]" id="bus" value="5" <?php echo $t5; ?>> Bus</td>
            <td><input type="text" name="trans_others" id="trans_others" class="textbox width_200" <?php if($transOthers == '') { ?> disabled="disabled" <?php } ?> value="<?php echo $transOthers; ?>"></td>
          </tr>
          <tr>
            <td height="30"><input type="checkbox" name="transportation[]" id="2wheeler" value="3" <?php echo $t3; ?>/> 2 Wheeler</td>
            <td><input type="checkbox" name="transportation[]" id="auto" value="6" <?php echo $t6; ?>/> Auto</td>
            <td>&nbsp;</td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="60"><h6>Expected Budget</h6></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="24%" height="40" class="red"><strong>Cost of the Event</strong></td>
        <td width="1%">:</td>
        <td><input type="text" name="basicCost" id="basicCost" class="textbox textCenter width_95" value="<?php echo $basicCost; ?>"/> 
          INR</td>
        </tr>
      <tr>
        <td height="40" valign="top">Cost Details</td>
        <td valign="top">:</td>
        <td valign="top">
        <table width="63%" border="0" cellspacing="0" cellpadding="0" class="table" id="generate_cost">
            <tr>
              <th width="12%" align="center">No</th>
              <th width="31%"  align="center">Amount</th>
              <th width="49%" align="center">Particulars</th>
              <th width="8%" align="center"><span id="addRow_cost" class="anchor" title="Add Details">[+]</span></th>
            </tr>
            <?php
			foreach($particulars as $pt) {
				//echo $pt;
				if($pt == "Venue") { $pts1 = "Venue"; }
				else if($pt == "Student Database") { $pts2 = "Student Database"; }
				else if($pt == "Others") { $pts3 = "Others"; }
				//break;
			}
			echo $pts1; echo "-".$pts2; echo "-".$pts3; 
			$k = 0;
			foreach($amounts as $amt) {
				$k++;
				
			?>
            <tr>
              <td align="center"><?php echo $k; ?></td>
              <td align="center">
              <input type="text" name="amounts[]" id="amounts_<?php echo $k; ?>" class="textbox textCenter width_95" value="<?php echo $amt; ?>"/>
              </td>
              <td colspan="2" align="center">
              <input type="text" name="amounts[]" id="particulars_<?php echo $k; ?>" class="textbox textCenter width_95" value="<?php echo $pts1; ?>"/>
              
                <?php /*?><select name="particulars[]" id="particulars_<?php echo $k; ?>" class="dropdown" style="width:160px;">
                <option value="" class="padding_2">Select</option>
                <option value="Venue" class="padding_2" <?php $selec1; ?>>Venue</option>
                <option value="Student Database" class="padding_2" <?php $selec; ?>>Student Database</option>
                <option value="Flex" class="padding_2" <?php $selec; ?>>Flex</option>
                <option value="Others" class="padding_2" <?php $selec; ?>>Others</option>
                </select><?php */?></td>
            </tr>
            <?php } ?>
        </table></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="60" align="center"><input type="submit"  name="submit" value="Submit" class="button width_200"></td>
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
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