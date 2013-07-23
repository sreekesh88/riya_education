<?php 
include ("../include/header.php"); 
include ("../include/validate.php"); 
include ("../include/menu.php"); 
$empID = $info['empID'];
$fbID = $_GET['id'];
?>

<?php
$event_feedback = mysql_query("SELECT * FROM `event_feedback` WHERE fbID = '$fbID'");
while($ary = mysql_fetch_array($event_feedback)) {
	$eventID = $ary['eventID'];
	 $events = mysql_query("SELECT * FROM `events` WHERE eventID = '$eventID'");
	 $row = mysql_fetch_array($events);
	 $title = $row['title'];
	 $event_cost = mysql_query("SELECT * FROM `event_cost` WHERE eventID = '$eventID'");
	 $rows = mysql_fetch_array($event_cost);
	 $basicCost = $rows['basicCost'];
	
	$attendees = $ary['attendees'];
	$vArrange = $ary['venueArrange'];
	 if($vArrange == '1') { $venueArrange = "Yes"; } else { $venueArrange = "No"; }
	
	$eExpMet = $ary['eventExpMet'];
	 if($eExpMet == '1') { $eventExpMet = "Yes"; } else { $eventExpMet = "No"; }
	 
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
    <td width="34%" height="40">Event Title</td>
    <td width="2%">:</td>
    <td colspan="4" class="red font-14"><strong><?php echo $title; ?></strong></td>
    </tr>
  <tr>
    <td height="40">No. of Participants attended</td>
    <td>:</td>
    <td colspan="4"><?php echo $attendees; ?></td>
    </tr>
  <tr>
    <td height="40" class="blue">Arrangement of the venue adequate?</td>
    <td>:</td>
    <td><?php echo $venueArrange; ?></td>
    <td colspan="3">Rating: &nbsp;&nbsp;&nbsp;<b class="green"><?php echo $venueRating; ?> out of 10</b></td>
    </tr>
  <tr>
    <td height="40" class="blue">Did your Event met your expectation?</td>
    <td>:</td>
    <td><?php echo $eventExpMet; ?></td>
    <td colspan="3">Rating: &nbsp;&nbsp;&nbsp;<b class="green"><?php echo $eventRating; ?> out of 10</b></td>
    </tr>
  <tr>
    <td height="40">Database collected</td>
    <td>:</td>
    <td><?php echo $dbCollected; ?></td>
    <td colspan="3">Rating: &nbsp;&nbsp;&nbsp;<b class="green"><?php echo $comntRating; ?> out of 10</b></td>
    </tr>
  <tr>
    <td colspan="6"><h6><b>What is your overall comments?</b></h6></td>
    </tr>
  <tr>
    <td colspan="6" valign="top" bgcolor="#EEEEEE" class="pad_15 green"><?php echo $overallCmnts; ?></td>
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
        <td width="80%" class="red font-14"><?php echo $basicCost; ?> INR</td>
      </tr>
      <tr>
        <td height="40"><b>Expense Details</b></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td height="40" valign="top" class="blue">Transportation</td>
        <td valign="top">:</td>
        <td valign="top">
		<?php 
		foreach($availTrans as $transportation) {
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
		echo "<br>";
		foreach($availAmts as $amts) {
			if($amts != '') {
				echo "<img src='../images/arrow-blue.png' alt='arrow' /> ".$amts."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
			}
		}
		
		?></td>
      </tr>
      <tr>
        <td height="50" class="blue">Accomodation</td>
        <td>:</td>
        <td>&nbsp;</td>
      </tr>
      </table>    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="4">&nbsp;</td>
  </tr>
  <tr>
    <td height="50" bgcolor="#E1EEED" class="green left_10"><strong>Grant Total for the Seminar</strong></td>
    <td height="50" bgcolor="#E1EEED">:</td>
    <td width="17%" height="50" bgcolor="#E1EEED" class="red font-14"><b><?php echo $grandTotal; ?> INR</b></td>
    <td width="18%" bgcolor="#E1EEED" class="green"><strong>Overall Rating</strong></td>
    <td width="1%" bgcolor="#E1EEED">:</td>
    <td width="28%" height="50" bgcolor="#E1EEED" class="red"><?php echo $overallRating; ?> out of 10</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="4">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="6" align="center"><input name="back" value="<<&nbsp;&nbsp;&nbsp;Go Back" type="button" class="button" onclick="history.back()" /></td>
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