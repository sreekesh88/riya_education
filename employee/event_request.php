<?php 
error_reporting(0);
include ("../include/header.php"); 
session_start();
if(!isset($_SESSION['logged_in']))
{
   header("Location:login.php");
}

include ("../include/validate.php"); 
include ("../include/menu.php"); 
$empID = $info['empID'];
$branchID = $info['branchID'];
//echo "RT: ".$rt = $_GET['id'];

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
    var index = 1;
	$('#addRow_delegate').click(function() {
		index++;
		var row = "<tr><td colspan='2' height='30' align='left'><input type='text' name='delegates[]' id='delegates_"+index+"' class='textbox width_150'/><span onclick='this.parentNode.remove()' style='color:red;cursor:pointer;padding-left:5px;'> [ x ] </span></td></tr>";
        addRowToTable($('#generate_delegate'), row);
    });
	
	var num = 0;
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
$saID = $_GET['id'];
$sales_activity = mysql_query("SELECT * FROM `sales_activity` WHERE saID = '$saID'");
while($row = mysql_fetch_array($sales_activity)) {
	$salesID = $row['salesID'];
	$instnName = $row['instnName'];
	$contPerson = $row['contPerson'];
	$mobile = $row['mobile'];
	$phone = $row['phone'];
	$email = $row['email'];
	$address = $row['addr1']."<br>".$row['addr2']."<br>".$row['addr3'];
	$visit_purpose = $row['visit_purpose'];
	if($visit_purpose == '2') {$eventType = "Seminar";}
	else if($visit_purpose == '3') {$eventType = "Fair";}
}
?>

