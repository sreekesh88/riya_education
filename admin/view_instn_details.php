<?php include ("../include/header.php"); 
include ("../include/validate.php"); 
include ("../include/menu.php"); 
$insID = $_GET['id'];

$instn = mysql_query("SELECT * FROM `institutions` WHERE insID = '$insID'");
$row1 = mysql_fetch_array($instn);
$institution = $row1['institution'];
$conID = $row1['conID'];
$countries = mysql_query("SELECT * FROM `countries` WHERE conID = '$conID'");
$row2 = mysql_fetch_array($countries);
$country = $row2['country'];
?>

<script>
/*function add_details(id) {
	var left = (screen.width/2)-(530/2);
	var top = (screen.height/2)-(430/2);
	var pop_win = window.open('add_intake_details.php?id='+id, '','left='+left+',top='+top+',toolbar=no,menubar=no,scrollbars=yes,width=530,height=200'); 
	
}*/

function add_details(id) {
	
	$("#details").dialog(
	   {
		bgiframe: true,
		autoOpen: false,
		height: 300,
		width: 400,
		modal: true,
		closeOnEscape: false
	   }
	);
	$('#instn_id').val(id);
	$('#details').dialog('open'); 
}

function updateDetails() {
	var intake = $('#intake').val();
	var fees = $('#fees').val();
	var id = $('#instn_id').val();

	$.ajax({  
		url: "add_intake_details.php",
        type: "POST",
		data: $("#formDetail").serialize(),
		success: function(data){
		document.location.reload();
		}
    });
}
</script>

<div id="wrapper_top"></div>
<div id="wrapper">
<?php include("../include/left.php"); ?>
<div class="main_col dotted_border">
<h2><?php echo $institution; ?> in <?php echo $country; ?></h2>
<br />
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table">
  <tr>
    <th width="5%">No</th>
    <th width="10%" align="center" class="padding_2">Program</th>
    <th width="40%" align="left" class="padding_2">Sub Program</th>
    <th width="15%">Intake</th>
    <th width="15%">Fees</th>
    <th width="15%">Actions</th>
  </tr>
<?php
$start = 0;
$limit = 15; 

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

$query = mysql_query("SELECT COUNT(*) FROM `instn-subpgm` WHERE insID = '$insID'");
$total_pages = mysql_fetch_array($query);
$total_records = $total_pages[0];
$num_pages = ceil($total_records/$limit);

$fetch_program = mysql_query("SELECT * FROM `instn-subpgm` WHERE insID = '$insID' LIMIT $start, $limit");
while($ary1 = mysql_fetch_array($fetch_program)) {
	$isID = $ary1['isID'];
	$pgmID = $ary1['pgmID'];
	$programs = mysql_query("SELECT program FROM `programs` WHERE pgmID = '$pgmID'");
	$ary2 = mysql_fetch_array($programs);
	$program = $ary2['program'];
	$spID = $ary1['spID'];
?>
  <tr>
    <td align="center"><?php echo $counter++; ?></td>
    <td align="center" class="font-11"><?php echo $program; ?></td>
    <td class="font-11"><?php
	$subprograms = mysql_query("SELECT * FROM `subprograms` WHERE spID = '$spID'");
	$ary3 = mysql_fetch_array($subprograms);
	echo $subpgm = $ary3['subpgm'];
	?>    </td>
    <td align="center" class="font-11"><?php
	$proDetails = mysql_query("SELECT * FROM `proDetails` WHERE isID = '$isID'");
	$ary4 = mysql_fetch_array($proDetails);
	echo $intake = $ary4['intake'];
	?></td>
    <td align="center" class="font-11"><?php echo $fees = $ary4['fees']; ?></td>
    <td align="center">
    <a href="javascript:void(0);" onclick="return add_details(<?php echo $isID; ?>)">
    <img src="../images/add.png" alt="assign" title="Add Fees" class="blank" width="16" height="16" /></a>
    &nbsp;&nbsp;&nbsp;&nbsp;
    <a href="update_country.php?id=<?php echo $conID; ?>">
    <img src="../images/edit.png" alt="edit" title="edit" class="blank" width="16" height="16" /></a>
    &nbsp;&nbsp;&nbsp;&nbsp;
    <img src="../images/delete.png" alt="delete" title="delete" class="blank" width="16" height="16" onclick="return confirm_delete(<?php echo $conID; ?>)"/>
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
  echo '<li><a href="view_instn_details.php?id='.$insID.'&page='.($page-1).'" class="previous">Previous</a></li>';
while($i<$total_records)
{
  if($page == $page_no) { $current = 'class="current"'; } else { $current = ''; }
  echo '<li><a href="view_instn_details.php?id='.$insID.'&page='.$page_no.'" '.$current.'>'.$page_no.'</a></li>';
  $page_no++;
  $i=$i+$limit;
}
  //<li><a href="javascript:void(0);" class="current">4</a></li>
if($page>=1 && $page<$num_pages)
  echo '<li><a href="view_instn_details.php?id='.$insID.'&page='.($page+1).'" class="next">Next</a></li>
</ul>';
}
?>
    </td>
  </tr>
</table>
<br />

<div id="details" title="Add Details" style="display:none;">
<form method="post" action="" enctype="multipart/form-data" id="formDetail" name="formDetail">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="pad">
  <tr>
    <td colspan="3" height="10"></td>
    </tr>
  <tr>
    <td width="33%" height="40" align="right">Intake</td>
    <td width="1%">:</td>
    <td width="66%"><input name="intake" id="intake" type="text" class="textbox"/></td>
  </tr>
  <tr>
    <td height="40" align="right">Fees</td>
    <td>:</td>
    <td><input name="fees" id="fees" type="text" class="textbox" /></td>
     <input type="hidden" name="instn_id" id="instn_id" value=""/>
  </tr>
  <tr>
    <td height="50">&nbsp;</td>
    <td>&nbsp;</td>
    <td><input type="button" name="submit" id="submit" value="Submit" class="button" onclick="updateDetails()"/></td>
  </tr>
</table>
</form>
</div>


</div> <!--end of main_col-->
</div> <!--end of wrapper-->

<?php include("../include/footer.php"); ?>

</div> <!--end of container-->
</body>
</html>
