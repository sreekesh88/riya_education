<?php include ("../include/header.php"); 
include ("../include/validate.php"); 
include ("../include/menu.php"); ?>

<?php
$action = isset($_REQUEST['action'])?$_REQUEST['action'] :'';
if($action == 'delete')
{
$query = mysql_query("UPDATE `seminars` SET delStatus = '1' WHERE semID =".$_REQUEST['id']);
header("location: add_seminars.php");
}
?>

<script type="text/javascript">

function edit_seminar(id) {
	var left = (screen.width/2)-(650/2);
	var top = (screen.height/2)-(400/2);
	var pop_win = window.open('edit_seminar.php?id='+id, '','left='+left+',top='+top+',toolbar=no,menubar=no,scrollbars=yes,width=500,height=300'); 
	
}

function confirm_delete(id)
{
	//alert(id);
	var r=confirm("Are you sure to delete this Seminar?")
	if (r==true)
 	{
  		window.location = "add_seminars.php?id="+id+"&action=delete";
  	}
	else
	{
		window.location = "add_seminars.php";
	}
}

$(function() {
$.noConflict();
var currentTime = new Date();
var year = currentTime.getFullYear();
		
	$("#semDate").datepicker({
	changeMonth: true,
	changeYear: true,
	dateFormat: "dd-mm-yy",
	minDate: "0y",
	yearRange: (year)+':'+(year+1) 
	});

});

</script>

<?php 
require("../include/validate.php");

if(isset($_POST['allocate']))
{
	$semTopic = $_POST['semTopic'];
	$faculty = $_POST['faculty'];
	$venue = $_POST['venue'];
	$semDate = date("Y-m-d", strtotime($_POST['semDate']));
	$semTime = $_POST['from1'].":".$_POST['from2']."--".$_POST['to1'].":".$_POST['to2']; 
	$delegate = $_POST['delegate'];
	$participants = $_POST['participants'];

	if($venue != '')
	{
	$query = mysql_query("INSERT INTO `seminars` (`semTopic`, `faculty`, `delegate`, `semDate`, `semTime`, `venue`,  `participants`) VALUES ('$semTopic', '$faculty', '$delegate', '$semDate', '$semTime', '$venue', '$participants')");	
	}
	header("location: add_seminars.php");						
	
}

?>


<script type="text/javascript" src="../js/validate.js"></script>
<div id="wrapper_top"></div>
<div id="wrapper">

<?php include("../include/left.php"); ?>

<div class="main_col dotted_border">
<div class="fullWidth">
<h2>Seminars</h2>
<br> 
        
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tablegeneral">
  <tr>
    <th width="5%">No</th>
    <th width="35%">Topic</th>
    <th width="20%">Faculty</th>
    <th width="15%">Date</th>
    <th width="10%">Action</th>
    <th width="10%">Status</th>
  </tr>
<?php
$counter = '0';          
$qry = mysql_query("SELECT * FROM `seminars` WHERE delStatus = '0'"); 
while($ary = mysql_fetch_array($qry)) {
$counter++;
?>
  <tr>
    <td align="center" height="25"><?php echo $counter; ?></td>
    <td align="left"><a href="view_seminars.php?id=<?php echo $ary['semID']; ?>" title="View Details"><?php echo $ary['semTopic']; ?></a></td>
    <td align="left"><?php echo $ary['faculty']; ?></td>
    <td align="center"><?php echo date("d-m-Y", strtotime($ary['semDate'])); ?></td>
    <td align="center">
    <a href="#">
<img src="../images/edit.png" alt="edit" title="edit" class="blank" width="16" height="16" onClick="return edit_seminar(<?php echo $ary['semID']; ?>)"/></a>
&nbsp;&nbsp;&nbsp;&nbsp;
<img src="../images/delete.png" alt="delete" title="delete" class="blank" width="16" height="16" onClick="return confirm_delete(<?php echo $ary['semID']; ?>)"/>            </td>
    <td align="center">
    <?php 
    if($ary['comStatus'] == '1') {echo "<img src='../images/complete.png' alt='Completed' title='Completed' class='blank' width='16' height='16' />";}
    else {echo "<img src='../images/not_complete.png' alt='pending' title='Pending' class='blank' width='16' height='16' />";}
    ?>
    </td>
  </tr>
<?php
}         
?>
</table>
</div>
<br />
<div class="fullWidth">
<br />
<form action="" method="post" enctype="multipart/form-data" name="form1">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="40" colspan="6" class="padding20"><h6>Allocate a seminar</h6></td>
  </tr>
  <tr>
    <td height="40" align="right"><b>Topic</b></td>
    <td align="center"><b>:</b></td>
    <td align="left"><input name="semTopic" type="text" class="textbox width_200" />    </td>
    <td align="right"><b>Faculty</b></td>
    <td align="center"><b>:</b></td>
    <td align="left"><input name="faculty" type="text" class="textbox width_200" /></td>
  </tr>
  <tr>
    <td width="13%"  height="40" align="right"><b>Venue</b></td>
    <td width="2%" align="center"><b>:</b></td>
    <td width="28%" align="left"><input name="venue" type="text" class="textbox width_200" /></td>
    <td width="18%" align="right"><b>Date</b></td>
    <td width="2%" align="center"><b>:</b></td>
    <td width="37%" align="left"><input name="semDate" id="semDate" type="text" class="textbox width_200 textCenter" readonly="readonly" /></td>
  </tr>
  <tr>
    <td height="40" align="right"><b>Timing from</b></td>
    <td align="center"><b>:</b></td>
    <td align="left">
    <select name="from1" id="from1" style="width:80px;" class="dropdown">
      <?php
        for($i=0;$i<=24;$i++)
        {
        $m = $i;
        $m = sprintf("%02d", $m);
        echo "<option value='$m' class='padding_2'>$m</option>";
        }
        ?>
    </select>
      <select name="from2" id="from2" style="width:80px;" class="dropdown">
        <option value="00" class='padding_2'>00</option>
        <option value="15" class='padding_2'>15</option>
        <option value="30" class='padding_2'>30</option>
        <option value="45" class='padding_2'>45</option>
    </select></td>
    <td align="right"><b>To</b></td>
    <td align="center"><b>:</b></td>
    <td align="left">
    <select name="to1" id="to1" style="width:80px;" class="dropdown">
      <?php
        for($i=0;$i<=24;$i++)
        {
        $m = $i;
        $m = sprintf("%02d", $m);
        echo "<option value='$m' class='padding_2'>$m</option>";
        }
        ?>
    </select>
    &nbsp;&nbsp;
    <select name="to2" id="to2" style="width:80px;" class="dropdown">
      <option value="00" class='padding_2'>00</option>
      <option value="15" class='padding_2'>15</option>
      <option value="30" class='padding_2'>30</option>
      <option value="45" class='padding_2'>45</option>
    </select>    </td>
  </tr>
  <tr>
    <td height="40" align="right"><b>Delegate</b></td>
    <td align="center"><b>:</b></td>
    <td align="left"><input name="delegate" type="text" class="textbox width_200" /></td>
    <td align="right"><b>No. of Participants</b></td>
    <td align="center"><b>:</b></td>
    <td align="left"><input name="participants" type="text" class="textbox width_200" /></td>
  </tr>
  <tr>
    <td height="60" colspan="6" align="center">
    <input type="submit" name="allocate" value="Allocate" class="button width_150" />
&nbsp;&nbsp;&nbsp;
	<input type="button" name="cancel" value="<< Back" class="button" onClick="history.back();" /></td>
    </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td colspan="4" align="left">&nbsp;</td>
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