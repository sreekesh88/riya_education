<?php 
include ("../include/header.php"); 
include ("../include/validate.php"); 
include ("../include/menu.php"); 
$empID = $info['empID'];

?>

<script type="text/javascript" src="<?php echo ROOT.'/js/jquery.date_timepicker.js'; ?>"></script>
<script type="text/javascript">
/*********** Text Area ***********/
var ids = [];
var blurfocus = function(id){
  document.getElementById(id).onfocus = function(){
    if(!ids[id]){ ids[id] = { id : id, val : this.value, active : false }; }
    if(this.value == ids[id].val){
	  this.value = "";
	}
  };
  document.getElementById(id).onblur = function(){
    if(this.value == ""){
	  this.value = ids[id].val;
	}
  }
}

$(function() {
	var currentTime = new Date();
	var year = currentTime.getFullYear();
			
	$( "#remDate" ).datetimepicker({
		changeMonth: true,
		changeYear: true,
		dateFormat: "dd-mm-yy"
	});
});
</script>

<div id="wrapper_top"></div>
<div id="wrapper">
<?php include("../include/left.php"); ?>
<div class="main_col dotted_border">
<?php
if(isset($_POST['submit'])) {
	$studID = $_POST['studID'];
	$reminder = mysql_real_escape_string($_POST['reminder']);
	if($_POST['remDate'] != '') { $remDate = date("Y-m-d H:i:s", strtotime($_POST['remDate'])); }
	$date = date("Y-m-d");
	
	if($reminder != 'Enter your reminders here...') {
		$query = mysql_query("INSERT INTO `reminders` (`empID`, `studID`, `reminder`, `remDate`, `date`) VALUES ('$empID', '$studID', '$reminder', '$remDate', '$date')");
	}
}
?>
<h2>Add a Reminder</h2>
<br />
<div class="fullWidth" id="new">
<form action="" method="post" enctype="multipart/form-data" name="postForm">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="30" align="right" valign="top">Student</td>
    <td align="center" valign="top">:</td>
    <td valign="top">
    <select name="studID" id="studID" class="dropdown">
    <option value="" selected="selected" class="padding_2">Select</option>
    <?php
	$res = mysql_query("SELECT * FROM `students` WHERE empID = '$empID' AND delStatus = '0'");
	while($arr = mysql_fetch_array($res)) {
	echo '<option value="'.$arr['studID'].'" class="padding_2">'.$arr['fname']." ".$arr['lname'].'</option>';
	}
    ?>
    </select>
    </td>
  </tr>
  <tr>
    <td height="80" align="right" valign="top">Message</td>
    <td width="2%" align="center" valign="top">:</td>
    <td valign="top"><textarea name="reminder" id="reminder" class="textarea width_440">Enter your reminders here...</textarea>
    <script type="text/javascript">blurfocus("reminder");</script></td>
  </tr>
  <tr>
    <td height="30" align="right">Remind me on</td>
    <td align="center">:</td>
    <td><input type="text" name="remDate" id="remDate" class="textbox width_200 textCenter" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td height="50"><input type="submit" name="submit" value="Add Reminder" class="button width_200"/></td>
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