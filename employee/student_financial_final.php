<?php include ("../include/header.php"); 
include ("../include/validate.php"); 
include ("../include/menu.php"); 
$empID = $info['empID'];
$branchID = $info['branchID'];
$studID = $_GET['sid'];
?>

<script>
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
	if(box.name == "otherFinance" && box.checked) {
		form.other_finance.disabled = false;
	} else if(box.name == "otherFinance" && box.checked == false) {
		form.other_finance.disabled = true;
	}	
}


</script>
<?php
if(isset($_POST['submit'])) {
	
	$finMode = $_POST['finMode'];
	$loan_sanc_letter = $_POST['loan_sanc_letter'];
	if($loan_sanc_letter != '') {
		$loan_sanc_letter_attach = '';		
		if($_FILES["loan_sanc_letter_attach"]["name"] != '') {
			$allowedExts = array("jpg", "jpeg", "gif", "png");
			$extension = end(explode(".", $_FILES["loan_sanc_letter_attach"]["name"]));
			if ((($_FILES["loan_sanc_letter_attach"]["type"] == "image/gif")
			|| ($_FILES["loan_sanc_letter_attach"]["type"] == "image/jpeg")
			|| ($_FILES["loan_sanc_letter_attach"]["type"] == "image/png")
			|| ($_FILES["loan_sanc_letter_attach"]["type"] == "image/pjpeg"))
			&& ($_FILES["loan_sanc_letter_attach"]["size"] < 256000) // file size in bytes -- 250 KB
			&& in_array($extension, $allowedExts))
			{
			  $loan_sanc_letter_attach = time()."_".$_FILES["loan_sanc_letter_attach"]["name"];	
			  move_uploaded_file($_FILES["loan_sanc_letter_attach"]["tmp_name"],"checklist/" . $loan_sanc_letter_attach);
			}
		}
	}
	
	$loan_property = $_POST['loan_property'];
	if($loan_property != '') {
		$loan_property_attach = '';		
		if($_FILES["loan_property_attach"]["name"] != '') {
			$allowedExts = array("jpg", "jpeg", "gif", "png");
			$extension = end(explode(".", $_FILES["loan_property_attach"]["name"]));
			if ((($_FILES["loan_property_attach"]["type"] == "image/gif")
			|| ($_FILES["loan_property_attach"]["type"] == "image/jpeg")
			|| ($_FILES["loan_property_attach"]["type"] == "image/png")
			|| ($_FILES["loan_property_attach"]["type"] == "image/pjpeg"))
			&& ($_FILES["loan_property_attach"]["size"] < 256000) // file size in bytes -- 250 KB
			&& in_array($extension, $allowedExts))
			{
			  $loan_property_attach = time()."_".$_FILES["loan_property_attach"]["name"];	
			  move_uploaded_file($_FILES["loan_property_attach"]["tmp_name"],"checklist/" . $loan_property_attach);
			}
		}
	}
	
	$fd_bank_letter = $_POST['fd_bank_letter'];
	if($fd_bank_letter != '') {
		$fd_bank_letter_attach = '';		
		if($_FILES["fd_bank_letter_attach"]["name"] != '') {
			$allowedExts = array("jpg", "jpeg", "gif", "png");
			$extension = end(explode(".", $_FILES["fd_bank_letter_attach"]["name"]));
			if ((($_FILES["fd_bank_letter_attach"]["type"] == "image/gif")
			|| ($_FILES["fd_bank_letter_attach"]["type"] == "image/jpeg")
			|| ($_FILES["fd_bank_letter_attach"]["type"] == "image/png")
			|| ($_FILES["fd_bank_letter_attach"]["type"] == "image/pjpeg"))
			&& ($_FILES["fd_bank_letter_attach"]["size"] < 256000) // file size in bytes -- 250 KB
			&& in_array($extension, $allowedExts))
			{
			  $fd_bank_letter_attach = time()."_".$_FILES["fd_bank_letter_attach"]["name"];	
			  move_uploaded_file($_FILES["fd_bank_letter_attach"]["tmp_name"],"checklist/" . $fd_bank_letter_attach);
			}
		}
	}
	
	$fd_receipt = $_POST['fd_receipt'];
	if($fd_receipt != '') {
		$fd_receipt_attach = '';		
		if($_FILES["fd_receipt_attach"]["name"] != '') {
			$allowedExts = array("jpg", "jpeg", "gif", "png");
			$extension = end(explode(".", $_FILES["fd_receipt_attach"]["name"]));
			if ((($_FILES["fd_receipt_attach"]["type"] == "image/gif")
			|| ($_FILES["fd_receipt_attach"]["type"] == "image/jpeg")
			|| ($_FILES["fd_receipt_attach"]["type"] == "image/png")
			|| ($_FILES["fd_receipt_attach"]["type"] == "image/pjpeg"))
			&& ($_FILES["fd_receipt_attach"]["size"] < 256000) // file size in bytes -- 250 KB
			&& in_array($extension, $allowedExts))
			{
			  $fd_receipt_attach = time()."_".$_FILES["fd_receipt_attach"]["name"];	
			  move_uploaded_file($_FILES["fd_receipt_attach"]["tmp_name"],"checklist/" . $fd_receipt_attach);
			}
		}
	}
	
	$sav_bank_letter = $_POST['sav_bank_letter'];
	if($sav_bank_letter != '') {
		$sav_bank_letter_attach = '';		
		if($_FILES["sav_bank_letter_attach"]["name"] != '') {
			$allowedExts = array("jpg", "jpeg", "gif", "png");
			$extension = end(explode(".", $_FILES["sav_bank_letter_attach"]["name"]));
			if ((($_FILES["sav_bank_letter_attach"]["type"] == "image/gif")
			|| ($_FILES["sav_bank_letter_attach"]["type"] == "image/jpeg")
			|| ($_FILES["sav_bank_letter_attach"]["type"] == "image/png")
			|| ($_FILES["sav_bank_letter_attach"]["type"] == "image/pjpeg"))
			&& ($_FILES["sav_bank_letter_attach"]["size"] < 256000) // file size in bytes -- 250 KB
			&& in_array($extension, $allowedExts))
			{
			  $sav_bank_letter_attach = time()."_".$_FILES["sav_bank_letter_attach"]["name"];	
			  move_uploaded_file($_FILES["sav_bank_letter_attach"]["tmp_name"],"checklist/" . $sav_bank_letter_attach);
			}
		}
	}
	
	$sav_bank_state = $_POST['sav_bank_state'];
	if($sav_bank_state != '') {
		$sav_bank_state_attach = '';		
		if($_FILES["sav_bank_state_attach"]["name"] != '') {
			$allowedExts = array("jpg", "jpeg", "gif", "png");
			$extension = end(explode(".", $_FILES["sav_bank_state_attach"]["name"]));
			if ((($_FILES["sav_bank_state_attach"]["type"] == "image/gif")
			|| ($_FILES["sav_bank_state_attach"]["type"] == "image/jpeg")
			|| ($_FILES["sav_bank_state_attach"]["type"] == "image/png")
			|| ($_FILES["sav_bank_state_attach"]["type"] == "image/pjpeg"))
			&& ($_FILES["sav_bank_state_attach"]["size"] < 256000) // file size in bytes -- 250 KB
			&& in_array($extension, $allowedExts))
			{
			  $sav_bank_state_attach = time()."_".$_FILES["sav_bank_state_attach"]["name"];	
			  move_uploaded_file($_FILES["sav_bank_state_attach"]["tmp_name"],"checklist/" . $sav_bank_state_attach);
			}
		}
	}
	
	$doc_lic = $_POST['doc_lic'];
	if($doc_lic != '') {
		$doc_lic_attach = '';		
		if($_FILES["doc_lic_attach"]["name"] != '') {
			$allowedExts = array("jpg", "jpeg", "gif", "png");
			$extension = end(explode(".", $_FILES["doc_lic_attach"]["name"]));
			if ((($_FILES["doc_lic_attach"]["type"] == "image/gif")
			|| ($_FILES["doc_lic_attach"]["type"] == "image/jpeg")
			|| ($_FILES["doc_lic_attach"]["type"] == "image/png")
			|| ($_FILES["doc_lic_attach"]["type"] == "image/pjpeg"))
			&& ($_FILES["doc_lic_attach"]["size"] < 256000) // file size in bytes -- 250 KB
			&& in_array($extension, $allowedExts))
			{
			  $doc_lic_attach = time()."_".$_FILES["doc_lic_attach"]["name"];	
			  move_uploaded_file($_FILES["doc_lic_attach"]["tmp_name"],"checklist/" . $doc_lic_attach);
			}
		}
	}
	
	$doc_pf = $_POST['doc_pf'];
	if($doc_pf != '') {
		$doc_pf_attach = '';		
		if($_FILES["doc_pf_attach"]["name"] != '') {
			$allowedExts = array("jpg", "jpeg", "gif", "png");
			$extension = end(explode(".", $_FILES["doc_pf_attach"]["name"]));
			if ((($_FILES["doc_pf_attach"]["type"] == "image/gif")
			|| ($_FILES["doc_pf_attach"]["type"] == "image/jpeg")
			|| ($_FILES["doc_pf_attach"]["type"] == "image/png")
			|| ($_FILES["doc_pf_attach"]["type"] == "image/pjpeg"))
			&& ($_FILES["doc_pf_attach"]["size"] < 256000) // file size in bytes -- 250 KB
			&& in_array($extension, $allowedExts))
			{
			  $doc_pf_attach = time()."_".$_FILES["doc_pf_attach"]["name"];	
			  move_uploaded_file($_FILES["doc_pf_attach"]["tmp_name"],"checklist/" . $doc_pf_attach);
			}
		}
	}
	
	$doc_gl = $_POST['doc_gl'];
	if($doc_gl) {
		$doc_gl_attach = '';		
		if($_FILES["doc_gl_attach"]["name"] != '') {
			$allowedExts = array("jpg", "jpeg", "gif", "png");
			$extension = end(explode(".", $_FILES["doc_gl_attach"]["name"]));
			if ((($_FILES["doc_gl_attach"]["type"] == "image/gif")
			|| ($_FILES["doc_gl_attach"]["type"] == "image/jpeg")
			|| ($_FILES["doc_gl_attach"]["type"] == "image/png")
			|| ($_FILES["doc_gl_attach"]["type"] == "image/pjpeg"))
			&& ($_FILES["doc_gl_attach"]["size"] < 256000) // file size in bytes -- 250 KB
			&& in_array($extension, $allowedExts))
			{
			  $doc_gl_attach = time()."_".$_FILES["doc_gl_attach"]["name"];	
			  move_uploaded_file($_FILES["doc_gl_attach"]["tmp_name"],"checklist/" . $doc_gl_attach);
			}
		}
	}
	
	$doc_others = $_POST['doc_others'];
	if($doc_others != '') {
		$doc_others_attach = '';		
		if($_FILES["doc_others_attach"]["name"] != '') {
			$allowedExts = array("jpg", "jpeg", "gif", "png");
			$extension = end(explode(".", $_FILES["doc_others_attach"]["name"]));
			if ((($_FILES["doc_others_attach"]["type"] == "image/gif")
			|| ($_FILES["doc_others_attach"]["type"] == "image/jpeg")
			|| ($_FILES["doc_others_attach"]["type"] == "image/png")
			|| ($_FILES["doc_others_attach"]["type"] == "image/pjpeg"))
			&& ($_FILES["doc_others_attach"]["size"] < 256000) // file size in bytes -- 250 KB
			&& in_array($extension, $allowedExts))
			{
			  $doc_others_attach = time()."_".$_FILES["doc_others_attach"]["name"];	
			  move_uploaded_file($_FILES["doc_others_attach"]["tmp_name"],"checklist/" . $doc_others_attach);
			}
		}
	}
	
	$otherFinance = $_POST['otherFinance'];
	if($otherFinance != '') {
		$other_finance = $_POST['other_finance'];	
		$other_finance_attach = '';		
		if($_FILES["other_finance_attach"]["name"] != '') {
			$allowedExts = array("jpg", "jpeg", "gif", "png");
			$extension = end(explode(".", $_FILES["other_finance_attach"]["name"]));
			if ((($_FILES["other_finance_attach"]["type"] == "image/gif")
			|| ($_FILES["other_finance_attach"]["type"] == "image/jpeg")
			|| ($_FILES["other_finance_attach"]["type"] == "image/png")
			|| ($_FILES["other_finance_attach"]["type"] == "image/pjpeg"))
			&& ($_FILES["other_finance_attach"]["size"] < 256000) // file size in bytes -- 250 KB
			&& in_array($extension, $allowedExts))
			{
			  $other_finance_attach = time()."_".$_FILES["other_finance_attach"]["name"];	
			  move_uploaded_file($_FILES["other_finance_attach"]["tmp_name"],"checklist/" . $other_finance_attach);
			}
		}
	}
	
	$assignedTo = $_POST['vdEmployee'];
	$date = date("Y-m-d");
	if($assignedTo != '') {
		$stud_visa = mysql_query("INSERT INTO `stud_visa` (`studID`, `assignedBy`, `assignedTo`, `date`, `branchID`) VALUES ('$studID', '$empID', '$assignedTo', '$date', '$branchID')");
		
		$svID = mysql_insert_id();
	}
	
	if($finMode != '') {
		$stud_finance = mysql_query("INSERT INTO `stud_finance` (`svID`, `finMode`, `loan_sanc_letter`, `loan_property`, `fd_bank_letter`, `fd_receipt`, `sav_bank_letter`, `sav_bank_state`, `otherFinance`, `other_finance`, `doc_lic`, `doc_pf`, `doc_gl`, `doc_others`, `loan_sanc_letter_attach`, `loan_property_attach`, `fd_bank_letter_attach`, `fd_receipt_attach`, `sav_bank_letter_attach`, `sav_bank_state_attach`, `other_finance_attach`, `doc_lic_attach`, `doc_pf_attach`, `doc_gl_attach`, `doc_others_attach`) VALUES ('$svID', '$finMode', '$loan_sanc_letter', '$loan_property', '$fd_bank_letter', '$fd_receipt', '$sav_bank_letter', '$sav_bank_state', '$otherFinance', '$other_finance', '$doc_lic', '$doc_pf', '$doc_gl', '$doc_others', '$loan_sanc_letter_attach', '$loan_property_attach', '$fd_bank_letter_attach', '$fd_receipt_attach', '$sav_bank_letter_attach', '$sav_bank_state_attach', '$other_finance_attach', '$doc_lic_attach', '$doc_pf_attach', '$doc_gl_attach', '$doc_others_attach')");
	}
	
	
	
	
	
	$dType = $_POST['dType'];
	$income_proof = $_POST['income_proof'];
	if($income_proof != '') {
		$income_proof_attach = '';		
		if($_FILES["income_proof_attach"]["name"] != '') {
			$allowedExts = array("jpg", "jpeg", "gif", "png");
			$extension = end(explode(".", $_FILES["income_proof_attach"]["name"]));
			if ((($_FILES["income_proof_attach"]["type"] == "image/gif")
			|| ($_FILES["income_proof_attach"]["type"] == "image/jpeg")
			|| ($_FILES["income_proof_attach"]["type"] == "image/png")
			|| ($_FILES["income_proof_attach"]["type"] == "image/pjpeg"))
			&& ($_FILES["income_proof_attach"]["size"] < 256000) // file size in bytes -- 250 KB
			&& in_array($extension, $allowedExts))
			{
			  $income_proof_attach = time()."_".$_FILES["income_proof_attach"]["name"];	
			  move_uploaded_file($_FILES["income_proof_attach"]["tmp_name"],"checklist/" . $income_proof_attach);
			}
		}
	}
	
	$sponsor = $_POST['sponsor'];
	if($sponsor == '1') {
		$name = $_POST['spName'];
		$relation = $_POST['spRelation'];
	} else if($sponsor == '2') {
		$name = $_POST['gdName'];
		$relation = $_POST['gdRelation'];
	}
	
	$gd_sal_state = $_POST['gd_sal_state'];
	if($gd_sal_state != '') {
		$gd_sal_state_attach = '';		
		if($_FILES["gd_sal_state_attach"]["name"] != '') {
			$allowedExts = array("jpg", "jpeg", "gif", "png");
			$extension = end(explode(".", $_FILES["gd_sal_state_attach"]["name"]));
			if ((($_FILES["gd_sal_state_attach"]["type"] == "image/gif")
			|| ($_FILES["gd_sal_state_attach"]["type"] == "image/jpeg")
			|| ($_FILES["gd_sal_state_attach"]["type"] == "image/png")
			|| ($_FILES["gd_sal_state_attach"]["type"] == "image/pjpeg"))
			&& ($_FILES["gd_sal_state_attach"]["size"] < 256000) // file size in bytes -- 250 KB
			&& in_array($extension, $allowedExts))
			{
			  $gd_sal_state_attach = time()."_".$_FILES["gd_sal_state_attach"]["name"];	
			  move_uploaded_file($_FILES["gd_sal_state_attach"]["tmp_name"],"checklist/" . $gd_sal_state_attach);
			}
		}
	}
	
	$affidavit = $_POST['affidavit'];
	if($affidavit != '') {
		$affidavit_attach = '';		
		if($_FILES["affidavit_attach"]["name"] != '') {
			$allowedExts = array("jpg", "jpeg", "gif", "png");
			$extension = end(explode(".", $_FILES["affidavit_attach"]["name"]));
			if ((($_FILES["affidavit_attach"]["type"] == "image/gif")
			|| ($_FILES["affidavit_attach"]["type"] == "image/jpeg")
			|| ($_FILES["affidavit_attach"]["type"] == "image/png")
			|| ($_FILES["affidavit_attach"]["type"] == "image/pjpeg"))
			&& ($_FILES["affidavit_attach"]["size"] < 256000) // file size in bytes -- 250 KB
			&& in_array($extension, $allowedExts))
			{
			  $affidavit_attach = time()."_".$_FILES["affidavit_attach"]["name"];	
			  move_uploaded_file($_FILES["affidavit_attach"]["tmp_name"],"checklist/" . $affidavit_attach);
			}
		}
	}
	
	$ca_state1 = $_POST['ca_state1'];
	if($ca_state1 != '') {
		$ca_state1_attach = '';		
		if($_FILES["ca_state1_attach"]["name"] != '') {
			$allowedExts = array("jpg", "jpeg", "gif", "png");
			$extension = end(explode(".", $_FILES["ca_state1_attach"]["name"]));
			if ((($_FILES["ca_state1_attach"]["type"] == "image/gif")
			|| ($_FILES["ca_state1_attach"]["type"] == "image/jpeg")
			|| ($_FILES["ca_state1_attach"]["type"] == "image/png")
			|| ($_FILES["ca_state1_attach"]["type"] == "image/pjpeg"))
			&& ($_FILES["ca_state1_attach"]["size"] < 256000) // file size in bytes -- 250 KB
			&& in_array($extension, $allowedExts))
			{
			  $ca_state1_attach = time()."_".$_FILES["ca_state1_attach"]["name"];	
			  move_uploaded_file($_FILES["ca_state1_attach"]["tmp_name"],"checklist/" . $ca_state1_attach);
			}
		}
	}
	
	$gd_passport = $_POST['gd_passport'];
	if($gd_passport != '') {
		$gd_passport_attach = '';		
		if($_FILES["gd_passport_attach"]["name"] != '') {
			$allowedExts = array("jpg", "jpeg", "gif", "png");
			$extension = end(explode(".", $_FILES["gd_passport_attach"]["name"]));
			if ((($_FILES["gd_passport_attach"]["type"] == "image/gif")
			|| ($_FILES["gd_passport_attach"]["type"] == "image/jpeg")
			|| ($_FILES["gd_passport_attach"]["type"] == "image/png")
			|| ($_FILES["gd_passport_attach"]["type"] == "image/pjpeg"))
			&& ($_FILES["gd_passport_attach"]["size"] < 256000) // file size in bytes -- 250 KB
			&& in_array($extension, $allowedExts))
			{
			  $gd_passport_attach = time()."_".$_FILES["gd_passport_attach"]["name"];	
			  move_uploaded_file($_FILES["gd_passport_attach"]["tmp_name"],"checklist/" . $gd_passport_attach);
			}
		}
	}
	
	$comp_regn = $_POST['comp_regn'];
	if($comp_regn != '') {
		$comp_regn_attach = '';		
		if($_FILES["comp_regn_attach"]["name"] != '') {
			$allowedExts = array("jpg", "jpeg", "gif", "png");
			$extension = end(explode(".", $_FILES["comp_regn_attach"]["name"]));
			if ((($_FILES["comp_regn_attach"]["type"] == "image/gif")
			|| ($_FILES["comp_regn_attach"]["type"] == "image/jpeg")
			|| ($_FILES["comp_regn_attach"]["type"] == "image/png")
			|| ($_FILES["comp_regn_attach"]["type"] == "image/pjpeg"))
			&& ($_FILES["comp_regn_attach"]["size"] < 256000) // file size in bytes -- 250 KB
			&& in_array($extension, $allowedExts))
			{
			  $comp_regn_attach = time()."_".$_FILES["comp_regn_attach"]["name"];	
			  move_uploaded_file($_FILES["comp_regn_attach"]["tmp_name"],"checklist/" . $comp_regn_attach);
			}
		}
	}
	
	$partnership = $_POST['partnership'];
	if($partnership != '') {
		$partnership_attach = '';		
		if($_FILES["partnership_attach"]["name"] != '') {
			$allowedExts = array("jpg", "jpeg", "gif", "png");
			$extension = end(explode(".", $_FILES["partnership_attach"]["name"]));
			if ((($_FILES["partnership_attach"]["type"] == "image/gif")
			|| ($_FILES["partnership_attach"]["type"] == "image/jpeg")
			|| ($_FILES["partnership_attach"]["type"] == "image/png")
			|| ($_FILES["partnership_attach"]["type"] == "image/pjpeg"))
			&& ($_FILES["partnership_attach"]["size"] < 256000) // file size in bytes -- 250 KB
			&& in_array($extension, $allowedExts))
			{
			  $partnership_attach = time()."_".$_FILES["partnership_attach"]["name"];	
			  move_uploaded_file($_FILES["partnership_attach"]["tmp_name"],"checklist/" . $partnership_attach);
			}
		}
	}
	
	$bal_sheet = $_POST['bal_sheet'];
	if($bal_sheet != '') {
		$bal_sheet_attach = '';		
		if($_FILES["bal_sheet_attach"]["name"] != '') {
			$allowedExts = array("jpg", "jpeg", "gif", "png");
			$extension = end(explode(".", $_FILES["bal_sheet_attach"]["name"]));
			if ((($_FILES["bal_sheet_attach"]["type"] == "image/gif")
			|| ($_FILES["bal_sheet_attach"]["type"] == "image/jpeg")
			|| ($_FILES["bal_sheet_attach"]["type"] == "image/png")
			|| ($_FILES["bal_sheet_attach"]["type"] == "image/pjpeg"))
			&& ($_FILES["bal_sheet_attach"]["size"] < 256000) // file size in bytes -- 250 KB
			&& in_array($extension, $allowedExts))
			{
			  $bal_sheet_attach = time()."_".$_FILES["bal_sheet_attach"]["name"];	
			  move_uploaded_file($_FILES["bal_sheet_attach"]["tmp_name"],"checklist/" . $bal_sheet_attach);
			}
		}
	}
	
	$it_returns = $_POST['it_returns'];
	if($it_returns != '') {
		$it_returns_attach = '';		
		if($_FILES["it_returns_attach"]["name"] != '') {
			$allowedExts = array("jpg", "jpeg", "gif", "png");
			$extension = end(explode(".", $_FILES["it_returns_attach"]["name"]));
			if ((($_FILES["it_returns_attach"]["type"] == "image/gif")
			|| ($_FILES["it_returns_attach"]["type"] == "image/jpeg")
			|| ($_FILES["it_returns_attach"]["type"] == "image/png")
			|| ($_FILES["it_returns_attach"]["type"] == "image/pjpeg"))
			&& ($_FILES["it_returns_attach"]["size"] < 256000) // file size in bytes -- 250 KB
			&& in_array($extension, $allowedExts))
			{
			  $it_returns_attach = time()."_".$_FILES["it_returns_attach"]["name"];	
			  move_uploaded_file($_FILES["it_returns_attach"]["tmp_name"],"checklist/" . $it_returns_attach);
			}
		}
	}
	
	$ca_state2 = $_POST['ca_state2'];
	if($ca_state2 != '') {
		$ca_state2_attach = '';		
		if($_FILES["ca_state2_attach"]["name"] != '') {
			$allowedExts = array("jpg", "jpeg", "gif", "png");
			$extension = end(explode(".", $_FILES["ca_state2_attach"]["name"]));
			if ((($_FILES["ca_state2_attach"]["type"] == "image/gif")
			|| ($_FILES["ca_state2_attach"]["type"] == "image/jpeg")
			|| ($_FILES["ca_state2_attach"]["type"] == "image/png")
			|| ($_FILES["ca_state2_attach"]["type"] == "image/pjpeg"))
			&& ($_FILES["ca_state2_attach"]["size"] < 256000) // file size in bytes -- 250 KB
			&& in_array($extension, $allowedExts))
			{
			  $ca_state2_attach = time()."_".$_FILES["ca_state2_attach"]["name"];	
			  move_uploaded_file($_FILES["ca_state2_attach"]["tmp_name"],"checklist/" . $ca_state2_attach);
			}
		}
	}
	
	$rental_agrmnt = $_POST['rental_agrmnt'];
	if($rental_agrmnt != '') {
		$rental_argmnt_attach = '';		
		if($_FILES["rental_argmnt_attach"]["name"] != '') {
			$allowedExts = array("jpg", "jpeg", "gif", "png");
			$extension = end(explode(".", $_FILES["rental_argmnt_attach"]["name"]));
			if ((($_FILES["rental_argmnt_attach"]["type"] == "image/gif")
			|| ($_FILES["rental_argmnt_attach"]["type"] == "image/jpeg")
			|| ($_FILES["rental_argmnt_attach"]["type"] == "image/png")
			|| ($_FILES["rental_argmnt_attach"]["type"] == "image/pjpeg"))
			&& ($_FILES["rental_argmnt_attach"]["size"] < 256000) // file size in bytes -- 250 KB
			&& in_array($extension, $allowedExts))
			{
			  $rental_argmnt_attach = time()."_".$_FILES["rental_argmnt_attach"]["name"];	
			  move_uploaded_file($_FILES["rental_argmnt_attach"]["tmp_name"],"checklist/" . $rental_argmnt_attach);
			}
		}
	}
	$rent_recpt = $_POST['rent_recpt'];
	if($rent_recpt != '') {
		$rent_recpt_attach = '';		
		if($_FILES["rent_recpt_attach"]["name"] != '') {
			$allowedExts = array("jpg", "jpeg", "gif", "png");
			$extension = end(explode(".", $_FILES["rent_recpt_attach"]["name"]));
			if ((($_FILES["rent_recpt_attach"]["type"] == "image/gif")
			|| ($_FILES["rent_recpt_attach"]["type"] == "image/jpeg")
			|| ($_FILES["rent_recpt_attach"]["type"] == "image/png")
			|| ($_FILES["rent_recpt_attach"]["type"] == "image/pjpeg"))
			&& ($_FILES["rent_recpt_attach"]["size"] < 256000) // file size in bytes -- 250 KB
			&& in_array($extension, $allowedExts))
			{
			  $rent_recpt_attach = time()."_".$_FILES["rent_recpt_attach"]["name"];	
			  move_uploaded_file($_FILES["rent_recpt_attach"]["tmp_name"],"checklist/" . $rent_recpt_attach);
			}
		}
	}
	$sp_sal_state = $_POST['sp_sal_state'];
	if($sp_sal_state != '') {
		$sp_sal_state_attach = '';		
		if($_FILES["sp_sal_state_attach"]["name"] != '') {
			$allowedExts = array("jpg", "jpeg", "gif", "png");
			$extension = end(explode(".", $_FILES["sp_sal_state_attach"]["name"]));
			if ((($_FILES["sp_sal_state_attach"]["type"] == "image/gif")
			|| ($_FILES["sp_sal_state_attach"]["type"] == "image/jpeg")
			|| ($_FILES["sp_sal_state_attach"]["type"] == "image/png")
			|| ($_FILES["sp_sal_state_attach"]["type"] == "image/pjpeg"))
			&& ($_FILES["sp_sal_state_attach"]["size"] < 256000) // file size in bytes -- 250 KB
			&& in_array($extension, $allowedExts))
			{
			  $sp_sal_state_attach = time()."_".$_FILES["sp_sal_state_attach"]["name"];	
			  move_uploaded_file($_FILES["sp_sal_state_attach"]["tmp_name"],"checklist/" . $sp_sal_state_attach);
			}
		}
	}
	
	$sp_passport = $_POST['sp_passport'];
	if($sp_passport != '') {
		$sp_passport_attach = '';		
		if($_FILES["sp_passport_attach"]["name"] != '') {
			$allowedExts = array("jpg", "jpeg", "gif", "png");
			$extension = end(explode(".", $_FILES["sp_passport_attach"]["name"]));
			if ((($_FILES["sp_passport_attach"]["type"] == "image/gif")
			|| ($_FILES["sp_passport_attach"]["type"] == "image/jpeg")
			|| ($_FILES["sp_passport_attach"]["type"] == "image/png")
			|| ($_FILES["sp_passport_attach"]["type"] == "image/pjpeg"))
			&& ($_FILES["sp_passport_attach"]["size"] < 256000) // file size in bytes -- 250 KB
			&& in_array($extension, $allowedExts))
			{
			  $sp_passport_attach = time()."_".$_FILES["sp_passport_attach"]["name"];	
			  move_uploaded_file($_FILES["sp_passport_attach"]["tmp_name"],"checklist/" . $sp_passport_attach);
			}
		}
	}
	$visa = $_POST['visa'];
	if($visa != '') {
		$visa_attach = '';		
		if($_FILES["visa_attach"]["name"] != '') {
			$allowedExts = array("jpg", "jpeg", "gif", "png");
			$extension = end(explode(".", $_FILES["visa_attach"]["name"]));
			if ((($_FILES["visa_attach"]["type"] == "image/gif")
			|| ($_FILES["visa_attach"]["type"] == "image/jpeg")
			|| ($_FILES["visa_attach"]["type"] == "image/png")
			|| ($_FILES["visa_attach"]["type"] == "image/pjpeg"))
			&& ($_FILES["visa_attach"]["size"] < 256000) // file size in bytes -- 250 KB
			&& in_array($extension, $allowedExts))
			{
			  $visa_attach = time()."_".$_FILES["visa_attach"]["name"];	
			  move_uploaded_file($_FILES["visa_attach"]["tmp_name"],"checklist/" . $visa_attach);
			}
		}
	}
	
	
	$otherProof = $_POST['otherProof'];
	$other_proof = $_POST['other_proof'];
	if($otherProof != '') {
		$other_proof_attach = '';		
		if($_FILES["other_proof_attach"]["name"] != '') {
			$allowedExts = array("jpg", "jpeg", "gif", "png");
			$extension = end(explode(".", $_FILES["other_proof_attach"]["name"]));
			if ((($_FILES["other_proof_attach"]["type"] == "image/gif")
			|| ($_FILES["other_proof_attach"]["type"] == "image/jpeg")
			|| ($_FILES["other_proof_attach"]["type"] == "image/png")
			|| ($_FILES["other_proof_attach"]["type"] == "image/pjpeg"))
			&& ($_FILES["other_proof_attach"]["size"] < 256000) // file size in bytes -- 250 KB
			&& in_array($extension, $allowedExts))
			{
			  $other_proof_attach = time()."_".$_FILES["other_proof_attach"]["name"];	
			  move_uploaded_file($_FILES["other_proof_attach"]["tmp_name"],"checklist/" . $other_proof_attach);
			}
		}
	}
	
	if($dType != '') {
		
		$stud_chklist = mysql_query("INSERT INTO `stud_chklist` (`svID`, `dType`, `income_proof`, `sponsor`, `name`, `relation`, `gd_sal_state`, `affidavit`, `ca_state1`, `gd_passport`, `comp_regn`, `partnership`, `bal_sheet`, `it_returns`, `ca_state2`, `rental_agrmnt`, `rent_recpt`, `sp_sal_state`, `sp_passport`, `visa`, `otherProof`, `other_proof`, `income_proof_attach`, `gd_sal_state_attach`, `affidavit_attach`, `ca_state1_attach`, `gd_passport_attach`, `comp_regn_attach`, `partnership_attach`, `bal_sheet_attach`, `it_returns_attach`, `ca_state2_attach`, `rental_argmnt_attach`, `rent_recpt_attach`, `sp_sal_state_attach`, `sp_passport_attach`, `visa_attach`, `other_proof_attach`) VALUES ('$svID', '$dType', '$income_proof', '$sponsor', '$name', '$relation', '$gd_sal_state', '$affidavit', '$ca_state1', '$gd_passport', '$comp_regn', '$partnership', '$bal_sheet', '$it_returns', '$ca_state2', '$rental_agrmnt', '$rent_recpt', '$sp_sal_state', '$sp_passport', '$visa', '$otherProof', '$other_proof', '$income_proof_attach', '$gd_sal_state_attach', '$affidavit_attach', '$ca_state1_attach', '$gd_passport_attach', '$comp_regn_attach', '$partnership_attach', '$bal_sheet_attach', '$it_returns_attach', '$ca_state2_attach', '$rental_argmnt_attach', '$rent_recpt_attach', '$sp_sal_state_attach', '$sp_passport_attach', '$visa_attach', '$other_proof_attach')");
	}
	

}
?>

