<?php include ("../include/header.php"); 
include ("../include/validate.php"); 
include ("../include/menu.php"); 
$empID = $info['empID'];
$branchID = $info['branchID'];
$studID = $_GET['sid'];
?>

<script>
function financeDetails(id)
{	
	$.ajax({
		url: "get_finance_details.php?id="+id,
		success: function(data){
			$("#financeDetails").html(data);
		}   
	});
}

function docType(id)
{	
	$.ajax({
		url: "get_doc_type.php?id="+id,
		success: function(data){
			$("#documentDetails").html(data);
		}   
	});
}

$(document).on('click','#sp2',function() {
	$("#gaurdianDetails").show();
	$("#sponsorDetails").hide();
});

$(document).on('click','#sp1',function() {
	$("#gaurdianDetails").hide();
	$("#sponsorDetails").show();
});

function disableMe(box) {
	if(box.name == "otherProof" && box.checked) {
		form.other_proof.disabled = false;
	} else if(box.name == "otherProof" && box.checked == false) {
		form.other_proof.disabled = true;
	}	
}

function disableFin(box) {
	//console.log(box.id,box.nextSibling.nextSibling.id);
	var a = box.nextSibling.nextSibling.id; 
	if(box.checked) {
		$('#'+a).attr('disabled',false);
	} else {
		$('#'+a).attr('disabled',true);
	}	
}


