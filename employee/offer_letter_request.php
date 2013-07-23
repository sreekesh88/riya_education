<?php include ("../include/header.php"); 
include ("../include/validate.php"); 
include ("../include/menu.php"); 
$studID = $_GET['sid'];
$empID = $info['empID'];

$students = mysql_query("SELECT * FROM `students` WHERE studID = '$studID'");
while($ary = mysql_fetch_array($students)) {
	$name = $ary['fname'].' '.$ary['lname'];
	$pgmID = $ary['program'];
	if($pgmID != '0') {
	 $subpgm = $ary['subProgram'];
	 $subPgms = mysql_query("SELECT * FROM `subprograms` WHERE spID = '$subpgm'");
	 $arr = mysql_fetch_array($subPgms);
	 $program = $arr['subpgm'];	
	} else {
	 $program = $ary['pgmOthers'];
	}
	$pgmOthers = $ary['pgmOthers'];
	$conID = $ary['country'];
	$qry = mysql_query("SELECT country FROM `countries` WHERE conID = '$conID'");
	$res = mysql_fetch_array($qry);
	$country = $res['country'];
	
	$offerLetterStatus = $ary['offerLetter'];
}

?>

<script>
function entryBox(id) {
	if(id == '2') {
	  $('#paymentEntry').show();
	} else {
	  $('#paymentEntry').hide();
	}
}
</script>

