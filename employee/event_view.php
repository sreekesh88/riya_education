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
$eventID = $_GET['id'];
?>

<?php
$centre = mysql_query("SELECT * FROM `event_centre` WHERE eventID = '$eventID'");
while($row = mysql_fetch_array($centre)) {
	$eventCentre = $row['eventCentre'];
	$organizer = $row['organizer'];	
	$conPerson = $row['conPerson'];
	$conNumber = $row['conNumber'];
	$email = $row['conEmail'];
	$pincode = $row['pincode'];
	$addr1 = $row['addr1'];
	$addr2 = $row['addr2'];
	$city = $row['city'];
	
	$stateID = $row['state'];
	$states = mysql_query("SELECT * FROM `states` WHERE stateID = '$stateID'");
	$res = mysql_fetch_array($states);
	$state = $res['state'];
}

$events = mysql_query("SELECT * FROM `events` WHERE eventID = '$eventID'");
while($row = mysql_fetch_array($events)) {
	$eventType = $row['eventType'];
	if($eventType == '0') { $event = "Seminar"; $display = 'style="display:none"';} 
	else if($eventType == '1') { $event = "Fair"; $display = 'style="display:block"';}
	
	$date = $row['date'];
	$empID = $row['empID'];
	$branchID = $row['branchID'];
	$title = $row['title'];
	$eventDate = date("d-m-Y",strtotime($row['eventDate']));
	$eventTime = $row['eventTime'];
	$session = $row['session'];
	$duration = $row['duration'];
	$expNum = $row['expNum'];
	$quest1 = $row['quest1'];
	$quest2 = $row['quest2'];
	$quest3 = $row['quest3'];
	$quest4 = $row['quest4'];
	$remarks = $row['remarks'];
	
	$staffID = $row['staffID'];
	$employees = mysql_query("SELECT fname,lname from `employees` WHERE empID = '$staffID'");
	$res = mysql_fetch_array($employees);
	$employee = $res['fname']." ".$res['lname'];
	$stfs = explode(",",$row['staffs']);	
	$dels = explode(",",$row['delegates']);

}

$eventCost = mysql_query("SELECT * FROM `event_cost` WHERE eventID = '$eventID'");
while($row = mysql_fetch_array($eventCost)) {
	$basicCost = $row['basicCost'];
	$amt = explode(",",$row['amounts']);
	$prts = explode(",",$row['particulars']);
	$avs = explode(",",$row['avUnits']);
	$avOthers = $row['avOthers'];
	$meals = explode(",",$row['meals']);
	$acc = explode(",",$row['accomodation']);
	$trans = explode(",",$row['transportation']);
	$transOthers = $row['transOthers']; 
	$totalCost = $row['totalCost'];
}

?>


