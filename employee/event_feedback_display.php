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
?>

<div id="wrapper_top"></div>
<div id="wrapper">
<?php include("../include/left.php"); ?>
<div class="main_col dotted_border">
<h2>Events</h2>
<br />
<div class="fullWidth">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tablegeneral">
  <tr>
    <th width="5%">No</th>
    <th width="40%" align="left" class="padding_2">Title of the Event</th>
    <th width="12%">Event Date</th>
    <th width="15%">Requested by</th>
    <th width="12%">Event Type</th>
    <th width="15%">Actions</th>
  </tr>
	<?php
    $counter = 1;
    $event_feedbacks = mysql_query("SELECT * FROM `event_feedback`");
    while($rows = mysql_fetch_array($event_feedbacks)) {
        
		$eventID = $rows['eventID'];
		$fbID = $rows['fbID'];
		
		$events = mysql_query("SELECT * FROM `events` WHERE eventID = '$eventID'");
		while($ary = mysql_fetch_array($events)) {
			$title = $ary['title'];
			$date = date("d-m-Y", strtotime($ary['eventDate']));
			$empID = $ary['empID'];
             $emps = mysql_query("SELECT fname,lname FROM `employees` WHERE empID = '$empID'");
             $row = mysql_fetch_array($emps);
             $requestedBy = $row['fname']." ".$row['lname'];
			 
			if($ary['eventType'] == '0') { $eventType = "Seminar";} 
			if($ary['eventType'] == '1') { $eventType = "Fair";}
		}
		
		

    ?>
  <tr>
    <td align="center"><?php echo $counter++; ?></td>
    <td align="left"><a href="event_feedback_view.php?id=<?php echo $fbID; ?>"><?php echo $title; ?></a></td>
    <td align="center"><?php echo $date; ?></td>
    <td align="center"><?php echo $requestedBy; ?></td>
    <td align="center"><?php echo $eventType; ?></td>
    <td align="center">
    <a href="event_feedback_edit.php?id=<?php echo $fbID; ?>">
    <img src="../images/edit.png" alt="edit" title="edit event" class="blank" width="16" height="16" /></a>
    </td>
  </tr>
	<?php
    }
    ?>
</table>


</div>

</div>
</div>

<?php include("../include/footer.php"); ?>

</div> <!--end of container-->
</body>
</html>