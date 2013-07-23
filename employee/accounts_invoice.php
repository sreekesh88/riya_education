<?php 
ob_start();
include ("../include/header.php"); 
include ("../include/validate.php"); 
include ("../include/menu.php"); 
//error_reporting(E_ALL); ini_set('display_errors', 'On'); 
$empID = $info['empID'];
$branchID = $info['branchID'];
$branches = mysql_query("SELECT branchCode FROM `branches` WHERE branchID = '$branchID'");
$res = mysql_fetch_array($branches);
$bCode = $res['branchCode'];
$invoiceDetails = "";
$invId = "";
$result = mysql_query("SELECT lastIncr FROM account_invoice ORDER BY lastIncr DESC LIMIT 1");	
	while($ary = mysql_fetch_array($result)) {
		$lastInc = $ary['lastIncr'];
	}
	
	if (empty($lastInc)) { 
		$lastInc = sprintf("%04d",1); 
		$counter = $lastInc;
		$invoice_number = "RE/".$counter;
	} else {
		$counter = sprintf("%04d",$lastInc+1);
		$invoice_number = "RE/".$counter;
	}
?>
<style>
.invoice_textbox {
	background: none repeat scroll 0 0 transparent;
    border: 1px none;
    cursor: cell;
    width: 99%;
}
</style>
<script>
$(function(){
	$(document).tooltip();
});

function addRow(obj){
	count = (obj.parentNode.parentNode.parentNode.children.length-3);
	slCount =  count+1;
	html = '<tr>'+
	    '<td title="Serial Number">'+slCount+'</td>'+
	    '<td title="Edit Description">'+
	    	'<textarea id="description_"'+count+' name="description_"'+count+' placeholder="Description" style="width: 351px; height: 85px;border: 0px none; resize: none;"></textarea>'+
	   	'</td>'+
	    '<td title="Click to edit Course Fees"onclick="this.children[0].focus()"><input id="course_fee_"'+count+' name="course_fee_"'+count+' type = "text" placeholder="Course Fee" class="invoice_textbox"></td>'+
	    '<td title="Click to edit Remuneration"onclick="this.children[0].focus()"><input id="remuneration_"'+count+' name="remuneration_"'+count+' type = "text" placeholder="Remuneration" class="invoice_textbox"></td>'+
	  '</tr>';
	$(html).insertAfter($(obj.parentNode.parentNode.parentNode.children[count]));
}

</script>
<?php 	
if(!empty($_POST['invoice_details']) && !empty($_POST['invoice_id'])){
	$invoiceDetails = (json_decode($_POST['invoice_details']));
	$invoiceId = $_POST['invoice_id'];
}

