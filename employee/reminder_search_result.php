<?php 
include ("../include/validate.php"); 
include("../include/config.php");
$empID = $info['empID'];
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tablegeneral">
  <tr>
    <th width="5%">No</th>
    <th width="35%">Message</th>
    <th width="15%">Reminder Date</th>
    <th width="15%">Student</th>
    <th width="15%">Date Created</th>
    <th width="15%">Actions</th>
  </tr>
<?php
$counter = 1;
$startDate = date("Y-m-d");
$sql = "SELECT reminders.*,CONCAT(s.fname,' ',s.`lname`) AS uname FROM `reminders` 
					LEFT JOIN students s ON (s.`studID` = reminders.`studID`)  WHERE reminders.remDate >= '$startDate' AND reminders.empID = '$empID' AND reminders.delStatus = '0'";

if(isset($_POST)){
	$rm_startDateValue = date('Y-m-d', strtotime(str_replace('-', '/', $_POST['rm_datepicker_startDate'])));
	$rm_endDateValue = date('Y-m-d', strtotime(str_replace('-', '/', $_POST['rm_datepicker_endDate'])));
	$rm_datevalue = date('Y-m-d', strtotime(str_replace('-', '/', $_POST['rm_datepicker'])));
	
	$dc_startDateValue = date('Y-m-d', strtotime(str_replace('-', '/', $_POST['dc_datepicker_startDate'])));
	$dc_endDateValue = date('Y-m-d', strtotime(str_replace('-', '/', $_POST['dc_datepicker_endDate'])));
	$dc_datevalue = date('Y-m-d', strtotime(str_replace('-', '/', $_POST['dc_datepicker'])));
	
	if(isset($_POST['rm_datepicker_startDate']) && $_POST['rm_datepicker_endDate']){
		$sql .= " AND reminders.remDate BETWEEN '".$rm_startDateValue."'" ." AND '".$rm_endDateValue."'";
	} else if($_POST['rm_datepicker']){
		$sql .= " AND reminders.remDate = '".$rm_datevalue."'";
	}
	
	if(isset($_POST['dc_datepicker_startDate']) && $_POST['dc_datepicker_endDate']){
		$sql .= " AND reminders.date BETWEEN '".$dc_startDateValue."'" ." AND '".$dc_endDateValue."'";
	} else if($_POST['dc_datepicker']){
		$sql .= " AND reminders.date = '".$dc_datevalue."'";
	}
	
	if(isset($_POST['stud_name'])){
		$sql .= " AND CONCAT(s.fname,' ',s.`lname`) LIKE '%".$_POST['stud_name']."%'";
	}
}

$sql .= "  ORDER BY reminders.remDate ASC";
$result = mysql_query($sql);
while($ary = mysql_fetch_array($result)) {
	$remID = $ary['remID'];
	$reminder = $ary['reminder'];
	$remDate = date("d-m-Y",strtotime($ary['remDate']));
	$date = date("d-m-Y",strtotime($ary['date']));
	$studID = $ary['studID'];
	$get_stud = mysql_query("SELECT fname,lname FROM `students` WHERE studID = '$studID'");
	$ary_stud = mysql_fetch_array($get_stud);
	$name = $ary_stud['fname']." ".$ary_stud['lname'];
	
	$today = strtotime(date("Y-m-d"));
	$alertDate = strtotime($ary['remDate']);
	$diff = $alertDate - $today;
?>
  <tr>
    <td align="center"><?php echo $counter++; ?></td>
    <td align="left" class="font-11"><?php echo $reminder; ?></td>
    <td align="center">
	<?php  
	if($diff == '0') { echo "<span style='color:red'>".$remDate."</span>"; }
	else {echo $remDate; }
	?></td>
    <td align="center"><?php echo $name; ?></td>
    <td align="center"><?php echo $date; ?></td>
    <td align="center">
    <a href="edit_reminders.php?id=<?php echo $remID; ?>">
    <img src="../images/edit.png" alt="edit" title="edit" class="blank" width="16" height="16" /></a>
    &nbsp;&nbsp;&nbsp;&nbsp;
    <img src="../images/delete.png" alt="delete" title="delete student" class="blank" width="16" height="16" onclick="return confirm_delete(<?php echo $remID; ?>)"/>
    </td>
  </tr>
<?php } ?>  
</table>
