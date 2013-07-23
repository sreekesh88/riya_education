<?php 
include ("../include/header.php"); 
include ("../include/validate.php"); 
include ("../include/menu.php"); 
$empID = $info['empID'];
?>

<script>
function viewSales(id,name) { 
	$("#salesView").dialog(
		   {
			bgiframe: true,
			autoOpen: false,
			height: 500,
			width: 600,
			modal: true,
			show: 'fade',
			close: 'fade',
		   }
	);
	//$('#ui-id-1').html(name);
	$.ajax({  
		url: "sales_registration_view.php?id="+id,
		success: function(data){
			$("#salesView").html(data);
   			$("#salesView").dialog('open');
		}
    });
}
</script>

<div id="wrapper_top"></div>
<div id="wrapper">
<?php include("../include/left.php"); ?>
<div class="main_col dotted_border" style="min-height:500px;">
<h2>Sales Activity List</h2>
<br />
<div class="fullWidth">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table">
    <tr>
      <th width="4%">No</th>
      <th width="10%">Date</th>
      <th width="10%">Sales ID</th>
      <th width="15%">Purpose</th>
      <th width="28%" align="left" class="left_5">Institution</th>
      <th width="18%">Follow up on</th>
      <th width="15%" colspan="3">Actions</th>
    </tr>
<?php
$start = 0;
$limit = 20; 

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

$query = mysql_query("SELECT COUNT(*) FROM `sales_activity` WHERE delStatus = '0'");
$total_pages = mysql_fetch_array($query);
$total_records = $total_pages[0];
$num_pages = ceil($total_records/$limit);

$sales_activity = mysql_query("SELECT * FROM `sales_activity` WHERE delStatus = '0' LIMIT $start, $limit");
while($row = mysql_fetch_array($sales_activity)) {
	$saID = $row['saID'];
	$date = date("d-m-Y", strtotime($row['date']));
	$salesID = $row['salesID'];
	$instnName = $row['instnName'];
	$followup = date("d-m-Y", strtotime($row['followupDate']))." - ".$row['followupTime'];
	
	$svpID = $row['visit_purpose'];
	if($svpID != '0') {
	$sales_visit_purpose = mysql_query("SELECT * FROM `sales_visit_purpose` WHERE svpID = '$svpID'");
	 $val = mysql_fetch_array($sales_visit_purpose);
	 $visit_purpose = $val['purpose']; 
	} else {
	 $visit_purpose = $row['other_visit_purpose']; 
	}
?>    
    <tr>
      <td align="center" class="font-11"><?php echo $counter++; ?></td>
      <td align="center" class="font-11"><?php echo $date; ?></td>
      <td align="center" class="green font-11"><?php echo $salesID; ?></td>
      <td align="center" class="blue font-11"><?php echo $visit_purpose; ?></td>
      <td align="left" class="font-11"><?php echo $instnName; ?></td>
      <td align="center" class="font-11"><?php echo $followup; ?></td>
      <td align="center">
      <a href="javascript:void(0);" onclick="viewSales(<?php echo $saID; ?>)"><img src="../images/view.png" alt="view" /></a>
      </td>
      <td align="center">
      <a href="sales_registration_edit.php?id=<?php echo $saID; ?>"><img src="../images/edit.png" alt="edit" /></a>
      </td>
      <td align="center">
      <?php if(($svpID == '2') || ($svpID == '3')) { ?>
      <a href="event_request.php?id=<?php echo $saID; ?>"><img src="../images/goto.png" alt="edit" /></a>
      <?php } ?>
      </td>
    </tr>
<?php
}
?>
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
  echo '<li><a href="sales_registration_list.php?page='.($page-1).'" class="previous">Previous</a></li>';
while($i<$total_records)
{
  if($page == $page_no) { $current = 'class="current"'; } else { $current = ''; }
  echo '<li><a href="sales_registration_list.php?page='.$page_no.'" '.$current.'>'.$page_no.'</a></li>';
  $page_no++;
  $i=$i+$limit;
}
  //<li><a href="#" class="current">4</a></li>
if($page>=1 && $page<$num_pages)
  echo '<li><a href="sales_registration_list.php?page='.($page+1).'" class="next">Next</a></li>
</ul>';
}
?>
    </td>
  </tr>
</table>

</div>

<div id="salesView" title="Sales Activity"></div>

</div>
</div>

<?php include("../include/footer.php"); ?>

</div> <!--end of container-->
</body>
</html>