<div id="wrapper_top"></div>
<div id="wrapper">
<?php include("../include/left_stud.php"); ?>
<div class="main_col dotted_border">
<h2>Details</h2>
<br />
<form action="" method="post" enctype="multipart/form-data" name="form">
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
        <td width="68%"><input type="radio" name="finMode" id="lic" value="8" onclick="return financeDetails(this.value);"/> LIC</td>
        </tr>
      <tr>
        <td><input type="radio" name="finMode" id="fd" value="2" onclick="return financeDetails(this.value);"/> Fixed Deposit</td>
        <td><input type="radio" name="finMode" id="pf" value="9" onclick="return financeDetails(this.value);"/> Provident Fund</td>
        </tr>
      <tr>
        <td><input type="radio" name="finMode" id="sav" value="3" onclick="return financeDetails(this.value);"/> Savings</td>
        <td><input type="radio" name="finMode" id="gl" value="10" onclick="return financeDetails(this.value);"/> Gold Loan</td>
      </tr>
      <tr>
        <td colspan="2"><input type="radio" name="finMode" id="otherFinance" value="11" onclick="return financeDetails(this.value);"/> Any other </td>
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
          <td width="32%"><input type="radio" name="dType" id="incProof" value="1" onclick="return docType(this.value);"/> Income Proof </td>
          <td width="68%"><input type="radio" name="dType" id="business" value="3" onclick="return docType(this.value);"/> Rental</td>
        </tr>
        <tr>
          <td><input type="radio" name="dType" id="rental" value="2" onclick="return docType(this.value);"/> Business</td>
          <td><input type="radio" name="dType" id="abroad" value="4" onclick="return docType(this.value);"/> Sponsor Abroad</td>
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




