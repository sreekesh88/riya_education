<style>
.side_col  ul {
	margin: 0px;
	padding: 0px;
}
.side_col ul li {
	list-style-type: none;
	display: block;
}
.side_col ul li a {
	float: left;
	width: 140px;
	padding-left: 20px;
	padding-top: 5px;
	padding-bottom: 5px;
	border-bottom-width: 1px;
	border-bottom-style: dotted;
	border-bottom-color: #CCCCCC;
	color: #0C4155;
	background-image: url(../images/arrow-light.png);
	background-repeat: no-repeat;
	background-position: 5px center;
	text-decoration: none;
}
.side_col ul li a:hover {
	color:  #076598;
	background-color: #CCCCCC;
	text-decoration: none;
}
</style>
<?php
$studID = $_GET['sid'];
$query = mysql_query("SELECT * FROM `students` WHERE studID = '$studID'");
while($array = mysql_fetch_array($query)) {
	$name = $array['fname']." ".$array['lname'];
}
?>
<div class="side_col">
<h3 style="margin-bottom:10px;"><?php echo $name; ?></h3>
<ul>
<li><a href="<?php echo ROOT."/employee/student_followup.php?sid=".$studID; ?>">Follow up</a></li>
<li><a href="<?php echo ROOT."/employee/student_profile.php?sid=".$studID; ?>">View Profile</a></li>
<li><a href="<?php echo ROOT."/employee/student_update.php?sid=".$studID; ?>">Update Profile</a></li>
<li><a href="<?php echo ROOT."/employee/student_documents.php?sid=".$studID; ?>">Documents</a></li>
<?php 
$doc_verify_status = TRUE;
$stud_docs = mysql_query("SELECT verify FROM `stud_docs` WHERE studID = '$studID'");
while($rows = mysql_fetch_array($stud_docs)) {
	$verify = $rows['verify'];
	if($verify != '1') { $doc_verify_status = FALSE; }
}
if($doc_verify_status) {
?>
<li><a href="<?php echo ROOT."/employee/student_financial.php?sid=".$studID; ?>">Finance & Visa</a></li>
<?php } ?>
<?php 
$visa_verify_status = FALSE;
$stud_visa = mysql_query("SELECT svID FROM `stud_visa` WHERE studID = '$studID'");
$ary = mysql_fetch_array($stud_visa);
$svID = $ary['svID'];
$stud_visa_docs = mysql_query("SELECT verify FROM `stud_visa_docs` WHERE svID = '$svID'");
while($row = mysql_fetch_array($stud_visa_docs)) {
	$verify = $row['verify'];
	if($verify != '1') { $visa_verify_status = TRUE; }
}
$visa_verify_status;
if($visa_verify_status) {
?>
<li><a href="<?php echo ROOT."/employee/student_departure.php?sid=".$studID; ?>">Departure Details</a></li>
<?php } ?>
<li><a href="<?php echo ROOT."/employee/offer_letter_request.php?sid=".$studID; ?>">Offer Letter Request</a></li>
<li><a href="<?php echo ROOT."/employee/student_assign.php?sid=".$studID; ?>">Assign Student</a></li>
</ul>
</div>