</script>
<?php
if(isset($_POST['submit'])) {
	function fileUpload($field, $file, &$str = NULL){ 
	 if($field != '') {
	 $attached_file = '';  
	  if($_FILES[$file]["name"] != '') {
	   $allowedExts = array("jpg", "jpeg", "gif", "png");
	   $extension = end(explode(".", $_FILES[$file]["name"]));
	   if ((($_FILES[$file]["type"] == "image/gif")
	   || ($_FILES[$file]["type"] == "image/jpeg")
	   || ($_FILES[$file]["type"] == "image/png")
	   || ($_FILES[$file]["type"] == "image/pjpeg"))
	   && ($_FILES[$file]["size"] < 256000) // file size in bytes -- 250 KB
	   && in_array($extension, $allowedExts))
	   {
		 $attached_file = time()."_".$_FILES[$file]["name"]; 
		 $str = $attached_file;
		 move_uploaded_file($_FILES[$file]["tmp_name"],"checklist/" . $attached_file);
	   }
	  }
	 }
	}	

	$loan_sanc_letter = $_POST['loan_sanc_letter'];
 	$loan_property = $_POST['loan_property'];
	$loan_others = $_POST['loan_others'];	
 	$fd_bank_letter = $_POST['fd_bank_letter'];
	$fd_receipt = $_POST['fd_receipt'];
	$fd_others = $_POST['fd_others'];	
	$sav_bank_letter = $_POST['sav_bank_letter'];
	$sav_bank_state = $_POST['sav_bank_state'];
	$sav_others = $_POST['sav_others'];	
	$doc_lic_others = $_POST['doc_lic_others'];
	$doc_pf_others = $_POST['doc_pf_others'];
	$doc_gl_others = $_POST['doc_gl_others'];
	$other_finance = $_POST['other_finance'];
 
 	fileUpload($loan_sanc_letter,"loan_sanc_letter_attach",$loan_sanc_letter_attach); 
 	fileUpload($loan_property,"loan_property_attach",$loan_property_attach);  
 	fileUpload($loan_others,"other_loan_doc_attach",$other_loan_doc_attach); 	
 	fileUpload($fd_bank_letter,"fd_bank_letter_attach",$fd_bank_letter_attach);
	fileUpload($fd_receipt,"fd_receipt_attach",$fd_receipt_attach);
	fileUpload($fd_others,"other_fd_doc_attach",$other_fd_doc_attach);	
	fileUpload($sav_bank_letter,"sav_bank_letter_attach",$sav_bank_letter_attach);
	fileUpload($sav_bank_state,"sav_bank_state_attach",$sav_bank_state_attach);
	fileUpload($sav_others,"other_sav_doc_attach",$other_sav_doc_attach);	
	fileUpload($doc_lic_others,"lic_doc_attach",$lic_doc_attach);
	fileUpload($doc_pf_others,"pf_doc_attach",$pf_doc_attach);
	fileUpload($doc_gl_others,"gl_doc_attach",$gl_doc_attach);
	fileUpload($other_finance,"other_fin_doc_attach",$other_fin_doc_attach);
		
	
	if($loan_others != '') {
		$other_loan_doc = $_POST['other_loan_doc'];  //name of the document
	}
	if($fd_others != '') {	
		$other_fd_doc = $_POST['other_fd_doc'];  //name of the document
	}		
	if($sav_others != '') {	
		$other_sav_doc = $_POST['other_sav_doc'];  //name of the document
	}	
	if($doc_lic != '') {	
		$lic_doc = $_POST['lic_doc'];  //name of the document
	}	
	if($doc_pf != '') {	
		$pf_doc = $_POST['pf_doc'];  //name of the document
	}	
	if($doc_gl) {	
		$gl_doc = $_POST['gl_doc'];  //name of the document
	}
	
	
	if($other_finance != '') {	
	$other_fin_doc = $_POST['other_fin_doc'];	//name of the document
	}
	
	
	
	$income_proof = $_POST['income_proof'];
	$gd_sal_state = $_POST['gd_sal_state'];
	$affidavit = $_POST['affidavit'];
	$ca_state1 = $_POST['ca_state1'];
	$gd_passport = $_POST['gd_passport'];
	$comp_regn = $_POST['comp_regn'];
	$partnership = $_POST['partnership'];
	$bal_sheet = $_POST['bal_sheet'];
	$it_returns = $_POST['it_returns'];
	$ca_state2 = $_POST['ca_state2'];
	$rental_agrmnt = $_POST['rental_agrmnt'];
	$rent_recpt = $_POST['rent_recpt'];
	$sp_sal_state = $_POST['sp_sal_state'];
	$sp_passport = $_POST['sp_passport'];
	$visa_sponsor = $_POST['visa_sponsor'];
	$inc_others = $_POST['inc_others'];
	$bus_others = $_POST['bus_others'];
	$ren_others = $_POST['ren_others'];
	$spr_others = $_POST['spr_others'];
	
	fileUpload($income_proof,"income_proof_attach", $income_proof_attach);
	fileUpload($gd_sal_state,"gd_sal_state_attach", $gd_sal_state_attach); 
	fileUpload($affidavit,"affidavit_attach", $affidavit_attach); 
	fileUpload($ca_state1,"ca_state1_attach", $ca_state1_attach); 
	fileUpload($gd_passport,"gd_passport_attach", $gd_passport_attach); 
	fileUpload($comp_regn,"comp_regn_attach", $comp_regn_attach); 
	fileUpload($partnership,"partnership_attach", $partnership_attach); 
	fileUpload($bal_sheet,"bal_sheet_attach", $bal_sheet_attach); 
	fileUpload($it_returns,"it_returns_attach", $it_returns_attach);
	fileUpload($ca_state2,"ca_state2_attach", $ca_state2_attach);
	fileUpload($rental_agrmnt,"rental_agrmnt_attach", $rental_agrmnt_attach);
	fileUpload($rent_recpt,"rent_recpt_attach", $rent_recpt_attach);
	fileUpload($sp_sal_state,"sp_sal_state_attach",$sp_sal_state_attach);
	fileUpload($sp_passport,"sp_passport_attach",$sp_passport_attach);
	fileUpload($visa_sponsor,"visa_sponsor_attach",$visa_sponsor_attach);
	fileUpload($inc_others,"other_inc_doc_attach",$other_inc_doc_attach);
	fileUpload($bus_others,"other_bus_doc_attach",$other_bus_doc_attach);
	fileUpload($ren_others,"other_ren_doc_attach",$other_ren_doc_attach);
	fileUpload($spr_others,"other_spr_doc_attach",$other_spr_doc_attach);

	
	
	
	if($inc_others != '') { 
		$other_inc_doc = $_POST['other_inc_doc'];  //name of the document
	}
	if($bus_others != '') {
		$other_bus_doc = $_POST['other_bus_doc'];  //name of the document
	}
	if($ren_others != '') {
		$other_ren_doc = $_POST['other_ren_doc'];  //name of the document
	}
	if($spr_others != '') {
		$other_spr_doc = $_POST['other_spr_doc'];  //name of the document
	}
	
	$finMode = $_POST['finMode'];
	$dType = $_POST['dType'];
	$type = "";
	$assignedTo = $_POST['vdEmployee'];
	$date = date("Y-m-d");
	if($assignedTo != '') {
		$stud_visa = mysql_query("INSERT INTO `stud_visa` (`studID`, `assignedBy`, `assignedTo`, `date`, `branchID`, `finMode`, `dType`) VALUES ('$studID', '$empID', '$assignedTo', '$date', '$branchID', '$finMode', '$dType')");
		
		$svID = mysql_insert_id();
	}
	
	function insertDocuments($doc, $attachment, $mode , $svID, $docName = NULL, $sponsorType = NULL, $sponsorName = NULL, $sponsorRelation = NULL){
		if(!empty($doc)){
		$stud_visa_docs = mysql_query("INSERT INTO `stud_visa_docs` 
		 		 (`svID`, `type`, `chkID`, `docName`, `attachment`, `sponsorType`, `name`, `relation`) VALUES
				 ('$svID', '".$mode."', '$doc', '".$docName."', '".$attachment."', '".$sponsorType."', '".$sponsorName."', '".$sponsorRelation."')");
		}
	}	
	
	if($finMode != '') {
		insertDocuments($_POST['loan_sanc_letter'], $loan_sanc_letter_attach, $finMode, $svID);
		insertDocuments($_POST['loan_property'], $loan_property_attach, $finMode, $svID);
		insertDocuments($_POST['loan_others'], $other_loan_doc_attach, $finMode, $svID, $_POST["other_loan_doc"]);
		insertDocuments($_POST['fd_bank_letter'], $fd_bank_letter_attach, $finMode, $svID);
		insertDocuments($_POST['fd_receipt'], $fd_receipt_attach, $finMode, $svID);
		insertDocuments($_POST['fd_others'], $other_fd_doc_attach, $finMode, $svID, $_POST["other_fd_doc"]);
		insertDocuments($_POST['sav_bank_letter'], $sav_bank_letter_attach, $finMode, $svID);
		insertDocuments($_POST['sav_bank_state'], $sav_bank_state_attach, $finMode, $svID);
		insertDocuments($_POST['sav_others'], $other_sav_doc_attach, $finMode, $svID, $_POST["other_sav_doc"]);
		insertDocuments($_POST['doc_lic_others'], $lic_doc_attach, $finMode, $svID, $_POST["lic_doc"]);
		insertDocuments($_POST['doc_pf_others'], $pf_doc_attach, $finMode, $svID, $_POST["pf_doc"]);
		insertDocuments($_POST['doc_gl_others'], $gl_doc_attach, $finMode, $svID, $_POST["gl_doc"]);
		insertDocuments($_POST['other_finance'], $other_fin_doc_attach, $finMode, $svID, $_POST["other_fin_doc"]);
	} 

	if($dType != '') {
		if(isset($sponsor) && $sponsor == '1') {
			$sponsorType = "S";
			$name = $_POST['spName'];
			$relation = $_POST['spRelation'];
		} else if(isset($sponsor) && $sponsor == '2') {
			$sponsorType = "G";
			$name = $_POST['gdName'];
			$relation = $_POST['gdRelation'];
		}
		insertDocuments($_POST['income_proof'], $income_proof_attach, $dType, $svID, "", $sponsorType, $name, $relation);
		insertDocuments($_POST['gd_sal_state'], $gd_sal_state_attach, $dType, $svID);
		insertDocuments($_POST['affidavit'], $affidavit_attach, $dType, $svID);
		insertDocuments($_POST['ca_state1'], $ca_state1_attach, $dType, $svID);
		insertDocuments($_POST['gd_passport'], $gd_passport_attach, $dType, $svID);
		insertDocuments($_POST['inc_others'], $other_inc_doc_attach, $dType, $svID, $_POST["other_inc_doc"]);
		insertDocuments($_POST['comp_regn'], $comp_regn_attach, $dType, $svID);
		insertDocuments($_POST['partnership'], $partnership_attach, $dType, $svID);
		insertDocuments($_POST['bal_sheet'], $bal_sheet_attach, $dType, $svID);
		insertDocuments($_POST['it_returns'], $it_returns_attach, $dType, $svID);
		insertDocuments($_POST['ca_state2'], $ca_state2_attach, $dType, $svID);
		insertDocuments($_POST['bus_others'], $other_bus_doc_attach, $dType, $svID, $_POST["other_bus_doc"]);
		insertDocuments($_POST['rental_agrmnt'], $rental_agrmnt_attach, $dType, $svID);
		insertDocuments($_POST['rent_recpt'], $rent_recpt_attach, $dType, $svID);
		insertDocuments($_POST['ren_others'], $other_ren_doc_attach, $dType, $svID, $_POST["other_ren_doc"]);
		insertDocuments($_POST['sp_sal_state'], $sp_sal_state_attach, $dType, $svID);
		insertDocuments($_POST['sp_passport'], $sp_passport_attach, $dType, $svID);
		insertDocuments($_POST['visa_sponsor'], $visa_sponsor_attach, $dType, $svID);
		insertDocuments($_POST['spr_others'], $other_spr_doc_attach, $dType, $svID, $_POST["other_spr_doc"]);
		
		}	
}
?>

<div id="wrapper_top"></div>
<div id="wrapper">
<?php include("../include/left_stud.php"); ?>
<div class="main_col dotted_border">
<h2>Details</h2>
<br />
<form action="" method="post" enctype="multipart/form-data" name="form" id="form">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr><td colspan="3"><h6>Financial Details</h6></td></tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="23%" valign="top">Mode of Payment</td>
    <td width="2%" valign="top">:</td>
    <td width="75%" valign="top">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="pad">
      <tr>
        <td width="32%"><input type="radio" name="finMode" id="loan" value="1" onclick="return financeDetails(this.value);"/> Loan</td>
        <td width="68%"><input type="radio" name="finMode" id="lic" value="4" onclick="return financeDetails(this.value);"/> LIC</td>
        </tr>
      <tr>
        <td><input type="radio" name="finMode" id="fd" value="2" onclick="return financeDetails(this.value);"/> Fixed Deposit</td>
        <td><input type="radio" name="finMode" id="pf" value="5" onclick="return financeDetails(this.value);"/> Provident Fund</td>
        </tr>
      <tr>
        <td><input type="radio" name="finMode" id="sav" value="3" onclick="return financeDetails(this.value);"/> Savings</td>
        <td><input type="radio" name="finMode" id="gl" value="6" onclick="return financeDetails(this.value);"/> Gold Loan</td>
      </tr>
      <tr>
        <td colspan="2"><input type="radio" name="finMode" id="otherFinance" value="7" onclick="return financeDetails(this.value);"/> Any other </td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3"><div id="financeDetails"></div></td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr><td colspan="3"><h6>Documents for Visa Process</h6></td></tr>
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td valign="top">Document type</td>
    <td valign="top">:</td>
    <td valign="top">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="pad">
        <tr>
          <td width="32%"><input type="radio" name="dType" id="incProof" value="8" onclick="return docType(this.value);"/> Income Proof </td>
          <td width="68%"><input type="radio" name="dType" id="business" value="10" onclick="return docType(this.value);"/> Rental</td>
        </tr>
        <tr>
          <td><input type="radio" name="dType" id="rental" value="9" onclick="return docType(this.value);"/> Business</td>
          <td><input type="radio" name="dType" id="abroad" value="11" onclick="return docType(this.value);"/> Sponsor Abroad</td>
        </tr>
	</table></td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3"><div id="documentDetails"></div></td>
    </tr>
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr><td colspan="3"><h6>Processing by</h6></td></tr>
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td align="center">Visa Staff</td>
    <td>:</td>
    <td>
    <select name="vdEmployee" id="vdEmployee" class="dropdown">
    <option value="" selected="selected" class="padding_2">Select</option>
    <?php
	$emps = mysql_query("SELECT * FROM `employees` WHERE deptID = '4' AND delStatus = '0'");
	while($row = mysql_fetch_array($emps)) {
		echo "<option value='".$row['empID']."' class='padding_2'>".$row['fname']." ".$row['lname']."</option>";
	}
	?>
    </select>    </td>
  </tr>
  <tr>
    <td height="60">&nbsp;</td>
    <td>&nbsp;</td>
    <td><input type="submit" name="submit" id="submit" value="Submit" class="button width_150"/></td>
  </tr>
</table>

</form>

</div> <!--end of main_col-->
</div> <!--end of wrapper-->

<?php include("../include/footer.php"); ?>

</div> <!--end of container-->
</body>
</html>




