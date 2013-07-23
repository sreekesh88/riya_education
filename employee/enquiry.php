<?php 
include ("../include/header.php"); 
include ("../include/validate.php"); 
include ("../include/menu.php"); 
$empID = $info['empID'];
$branchID = $info['branchID'];
$branches = mysql_query("SELECT branchCode FROM `branches` WHERE branchID = '$branchID'");
$res = mysql_fetch_array($branches);
$bCode = $res['branchCode'];
?>
<style>
.result {
	background-color: #be0000;
	color: #fff;
	padding: 5px 10px;
}
</style>
<script type="text/javascript">
$(document).on('click','#yes',function() {
	$("#bandScore").show();
});

$(document).on('click','#no',function() {
	$("#bandScore").hide();
});

function evaluate_student() 
{ 
	var pgmScore = $("#pgmScore").val();				//diploma score
	var ielts = $('input[name=ielts]:checked').val();	//ielts
	var bScore = $("#bScore").val(); 					//band score
	var marks = $("#marks").val(); 						//marks in english

	if(pgmScore) {
		if(ielts == 1) {
			if(bScore<pgmScore) {
				$('#alert').html("<span class='result'>IELTS Score not required enough</span>");
				setTimeout("$('#alert').fadeIn('slow')", 1000);
			} else if(bScore>=pgmScore) {
				$('#alert').html("<span class='result'>Eligible for Higher Education</span>");
				setTimeout("$('#alert').fadeIn('slow')", 1000);
			}
		} else {
			if(marks != '') {
				if(marks<75) { //alert(marks);
					$('#alert').html("<span class='result'>IELTS Score is required</span>");
				setTimeout("$('#alert').fadeIn('slow')", 1000);
				} else if(marks>=75){
					$('#alert').html("<span class='result'>Eligible for Higher Education</span>");
				setTimeout("$('#alert').fadeIn('slow')", 1000);
				}
			}
		}
	} else {
		$('#alert').html("<span class='result'>Please fill required fields</span>");
		setTimeout("$('#alert').fadeOut('slow')", 3000);
	}

}

function toggleSelection(){
	if(document.getElementById('processBy').disabled==true){
		document.getElementById('processBy').disabled=false;
		document.getElementById('processBy').style.cursor = "auto";
	}else{
		document.getElementById('processBy').disabled=true;
		document.getElementById('processBy').style.cursor = "not-allowed";
	}
}
</script>

<?php
if(isset($_POST['submit'])) {
	
	$result = mysql_query("SELECT lastInc FROM `enquiries` ORDER BY lastInc DESC LIMIT 1");	
	while($ary = mysql_fetch_array($result)) {
	$lastInc = $ary['lastInc'];
	}
	if ($lastInc == '') { 
		$lastInc = sprintf("%04d",1); 
		$counter = $lastInc;
		$refID = "GEN".$bCode.$counter;
	} else {
		$counter = sprintf("%04d",$lastInc+1);
		$refID = "GEN".$bCode.$counter;
	}
	
	$date = date("Y-m-d");
	$country = $_POST['country'];
	$pgmScore = $_POST['pgmScore'];
	if($pgmScore == '5.5') { $level = "Diploma"; }
	else if($pgmScore == '6') { $level = "Under Graduate"; }
	else if($pgmScore == '6.5') { $level = "Post Graduate"; }
	else if($pgmScore == '7') { $level = "Teaching"; }
	$studName = $_POST['name'];
	$contact = $_POST['contact'];
	$program = $_POST['program'];	
	$marks = $_POST['marks'];
	$class = $_POST['qlfn'];
	$bScore = $_POST['bScore'];
	if($_POST['allocate_to'] == '1') { $processBy = $_POST['processBy']; }
	else { $processBy = $empID; }
	$remarks = $_POST['remarks'];
	$expDate = $_POST['expDate'];
	$fee = $_POST['fee'];
	
	if($remarks != '') {
		$query = mysql_query("INSERT INTO `enquiries` (`refID`, `empID`, `country`, `level`, `date`, `studName`, `contact`, `program`, `marks`, `class`, `bScore`, `remarks`, `allocatedStaff`, `expDate`, `fee`, `lastInc`) VALUES ('$refID', '$empID', '$country', '$level', '$date', '$studName', '$contact', '$program', '$marks', '$class', '$bScore', '$remarks', '$processBy', '$expDate', '$fee', '$counter')");
		
		if($query > 0) {
		$success = "Enquiry has been submitted succesfully";
		?>    
		<script language='javascript'>
		setTimeout("$('#success').fadeOut('slow')", 3000);
		</script>
		<?php
		}
	}	

}
?>

