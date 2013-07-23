<?php include 'config.php'; 
//error_reporting(0);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="Shortcut Icon" href="<?php echo ROOT.'/images/favicon.ico'; ?>" type="image/x-icon" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" href="<?php echo ROOT.'/css/style.css'; ?>" type="text/css">
<link rel="stylesheet" href="<?php echo ROOT.'/css/menu.css'; ?>" type="text/css">

<!-- jQuery Theme -->
<link rel="stylesheet" href="<?php echo ROOT.'/js/jquery-ui/css/base-theme/jquery-ui.css'; ?>" type="text/css">
<script type="text/javascript" src="<?php echo ROOT.'/js/jquery-ui/js/jquery.js'; ?>"></script>
<script type="text/javascript" src="<?php echo ROOT.'/js/jquery-ui/js/jquery-ui-custom.min.js'; ?>"></script>
<link rel="stylesheet" type="text/css" href="<?php echo ROOT.'/js/facebook_beeper_notification/style.css'; ?>" />
<script src="<?php echo ROOT.'/js/facebook_beeper_notification/jquery.facebookBeeper.js'; ?>" type="text/javascript"></script>

</head>

<body>
<div id="container">

<a href="#" class="control" id="popup_control" style="display: none;"></a>
<?php 
session_start();
if (!isset($_SESSION["emp_inbox_count"])) { 
   $_SESSION["emp_inbox_count"] = 0; 
}
?>
<div id="header">
<a href="<?php echo ((COOKIE_TYPE != "reep") ? ROOT."/".COOKIE_TYPE."/" : ROOT."/"); ?>"><div id="logo"></div></a>

<div id="info">
<script>

$(function(){
	$('#popup_control').click();
})
</script>
<?php 


if(isset($_COOKIE[COOKIE_NAME])) { 
if(COOKIE_TYPE == "admin") { 
echo "<span class='infoTxt'>Welcome <b>".$_COOKIE[COOKIE_NAME]."</b></span>";	
echo "<span class='infoTxt'><a href='logout.php' style='color:#09f;'>Logout</a></span>";	
echo "<span class='infoTxt'>".date('l, j')."<sup>".date('S')."</sup>".date('F  Y')."</span>";
	}
else {
$username = $_COOKIE[COOKIE_NAME];
$query = mysql_query("SELECT fname,lname FROM `employees` WHERE username = '$username'");
$ary = mysql_fetch_array($query);
$user = $ary['fname']." ".$ary['lname'];

?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td rowspan="3" align="right"><img src="../employee/photos/1372163863_avatar.png" height="50"/> </td>
  </tr>
  <tr>
    <td align="right"><b><?php echo $user; ?></b></td>
  </tr>
  <tr>
    <td align="right"><a href="logout.php" style="color:#0099FF;text-decoration:none;">Logout</a></td>
  </tr>
</table>
<?php		
	}
} 
  /*<tr>
    <td colspan="2"><a href="emp_inbox.php"><span style="width:25px;"class="infoTxt"><span class="messageBox">'.$_SESSION["emp_inbox_count"].'</span><img src="../images/mailbox.png" width="25" height="25" class="border0" /></span></a></td>
  </tr>*/
?>
</div> <!-- end of info -->
</div> <!--end of header-->

<?php

	$res = mysql_query("SELECT * FROM `employees` WHERE username = '$username' AND delStatus = '0'");
	$empDetails = (mysql_fetch_array($res));
	$query = mysql_query("SELECT * FROM `reminders` WHERE empId = '".$empDetails[0]."' AND delStatus = '0' AND remDate >= NOW()  AND remDate <= DATE_ADD(NOW(), INTERVAL 1 HOUR);");
	$rows = Array();
	?>
	<?php if(mysql_num_rows($query)>0){ ?>
	  <div id="BeeperBox" class="UIBeeper">
         <div class="UIBeeper_Full">
            <div class="Beeps">
               <div class="UIBeep UIBeep_Top UIBeep_Bottom UIBeep_Selected" style="opacity: 1; ">
               <!-- Below Is The Link To Which Bepper Will Point To (replace # with the required link) -->
                  <a class="UIBeep_NonIntentional" href="#">
                     <span class="beeper_x">&nbsp;</span>
                     <div class="UIBeep_Title">
                     	<span ><b style="font-size: 9px; color: rgb(255, 255, 255); font-weight: bold;">Reminders to be executed within 1 hour</b></span>
						  <br/>
						   <u><i><b>
							   <div style="float: left; width:150px;">Reminder </div>
							   <div class="timeDisplay" style="float: right;">Time</div>
						   </b></i></u> <br/>
						   <hr></hr>
							<?php
							while($row = mysql_fetch_array($query)){
								if(strlen($row['reminder']) > 25){  
									$row['reminder'] = substr($row['reminder'], 0, 25).'...';
								}
								$timestamp = strtotime($row['remDate']);
								$hour = date('G',$timestamp);
								if($hour > 12){
									$timestamp = date("@ h:i", $timestamp)." pm";
								}else{
									$timestamp = date("@ H:i", $timestamp);
								}
							?>
							  <div> <div class="blueName"><?php echo $row['reminder']?> :</div>
							   <div class="timeDisplay"><?php echo $timestamp;?></div>
							   </div>
							   
							  <?php 
							}
							?>
			         </div>
		                  </a>
		               </div>
		            </div>
		         </div>
		      </div>
	<?php 
		}
	?>