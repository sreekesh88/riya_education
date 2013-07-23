<?php
include ("../include/config.php");
error_reporting(0);
?>
<script>
$(function() {
    $( '.enquiryRow' ).tooltip();
  });
</script>
<div class="fullWidth">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tablegeneral">
  <tr>
    <th width="5%">No</th>
    <th width="11%">Date</th>
    <th width="12%">Ref. ID</th>
    <th width="20%" align="left" class="left_10">Student</th>
    <th width="12%">Country</th>
    <th width="30%" align="left" class="left_5">Program</th>
    <th width="10%" colspan="2" rowspan="1">Actions</th>
  </tr>
<?php

$start = 0;
$limit = 30; 

if(isset($_GET['page'])) {
	$page = $_GET['page'];
	$counter = ((($page - 1) * $limit) + 1);
}
else {
	$page = 1;
	$counter = 1;
}
if ($page) 
	{
		$start = $limit *($page - 1);
		$end = $limit;
	}

$query = mysql_query("SELECT COUNT(*) FROM `enquiries` WHERE delStatus = '0'");
$total_pages = mysql_fetch_array($query);
$total_records = $total_pages[0];
$num_pages = ceil($total_records/$limit);

$sql = "SELECT * FROM `enquiries` WHERE delStatus = '0'";

$startDateValue = date('Y-m-d', strtotime(str_replace('-', '/', $_POST['datepicker_startDate'])));
$endDateValue = date('Y-m-d', strtotime(str_replace('-', '/', $_POST['datepicker_endDate'])));
$datevalue = date('Y-m-d', strtotime(str_replace('-', '/', $_POST['datepicker'])));

if(isset($_POST['datepicker_startDate']) && $_POST['datepicker_endDate']){
	$sql .= " AND date BETWEEN '".$startDateValue."'" ." AND '".$endDateValue."'";
} else if($_POST['datepicker']){
	$sql .= " AND date = '".$datevalue."'";
}
if(isset($_POST['country']) && $_POST['country'] != 'all'){
	$sql .= " AND country = ".$_POST['country'];
}
if(isset($_POST['name'])){
	$sql .= " AND studName LIKE '%".$_POST['name']."%'";
}
if(isset($_POST['ref_id'])){
	$sql .= " AND refID LIKE '%".$_POST['ref_id']."%'";
}
$sql .= " LIMIT $start, $limit";

$enquiry = mysql_query($sql);
if(mysql_num_rows($enquiry) == 0){
	echo '<tr><td align="center" colspan="9" style="color:#D71616">-- No records found for current search criteria --</td></tr>';
}
while($rows = mysql_fetch_array($enquiry)) { 
	$enqID = $rows['enqID'];
	$refID = $rows['refID'];
	$register = $rows['register']; 
	$date = date("d-m-Y",strtotime($rows['date']));
	$student = $rows['studName'];
	$program = $rows['program'];
	$conID = $rows['country'];
	$countries = mysql_query("SELECT * FROM `countries` WHERE conID = '$conID'");
     $ary = mysql_fetch_array($countries);
	 $country = $ary['country'];
	
	$allocated = $rows['allocated'];	
	$allocatedStaff = $rows['allocatedStaff'];
	$employees = mysql_query("SELECT * FROM `employees` WHERE empID = '$allocatedStaff'");
	 $row = mysql_fetch_array($employees);
	 $staff = $row['fname'].' '.$row['lname'];
	 $tooltip = (!empty($rows['expDate']) ? $rows['expDate'] : $rows['remarks']);
?>
  <tr class="enquiryRow" >
    <td align="center" title=" <?php echo $tooltip; ?>"height="30"><?php echo $counter++; ?></td>
    <td align="center"title=" <?php echo $tooltip; ?>"><?php echo $date; ?></td>
    <td align="center" title=" <?php echo $tooltip; ?>"class="font-11 green"><?php echo $refID; ?></td>
    <td title=" <?php echo $tooltip; ?>"align="left"><a href="#" onclick="enquiry_view(<?php echo $enqID; ?>)" class="left_10"><?php echo $student; ?> &nbsp; <img  rowspan="1" src="../images/expand.png" alt="view" /></a></td>
    <td align="center"title=" <?php echo $tooltip; ?>"><?php echo $country; ?></td>
    <td align="left" title=" <?php echo $tooltip; ?>"class="left_5"><?php echo $program; ?></td>
    <td align="center" title="Allocate to <?php echo $staff?>" rowspan="1">
    <img src="../images/allocate.png" alt="allocate"/></td>
    <td align="center" rowspan="1">
    <?php if($register != '1') { ?>
    <a href="student_add.php?enqID=<?php echo $enqID; ?>" title="Register Student"><img src="../images/register.png" alt="register" class="border0"/></a>
    <?php } ?>
    </td>
  </tr>
<?php } ?>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td width="30%" height="80">&nbsp;</td>
    <td align="center">
    <?php
$i=1;
if($total_records > $limit)
{

echo '<ul class="pagination classC page-C-02">';
$page_no = 1;
if($page>1)  
  echo '<li><a href="enquiries.php?page='.($page-1).'" class="previous">Previous</a></li>';
while($i<$total_records)
{
  if($page == $page_no) { $current = 'class="current"'; } else { $current = ''; }
  echo '<li><a href="enquiries.php?page='.$page_no.'" '.$current.'>'.$page_no.'</a></li>';
  $page_no++;
  $i=$i+$limit;
}
  //<li><a href="#" class="current">4</a></li>
if($page>=1 && $page<$num_pages)
  echo '<li><a href="enquiries.php?page='.($page+1).'" class="next">Next</a></li>
</ul>';
}
?>
    </td>
  </tr>
</table>

</div>