<div id="wrapper_top"></div>
<div id="wrapper">

<div id="enquiry">
<form action="" method="post" enctype="multipart/form-data" name="form">
<table width="100%" border="0" cellspacing="0" cellpadding="0" id="">
  <tr>
    <td colspan="4" height="40"><h2>General Enquiry</h2></td>
  </tr>
  <tr>
    <td width="25%" height="35">Select Country</td>
    <td width="2%" align="center"><strong>:</strong></td>
    <td width="35%" align="left"><select name="country" id="country" class="dropdown" style="width:150px;">
      <option value="0" selected="selected" class="padding_2">Select</option>
      <?php
	$res1 = mysql_query("SELECT * FROM `countries` WHERE delStatus = '0'");
	while($arr1 = mysql_fetch_array($res1)) {
	echo '<option value="'.$arr1['conID'].'" class="padding_2">'.$arr1['country'].'</option>';
	}
    ?>
    </select></td>
    <td width="41%" align="left" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td height="35">Select Level</td>
    <td align="center"><strong>:</strong></td>
    <td align="left">
    <select name="pgmScore" id="pgmScore" class="dropdown" style="width:150px;">
    <option value="" selected="selected" class="padding_2">Select</option>
    <option value="5.5" class="padding_2">Diploma</option>
    <option value="6" class="padding_2">Under Graduate</option>
    <option value="6.5" class="padding_2">Post Graduate</option>
    <option value="7" class="padding_2">Teaching</option>
    </select>    </td>
    <td width="41%" align="left" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td height="35">Have you taken IELTS?</td>
    <td align="center"><strong>:</strong></td>
    <td align="left">
    <input type="radio" name="ielts" id="yes" value="1" /> Yes
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <input type="radio" name="ielts" id="no" value="0" /> No</td>
    <td width="41%" align="left" valign="top">&nbsp;</td>
  </tr>  
  <tr id="bandScore" style="display: none;">
    <td height="35">Band Score</td>
    <td align="center"><strong>:</strong></td>
    <td align="left">
    <input type="text" name="bScore" id="bScore" class="textbox width_95 textCenter" /></td>
    <td width="41%" align="left" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td height="35">Marks for English in </td>
    <td align="center"><strong>:</strong></td>
    <td align="left">
    <select name="qlfn" id="qlfn" class="dropdown" style="width: 80px;">
    <option value="" selected="selected" class="padding_2">Select</option>
    <option value="1" class="padding_2">Xth</option>
    <option value="2" class="padding_2">XIIth</option>
    </select>
    <input type="text" name="marks" id="marks" class="textbox width_60 textCenter" />
    <strong>%</strong></td>
    <td width="41%" align="left" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td height="50">&nbsp;</td>
    <td>&nbsp;</td>
    <td><input type="button" name="evaluate" id="evaluate" value="Evaluate" class="button" onclick="return evaluate_student()"/> &nbsp;&nbsp;&nbsp;
      <input type="button" name="reset" id="reset" value="Clear" class="button" onclick="location.reload(true);"/></td>
    <td><span id="alert"></span></td>
  </tr>
  <tr>
    <td height="35">Student</td>
    <td align="center"><strong>:</strong></td>
    <td><input type="text" name="name" id="name" class="textbox" placeholder="Full Name" /></td>
    <td>
      <input type="text" name="contact" id="contact" class="textbox" placeholder="Contact Number"/></td>
  </tr>
  <tr>
    <td height="45">Preferring Program</td>
    <td align="center"><strong>:</strong></td>
    <td colspan="2">
    <input type="text" name="program" id="program" class="textbox" style="width: 330px;" /></td>
    </tr>
  <tr>
    <td height="45">Allocate User
        <input type="checkbox" onclick="toggleSelection();" name="allocate_to" id="allocate_to" class="checkbox" value='1'/>    </td>
    <td align="center"><strong>:</strong></td>
    <td>
    <select name="processBy" style="cursor:not-allowed;width:160px;" id="processBy" disabled="true" class="dropdown">
      <option value="" selected="selected" class="padding_2">Select</option>
      <?php
	$employees = mysql_query("SELECT empID,fname,lname FROM `employees` WHERE deptID = '1' AND delStatus = '0'");
	while($rows = mysql_fetch_array($employees)) {
		echo '<option value="'.$rows['empID'].'"';
		if($rows['empID'] == $empID)
		echo 'selected="selected"';
		echo '>'.$rows['fname'].' '.$rows['lname'].'</option>';
	}
	?>
    </select>    </td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="80" valign="top">Remarks about the enquiry</td>
    <td align="center" valign="top"><strong>:</strong></td>
    <td colspan="2" valign="top">
    <textarea name="remarks" id="remarks" class="textarea_dotted" style="padding: 5px;width: 330px;"></textarea>    </td>
  </tr>
  <tr>
    <td height="35">Expected Date</td>
    <td align="center"><strong>:</strong></td>
    <td>
    <input type="text" name="expDate" id="expDate" class="textbox" />
    <span class="right">Fee &nbsp;&nbsp; </span></td>
    <td>
      <input type="text" name="fee" id="fee" class="textbox" /></td>
  </tr>
  <tr>
    <td height="50" valign="top">&nbsp;</td>
    <td align="center" valign="top">&nbsp;</td>
    <td colspan="2">
    <input type="submit" name="submit" value="Submit" class="button width_200"/>
    &nbsp;&nbsp;&nbsp;&nbsp;
    <input type="button" name="back" value="<< Back" class="button" onclick="history.back(0)"/></td>
  </tr>
  <tr>
    <td height="50" align="right" valign="bottom"></td>
    <td align="right" valign="bottom">&nbsp;</td>
    <td align="left" valign="top"><span class="blue font-11" id="success"><?php echo $success; ?></span></td>
    <td align="right" valign="bottom">&nbsp;</td>
  </tr>
