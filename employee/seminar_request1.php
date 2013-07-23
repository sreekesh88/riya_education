<?php 
include ("../include/header.php"); 
include ("../include/validate.php"); 
include ("../include/menu.php"); 
$empCode = $info['empCode'];
?>

<script type="text/javascript" src="../js/datepair.js"></script>
<script type="text/javascript" src="../js/jquery.timepicker.js"></script>
<link rel="stylesheet" type="text/css" href="../css/jquery.timepicker.css" />

<script>
$(function() {

var currentTime = new Date();
var year = currentTime.getFullYear();
		
	$("#semDate").datepicker({
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
	$('#addRow').click(function() {
		index++;
        var row = "<tr><td align='center'>"+index+"</td><td align='center'><input name='part_"+index+"' type='text' class='textbox width_200' /></td><td align='center'><input name='cost_"+index+"' type='text' class='textbox' /></td></tr>";
        addRowToTable($('#generate'), row);
		$('#totalNos').val(Number(index));
    });
});

</script>

<?php
if(isset($_POST['submit'])) {
	
	$branchID = $info['branchID'];
	$email = $info['email'];
	$semTopic = $_POST['semTopic'];
	$venue = $_POST['venue'];
	$staff = $_POST['staff']; 
	$semDate = date("Y-m-d", strtotime($_POST['semDate']));
	$semTime = $_POST['startTime']." - ".$_POST['endTime'];
	$staff = $_POST['staff']; 
	$accStaff = $_POST['accStaff'];
	$delegate = $_POST['delegate']; 
	$accDelegate = $_POST['accDelegate'];
	$studLevel = $_POST['studLevel']; 
	$expStuds = $_POST['expStuds'];  
	$date = date("Y-m-d", strtotime($_POST['date'])); 
	$aim = $_POST['aim'];  
	$notes = $_POST['notes'];
	$totalCost = $_POST['totalCost'];
	
	if($semTopic != '') {
		$query = mysql_query("INSERT INTO `seminars` (`date`, `empCode`, `email`, `branchID`, `semTopic`, `semDate`, `semTime`, `venue`, `staff`, `accStaff`, `delegate`, `accDelegate`, `expStuds`, `studLevel`, `aim`, `notes`, `totalCost`) VALUES ('$date', '$empCode', '$email', '$branchID', '$semTopic', '$semDate', '$semTime', '$venue', '$staff', '$accStaff', '$delegate', '$accDelegate', '$expStuds', '$studLevel', '$aim', '$notes', '$totalCost')");
		
		$semID = mysql_insert_id();
		$totalNos = $_POST['totalNos'];
		
		if($semID != '') {
			for($i=1;$i<=$totalNos;$i++) {
				
				$particulars = $_POST['part_'.$i];
				$cost = $_POST['cost_'.$i];
				
				$query = mysql_query("INSERT INTO `seminar_cost` (`semID`, `particulars`, `cost`) VALUES ('$semID', '$particulars', '$cost')");
			}
		}
	}
}
?>

<div id="wrapper_top"></div>
<div id="wrapper">
<?php include("../include/left.php"); ?>
<div class="main_col dotted_border">
<h2>Request a Seminar</h2>
<br />
<div class="fullWidth">
<form action="" method="post" enctype="multipart/form-data">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="50"><strong>Seminar Topic</strong></td>
    <td>:</td>
    <td colspan="4"><input type="text" name="semTopic" id="semTopic" class="textboxLarge"/></td>
    </tr>
  <tr>
    <td width="17%" height="50"><strong>Venue</strong></td>
    <td width="2%">:</td>
    <td width="28%"><input type="text" name="venue" id="venue" class="textbox"/></td>
    <td width="22%"><strong>Staff</strong></td>
    <td width="2%">:</td>
    <td width="29%"><input type="text" name="staff" id="staff" class="textbox"/></td>
  </tr>
  <tr>
    <td height="50"><strong>Date</strong></td>
    <td>:</td>
    <td><input type="text" name="semDate" id="semDate" class="textbox textCenter" readonly="readonly"/></td>
    <td><strong>Accompanying Staff (if any)</strong></td>
    <td>:</td>
    <td>
    <input type="text" name="accStaff" id="accStaff" class="textbox"/></td>
  </tr>
  <tr>
    <td height="50"><strong>Timing</strong></td>
    <td>:</td>
    <td>    
    <input type="text" id="startTime" name="startTime" class="time width_60 textbox" /> to
    <input type="text" id="endTime" name="endTime" class="time width_60 textbox" />    </td>
    <td><strong>Delegate</strong></td>
    <td>:</td>
    <td><input type="text" name="delegate" id="delegate" class="textbox"/></td>
  </tr>
  <tr>
    <td height="50"><strong>Level of Participants</strong></td>
    <td>:</td>
    <td><input type="text" name="studLevel" id="studLevel" class="textbox"/></td>
    <td><strong>Accompanying Delegate (if any)</strong></td>
    <td>:</td>
    <td><input type="text" name="accDelegate" id="accDelegate" class="textbox"/></td>
  </tr>
  <tr>
    <td height="50"><strong>Expected no. of Participants</strong></td>
    <td>:</td>
    <td><input type="text" name="expStuds" id="expStuds" class="textbox"/></td>
    <td><strong>Date of Request</strong></td>
    <td>:</td>
    <td><input type="text" name="date" id="date" class="textbox textCenter" value="<?php echo date("d-m-Y"); ?>" readonly="readonly"/></td>
  </tr>
  <tr><td colspan="6">&nbsp;</td></tr>
  <tr>
    <td height="90" valign="top"><strong>Aim of the Seminar</strong></td>
    <td valign="top">:</td>
    <td colspan="4" valign="top"><textarea name="aim" id="aim" class="textarea_dotted width_440 padding_3"></textarea></td>
    </tr>
  <tr>
    <td height="90" valign="top"><strong>Notes (if any)</strong></td>
    <td valign="top">:</td>
    <td colspan="4" valign="top"><textarea name="notes" id="notes" class="textarea_dotted width_440 padding_3"></textarea></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="6"><h6>Estimated Cost Details</h6><br /> </td>
  </tr>  
  <tr>
    <td colspan="6">
   
<table width="60%" cellpadding="0" cellspacing="0" id="generate" class="table">
  <tr>
	<th width="10%">No</th>
  	<th width="60%">Particulars</th>
    <th width="30%">Cost</th>
  </tr>
  <tr>
    <td align="center">1</td>
    <td align="center"><input type='text' name='part_1' class='textbox width_200'/></td>
    <td align="center"><input type='text' name='cost_1' class='textbox' /></td>
  </tr>
</table>
<span id="addRow" class="anchor">Add another row</span> 
<table width="50%" cellpadding="0" cellspacing="0">
  <tr>  	
    <th width="18%" align="left" height="30">Total Nos:</th>
    <th width="82%" align="left"><input type='text' name='totalNos' id="totalNos" class='textbox width_40 textCenter' readonly="readonly" /></th>
  </tr>
  <tr>  	
    <th width="18%" align="left">Total Cost:</th>
    <th width="82%" align="left"><input type='text' name='totalCost' class='textbox width_95' /></th>
  </tr>
</table>     

    </td>
    </tr>
  <tr><td colspan="6">&nbsp;</td></tr>
  <tr>
    <td colspan="6" align="center">
    <input type="submit" name="submit" id="submit" value="Submit" class="button width_200" />    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
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