<?php
if(isset($_POST['submit'])) {

	$date = date("Y-m-d");
	$eventType = $_POST['eventType'];
	$title = $_POST['title'];
	$eventDate = date("Y-m-d", strtotime($_POST['eventDate']));
	$eventTime = $_POST['startTime']." - ".$_POST['endTime'];
	$delegates = implode(',',$_POST['delegates']);
	$staffID = $_POST['staffID'];
	$staffs = implode(',',$_POST['staffs']);
	$session = $_POST['session'];
	$duration = $_POST['duration'];
	$expNum = $_POST['expNum'];
 
	$quest1 = mysql_real_escape_string($_POST['quest1']);
	$quest2 = mysql_real_escape_string($_POST['quest2']);
	$quest3 = mysql_real_escape_string($_POST['quest3']);
	$quest4 = mysql_real_escape_string($_POST['quest4']);
	$remarks = mysql_real_escape_string($_POST['remarks']);
	
	if($title != '') {
		$seminar = mysql_query("INSERT INTO `events` (`eventType`, `salesID`, `date`, `empID`, `branchID`, `title`, `eventDate`, `eventTime`, `delegates`, `staffID`, `staffs`, `session`, `duration`, `expNum`, `quest1`, `quest2`, `quest3`, `quest4`, `remarks`) VALUES ('$eventType', '$date', '$empID', '$branchID', '$title', '$eventDate', '$eventTime', '$delegates', '$staffID', '$staffs', '$session', '$duration', '$expNum', '$quest1', '$quest2', '$quest3', '$quest4', '$remarks')");
	}
	
	$eventID = mysql_insert_id();
	
	$eventCentre = $_POST['eventCentre'];
	$organizer = $_POST['organizer'];
	$addr1 = $_POST['addr1'];
	$addr2 = $_POST['addr2'];
	$city = $_POST['city'];
	$state = $_POST['state'];
	$pincode = $_POST['pincode'];
	$conPerson = $_POST['conPerson'];
	$conEmail = $_POST['conEmail'];
	$conNumber = $_POST['conNumber'];
	
	if($eventCentre != '') {	
		$event = mysql_query("INSERT INTO `event_centre` (`eventID`, `eventCentre`, `organizer`, `addr1`, `addr2`, `city`, `state`, `pincode`, `conPerson`, `conEmail`, `conNumber`) VALUES ('$eventID', '$eventCentre', '$organizer', '$addr1', '$addr2', '$city', '$state', '$pincode', '$conPerson', '$conEmail', '$conNumber')");
	}
	
	$basicCost = $_POST['basicCost'];
	$amounts = implode(',',$_POST['amounts']);
	$particulars = implode(',',$_POST['particulars']);
	$avUnits = implode(',',$_POST['avUnits']);
	$av_others = $_POST['av_others'];
	$meals = implode(',',$_POST['meals']);
	$accomodation = implode(',',$_POST['accomodation']);
	$transportation = implode(',',$_POST['transportation']);
	$trans_others = $_POST['trans_others'];
	
	if($basicCost != '') {
		$cost = mysql_query("INSERT INTO `event_cost` (`eventID`, `basicCost`, `amounts`, `particulars`, `avUnits`, `avOthers`, `meals`, `accomodation`, `transportation`, `transOthers`) VALUES ('$eventID', '$basicCost', '$amounts', '$particulars', '$avUnits', '$av_others', '$meals', '$accomodation', '$transportation', '$trans_others')");
		
		if($cost > 0) {
			$success = "Your Feedback has been submitted successfully!";
			?>    
			<script language='javascript'>
			setTimeout("$('#success').fadeOut('slow')", 3000);
			</script>
			<?php
		}
	}
	
}
?><div id="wrapper_top"></div>
<div id="wrapper">
<?php include("../include/left.php"); ?>
<div class="main_col dotted_border">
<h2>Event Request Form</h2>
<br />        
<div class="fullWidth">
<form action="" method="post" enctype="multipart/form-data" name="fields">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="6" valign="top" align="center"><div id="success" class="green"><?php echo $success; ?></div></td>
  </tr>
  <?php if($saID != '') { ?>
  <tr>
    <td colspan="6">
    	<div id="searchArea" style="margin-bottom: 15px;">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="15%" height="30">Sales ID</td>
            <td width="2%">:</td>
            <td width="33%"><b class="red"><?php echo $salesID; ?></b></td>
            <td width="15%">Event type</td>
            <td width="2%">:</td>
            <td width="33%"><b class="green"><?php echo $eventType; ?></b></td>
          </tr>
          <tr>
            <td height="30">Institution Name</td>
            <td>:</td>
            <td><?php echo $instnName; ?></td>
            <td>Email</td>
            <td>:</td>
            <td align="left" valign="top"><?php echo $email; ?></td>
          </tr>
          <tr>
            <td height="30">Contact Person</td>
            <td>:</td>
            <td><?php echo $contPerson; ?></td>
            <td>Address</td>
            <td>:</td>
            <td rowspan="2" align="left" valign="top"><?php echo $address; ?></td>
          </tr>
          <tr>
            <td height="30">Mobile</td>
            <td>:</td>
            <td><?php echo $mobile; ?></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            </tr>
        </table>
        </div>
    </td>
  </tr>
  <?php } ?>
  <tr>
    <td>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="50" valign="top" class="blue"><strong>Type of Event</strong></td>
        <td height="30" valign="top">:</td>
        <td height="30" colspan="4" valign="top" class="green">
		    <input type="radio" id="radio1" name="eventType" value="0" /> &nbsp;&nbsp;<strong>Seminar</strong> &nbsp;&nbsp;&nbsp;&nbsp;
            <input type="radio" id="radio2" name="eventType" value="1" /> &nbsp;&nbsp;<strong>Fair</strong>
        </td>
      </tr>
      <tr>
        <td height="40" valign="top" class="red"><strong>Centre of Event</strong>&nbsp;&nbsp;&nbsp;</td>
        <td valign="top">:</td>
        <td valign="top"><input type="text" name="eventCentre" id="eventCentre" class="textbox width_200"/></td>
        <td valign="top" colspan="3">
        <div id="org" style="display:none;">
          	<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="36" class="blue">Organized by </td>
                <td width="4%">:</td>
                <td width="60%"><input type="text" name="organizer" id="organizer" class="textbox width_200" /></td>
              </tr>
            </table>          
        </div>
        </td>
      </tr>
      <tr>
        <td height="40" valign="top">Contact Person</td>
        <td valign="top">:</td>
        <td valign="top"><input type="text" name="conPerson" id="conPerson" class="textbox width_200"/></td>
        <td rowspan="2" valign="top">Address</td>
        <td rowspan="2" valign="top">:</td>
        <td rowspan="2" valign="top"><div class="addressBox">
          <input type="text" name="addr1" id="addr1" class="addrInput" />
          <input type="text" name="addr2" id="addr2" class="addrInput" />
        </div></td>
      </tr>
      <tr>
        <td width="15%" height="40" valign="top">Contact Number</td>
        <td width="2%" valign="top">:</td>
        <td width="33%" valign="top"><input type="text" name="conNumber" id="conNumber" class="textbox width_200" /></td>
        </tr>
      <tr>
        <td width="15%">Email Id</td>
        <td width="2%">:</td>
        <td width="33%"><input type="text" name="conEmail" id="conEmail" class="textbox width_200"/></td>
        <td width="18%">City / Area</td>
        <td width="2%">:</td>
        <td width="30%"><input type="text" name="city" id="city" class="textbox width_200" /></td>
      </tr>
      <tr>
        <td height="40">Pincode</td>
        <td>:</td>
        <td><input type="text" name="pincode" id="pincode" class="textbox width_200" maxlength="6" />        </td>
        <td>State</td>
        <td>:</td>
        <td><select name="state" id="state" class="dropdown" >
          <option value="" selected="selected" class="padding_2">Select</option>
          <?php
		$states = mysql_query("SELECT * FROM `states`");
		while($rows = mysql_fetch_array($states)) {
			echo "<option value='".$rows['stateID']."' class='padding_2'";
			if($rows['stateID'] == '10')
			echo "selected='selected'";
			echo ">".$rows['state']."</option>";
		}
		?>
        </select></td>
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
        <td height="40" colspan="4" valign="top"><input type="text" name="title" id="title" class="textboxLarge"/></td>
        </tr>
      <tr>
        <td width="15%" height="35" valign="top">Date of Event</td>
        <td width="2%" valign="top">:</td>
        <td width="33%" valign="top"><input type="text" name="eventDate" id="eventDate" class="textbox width_200 textCenter"/></td>
        <td width="18%" valign="top">Time</td>
        <td width="2%" valign="top">:</td>
        <td width="30%" valign="top"><input type="text" id="startTime" name="startTime" class="time width_95 textbox textCenter"/>
