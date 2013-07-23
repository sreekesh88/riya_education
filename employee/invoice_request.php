<?php include ("../include/header.php"); 
include ("../include/validate.php"); 
include ("../include/menu.php");
error_reporting(E_ALL); ini_set('display_errors', 'On');
$empID = $info['empID'];
$studID = $_GET['sid'];
$result = mysql_query("SELECT CONCAT(s.fname,' ',s.lname)AS studName, sp.passNum , spr.subpgm,  s.dob
							FROM students s
							LEFT JOIN stud_passport sp ON (sp.studID = s.studID)
							LEFT JOIN subprograms spr ON (s.subProgram = spr.spID)
							WHERE s.studID = $studID");	
$array = mysql_fetch_assoc($result);

?>
<script>
$(function (){
	$('#course_start_date').datepicker();
	$('#course_end_date').datepicker();
})

</script>
<?php 
if(!empty($_POST['submitInvoice'])){
	$studId 			= $_POST['studId'];
	$course_start_date 	= $_POST['course_start_date'];
	$course_end_date 	= $_POST['course_end_date'];
	$course_fee 		= $_POST['course_fee'];
	$query = mysql_query("INSERT into `invoice` (studID,course_start_date,course_end_date,course_fee ) VALUES ('$studId','$course_start_date','$course_end_date','$course_fee')");
}
?>
<div id="wrapper_top"></div>

<div id="wrapper">
  <?php include("../include/left.php"); ?>
<div class="main_col dotted_border">
<h2>Request an Invoice</h2>
<br />
<div id="searchResult">
<form action="" method="POST" id="invoiceForm" name="invoiceForm">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table">
  <tr>
  	<td>Student ID</td> <td> 
  		<input type="text" disabled="disabled" value="<?php echo $studID;?>"/>
  		<input type="hidden"  name="studId" value="<?php echo $studID;?>"/>
  	</td>
  </tr>
  <tr>
  	<td>Name</td> <td>
  		 <input type="text" disabled="disabled" name="" value="<?php echo $array['studName'];?>"/>
  	</td>
  </tr>
  <tr>
  	<td>Passport Number</td> <td> 
  		<input type="text" disabled="disabled" name="" value="<?php echo $array['passNum'];?>"/>
  	</td>
  </tr>
  <tr>
  	<td>Date Of Birth</td> <td>
  		 <input type="text" disabled="disabled"  value="<?php echo $array['dob'];?>"/>
  	</td>
  </tr>
  <tr>
  	<td>Course Selected</td>
  		 <td> <input type="text" disabled="disabled" name="" value="<?php echo $array['subpgm'];?>"/>
  	</td>
  </tr>
  <tr>
  	<td>Course Start Date</td> <td> <input type="text" name="course_start_date" id="course_start_date"/></td>
  </tr>
  <tr>
  	<td>Course End Date</td> <td> <input type="text" name="course_end_date" id="course_end_date"/></td>
  </tr>
  <tr>
  	<td>Course Fees</td> <td> <input type="text" name="course_fee" id="course_fee"/></td>
  </tr>
  <tr>
  	<td colspan="2">
  	<input type="submit" align="center"class="button" value="Submit" name="submitInvoice"></td>
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