if(isset($_POST['submit'])){
	$full_address 	= ($_POST['full_address'] ? $_POST['full_address'] : "");
	$course_fee 	= ($_POST['course_fee'] ? $_POST['course_fee'] : "");
	$date 			= ($_POST['date'] ? $_POST['date'] : "");
	$total 			= ($_POST['total'] ? $_POST['total'] : "");
	$inWords 		= ($_POST['inWords'] ? $_POST['inWords'] : "");
	$remuneration 	= ($_POST['remuneration'] ? $_POST['remuneration'] : "");
	$beneficiary 	= ($_POST['beneficiary'] ? $_POST['beneficiary'] : "");
	$bank 			= ($_POST['bank'] ? $_POST['bank'] : "");
	$accountNo 		= ($_POST['accountNo'] ? $_POST['accountNo'] : "");
	$addr1 			= ($_POST['addr1'] ? $_POST['addr1'] : "");
	$addr2 			= ($_POST['addr2'] ? $_POST['addr2'] : "");
	$addr3 			= ($_POST['addr3'] ? $_POST['addr3'] : "");
	$branch 		= ($_POST['branch'] ? $_POST['branch'] : "");
	$swiftCode 		= ($_POST['swiftCode'] ? $_POST['swiftCode'] : "");
	$neft 			= ($_POST['neft'] ? $_POST['neft'] : "");
	$person_name 	= ($_POST['person_name'] ? $_POST['person_name'] : "");
	$designation 	= ($_POST['designation'] ? $_POST['designation'] : "");
	$description	= ($_POST['description'] ? $_POST['description'] : "");
	$id = $_POST['invoiceId'];

	if(!empty($_POST['invoiceId'])){
		$id = $_POST['invoiceId'];
		mysql_query("UPDATE `invoice` SET `printed` = '1' WHERE `id` = $id");
	}
	$contact = mysql_query("INSERT INTO account_invoice 
							(full_address,invoice_number,date,total,inWords,course_fee,remuneration,beneficiary,bank,accountNo,addr1,addr2,addr3,branch,swiftCode,neft,person_name,designation,description,lastIncr)
					 VALUES ('$full_address' , '$invoice_number','$date','$total','$inWords', '$course_fee', '$remuneration', '$beneficiary', '$bank', '$accountNo', '$addr1', '$addr2', '$addr3', '$branch', '$swiftCode', '$neft', '$person_name', '$designation', '$description','$counter')");
	
	$invId = mysql_insert_id();
	header('Location: accounts_invoice_preview.php?id='.$invId);

}?>
<div id="wrapper_top"></div>
<div id="wrapper">
  <?php include("../include/left.php"); ?>
  <div class="main_col dotted_border">
  <?php 
  if(!empty($invoiceDetails)){
  	?>
  	<h2 align="center">	Details </h2>
  	<br />
  	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="alternate_color">
			<tr>
				<td>ID</td>
				<td><?php echo $invoiceDetails[0];?></td>
			</tr>
			<tr>
				<td>Name</td>
				<td><?php echo $invoiceDetails[1];?></td>
			</tr>
			<tr>
				<td>Course Applied</td>
				<td><?php echo $invoiceDetails[2];?></td>
			</tr>
			<tr>
				<td>Passport No</td>
				<td><?php echo $invoiceDetails[3];?></td>
			</tr>
			<tr>
				<td>Start Date</td>
				<td><?php echo $invoiceDetails[4];?></td>
			</tr>
			<tr>
				<td>End Date</td>
				<td><?php echo $invoiceDetails[5];?></td>
			</tr>
			<tr>
				<td>Course Fees</td>
				<td><?php echo $invoiceDetails[6];?></td>
			</tr>
		</table>
  	<?php 
  }
  
  ?>
  
  <br />
<h2 align="center">	Invoice</h2>
<br />
<div class="fullWidth">
<form action="" method="post" enctype="multipart/form-data" name="fields">
<div id="pageToPrint">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
   <td colspan="3" valign="top">
	   <textarea placeholder="Type the address here" style="border: 1px solid; width: 351px; height: 85px; resize: none;" name="full_address"><?php if(!empty($_POST['full_address'])) { echo $_POST['full_address']; }?></textarea>
    </td>
    <td></td>
     <td colspan="2" valign="top">
	   <div style="border: 1px solid; height: 84px;" class="addressBox">
    	<div style="padding: 7px 0px 0px;">
    		<label style="float: left;"> Invoice :</label>
    		<label class="addrInput" style="color:red;float: right;position: relative;width: 145px;"><?php echo $invoice_number;?></label>
		</div>
	<br><br>
		<div style="padding: 7px 0px 0px;">
	    	<label style="float: left;"> Date :</label>
	    	<input type="text" placeholder="DD/MM/YYYY" name="date" id="date" class="addrInput"  style="float: right;position: relative;width: 145px;">
    	</div>
    </div>
    </td>
	</tr>
  <tr>
  <tr><td colspan="6">&nbsp;</td></tr>
  <td colspan = "6">
  	<table class="table"width="668px" border="1">
  <tr>
    <th width="10%">Sl No:</th>
    <th width="50%">Description</th>
    <th width="20%">Course Fee</th>
    <th width="20%">Agency Remuneration <span title="Click to add new entry" onclick="addRow(this);"> + </span></th>
  </tr>
  <tr>
    <td title="Serial Number">1</td>
    <td title="Edit Description">
    	<textarea id="description" name="description" placeholder="Description" style="width: 351px; height: 85px; border: 0px none;resize: none;"></textarea>
   	</td>
    <td title="Click to edit Course Fees"onclick="this.children[0].focus()"><input id="course_fee" name="course_fee" type = "text" placeholder="Course Fee" class="invoice_textbox"></td>
    <td title="Click to edit Remuneration"onclick="this.children[0].focus()"><input id="remuneration" name = "remuneration" type = "text" placeholder="Remuneration" class="invoice_textbox"></td>
  </tr>
   <tr>
    <td colspan="3">Total</td>
    <td title="Click to edit Total" >
    	 <input type = "text" placeholder="Total" class="invoice_textbox" name="total">
    </td>
  </tr>
  <tr>
    <td colspan="4">
    <input  title="Click to edit Agency remuneration" type = "text" placeholder="Agency remuneration in words" class="invoice_textbox" name="inWords">
    </td>
  </tr>
</table>
</td>
    
    </tr>
<tr><td colspan="6">&nbsp;</td></tr>
<table width="300">
  <tr>
    <td width="40%"  style="padding:1px 4px 5px 0px">Beneficiary</td>
    <td width="5%">:</td>
    <td width="55%"  title="Click to edit" ><input type="text"  class="invoice_textbox" placeholder="Beneficiary Name"id="beneficiary" name="beneficiary"></td>
  </tr>
  <tr>
    <td style="padding:1px 4px 5px 0px">Bank</td>
    <td>:</td>
    <td title="Click to edit"><input class="invoice_textbox" placeholder="Bank Name" type="text" id="bank" name="bank"></td>
  </tr>
  <tr>
    <td style="padding:1px 4px 5px 0px">Account No</td>
    <td>:</td>
    <td title="Click to edit"><input type="text" class="invoice_textbox" id="accountNo" placeholder="Account Number"name="accountNo"></td>
  </tr>
  <tr>
    <td style="padding:1px 4px 5px 0px">Address</td>
    <td>:</td>
    <td title="Click to edit">
    <div class="addressBox" style="border: 0px;">
    <input type="text" class="invoice_textbox" style="border: 1px outset;" placeholder="Address 1" id="addr1" name="addr1">
    <input type="text" class="invoice_textbox" style="border: 1px outset;" placeholder="Address 2" id="addr2" name="addr2">
    <input type="text" class="invoice_textbox" style="border: 1px outset;" placeholder="Address 3" id="addr3" name="addr3">
    </div>
    </td>
  </tr>
  <tr>
    <td style="padding:1px 4px 5px 0px">Branch</td>
    <td>:</td>
    <td title="Click to edit"><input type="text" class="invoice_textbox" id="branch" placeholder="Branch Name"name="branch"></td>
  </tr>
  <tr>
    <td style="padding:1px 4px 5px 0px">SWIFT Code</td>
    <td>:</td>
    <td title="Click to edit"><input type="text" class="invoice_textbox" id="swiftCode" placeholder="SWIFT Code" name="swiftCode"></td>
  </tr>
  <tr>
    <td style="padding:1px 4px 5px 0px">RTGS/NEFT</td>
    <td>:</td>
    <td title="Click to edit"><input type="text" class="invoice_textbox" id="neft" placeholder="RTGS/NEFT Code" name="neft"></td>
  </tr>
</table>

<table width="100%">
<tr>
	<td title="Click to edit" style="float: right;">
		<input type="text" class="invoice_textbox" id="person_name" placeholder="Corresponding Person Name" name="person_name">
	</td>
</tr>
<tr>
	<td>
		&nbsp;
	</td>
</tr>
<tr>
	<td title="Click to edit" style="float: right;">
		<input type="text" class="invoice_textbox" id="designation" placeholder="Designation" name="designation">
	</td>
</tr>
</table>
</table>
</div>
<input type="hidden" id="htmlContent" name="htmlContent"/>
<input type="hidden" id="invoiceId" name="invoiceId" value="<?php echo $invoiceId;?>"/>
<input type="submit" class="button" name="submit" value="Submit">
</form>

</div>

</div>
</div>
<?php include("../include/footer.php"); ?>

</div> <!--end of container-->
</body>
</html>

<?php ob_end_flush();?>