<?php
include("../include/config.php");
?>
<?php
$saID = $_GET['id'];
$query = mysql_query("SELECT * FROM `sales_activity` WHERE saID = '$saID'");
while($row = mysql_fetch_array($query)) {
	$date = date("d-m-Y",strtotime($row['date']));
	$followup = date("d-m-Y", strtotime($row['followupDate']))." - ".$row['followupTime'];
	$address = $row['addr1']."<br>".$row['addr2']."<br>".$row['addr3'];
	$svpID = $row['visit_purpose'];
	if($svpID != '0') {
	$sales_visit_purpose = mysql_query("SELECT * FROM `sales_visit_purpose` WHERE svpID = '$svpID'");
	 $val = mysql_fetch_array($sales_visit_purpose);
	 $visit_purpose = $val['purpose'];
	} else {
	 $visit_purpose = $row['other_visit_purpose']; 
	}
	$confirm = $row['confirm'];
	if($confirm == '1') { $status = "Confirmed"; }
	else if($confirm == '2') { $status = "Not Confirmed"; }
?>
<div class="fullWidth">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="30%" height="30" valign="top">Date</td>
    <td width="2%" valign="top">:</td>
    <td width="68%" valign="top" class="blue"><?php echo $date; ?></td>
    </tr>
  <tr>
    <td height="30" valign="top">Sales ID</td>
    <td valign="top">:</td>
    <td valign="top"><b class="red"><?php echo $row['salesID']; ?></b></td>
  </tr>
  <tr>
    <td valign="top">Place of Visit</td>
    <td valign="top">:</td>
    <td valign="top">
    <table width="400" border="0" cellspacing="0" cellpadding="0" class="pad">
      <tr>
        <td><?php echo $row['instnName']; ?></td>
        <td><?php echo $row['email']; ?></td>
      </tr>
      <tr>
        <td><?php echo $row['contPerson']; ?></td>
        <td rowspan="3"><?php echo $address; ?></td>
      </tr>
      <tr>
        <td><?php echo $row['mobile']; ?></td>
        </tr>
      <tr>
        <td><?php echo $row['phone']; ?></td>
      </tr>
    </table>    </td>
    </tr>
  <tr>
    <td height="30" valign="top">&nbsp;</td>
    <td valign="top">&nbsp;</td>
    <td valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td height="30" valign="top">Purpose of Visit</td>
    <td valign="top">:</td>
    <td valign="top">
	<b class="green"><?php echo $visit_purpose; ?></b>
    <br />
    
    <?php if(($svpID == '2') || ($svpID == '3')) { ?>
		<label class="blue">Request for <?php echo $visit_purpose; ?></label> : 
        <label class="red"><?php echo $status; ?></label>
        <br />
	<?php } ?>
    
    <?php if($row['venue_detail'] != '') { ?>
    <div class="top_10">
		<b>Venue Details</b> <br />
		<label><?php echo $row['venue_detail']; ?></label>
    </div>
    <?php } ?>
    
    <?php if($row['remarks'] != '') { ?>
    <div class="top_10">
		<b>Remarks</b> <br />
		<label><?php echo $row['remarks']; ?></label>
    </div>
    <?php } ?>
    <?php if($confirm == '2') { ?>
    	<b>Reason</b> <br />
    	<label class="top_10"><?php echo $row['reason']; ?></label>
    <?php } ?>    </td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td height="30">No. of data collected</td>
    <td>:</td>
    <td><?php echo $row['data_collected']; ?></td>
    </tr>
  <tr>
    <td height="30">Follow up on</td>
    <td>:</td>
    <td><?php echo $followup; ?></td>
  </tr>
</table>
<?php } ?>
</div>
