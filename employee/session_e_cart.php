<?php 
session_start();

if (!isset($_SESSION["session_data"])) { 
   $_SESSION["session_data"] = array(); 
} 
//check for current product in visitor's shopping cart content 
$i=0; 
$update = true;

while ($i<count($_SESSION["session_data"]) ){
	$i++; 
}
for($j=0; $j<count($_SESSION["session_data"]); $j++){
	if(($_SESSION["session_data"][$j]['course']['details'] == $_POST['course']['details'] &&
		 $_SESSION["session_data"][$j]['course']['pgmIntake'] == $_POST['course']['pgmIntake'] &&
		 $_SESSION["session_data"][$j]['course']['subPgm'] == $_POST['course']['subPgm'] &&
		 $_SESSION["session_data"][$j]['course']['pgmFees'] == $_POST['course']['pgmFees'] &&
		 $_SESSION["session_data"][$j]['institution']['inst'] == $_POST['institution']['inst'])){
		$update = false;
	}
}
if ($i < count($_SESSION["session_data"])) //increase current product's item quantity 
{ 
    $_SESSION["session_data"][$i]++; 
} 
else //no such product in the cart - add it 
{ 
	if($update){
    	$_SESSION["session_data"][] = $_POST;
	} 
}
echo count($_SESSION["session_data"]);
?>