<?php
if(isset($_POST['submit'])) {
	
	$date = date("Y-m-d");
	$offerMode = $_POST['offerMode'];
	$insID = $_POST['insID'];
	$assignTo = $_POST['assignTo'];
	$payment = $_POST['payment'];
	$amount = $_POST['amount'];
	
	if($insID != '') {
	$query = mysql_query("INSERT INTO `offer_letters` (`date`, `assignedBy`, `assignedTo`, `studID`, `pgmID`, `subPgmID`, `pgmOthers`, `conID`, `offerMode`, `insID`, `payment`, `amount`) VALUES ('$date', '$empID', '$assignTo', '$studID', '$pgmID', '$subpgm', '$pgmOthers', '$conID', '$offerMode', '$insID', '$payment', '$amount')");
	
		if($query > 0) {
			$success = "Offer letter requested succesfully";
			$stud_update = mysql_query("UPDATE `students` SET `offerLetter` = '1' WHERE studID = '$studID'");
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
<?php include("../include/left_stud.php"); ?>
<div class="main_col dotted_border">
<h2>Offer Letter Request</h2>
<br />
<form action="" method="post" enctype="multipart/form-data" name="form">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="35">Payment received</td>
      <td>:</td>
      <td><b>
        <input name="payment" type="radio" value="1" onclick="entryBox(this.value);"/>&nbsp; No
        &nbsp;&nbsp;&nbsp;&nbsp;
        <input name="payment" type="radio" value="2" onclick="entryBox(this.value);"/>&nbsp; Yes </b>
        &nbsp;&nbsp;&nbsp;&nbsp;
	  <span id="paymentEntry" style="display:none;"><input name="amount" id="amount" type="text" class="textbox width_95 textCenter" placeholder="Amount"/></span>
      </td>
    </tr>
    <tr>
      <td width="24%" height="35">Name of the Student</td>
      <td width="2%">:</td>
      <td width="74%"><b><?php echo $name; ?></b></td>
    </tr>
    <tr>
      <td height="35">Preferred Program</td>
      <td>:</td>
      <td><b><?php echo $program; ?></b></td>
    </tr>
    <tr>
      <td height="35">Preferred Country</td>
      <td>:</td>
      <td><b><?php echo $country; ?></b></td>
    </tr>
    <tr>
      <td height="35">Mode of Offer Letter</td>
      <td>:</td>
      <td><b>
      <input name="offerMode" type="radio" value="1"/> Conditional
      &nbsp;&nbsp;&nbsp;&nbsp;
      <input name="offerMode" type="radio" value="2"/> Unconditional
      </b></td>
    </tr>
    <tr>
      <td height="45">Institution</td>
      <td>:</td>
      <td>
      <select name="insID" id="insID" class="dropdown">
       <option value="" selected="selected" class="padding_2">Select</option>
       <?php
	   $instns = mysql_query("SELECT * FROM `institutions` WHERE conID = '$conID'");
	   while($res = mysql_fetch_array($instns)) {
	      echo '<option value="'.$res['insID'].'" class="padding_2">'.$res['institution'].'</option>';		
	   }
	   ?>
      </select></td>
    </tr>
    <tr>
      <td height="45">Assigning to</td>
      <td>:</td>
      <td><select name="assignTo" id="assignTo" class="dropdown">
        <option value="" selected="selected" class="padding_2">Select</option>
        <?php
	   $doc_emps = mysql_query("SELECT * FROM `employees` WHERE deptID = '2'");
	   while($res = mysql_fetch_array($doc_emps)) {
	      echo '<option value="'.$res['empID'].'" class="padding_2">'.$res['fname'].' '.$res['lname'].'</option>';		
	   }
	   ?>
      </select></td>
    </tr>
    <tr>
      <td height="60">&nbsp;</td>
      <td>&nbsp;</td>
      <td>
      <input type="submit" name="submit" id="submit" value="Submit" class="button width_200"/>
      <span class="alert" id="success"><?php echo $success; ?></span>      </td>
    </tr>
    <tr>
      <td colspan="3">&nbsp;</td>
    </tr>
    <?php
	$counter = 1;
	$offer_letters = mysql_query("SELECT * FROM `offer_letters` WHERE studID = '$studID' AND delStatus = '0'");
	$total_rows = mysql_num_rows($offer_letters); 
	
	if($total_rows > 0) {
	?>
    <tr>
      <td colspan="3"><h6>Previous Requests</h6></td>
    </tr>
    <tr>
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3">
      <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table">
        <tr>
          <th width="5%">No</th>
          <th width="25%" align="left" class="left_10">Institution</th>
          <th width="35%" align="left" class="left_10">Program</th>
          <th width="15%">Country</th>
          <th width="10%">Date</th>
          <th width="10%">Status</th>
        </tr>
        <?php
		$counter = 1;
		$offer_letters = mysql_query("SELECT * FROM `offer_letters` WHERE studID = '$studID' AND delStatus = '0'");
		while($rows = mysql_fetch_array($offer_letters)) {
			$studID = $rows['studID'];
			$date = date("d-m-Y",strtotime($rows['date']));
			$insID = $rows['insID'];
				$instns = mysql_query("SELECT * FROM `institutions` WHERE insID = '$insID'");
				$arr1 = mysql_fetch_array($instns);
				$institution = $arr1['institution'];
			$pgmID = $rows['pgmID'];
			if($pgmID != '0') {
				$subPgmID = $rows['subPgmID'];
				$subPgms = mysql_query("SELECT * FROM `subprograms` WHERE spID = '$subPgmID'");
				$arr2 = mysql_fetch_array($subPgms);
				$program = $arr2['subpgm'];
			} else {
				$program = $rows['pgmOthers'];
			}
			$conID = $rows['conID'];
				$countries = mysql_query("SELECT * FROM `countries` WHERE conID = '$conID'");
				$arr3 = mysql_fetch_array($countries);
				$country = $arr3['country'];
			$reqStatus = $rows['reqStatus'];
		?>
        <tr>
          <td align="center"><?php echo $counter++; ?></td>
          <td align="left" class="left_10"><?php echo $institution; ?></td>
          <td align="left" class="left_10"><?php echo $program; ?></td>
          <td align="center"><?php echo $country; ?></td>
          <td align="center"><?php echo $date; ?></td>
          <td align="center">
          <a href="offer_letter_view.php?sid=<?php echo $studID; ?>"><img src="../images/view.png" alt="view" /></a>
          </td>
        </tr>
        <?php } ?>
      </table></td>
    </tr>
    <?php } ?>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>

</form>

</div> <!--end of main_col-->
</div> <!--end of wrapper-->

<?php include("../include/footer.php"); ?>

</div> <!--end of container-->
</body>
</html>
