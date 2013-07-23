<?php 
include ("../include/header.php"); 
include ("../include/validate.php"); 
include ("../include/menu.php"); 
$empCode = $info['empCode'];
$branchID = $info['branchID'];
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
	timeFormat: 'h:i:A', 
	'scrollDefaultNow': true
	});
	$('#endTime').timepicker({ 
	timeFormat: 'h:i:A',
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
		var row = "<tr><td colspan='2' height='30' align='left'><input type='text' name='delegates[]' id='delegates_"+index+"' class='textbox width_150'/></td></tr>";
        addRowToTable($('#generate_delegate'), row);
    });
	
	var num = 0;
	$('#addRow_staff').click(function() {
		num++;
		var row = "<tr><td colspan='2' height='30' align='left'><input type='text' name='staffs[]' id='staffs_"+num+"' class='textbox width_150'/></td></tr>";
        addRowToTable($('#generate_staff'), row);
    });
	
	$('#addRow_cost').click(function() {
		index++;
		var row = "<tr><td width='12%' align='center'>"+index+"</td><td width='31%' align='center'><input type='text' name='amounts[]' id='textfield_"+index+"' class='textbox textCenter width_95'/></td><td colspan='2' align='center'><select name='particulars[]' id='particulars_"+index+"' class='dropdown' style='width:160px;'><option value='' selected='selected' class='padding_2'>Select</option><option value='Venue' class='padding_2'>Venue</option><option value='Student Database' class='padding_2'>Student Database</option><option value='Flex' class='padding_2'>Flex</option><option value='Others' class='padding_2'>Others</option></select></td></tr>";
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

</script>

<?php
if(isset($_POST['submit'])) {

	$date = date("Y-m-d");
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
		$seminar = mysql_query("INSERT INTO `seminars` (`date`, `empCode`, `branchID`, `title`, `eventDate`, `eventTime`, `delegates`, `staffID`, `staffs`, `session`, `duration`, `expNum`, `quest1`, `quest2`, `quest3`, `quest4`, `remarks`) VALUES ('$date', '$empCode', '$branchID', '$title', '$eventDate', '$eventTime', '$delegates', '$staffID', '$staffs', '$session', '$duration', '$expNum', '$quest1', '$quest2', '$quest3', '$quest4', '$remarks')");
	}
	
	$semID = mysql_insert_id();
	
	$orgzn = $_POST['organization'];
	$addr1 = $_POST['addr1'];
	$addr2 = $_POST['addr2'];
	$city = $_POST['city'];
	$state = $_POST['state'];
	$pincode = $_POST['pincode'];
	$conPerson = $_POST['conPerson'];
	$conEmail = $_POST['conEmail'];
	$conNumber = $_POST['conNumber'];
	
	if($orgzn != '') {
		$organization = mysql_query("INSERT INTO `sem_orgzn` (`semID`, `organization`, `addr1`, `addr2`, `city`, `state`, `pincode`, `conPerson`, `conEmail`, `conNumber`) VALUES ('$semID', '$orgzn', '$addr1', '$addr2', '$city', '$state', '$pincode', '$conPerson', '$conEmail', '$conNumber')");
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
	$totalCost = $_POST['totalCost'];	
	
	if($totalCost != '') {
		$cost = mysql_query("INSERT INTO `sem_cost` (`semID`, `basicCost`, `amounts`, `particulars`, `avUnits`, `avOthers`, `meals`, `accomodation`, `transportation`, `transOthers`, `totalCost`) VALUES ('$semID', '$basicCost', '$amounts', '$particulars', '$avUnits', '$av_others', '$meals', '$accomodation', '$transportation', '$trans_others', '$totalCost')");
		
		if($cost > 0) {
			$success = "Your Seminar request has been submitted successfully!";
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
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="50" colspan="6" valign="top" class="red">
        <strong>Name of the Organization/Place </strong>&nbsp;&nbsp;&nbsp;
        <input type="text" name="organization" id="organization" class="textboxLarge" tabindex="1"/>&nbsp;&nbsp;&nbsp;&nbsp;
        <input name="" type="radio" value="" />&nbsp; Seminar &nbsp;&nbsp;&nbsp;<input name="" type="radio" value="" />&nbsp; Fair</td>
      </tr>
      <tr>
        <td width="15%" height="40" valign="top">Contact Person</td>
        <td width="2%" valign="top">:</td>
        <td width="33%" valign="top"><input type="text" name="conPerson" id="conPerson" class="textbox width_200" tabindex="2"/></td>
        <td width="18%" rowspan="2" valign="top">Address</td>
        <td width="2%" rowspan="2" valign="top">:</td>
        <td width="30%" rowspan="2" valign="top"><div class="addressBox">
          <input type="text" name="addr1" id="addr1" class="addrInput" tabindex="6" />
          <input type="text" name="addr2" id="addr2" class="addrInput" tabindex="7" />
        </div></td>
      </tr>
      <tr>
        <td width="15%" height="40" valign="top">Contact Number</td>
        <td width="2%" valign="top">:</td>
        <td width="33%" valign="top"><input type="text" name="conNumber" id="conNumber" class="textbox width_200" tabindex="8"/></td>
        </tr>
      <tr>
        <td>Email Id</td>
        <td>:</td>
        <td><input type="text" name="conEmail" id="conEmail" class="textbox width_200" tabindex="3"/></td>
        <td>City / Area</td>
        <td>:</td>
        <td><input type="text" name="city" id="city" class="textbox width_200" tabindex="4"/></td>
      </tr>
      <tr>
        <td height="40">Pincode</td>
        <td>:</td>
        <td><input type="text" name="pincode" id="pincode" class="textbox width_200" maxlength="6" tabindex="9"/>        </td>
        <td>State</td>
        <td>:</td>
        <td><select name="state" id="state" class="dropdown" tabindex="5">
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
        <td height="40" colspan="6" valign="top"><strong class="red">Title of the Seminar</strong> &nbsp;&nbsp;
          <input type="text" name="title" id="title" class="textboxLarge" tabindex="10"/></td>
        </tr>
      <tr>
        <td width="15%" height="35" valign="top">Date of Event</td>
        <td width="2%" valign="top">:</td>
        <td width="33%" valign="top"><input type="text" name="eventDate" id="eventDate" class="textbox width_200 textCenter" tabindex="11"/></td>
        <td width="18%" valign="top">Time</td>
        <td width="2%" valign="top">:</td>
        <td width="30%" valign="top"><input type="text" id="startTime" name="startTime" class="time width_95 textbox textCenter" tabindex="12" />
-
  <input type="text" id="endTime" name="endTime" class="time width_95 textbox textCenter" tabindex="13" /></td>
      </tr>
      <tr>
        <td height="35" valign="top">Delegate (s)</td>
        <td valign="top">:</td>
        <td valign="top">
        
        <table width="230" border="0" cellspacing="0" cellpadding="0" id="generate_delegate">
            <tr>
              <td width="160" height="30" align="left"><input type="text" name="delegates[]" id="delegate_1" class="textbox width_150" tabindex="14"/></td>
              <td width="70" align="left"><span id="addRow_delegate" class="anchor" title="Add Delegates">[+]</span></td>
            </tr>            
        </table>        </td>
        <td valign="top">Staff (s)</td>
        <td valign="top">:</td>
        <td valign="top">
        <table width="230" border="0" cellspacing="0" cellpadding="0" id="generate_staff">
          <tr>
            <td width="180" align="left" height="30"><select name="staffID" id="staffID" class="dropdown" style="width:170px;" tabindex="16">
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
        <td width="15%"><input type="text" name="session" id="session" class="textbox width_60" tabindex="17"/></td>
        <td width="18%">Length of Session</td>
        <td width="2%">:</td>
        <td width="48%"><input type="text" name="duration" id="duration" class="textbox width_60" tabindex="18"/> hrs</td>
      </tr>
      <tr>
        <td height="35" colspan="6">No. of Participants Expected:</td>
      </tr>
      <tr>
        <td colspan="6" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="17%">&nbsp;</td>
            <td width="16%" height="35"><input type="radio" name="expNum" value="Not Sure" tabindex="19" />
              Not Sure</td>
            <td width="16%"><input type="radio" name="expNum" value="1-10" tabindex="20" />
              1-10</td>
            <td width="51%"><input type="radio" name="expNum" value="11-25" tabindex="21" />
              11-25</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td height="35"><input type="radio" name="expNum" value="26-50" tabindex="22" />
              26-50</td>
            <td><input type="radio" name="expNum" value="51-100" tabindex="23" />
              51-100</td>
            <td><input type="radio" name="expNum" value="Above 100" tabindex="24" />
              Above 100</td>
          </tr>
        </table></td>
        </tr>
    </table>    </td>
  </tr>
  <tr>
    <td height="60"><h6>Payment Information</h6></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="24%" height="40" class="red"><strong>Cost of Seminar</strong></td>
        <td width="1%">:</td>
        <td><input type="text" name="basicCost" id="basicCost" class="textbox textCenter width_95" tabindex="25"/> 
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
    <td height="60"><h6>General Information</h6></td>
  </tr>
  <tr>
    <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td valign="top" class="red">1. Describe your target audience. Who is likely to attend?</td>
          </tr>
        <tr>
          <td height="100" valign="top"><textarea name="quest1" class="textarea width_440" tabindex="32"></textarea></td>
          </tr>
        <tr>
          <td valign="top" class="red">2. Is there any specific topic you would like to address in the Seminar?</td>
          </tr>
        <tr>
          <td height="100" valign="top"><textarea name="quest2" class="textarea width_440" tabindex="33"></textarea></td>
          </tr>
        <tr>
          <td valign="top" class="red">3. What are your hope for this Seminar?</td>
          </tr>
        <tr>
          <td height="100" valign="top"><textarea name="quest3" class="textarea width_440" tabindex="34"></textarea></td>
          </tr>
        <tr>
          <td valign="top" class="red">4. What type of publicity will you use?</td>
          </tr>
        <tr>
          <td height="100" valign="top"><textarea name="quest4" class="textarea width_440" tabindex="35"></textarea></td>
          </tr>
        <tr>
          <td valign="top">Remarks <span class="green">(if any)</span></td>
          </tr>
        <tr>
          <td height="100" valign="top"><textarea name="remarks" class="textarea width_440" tabindex="36"></textarea></td>
          </tr>
      </table></td>
  </tr>
  <tr>
    <td height="60"><h6>Additional Requirements</h6></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0" class="pad">
      <tr>
        <td width="18%" height="60" valign="top">Audio/Visual units</td>
        <td width="1%" valign="top">:</td>
        <td width="81%" valign="top">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="30%" height="30"><input type="checkbox" name="avUnits[]" id="avProj" value="1" tabindex="37" > LCD Projector</td>
            <td width="30%"><input type="checkbox" name="avUnits[]" id="avPinboard" value="4" tabindex="40"> Pinboard</td>
            <td width="40%"><input type="checkbox" name="avUnits" id="avTv" value="7" tabindex="43"> TV</td>
          </tr>
          <tr>
            <td height="30"><input type="checkbox" name="avUnits[]" id="avLap" value="2" tabindex="38"> Laptop</td>
            <td><input type="checkbox" name="avUnits[]" id="avFlex" value="5" tabindex="41"> Flex</td>
            <td><input type="checkbox" name="av_chkbx" id="av_chkbx" onclick="disableMe(this)" value="0" tabindex="44" /> 
              Others</td>
          </tr>
          <tr>
            <td height="30"><input type="checkbox" name="avUnits[]" id="avMobile" value="3" tabindex="39"> Mobile</td>
            <td><input type="checkbox" name="avUnits[]" id="avComputer" value="6" tabindex="42"> Computer</td>
            <td><input type="text" name="av_others" id="av_others" class="textbox width_200" disabled="disabled" tabindex="45"></td>
          </tr>
        </table>        </td>
      </tr>
      <tr>
        <td height="40" valign="top" bgcolor="#eee">Meals</td>
        <td valign="top" bgcolor="#eee">:</td>
        <td bgcolor="#eee"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="30%" height="30"><input type="checkbox" name="meals[]" id="drinks" value="1" tabindex="46"> Coffee/Tea</td>
            <td width="30%"><input type="checkbox" name="lunch" id="lunch" value="3" tabindex="48" /> Lunch</td>
            <td width="40%">&nbsp;</td>
            </tr>
          <tr>
            <td height="30"><input type="checkbox" name="brkfst" id="brkfst" value="2" tabindex="47" /> Breakfast </td>
            <td><input type="checkbox" name="meals[]" id="dinner" value="4" tabindex="49" /> Dinner</td>
            <td>&nbsp;</td>
            </tr>
        </table></td>
      </tr>
      <tr>
        <td height="40">Accomodation</td>
        <td>:</td>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="25%"><input type="checkbox" name="accomodation[]" id="single" value="1" tabindex="50"> Single Room</td>
    <td width="25%"><input type="checkbox" name="accomodation[]" id="double" value="2" tabindex="51"> Double Room</td>
    <td width="25%"><input type="checkbox" name="checkbox2" id="checkbox2" /> Twin Sharing</td>
    <td width="25%"><input type="checkbox" name="checkbox3" id="checkbox3" /> Suite Room </td>
  </tr>
</table></td>
      </tr>
      <tr>
        <td valign="top" bgcolor="#eee">Transportation</td>
        <td valign="top" bgcolor="#eee">:</td>
        <td valign="top" bgcolor="#eee"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="30%" height="30"><input type="checkbox" name="transportation[]" id="flight" value="1" tabindex="52"> Flight</td>
            <td width="30%"><input type="checkbox" name="transportation[]" id="train" value="4" tabindex="54"> Train</td>
            <td width="40%"><input type="checkbox" name="trans_chkbx" id="trans_chkbx" onClick="disableMe(this)" value="0" tabindex="56"> Others</td>
          </tr>
          <tr>
            <td height="30"><input type="checkbox" name="transportation[]" id="car" value="2" tabindex="53"> Car</td>
            <td><input type="checkbox" name="transportation[]" id="bus" value="5" tabindex="55"> Bus</td>
            <td><input type="text" name="trans_others" id="trans_others" class="textbox width_200" disabled="disabled" tabindex="57"></td>
          </tr>
          <tr>
            <td height="30"><input type="checkbox" name="transportation[]" id="2wheeler" value="3"/> 2 Wheeler</td>
            <td><input type="checkbox" name="checkbox" id="checkbox" value="6"/> Auto</td>
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
        <td width="23%" class="red"><strong>Total cost for the Seminar</strong></td>
        <td width="2%">:</td>
        <td width="75%">
        <input type="text" name="totalCost" id="totalCost" class="textbox width_95 textCenter" tabindex="59" /> INR        </td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="60" align="center"><input type="submit"  name="submit"value="Submit Request" class="button width_200" tabindex="60"></td>
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