<div id="wrapper_top"></div>
<div id="wrapper">
<?php include("../include/left.php"); ?>
<div class="main_col dotted_border">
<h2>Event Information</h2>
<br />
<div class="fullWidth">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="6" valign="top" align="center"><div id="success" class="green"><?php echo $success; ?></div></td>
  </tr>
  <tr>
    <td>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="40" valign="top" class="blue"><strong>Type of Event</strong></td>
        <td height="30" valign="top">:</td>
        <td height="30" colspan="4" valign="top" class="red font-14"><strong><?php echo $event; ?></strong></td>
      </tr>
      <tr>
        <td valign="top" height="40" class="red"><strong>Centre of Event</strong></td>
        <td valign="top">:</td>
        <td valign="top" class="green font-14"><strong><?php echo $eventCentre; ?></strong></td>
        <td valign="top" colspan="3">
        <div <?php echo $display; ?> > 
          	<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="36" class="green">Organized by </td>
                <td width="4%">:</td>
                <td width="60%"><?php echo $organizer; ?></td>
              </tr>
            </table>          
        </div>
        </td>
      </tr>
      <tr>
        <td valign="top">Contact Person</td>
        <td valign="top">:</td>
        <td valign="top"><?php echo $conPerson; ?></td>
        <td rowspan="2" valign="top">Address</td>
        <td rowspan="2" valign="top">:</td>
        <td rowspan="2" valign="top"><?php echo $addr1."<br>".$addr2; ?></td>
      </tr>
      <tr>
        <td width="15%"  valign="top">Contact Number</td>
        <td width="2%" valign="top">:</td>
        <td width="33%" valign="top"><?php echo $conNumber; ?></td>
      </tr>
      <tr>
        <td width="15%" height="35">Email Id</td>
        <td width="2%">:</td>
        <td width="33%"><?php echo $email; ?></td>
        <td width="18%">City / Area</td>
        <td width="2%">:</td>
        <td width="30%"><?php echo $city; ?></td>
      </tr>
      <tr>
        <td height="35">Pincode</td>
        <td>:</td>
        <td><?php echo $pincode; ?></td>
        <td>State</td>
        <td>:</td>
        <td><?php echo $state; ?></td>
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
        <td height="40" colspan="4" valign="top" class="green font-14"><b><?php echo $title; ?></b></td>
      </tr>
      <tr>
        <td width="15%" height="35" valign="top">Date of Event</td>
        <td width="2%" valign="top">:</td>
        <td width="33%" valign="top"><?php echo $eventDate; ?></td>
        <td width="18%" valign="top">Time</td>
        <td width="2%" valign="top">:</td>
        <td width="30%" valign="top"><?php echo $eventTime; ?></td>
      </tr>
      <tr>
        <td height="35" valign="top">Delegate (s)</td>
        <td valign="top">:</td>
        <td valign="top"><?php foreach($dels as $delegates) { echo $delegates."<br>"; } ?></td>
        <td valign="top">Staff (s)</td>
        <td valign="top">:</td>
        <td valign="top"><?php echo $employee."<br>"; foreach($stfs as $staffs) { echo $staffs."<br>"; } ?></td>
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
        <td width="15%"><?php echo $session; ?></td>
        <td width="18%">Length of Session</td>
        <td width="2%">:</td>
        <td width="48%"><?php echo $duration; ?> hr(s)</td>
      </tr>
      <tr>
        <td height="35" colspan="6">No. of Participants Expected:  &nbsp;&nbsp;&nbsp;
        <strong class="blue"><?php echo $expNum; ?></strong></td>
      </tr>
    </table>    </td>
  </tr>
  <tr>
    <td height="60"><h6>Payment Information</h6></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="24%" height="40" class="red"><strong>Cost of the Event</strong></td>
        <td width="1%">:</td>
        <td><strong><?php echo $basicCost; ?> INR</strong></td>
        </tr>
      <tr>
        <td height="40" valign="top">Cost Details</td>
        <td valign="top">:</td>
        <td valign="top">
        <table width="63%" border="0" cellspacing="0" cellpadding="0" class="table">
            <tr>
              <th align="center">No</th>
              <th align="center">Amount</th>
              <th align="center">Particulars</th>
            </tr>
            <tr>
              <td width="12%" align="center">
              <?php
			  $Num = count($prts);
			  for($i = 1; $i<=$Num; $i++) {
			  	echo $i."<br>";
			  }
			  ?>
              </td>
              <td width="31%" align="center"><?php foreach($amt as $amounts) { echo $amounts."<br>"; } ?></td>
              <td align="center"><?php foreach($prts as $particulars) { echo $particulars."<br>"; } ?></td>
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
          <td valign="top">1. Describe your target audience. Who is likely to attend?</td>
          </tr>
        <tr>
          <td valign="top" class="pad_15 blue"><?php echo $quest1; ?></td>
        </tr>
        <tr>
          <td valign="top">2. Is there any specific topic you would like to address in the Seminar?</td>
          </tr>
        <tr>
          <td valign="top" class="pad_15 blue"><?php echo $quest2; ?></td>
        </tr>
        <tr>
          <td valign="top">3. What are your hope for this Seminar?</td>
          </tr>
        <tr>
          <td valign="top" class="pad_15 blue"><?php echo $quest3; ?></td>
        </tr>
        <tr>
          <td valign="top">4. What type of publicity will you use?</td>
          </tr>
        <tr>
          <td valign="top" class="pad_15 blue"><?php echo $quest4; ?></td>
        </tr>
        <tr>
          <td valign="top"><h6><b>Remarks</b></h6></td>
          </tr>
        <tr>
          <td valign="top" bgcolor="#EEEEEE" class="pad_15 green"><?php echo $remarks; ?></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td height="60"><h6>Additional Requirements</h6></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0" class="pad">
      <tr>
        <td width="18%" height="35" class="green">Audio/Visual units</td>
        <td width="2%">:</td>
        <td width="80%">
		<?php 
		foreach($avs as $avUnits) {
			$arr = array("1" => "LCD Projector",
					 "2" => "Laptop",
					 "3" => "Mobile",
					 "4" => "Pinboard",
					 "5" => "Flex",
					 "6" => "Computer",
					 "7" => "TV"					 
					 );
			if($avUnits != '') {			 
				echo "<img src='../images/arrow-blue.png' alt='arrow' /> ".$arr[$avUnits]."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
			}
		}
		if($avOthers != '') {
		echo "<img src='../images/arrow-blue.png' alt='arrow' /> ".$avOthers;
		}
		?>        </td>
      </tr>
      <tr>
        <td height="35" bgcolor="#eee" class="green">Meals</td>
        <td bgcolor="#eee">:</td>
        <td bgcolor="#eee">
        <?php 
		foreach($meals as $meal) {
			$arr = array("1" => "Coffee/Tea",
					 "2" => "Breakfast",
					 "3" => "Lunch",
					 "4" => "Dinner"			 
					 );
			if($meal != '') {
				echo "<img src='../images/arrow-blue.png' alt='arrow' /> ".$arr[$meal]."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
			} else {
				echo "Nil";
			}
		}
		?>
        </td>
      </tr>
      <tr>
        <td height="35" class="green">Accomodation</td>
        <td>:</td>
        <td>
        <?php 
		foreach($acc as $accomodation) {
			$arr = array("1" => "Single Room",
					 "2" => "Double Room",
					 "3" => "Twin Sharing",
					 "4" => "Suite Room"			 
					 );
			if($accomodation != '') {
				echo "<img src='../images/arrow-blue.png' alt='arrow' /> ".$arr[$accomodation]."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
			} else {
				echo "Nil";
			}
		}
		?>
        </td>
      </tr>
      <tr>
        <td height="35" bgcolor="#eee" class="green">Transportation</td>
        <td bgcolor="#eee">:</td>
        <td bgcolor="#eee">
        <?php 
		$l = 1;
		foreach($trans as $transportation) {
			$arr = array("1" => "Flight",
					 "2" => "Car",
					 "3" => "2 Wheeler",
					 "4" => "Train",
					 "5" => "Bus",
					 "6" => "Auto"				 
					 );
			if($transportation != '') {			 
				echo "<img src='../images/arrow-blue.png' alt='arrow' /> ".$arr[$transportation]."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
			}
		}
		if($transOthers != '') {
		echo "<img src='../images/arrow-blue.png' alt='arrow' /> ".$transOthers;
		}
		?>        </td>
      </tr>
    </table></td>
  </tr>
  <tr><td colspan="3">&nbsp;</td></tr>
  <tr>
    <td bgcolor="#EEEEEE"><h6>Expected Budget</h6></td>
  </tr>
  <tr>
    <td bgcolor="#EEEEEE" height="50">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="23%" align="center" class="red">Expected cost for the Event</td>
        <td width="2%">:</td>
        <td width="75%" class="red"><strong><?php echo $basicCost ?> INR</strong></td>
      </tr>
    </table>
    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="60" align="center"><input type="submit"  name="submit" value="<< Back" class="button width_200" onclick="history.back();"/></td>
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
  </tr>
</table>
</div>

</div>
</div>

<?php include("../include/footer.php"); ?>

</div> <!--end of container-->
</body>
</html>