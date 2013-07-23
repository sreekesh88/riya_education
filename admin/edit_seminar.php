<?php include("../include/config.php") ?>

<link rel="stylesheet" type="text/css" href="<?php echo ROOT."/css/style.css"; ?>">
<link rel="stylesheet" type="text/css" href="<?php echo ROOT."/js/jquery-ui/css/base-theme/jquery-ui.css"; ?>">
<script type="text/javascript" src="<?php echo ROOT."/js/jquery-ui/js/jquery-1.8.3.js"; ?>"></script>
<script type="text/javascript" src="<?php echo ROOT."/js/jquery-ui/js/jquery-ui-1.9.2.custom.min.js"; ?>"></script>


<?php
require ("../include/validate.php");
$semID = $_GET['id'];
 
$query = mysql_query("SELECT * FROM `seminars` WHERE semID = '$semID'");
while($ary = mysql_fetch_array($query))
{
	$semTopic = $ary['semTopic'];
	$faculty = $ary['faculty'];
	$semDate = $ary['semDate'];
	$venue = $ary['venue'];
	$semTime = $ary['semTime'];
}

if(isset($_POST['update']))
{
	$semTopic = $_POST['semTopic'];
	$faculty = $_POST['faculty'];
	$venue = $_POST['venue'];
	$semDate = date("Y-m-d", strtotime($_POST['semDate']));
	$semTime = $_POST['from1'].":".$_POST['from2']."--".$_POST['to1'].":".$_POST['to2'];
	
	$query = mysql_query("UPDATE `seminars` 
						  SET `semTopic` = '$semTopic', 
							   `faculty` = '$faculty', 
							   `venue` = '$venue', 
							   `semDate` = '$semDate', 
							   `semTime` = '$semTime'
						  WHERE	semID = '$semID'"); 
}
?>

<script type="text/javascript">
window.onunload = function()
{
	window.opener.location.reload();
	window.close();
};

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

});
</script>

<style type="text/css">
<!--
.list_field {	width: 160px;
	height: 22px;
	-webkit-border-radius: 2px;
	border-radius: 2px;
	border: solid 1px #ccc;
	font-size: 11px;
}
-->
</style>
<form method="post" action="" enctype="multipart/form-data">
<table width="100%%" border="0" cellspacing="0" cellpadding="0" bgcolor="#eee">
  <tr>
    <td height="40" colspan="3" align="left" class="txt_bold_14" bgcolor="#ccc">Edit Seminar Details</td>
  </tr>
  <tr>
    <td height="30" align="right"><h3>Topic</h3></td>
    <td width="5%" align="center">:</td>
    <td align="left">
      <input type="text" name="semTopic" id="semTopic" class="text_input" value="<?php echo $semTopic; ?>">    </td>
  </tr>
  <tr>
    <td height="30" align="right"><h3>Faculty</h3></td>
    <td align="center">:</td>
    <td align="left">
      <input type="text" name="faculty" id="faculty" class="text_input" value="<?php echo $faculty; ?>"></td>
  </tr>
  <tr>
    <td height="30" align="right"><h3>Venue</h3></td>
    <td align="center">:</td>
    <td align="left"><input type="text" name="venue" id="venue" class="text_input" value="<?php echo $venue; ?>"/></td>
  </tr>
  <tr>
    <td height="30" align="right" valign="top"><h3>Date</h3>
    <?php
	$a = explode(":",$semTime);
	$b = explode("--", $a[1]);
	//echo $a[0]."-".$b[0]."-".$b[1]."-".$a[2];
	$from1 = $a[0];
	$from2 = $b[0];
	$to1 = $b[1];
	$to2 = $a[2];
	?>
    </td>
    <td align="center" valign="top">:</td>
    <td align="left" valign="top"><input type="text" name="semDate" id="semDate" class="text_input" style="width: 80px;" value="<?php echo date("d-m-Y", strtotime($semDate)); ?>"/></td>
  </tr>
  <tr>
    <td height="30" align="right" valign="top"><h3>Company Profile</h3></td>
    <td align="center" valign="top">:</td>
    <td align="left" valign="top"><table width="50%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><h3>From</h3></td>
        <td>
        <select name="from1" id="from1" style="width:40px;" class="list_field">
        <?php
        for($i=0;$i<=24;$i++)
        {
        $m = $i;
        $m = sprintf("%02d", $m);
        echo "<option value='".$m."'";
		if($m == $from1)
		echo "selected = 'selected'";
		echo ">".$m."</option>";
        }
        ?>
        </select>
          &nbsp;&nbsp;
         <?php
		 $sel1 = '';
		 $sel2 = '';
		 $sel3 = '';
		 $sel4 = '';
		  
		 	  if($from2 == "00") { $sel1 = "selected='selected'"; }
		 else if($from2 == "15") { $sel2 = "selected='selected'"; }
		 else if($from2 == "30") { $sel3 = "selected='selected'"; }
		 else if($from2 == "45") { $sel4 = "selected='selected'"; }
		 ?>  
        <select name="from2" id="from2" style="width:40px;" class="list_field">
            <option value="00" <?php echo $sel1; ?> >00</option>
            <option value="15" <?php echo $sel2; ?> >15</option>
            <option value="30" <?php echo $sel3; ?> >30</option>
            <option value="45" <?php echo $sel4; ?> >45</option>
        </select></td>
      </tr>
      <tr>
        <td><h3>To</h3></td>
        <td>
        <select name="to1" id="to1" style="width:40px;" class="list_field">
        <?php
        for($i=0;$i<=24;$i++)
        {
        $m = $i;
        $m = sprintf("%02d", $m);
        echo "<option value='".$m."'";
		if($m == $to1)
		echo "selected = 'selected'";
		echo ">".$m."</option>";
        }
		?>
        </select>
        &nbsp;&nbsp;
        <?php
		 $selec1 = '';
		 $selec2 = '';
		 $selec3 = '';
		 $selec4 = '';
		  
		 	  if($to2 == "00") { $selec1 = "selected='selected'"; }
		 else if($to2 == "15") { $selec2 = "selected='selected'"; }
		 else if($to2 == "30") { $selec3 = "selected='selected'"; }
		 else if($to2 == "45") { $selec4 = "selected='selected'"; }
		?>  
        <select name="to2" id="to2" style="width:40px;" class="list_field">
          <option value="00" <?php echo $selec1; ?> >00</option>
          <option value="15" <?php echo $selec2; ?> >15</option>
          <option value="30" <?php echo $selec3; ?> >30</option>
          <option value="45" <?php echo $selec4; ?> >45</option>
        </select>        </td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
    <td height="60" align="left">
      <input type="submit" name="update" id="update" value="Update" class="button_sml">    </td>
  </tr>
</table>
</form>
