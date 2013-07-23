<?php 
include ("../include/header.php"); 
include ("../include/validate.php"); 
include ("../include/menu.php"); 
$empID = $info['empID'];
$invID = $_GET['id'];

$result = mysql_query("SELECT * FROM account_invoice WHERE invId = $invID");

$row = mysql_fetch_assoc($result);

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
	$('#htmlContent').val($("#pageToPrint").html());
	
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

<div id="wrapper_top"></div>
<div id="wrapper">
  <?php include("../include/left.php"); ?>
  <div class="main_col dotted_border">
<h2 align="center">	Invoice</h2>
<br />
<div class="fullWidth">
<div id="pageToPrint">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
   <td colspan="3" valign="top">
	   <span style="float: left; width: 350px; border: 1px solid; height: 84px;"><?php if(!empty($row['full_address'])) { echo $row['full_address']; }?></textarea>
    </td>
    <td></td>
     <td colspan="2" valign="top">
	   <div style="border: 1px solid; height: 84px;" class="addressBox">
    	<div style="padding: 7px 0px 0px;">
    		<label style="float: left;"> Invoice :</label>
    		<label><?php if(!empty($row['invoice_number'])) { echo $row['invoice_number']; }?></label>
		</div>
	<br><br>
		<div style="padding: 7px 0px 0px;">
	    	<label style="float: left;"> Date :</label>
	    	<label><?php if(!empty($row['date'])) { echo $row['date']; }?></label>
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
    <th width="20%">Agency Remuneration </th>
  </tr>
  <tr>
    <td title="Serial Number">1</td>
    <td title="Edit Description">
    	<span style="width: 351px; height: 85px; border: 0px none;resize: none;"><?php if(!empty($row['description'])) { echo $row['description']; }?></span>
   	</td>
    <td>
    	<label><?php if(!empty($row['course_fee'])) { echo $row['course_fee']; }?></label>
    </td>
    <td><label><?php if(!empty($row['remuneration'])) { echo $row['remuneration']; }?></label></td>
  </tr>
   <tr>
    <td colspan="3">Total</td>
    <td>
    	 <label><?php if(!empty($row['course_fee'])) { echo $row['course_fee']; }?></label>
    </td>
  </tr>
  <tr>
    <td colspan="4">
    <label><?php if(!empty($row['course_fee'])) { echo $row['course_fee']; }?></label>
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
    <td width="55%"><label><?php if(!empty($row['beneficiary'])) { echo $row['beneficiary']; }?></label></td>
  </tr>
  <tr>
    <td style="padding:1px 4px 5px 0px">Bank</td>
    <td>:</td>
    <td><label><?php if(!empty($row['bank'])) { echo $row['bank']; }?></label></td>
  </tr>
  <tr>
    <td style="padding:1px 4px 5px 0px">Account No</td>
    <td>:</td>
    <td><label><?php if(!empty($row['accountNo'])) { echo $row['accountNo']; }?></label></td>
  </tr>
  <tr>
    <td style="padding:1px 4px 5px 0px">Address</td>
    <td>:</td>
    <td>
    <div class="addressBox" style="border: 0px;">
    <label><?php if(!empty($row['addr1'])) { echo $row['addr1']; }?></label>
    <br/>
    <label><?php if(!empty($row['addr2'])) { echo $row['addr2']; }?></label>
    <br/>
    <label><?php if(!empty($row['addr3'])) { echo $row['addr3']; }?></label>
    <br/>
    </div></td>
  </tr>
  <tr>
    <td style="padding:1px 4px 5px 0px">Branch</td>
    <td>:</td>
    <td><label><?php if(!empty($row['branch'])) { echo $row['branch']; }?></label></td>
  </tr>
  <tr>
    <td style="padding:1px 4px 5px 0px">SWIFT Code</td>
    <td>:</td>
    <td><label><?php if(!empty($row['swiftCode'])) { echo $row['swiftCode']; }?></label></td>
  </tr>
  <tr>
    <td style="padding:1px 4px 5px 0px">RTGS/NEFT</td>
    <td>:</td>
    <td><label><?php if(!empty($row['neft'])) { echo $row['neft']; }?></label></td>
  </tr>
</table>

<table width="100%">
<tr>
	<td style="float: right;">
		<label><?php if(!empty($row['person_name'])) { echo $row['person_name']; }?></label>
	</td>
</tr>
<tr>
	<td>
		&nbsp;
	</td>
</tr>
<tr>
	<td style="float: right;">
		<label><?php if(!empty($row['designation'])) { echo $row['designation']; }?></label>	
	</td>
</tr>
</table>
</table>
</div>

<form action="invoice_generate_pdf.php" method="POST">
	<input type ="hidden" name="htmlContent" id="htmlContent"/>
	<input type="submit" class="filter_search button" name="pdf" value="Generate PDF"/>
</form>

</div>

</div>
</div>
<?php include("../include/footer.php"); ?>

</div> <!--end of container-->
</body>
</html>