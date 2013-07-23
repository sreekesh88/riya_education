<?php 
include ("../include/header.php"); 
session_start();
$deptID = $_SESSION['is_user']; 
$departments = mysql_query("SELECT * FROM `departments` WHERE deptID = $deptID");
while($rows = mysql_fetch_array($departments)) {
	$department = $rows['department'];
}
include ("../include/validate.php"); 
include ("../include/menu.php"); 
$_SESSION["emp_inbox_count"] = 0;
$empID = $info['empID'];

$enqList = mysql_query("SELECT * FROM `enquiries` WHERE allocatedStaff = '$empID' AND delStatus = '0'");
$studDocRejectList = mysql_query("SELECT sd.*,CONCAT(s.fname,' ',s.lname) AS studName,dl.document FROM `stud_docs` sd
										LEFT JOIN students s ON (s.studID=sd.studID)
										LEFT JOIN document_list dl ON dl.docID = sd.docID
										WHERE sd.uploads != '' AND sd.verify = '2' AND sd.empID='$empID' AND sd.delStatus = '0'");
$studVisaDocRejectList = mysql_query("SELECT svd.*,sv.studID, vc.document,CONCAT(s.fname,' ',s.lname) as studName FROM `stud_visa_docs` svd
												LEFT JOIN stud_visa sv ON svd.svID = sv.svID
												LEFT JOIN students s ON s.studID=sv.studID
												LEFT JOIN visa_checklist vc ON vc.chkID = svd.chkID
												WHERE svd.attachment != '' AND svd.verify = '2' AND sv.assignedBy = $empID");
$studVisaAssigned = mysql_query("SELECT sv.*,CONCAT(s.fname,' ',s.lname) AS studName FROM `stud_visa` sv
												LEFT JOIN students s ON s.studID=sv.studID
													WHERE sv.assignedTo = $empID");
$seminarApprovalList = mysql_query("SELECT * FROM `events` WHERE acceptStatus = 1 AND empID = $empID");

$invoiceList = mysql_query("SELECT i.*, i.id as invId,CONCAT(s.fname,' ',s.lname) AS studName, sp.subpgm, spa.passNum FROM `invoice` i
												LEFT JOIN students s ON (s.studID = i.studID)
												LEFT JOIN subprograms sp ON (sp.spID = s.subProgram)
												LEFT JOIN stud_passport spa ON spa.studID=s.studID
												WHERE printed = 0");

?>

<script>
function enquiry_view(id) {
		$.ajax({  
		url: "enquiry_view.php?id="+id,
		success: function(data){
			$("#dialog").html(data);
		}   
	});
	
	$("#dialog").dialog(
		   {
			bgiframe: true,
			autoOpen: false,
			height: 300,
			width: 600,
			modal: true
		   }
	);
		$('#dialog').dialog('open'); 
		return false;
}

function proceedToPrint( domObj, id){
	cartObj = domObj.parentNode.parentNode.getElementsByTagName("td");
	arrayObj = new Array();
	for (var val in cartObj){
		if(cartObj[val].innerHTML && cartObj[val].innerHTML.indexOf('<a href')==-1)
			arrayObj.push(cartObj[val].innerHTML);
	}
	$('#invoice_details').val(JSON.stringify(arrayObj));
	$('#invoice_id').val(id);
	$('#this_form').submit();
	return false;
}
</script>

<body>

<div id="wrapper_top"></div>
<div id="wrapper">

<?php include("../include/left.php"); ?>

<div class="main_col dotted_border">
<div class="heading1" style="margin-bottom:10px;"><b><?php echo $department; ?> Inbox</b></div>

<div class="fullWidth">
<?php if($deptID == '1') { ?>
<?php
$counter = 1;
if(mysql_num_rows($enqList) > 0){ ?>
<h2>Enquiriy List</h2>
<br/>
	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table">
 	<tr>
        <th>Sl No:</th>
        <th>Student Name</th>
        <th>Action</th>
      </tr>
  <?php 
while($row = mysql_fetch_array($enqList)) {
	$enqID = $row['enqID'];
	$student = $row['studName'];
	$_SESSION["emp_inbox_count"]++;
	?>
      <tr>
        <td width="10%" height="25" align="center"><?php echo $counter++; ?></td>
        <td width="60%"><?php echo $student; ?></td>
        <td width="30%" align="center"><a href="javascript:void(0);" onclick="enquiry_view(<?php echo $enqID; ?>)">View</a></td>
      </tr>
	<?php } ?>
</table>
<?php }?>
<br/>
	<?php
$counter = 1;
if(mysql_num_rows($studDocRejectList) > 0){ ?>
<h2>Rejected Document List</h2>
<br/>
	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table">
 	 <tr>
        <th>Sl No:</th>
        <th>Student Name</th>
        <th>Document Name</th>
        <th>Action</th>
      </tr>
  <?php 
while($row = mysql_fetch_array($studDocRejectList)) {
	$tbID = $row['svdID'];
	$studName = $row['studName'];
	$stdId = $row['studID'];
	$document = $row['document'];
	$_SESSION["emp_inbox_count"]++;
	?>
      <tr>
        <td width="10%" height="25" align="center"><?php echo $counter++; ?></td>
        <td width="60%"><?php echo $studName; ?></td>
        <td width="60%"><?php echo $document; ?></td>
        <td width="30%" align="center"><a href="student_documents.php?sid=<?php echo $stdId;?>">View</a></td>
      </tr>
	<?php } ?>
</table>
<?php }?>

<br/>
	<?php
$counter = 1; 
if(mysql_num_rows($studVisaDocRejectList) > 0){ ?>
<h2>Rejected Visa Document List</h2>
<br/>
	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table">
 	 <tr>
        <th>Sl No:</th>
        <th>Student Name</th>
        <th>Visa Document Name</th>
        <th>Action</th>
      </tr>
  <?php 
while($row = mysql_fetch_array($studVisaDocRejectList)) {
	$stdId = $row['studID'];
	$document = (!empty($row['docName']) ? $row['docName'] : $row['document']);
	$_SESSION["emp_inbox_count"]++;
	?>
      <tr>
        <td width="10%" height="25" align="center"><?php echo $counter++; ?></td>
        <td width="60%"><?php echo $row['studName']; ?></td>
        <td width="60%"><?php echo $document; ?></td>
        <td width="30%" align="center"><a href="student_financial_view.php?sid=<?php echo $stdId;?>">View</a></td>
      </tr>
	<?php } ?>
</table>
<?php }?>

<br/>
	<?php
$counter = 1; 
if(mysql_num_rows($seminarApprovalList) > 0){ ?>
<h2>Approved Seminar List</h2>
<br/>
	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table">
 	 <tr>
        <th>Sl No:</th>
        <th>Seminar Name</th>
        <th>Event Date</th>
        <th>Action</th>
      </tr>
  <?php 
while($row = mysql_fetch_array($seminarApprovalList)) {
	$id = $row['eventID'];
	$_SESSION["emp_inbox_count"]++;
	?>
      <tr>
        <td width="10%" height="25" align="center"><?php echo $counter++; ?></td>
        <td width="60%"><?php echo $row['title']; ?></td>
        <td width="60%"><?php echo $row['eventDate']; ?></td>
        <td width="30%" align="center"><a href="event_view.php?id=<?php echo $id;?>">View</a></td>
      </tr>
	<?php } ?>
</table>
<?php }?>

<div id="dialog" title="Enquiry Details"></div>
<?php } else if($deptID == '4'){ ?>
<?php
$counter = 1;
if(mysql_num_rows($studVisaAssigned) > 0){ ?>
<h2>Assigned Visa Document List</h2>
<br/>
	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table">
 	<tr>
        <th>Sl No:</th>
        <th>Student Name</th>
        <th>Action</th>
      </tr>
  <?php 
while($row = mysql_fetch_array($studVisaAssigned)) {
	$id = $row['svID'];
	$student = $row['studName'];
	$_SESSION["emp_inbox_count"]++;
	?>
      <tr>
        <td width="10%" height="25" align="center"><?php echo $counter++; ?></td>
        <td width="60%"><?php echo $student; ?></td>
        <td width="30%" align="center"><a href="vd_student_financial_view.php?sid=<?php echo $id;?>">View</a></td>
      </tr>
	<?php } ?>
</table>
<?php }?>
<br/>

<?php
$counter = 1;
if(mysql_num_rows($invoiceList) > 0){ ?>
<h2>Invoice List</h2>
<br/>
	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table">
 	<tr>
        <th>Sl No:</th>
        <th>Student Name</th>
        <th>Course</th>
        <th>Passport Number</th>
        <th>Start Date</th>
        <th>End Date</th>
        <th>Fee</th>
        <th>Action</th>
      </tr>
  <?php 
while($row = mysql_fetch_array($invoiceList)) {
	$_SESSION["emp_inbox_count"]++;
	?>
      <tr>
        <td width="10%" height="25" align="center"><?php echo $counter++; ?></td>
        <td width="60%"><?php echo $row['studName']; ?></td>
        <td width="60%"><?php echo $row['subpgm']; ?></td>
        <td width="60%"><?php echo $row['passNum']; ?></td>
        <td width="60%"><?php echo $row['course_start_date']; ?></td>
        <td width="60%"><?php echo $row['course_end_date']; ?></td>
        <td width="60%"><?php echo $row['course_fee']; ?></td>
        <td width="30%" align="center"><a href="javascript:void(0);" onclick="return proceedToPrint(this, <?php echo $row['invId']?>);">View</a></td>
      </tr>
	<?php } ?>
</table>
<?php }?>
<br/>
<?php }?>
</div>
<form action="accounts_invoice.php" method="post" id="this_form">
	<input type="hidden" name="invoice_details" id="invoice_details" value=""/>
	<input type="hidden" name="invoice_id" id="invoice_id" value=""/>
</form>
</div>
</div>

<?php include("../include/footer.php"); ?>


</div> <!--end of container-->
</body>
</html>