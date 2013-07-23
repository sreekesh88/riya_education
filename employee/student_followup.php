<?php 
date_default_timezone_set("Asia/Kolkata");
include ("../include/header.php"); 
include ("../include/validate.php"); 
include ("../include/menu.php"); 
$empID = $info['empID'];
$studID = $_GET['sid'];

$query = mysql_query("SELECT * FROM `students` WHERE studID = '$studID'");
while($array = mysql_fetch_array($query)) {
	$name = $array['fname']." ".$array['lname'];
	$regNo = $array['regNo'];
	$photo = ((!empty($array['photo'])) && (file_exists("photos/".$array['photo']))) ? "photos/".$array['photo'] : "photos/default-img.png";
	$studID = $array['studID'];
	$pgmID = $array['program'];
	if($pgmID != '0') {
		$subPgm = $array['subProgram'];
		$subPgms = mysql_query("SELECT * FROM `subprograms` WHERE spID = '$subPgm'");
		$arr = mysql_fetch_array($subPgms);
		$program = $arr['subpgm'];
	} else {
		$program = $array['pgmOthers'];
	}
	$conID = $array['country'];
	$convertStatus = $array['convertStatus'];	
	
	$activeempID = $array['empID'];
}
$qry1 = mysql_query("SELECT * FROM `stud_contact` WHERE studID = '$studID'");
while($ary1 = mysql_fetch_array($qry1)) {
	$mobile = $ary1['conCode']." ".$ary1['mobile'];
	$email = $ary1['email'];
}

$qry3 = mysql_query("SELECT country FROM `countries` WHERE conID = '$conID'");
	$ary3 = mysql_fetch_array($qry3);
	$country = $ary3['country'];

$qry4 = mysql_query("SELECT qid,otherQlfn FROM `stud_education` WHERE studID = '$studID'");
while($ary4 = mysql_fetch_array($qry4)) {
	$qid = $ary4['qid'];
	$otherQlfn = $ary4['otherQlfn'];
}

if($qid != '6') {
$qry5 = mysql_query("SELECT qualification FROM `qualifications` WHERE qid = '$qid'");
	$ary5 = mysql_fetch_array($qry5);
	$qlfn = $ary5['qualification'];
} else {
	$qlfn = $otherQlfn;
}

?>


<script type="text/javascript">
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

function change_status(id) { 
	var left = (screen.width/2)-(450/2);
	var top = (screen.height/2)-(350/2);
	pop_win = window.open('stud_change_status.php?id='+id, '','left='+left+',top='+top+',toolbar=no,menubar=no,scrollbars=yes,width=400,height=200');
}
</script>

<div id="wrapper_top"></div>
<div id="wrapper">
<?php include("../include/left_stud.php"); ?>
<div class="main_col dotted_border">
<h2>Basic Info</h2>
<br />
<div class="fullWidth">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="pad">
  <tr>
    <td width="217">Register No.</td>
    <td width="8">:</td>
    <td width="417"><b><?php echo $regNo; ?></b></td>
    <td width="202" rowspan="6" align="center"><img src="<?php echo $photo; ?>" alt="picture" width="99" height="128" style="border: 4px solid #777;" /><br /> 
    <div id="status"><span class="link"><a href="#" title="change status" onclick="return change_status(<?php echo $studID?>)">Change</a></span> &nbsp;&nbsp;
    <?php
	if($convertStatus == '0') {
    echo '<img src="../images/status_yellow.png" width="45" height="13"/>';
	} else if($convertStatus == '1') {
	echo '<img src="../images/status_green.png" width="45" height="13"/>';
	} else if($convertStatus == '2') {
	echo '<img src="../images/status_red.png" width="45" height="13"/>';
	}
    ?>
    </div> </td>
  </tr>
  <tr>
    <td>Email Id</td>
    <td>:</td>
    <td><b><?php echo $email; ?></b></td>
  </tr>
  <tr>
    <td>Mobile No.</td>
    <td>:</td>
    <td><b>+<?php echo $mobile; ?></b></td>
  </tr>
  <tr>
    <td>Preferred Program</td>
    <td>:</td>
    <td><b><?php echo $program; ?></b></td>
  </tr>
  <tr>
    <td>Preferred Country</td>
    <td>:</td>
    <td><b><?php echo $country; ?></b></td>
  </tr>
  <tr>
    <td>Highest Qualification</td>
    <td>:</td>
    <td><b><?php echo $qlfn; ?></b></td>
  </tr>
</table>
</div>
<br />


<div class="fullWidth" style="border:1px solid #1882A8;">
<h2>Follow Up</h2><br />

<?php
if(isset($_POST['submit'])) {
	$response = $_POST['response'];
	$notes = mysql_real_escape_string($_POST['notes']);
	$date = date("Y-m-d");
	$time = date("H:i:s"); 
	
	if($notes != 'Enter your notes here...') {
		$query = mysql_query("INSERT INTO `follow_up` (`empID`, `studID`, `response`, `notes`, `date`, `time`) VALUES ('$empID', '$studID', '$response', '$notes', '$date', '$time')");
	}	
}	
?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="3">
    <?php
	$color = 1;
	$result = mysql_query("SELECT * FROM `follow_up` WHERE studID = '$studID'");
	while($ary = mysql_fetch_array($result)) {
		$notes = $ary['notes'];	
		$date = date("d/m/Y", strtotime($ary['date']));
		$time = date("h:i a",strtotime($ary['time']));		
		$response = $ary['response'];
		
		$employeeCode = $ary['empID'];
		$res = mysql_query("SELECT fname,lname FROM `employees` WHERE empID = '$employeeCode'");
		$arr = mysql_fetch_array($res);
		$empName = $arr['fname']." ".$arr['lname'];
		
		$sid = $ary['studID'];
		$studs = mysql_query("SELECT fname,lname FROM `students` WHERE studID = '$sid'");
		$st = mysql_fetch_array($studs);
		$studName = $st['fname']." ".$st['lname'];
		
		if($response == 1) {
		echo '<div class="followUp-wrapper">
			<div class="followUp-sml grey"><i>'.$studName.'</i></div>
			<div class="followUp-big font-11">'.$notes.'</div>
			<div class="followUp-sml font-11 grey">'.$date."&nbsp;&nbsp;&nbsp;".$time.'</div>
		</div>';
		//$color = 2;
		}
		else {
		echo '<div class="followUp-wrapper-alt">
			<div class="followUp-sml grey"><i>'.$empName.'</i></div>
			<div class="followUp-big font-11">'.$notes.'</div>
			<div class="followUp-sml font-11 grey">'.$date."&nbsp;&nbsp;&nbsp;".$time.'</div>
		</div>';
		//$color = 1;
		}
    } ?>
    </td>
  </tr>
  <tr><td colspan="3">&nbsp;</td></tr>
  <tr>
    <td width="125">&nbsp;</td>
    <td>
    <?php
	if($activeempID == $empID) {
	?>
    <form action="" method="post" enctype="multipart/form-data" name="postForm">
    <div class="followUp-big">
    <input name="response" type="checkbox" value="1" /> <?php echo $name; ?>
    <textarea name="notes" id="notes" class="textarea width_440">Enter your notes here...</textarea>
    <script type="text/javascript">blurfocus("notes");</script>
    <span style="float:right;margin-top: 5px;"><input type="submit" name="submit" value="Submit" class="button"/></span>
    </div>
    </form>
    <?php } ?>
    </td>
    <td width="125">&nbsp;</td>
  </tr>
</table>



</div>

</div>
</div>

<?php include("../include/footer.php"); ?>

</div> <!--end of container-->
</body>
</html>