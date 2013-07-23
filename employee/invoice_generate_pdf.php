<?php 
include ("../include/validate.php"); 
include("../include/config.php");
include('../include/tcpdf/tcpdf.php'); 
$empID = $info['empID'];
$filename == 'student_details';
$html = $_POST['htmlContent'];
if(isset($_POST['htmlContent'])){
	$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

	$pdf->SetCreator(PDF_CREATOR);
	$pdf->SetAuthor($name);
	$pdf->SetTitle('TCPDF Exasmple 006');
	$pdf->SetSubject('TCPDF Tutorial');
	$pdf->SetKeywords('TCPDF, PDF, example, test, guide');
	
	// set default header data
	$pdf->SetHeaderData('logo1.png', '80px');
	
	// set header and footer fonts
	$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
	$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
	
	// set default monospaced font
	$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
	
	// set margins
	$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
	$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
	$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
	
	// set auto page breaks
	$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
	
	// set image scale factor
	$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
	
	// set some language-dependent strings (optional)
	if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	    require_once(dirname(__FILE__).'/lang/eng.php');
	    $pdf->setLanguageArray($l);
	}
	
	// ---------------------------------------------------------
	
	// set font
	$pdf->SetFont('dejavusans', '', 10);
	
	// add a page
	$pdf->AddPage();
		$pdf->Write(0, 'Invoice', '', 0, 'L', true, 0, false, false, 0);
	$pdf->Write(0, ' ', '', 0, 'L', true, 0, false, false, 0);
	
	$style = '<style>
		    table {
		    	border:1px solid #CCCCCC;
		    }
		    td {
		    	border:0px solid #CCCCCC;
		    }
		    th {
			    border:1px solid #CCCCCC;
			    color : #800101;
			    text-align: center;
		    }
	    </style>';

	$pdf->writeHTML($html, true, false, true, false, '');
	$pdf->Output('ssss.pdf', 'I');
} else if($_POST['excel']){
	header('Content-type: application/ms-excel');
	header('Content-Disposition: attachment; filename='.$filename.'.xls');
	echo $newhtml;;
}
?>