</table>
</form>
</div>

<div id="search">
<?php
$conID = '';
$pgmID = '';

if(isset($_POST['search'])) {
	$pgmID = $_POST['program'];
	$conID = $_POST['country'];
	$spID = $_POST['subPgm'];
	
	$row1 = mysql_query("SELECT program FROM `programs` WHERE pgmID = '$pgmID'");
	$ary1 = mysql_fetch_array($row1);
	$program = $ary1['program'];
	$row2 = mysql_query("SELECT country FROM `countries` WHERE conID = '$conID'");
	$ary2 = mysql_fetch_array($row2);
	$country = $ary2['country'];
}
?>

<script>
function getSubPgm(id) {
	$.ajax({ 
		url: "get_subPgms.php?id="+id,
		success: function(data){
			$("#subpgms").html(data);
		}   
	});
} 

function formSubmit(){
	$.ajax({ 
		url: "search_program_enquiry.php",
		method : "POST",
		data : $('#searchForm').serialize(),
		success: function(data){
			$('#searchResult').html(data);
		}   
	});
	return false;
}

function getProgramName() {
	$('#program').val($('#subPgm option:selected').text());
}

</script>

<div id="searchArea">
<div style="padding-bottom: 5px;"><img src="../images/search.png" alt="img" width="184" height="26"></div>
<div id="searchBox">
<form  method="post"  enctype="multipart/form-data" name="searchForm" id="searchForm">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="40" align="center">
      <select name="country" id="country" class="dropdown">
        <option value="0" selected="selected" class="padding_2">Select Country</option>
        <?php
	$res1 = mysql_query("SELECT * FROM `countries` WHERE delStatus = '0'");
	while($arr1 = mysql_fetch_array($res1)) {
	echo '<option value="'.$arr1['conID'].'" class="padding_2"';
	if($arr1['conID'] == $conID)
	echo 'selected="selected"';
	echo '>'.$arr1['country'].'</option>';
	}
    ?>
        </select>    </td>
  </tr>
  <tr>
    <td height="40" align="center">
      <select name="program" id="program" class="dropdown" onChange="return getSubPgm(this.value);">
        <option value="" selected="selected" class="padding_2">Select Program</option>
        <?php
			$qry = mysql_query("SELECT * FROM `programs` WHERE delStatus = '0' ORDER BY program ASC");
			while($arr = mysql_fetch_array($qry)) {
			echo '<option value="'.$arr['pgmID'].'" class="padding_2"';
			if($arr['pgmID'] == $pgmID)
			echo 'selected="selected"';
			echo '>'.$arr['program'].'</option>';
			}
		?>
      </select>
      </td>
  </tr>
  <tr>
    <td height="40" align="center"><div id="subpgms">
      <select name="subPgm" id="subPgm" class="dropdown">
        <option value="" selected="selected" class="padding_2">Select Sub-Program</option>
        </select>
    </div></td>
  </tr>
  <tr>
    <td height="40" align="center">
    <input type="submit" name="search" onClick="return formSubmit();" value="Search" class="button">
    </td>
  </tr>
  <tr><td>&nbsp;</td></tr>
  <tr><td><div id="searchResult"></div></td></tr>
</table>
</form>
</div>
</div><br>




</div>
</div>

<?php include("../include/footer.php"); ?>

</div> <!--end of container-->
</body>
</html>