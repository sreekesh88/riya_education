<?php 
include ("../include/header.php"); 
include ("../include/validate.php"); 
include ("../include/menu.php"); 
$empID = $info['empID'];
?>

<?php
$success = '';
$email = $info['email'];
$date = date("Y-m-d");
$time = date("H:i:s"); 

if(isset($_POST['submit'])) {

$subject = mysql_real_escape_string($_POST['subject']);

if($subject != '') {
	$qry = mysql_query("INSERT INTO `forums` (`subject`, `empID`, `email`, `date`, `time`) VALUES ('$subject', '$empID', '$email', '$date', '$time')");
	if($qry > 0) {
		$success = "Your Subject has been submitted successfully!";
		header("refresh:1, url=forums.php");
	}
}
}
?>

<div id="wrapper_top"></div>
<div id="wrapper">
<?php include("../include/left.php"); ?>
<div class="main_col dotted_border">
<h2>New Discussion</h2>
<br />
<div class="fullWidth">
<form action="" method="post" enctype="multipart/form-data" name="forum">
<table width="80%" border="0" cellspacing="0" cellpadding="0" class="pad">
    <tr>
      <td height="50">
      Topic <br>
      <input name="subject" id="subject" type="text" class="textbox width_440">
      <label id="errorSubject" class="error"></label>
      </td>
    </tr>
    <tr>
      <td>
      <input name="submit" value="Submit" type="submit" class="button width_200" id="click">
      <span class="red"><?php echo $success; ?></span>
      </td>
    </tr>
  </table>
</form>

</div>

</div>
</div>

<?php include("../include/footer.php"); ?>

</div> <!--end of container-->
</body>
</html>