-
  <input type="text" id="endTime" name="endTime" class="time width_95 textbox textCenter"/></td>
      </tr>
      <tr>
        <td height="35" valign="top">Delegate (s)</td>
        <td valign="top">:</td>
        <td valign="top">
        
        <table width="230" border="0" cellspacing="0" cellpadding="0" id="generate_delegate">
            <tr>
              <td width="160" height="30" align="left"><input type="text" name="delegates[]" id="delegate_1" class="textbox width_150"/></td>
              <td width="70" align="left"><span id="addRow_delegate" class="anchor" title="Add Delegates">[+]</span></td>
            </tr>            
        </table>        </td>
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
					echo '<option value="'.$row['empID'].'" class="padding_2">'.$row['fname'].' '.$row['lname'].'</option>';
				}
				?>
              </select></td>
            <td width="50" align="left"><span id="addRow_staff" class="anchor" title="Add Staffs">[+]</span></td>
          </tr>
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
        <td width="15%"><input type="text" name="session" id="session" class="textbox width_60"/></td>
        <td width="18%">Length of Session</td>
        <td width="2%">:</td>
        <td width="48%"><input type="text" name="duration" id="duration" class="textbox width_60"/> hrs</td>
      </tr>
      <tr>
        <td height="35" colspan="6" class="blue"><strong>No. of Participants Expected:</strong></td>
      </tr>
      <tr>
        <td colspan="6" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="17%">&nbsp;</td>
            <td width="16%" height="35"><input type="radio" name="expNum" value="Not Sure"/> Not Sure</td>
            <td width="16%"><input type="radio" name="expNum" value="1-10" /> 1-10</td>
            <td width="51%"><input type="radio" name="expNum" value="11-25" /> 11-25</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td height="35"><input type="radio" name="expNum" value="26-50" /> 26-50</td>
            <td><input type="radio" name="expNum" value="51-100" /> 51-100</td>
            <td><input type="radio" name="expNum" value="Above 100" /> Above 100</td>
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
          <td height="100" valign="top"><textarea name="quest1" class="textarea width_440"></textarea></td>
          </tr>
        <tr>
          <td valign="top" class="green">2. Is there any specific topic you would like to address in the Seminar?</td>
          </tr>
        <tr>
          <td height="100" valign="top"><textarea name="quest2" class="textarea width_440"></textarea></td>
          </tr>
        <tr>
          <td valign="top" class="green">3. What are your hope for this Seminar?</td>
          </tr>
        <tr>
          <td height="100" valign="top"><textarea name="quest3" class="textarea width_440"></textarea></td>
          </tr>
        <tr>
          <td valign="top" class="green">4. What type of publicity will you use?</td>
          </tr>
        <tr>
          <td height="100" valign="top"><textarea name="quest4" class="textarea width_440"></textarea></td>
          </tr>
        <tr>
          <td valign="top">Remarks <span class="green">(if any)</span></td>
          </tr>
        <tr>
          <td height="100" valign="top"><textarea name="remarks" class="textarea width_440"></textarea></td>
          </tr>
      </table></td>
  </tr>
  <tr>
    <td height="60"><h6>Additional Requirements</h6></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0" class="pad">
      <tr>
        <td width="18%" height="60" valign="top" class="green">Audio/Visual units</td>
        <td width="1%" valign="top">:</td>
        <td width="81%" valign="top">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="30%" height="30"><input type="checkbox" name="avUnits[]" id="avProj" value="1"  > LCD Projector</td>
            <td width="30%"><input type="checkbox" name="avUnits[]" id="avPinboard" value="4" > Pinboard</td>
            <td width="40%"><input type="checkbox" name="avUnits" id="avTv" value="7"> TV</td>
          </tr>
          <tr>
            <td height="30"><input type="checkbox" name="avUnits[]" id="avLap" value="2"> Laptop</td>
            <td><input type="checkbox" name="avUnits[]" id="avFlex" value="5" > Flex</td>
            <td><input type="checkbox" name="av_chkbx" id="av_chkbx" onclick="disableMe(this)" value="0" /> 
              Others</td>
          </tr>
          <tr>
            <td height="30"><input type="checkbox" name="avUnits[]" id="avMobile" value="3"> Mobile</td>
            <td><input type="checkbox" name="avUnits[]" id="avComputer" value="6"> Computer</td>
            <td><input type="text" name="av_others" id="av_others" class="textbox width_200" disabled="disabled"></td>
          </tr>
        </table>        </td>
      </tr>
      <tr>
        <td height="40" valign="top" bgcolor="#eee" class="green">Meals</td>
        <td valign="top" bgcolor="#eee">:</td>
        <td bgcolor="#eee"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="30%" height="30"><input type="checkbox" name="meals[]" id="drinks" value="1" > Coffee/Tea</td>
            <td width="30%"><input type="checkbox" name="meals[]" id="lunch" value="3" /> Lunch</td>
            <td width="40%">&nbsp;</td>
            </tr>
          <tr>
            <td height="30"><input type="checkbox" name="meals[]" id="brkfst" value="2" /> Breakfast </td>
            <td><input type="checkbox" name="meals[]" id="dinner" value="4" /> Dinner</td>
            <td>&nbsp;</td>
            </tr>
        </table></td>
      </tr>
      <tr>
        <td height="40" class="green">Accomodation</td>
        <td>:</td>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="25%"><input type="checkbox" name="accomodation[]" id="single" value="1"> Single Room</td>
    <td width="25%"><input type="checkbox" name="accomodation[]" id="double" value="2"> Double Room</td>
    <td width="25%"><input type="checkbox" name="accomodation[]" id="twin" value="3"/> Twin Sharing</td>
    <td width="25%"><input type="checkbox" name="accomodation[]" id="suite" value="4"/> Suite Room</td>
  </tr>
