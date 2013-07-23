<?php
$action = isset($_POST["action"]) ? $_POST["action"] : "";
$type = isset($_REQUEST["type"]) ? $_REQUEST['type'] : "";
$id = isset($_REQUEST["id"]) ? $_REQUEST['id'] : "";

if (empty($action)) {
if($type == "index") {
	// Send back the contact form HTML
		$output = "<div style='display:none'>
		<div class='contact-top'></div>
		<div class='contact-content'>
			<h1 class='contact-title'>Description</h1>
			<div class='contact-loading' style='display:none'></div>
			<div class='contact-message' style='display:none'></div>";
		$output .= '<table width="100%" border="0" cellspacing="0" cellpadding="0">
					  <tr>
						<td>'.$id.'</td>
					  </tr>
					</table>';	
		$output .= "	
		</div>
		<div class='contact-bottom'></div>
		</div>";
	}
	echo $output;
}

exit;

?>