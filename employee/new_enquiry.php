<?php 
include ("../include/header.php"); 
include ("../include/validate.php"); 
include ("../include/menu.php"); 
$empCode = $info['empCode'];
?>

<script type="text/javascript">
$(function() {	
	$('#modal').dialog({
		modal: true,
		width: 800,
		height: 500
	});
});

/*function ieltsInfo(id)
{	
	$.ajax({
		url: "get_ieltsInfo.php?id="+id,
		success: function(data){
			$("#ieltsInfo").html(data);
		}   
	});
}*/

function evaluate_student() 
{ 
	var pgmScore = $("#pgmScore").val();			//diploma score
	var ielts = $("#ielts").val(); 					//ielts
	var marks = $("#marks").val(); 					//marks in english
	//var qlfn = $("#qlfn").val(); 					//basic qualification
	//var skip = $("#skipScore").attr('checked');	//ielts skipping	
	
	
	

}
</script>

<?php
if(isset($_POST['submit'])) {

	$date = date("Y-m-d");
	$studName = $_POST['name'];
	$contact = $_POST['contact'];	
	$marks = $_POST['marks'];
	$level = $_POST['qlfn'];
	$score = $_POST['ielts'];
	$remarks = $_POST['remarks'];
	
	if($remarks != '') {
		$query = mysql_query("INSERT INTO `enquiries` (`date`, `empCode`, `studName`, `contact`, `marks`, `level`, `score`, `remarks`) VALUES ('$date', '$empCode', '$studName', '$contact', '$marks', '$level', '$score', '$remarks')");
	}	

}
?>

<div id="wrapper_top"></div>
<div id="wrapper">
  <?php include("../include/left.php"); ?>
  <div class="dotted_border" id="modal" title="General Enquiry">

<div class="fullWidth">
<form action="" method="post" enctype="multipart/form-data" name="form">
<table width="100%" border="0" cellspacing="0" cellpadding="0" id="">
  <tr>
    <td width="25%" height="35">Select Country</td>
    <td width="2%" align="center"><strong>:</strong></td>
    <td width="38%" align="left"><select name="country" id="country" class="dropdown" style="width:150px;">
      <option value="0" selected="selected" class="padding_2">Select</option>
      <?php
	$res1 = mysql_query("SELECT * FROM `countries` WHERE delStatus = '0'");
	while($arr1 = mysql_fetch_array($res1)) {
	echo '<option value="'.$arr1['conID'].'" class="padding_2">'.$arr1['country'].'</option>';
	}
    ?>
    </select>      &nbsp;    </td>
    <td width="35%" rowspan="4" align="left" valign="top">
    <div id="ieltsInfo" class="help">
     <b>Minimum IELTS Score : </b>  <br />
     For Diplomas : <b class="alert">5.5</b><br />
     For Under Graduates : <b class="alert">6</b><br />
     For Post Graduates : <b class="alert">6.5</b><br />
     For Teaching : <b class="alert">7</b>    </div>    </td>
  </tr>
  <tr>
    <td height="35">Select Program</td>
    <td align="center"><strong>:</strong></td>
    <td align="left">
    <select name="pgmScore" id="pgmScore" class="dropdown" style="width:150px;">
    <option value="" selected="selected" class="padding_2">Select</option>
    <option value="5.5" class="padding_2">Diploma</option>
    <option value="6" class="padding_2">Under Graduate</option>
    <option value="6.5" class="padding_2">Post Graduate</option>
    <option value="7" class="padding_2">Teaching</option>
    </select>
    </td>
  </tr>
  <tr>
    <td height="35">IELTS Score</td>
    <td align="center"><strong>:</strong></td>
    <td align="left">
    <input type="text" name="ielts" id="ielts" class="textbox width_95 textCenter" />  &nbsp; 
    <input type="checkbox" name="skipScore" id="skipScore" /> Not now</td>
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
    <input type="text" name="marks" id="marks" class="textbox width_95 textCenter" />
    <strong>%</strong></td>
    </tr>
  <tr>
    <td height="50">&nbsp;</td>
    <td>&nbsp;</td>
    <td><input type="button" name="evaluate" id="evaluate" value="Evaluate" class="button" onclick="evaluate_student()"/></td>
    <td><span id="alert" class="alert"></span></td>
  </tr>
  <tr>
    <td height="35">Student Name</td>
    <td align="center"><strong>:</strong></td>
    <td colspan="2"><input type="text" name="name" id="name" class="textbox" /></td>
  </tr>
  <tr>
    <td height="35">Contact Number</td>
    <td align="center"><strong>:</strong></td>
    <td colspan="2"><input type="text" name="contact" id="contact" class="textbox" /></td>
  </tr>
  <tr>
    <td height="80" valign="top">Remarks about the enquiry</td>
    <td align="center" valign="top"><strong>:</strong></td>
    <td colspan="2" valign="top"><textarea name="remarks" id="remarks" class="textarea_dotted width_440" style="padding: 5px;"></textarea></td>
  </tr>
  <tr>
    <td height="50" valign="top">&nbsp;</td>
    <td align="center" valign="top">&nbsp;</td>
    <td colspan="2"><input type="submit" name="submit" value="Submit" class="button width_200"/></td>
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