</table></td>
      </tr>
      <tr>
        <td valign="top" bgcolor="#eee" class="green">Transportation</td>
        <td valign="top" bgcolor="#eee">:</td>
        <td valign="top" bgcolor="#eee"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="30%" height="30"><input type="checkbox" name="transportation[]" id="flight" value="1" > Flight</td>
            <td width="30%"><input type="checkbox" name="transportation[]" id="train" value="4"> Train</td>
            <td width="40%"><input type="checkbox" name="trans_chkbx" id="trans_chkbx" onClick="disableMe(this)" value="0"> Others</td>
          </tr>
          <tr>
            <td height="30"><input type="checkbox" name="transportation[]" id="car" value="2"> Car</td>
            <td><input type="checkbox" name="transportation[]" id="bus" value="5"> Bus</td>
            <td><input type="text" name="trans_others" id="trans_others" class="textbox width_200" disabled="disabled"></td>
          </tr>
          <tr>
            <td height="30"><input type="checkbox" name="transportation[]" id="2wheeler" value="3"/> 2 Wheeler</td>
            <td><input type="checkbox" name="transportation[]" id="auto" value="6"/> Auto</td>
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
        <td><input type="text" name="basicCost" id="basicCost" class="textbox textCenter width_95"/> 
          INR</td>
        </tr>
      <tr>
        <td height="40" valign="top">Cost Details</td>
        <td valign="top">:</td>
        <td valign="top">
        <table width="63%" border="0" cellspacing="0" cellpadding="0" class="table" id="generate_cost">
            <tr>
              <th align="center">No</th>
              <th align="center">Amount</th>
              <th width="49%" align="center">Particulars</th>
              <th width="8%" align="center"><span id="addRow_cost" class="anchor" title="Add Details">[+]</span></th>
            </tr>
            <tr>
              <td width="12%" align="center">1</td>
              <td width="31%" align="center"><input type="text" name="amounts[]" id="amounts_1" class="textbox textCenter width_95"/></td>
              <td colspan="2" align="center">
                <select name="particulars[]" id="particulars_1" class="dropdown" style="width:160px;">
                <option value="" selected="selected" class="padding_2">Select</option>
                <option value="Venue" class="padding_2">Venue</option>
                <option value="Student Database" class="padding_2">Student Database</option>
                <option value="Flex" class="padding_2">Flex</option>
                <option value="Others" class="padding_2">Others</option>
                </select></td>
            </tr>
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