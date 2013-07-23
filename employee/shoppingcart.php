<?php 
date_default_timezone_set("Asia/Kolkata");
include ("../include/header.php"); 
include ("../include/validate.php"); 
include ("../include/menu.php"); 
?>

<script>
function proceedToRegistration(domObj){
	cartObj = domObj.parentNode.parentNode.getElementsByTagName("td");
	arrayObj = {};
	for (var val in cartObj){
		arrayObj[cartObj[val].id] = cartObj[val].innerHTML;
	}
	
	$('#e-cart-session_data').val(JSON.stringify(arrayObj));
	$('#this_form').submit();
	return false;
}

</script>
<div id="wrapper_top"></div>
<div id="wrapper">

<div class="full_col">
<h2>Riya e-cart</h2>
<br />

<div class="fullWidth">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tablegeneral">
  <tr>
    <th width="5%">No</th>
    <th width="20%">Details</th>
    <th width="10%">Program Intake</th>
    <th width="30%">Sub Program</th>
    <th width="10%">Program Fees</th>
    <th width="25%">Institution</th>
    <th width="5%">Action</th>
  </tr>
<?php
if(isset($_POST['clearEcart'])){
	unset($_SESSION['session_data']);
}
$count = 0;
if(count($_SESSION['session_data']) == 0){
	?>
	<tr style="text-align: center">
		<td colspan="7" align="center" style="color: red">--Cart is empty -- <br/>Please <a href="<?php echo ROOT.'/employee/search_program.php'; ?>">Click Here</a> to go to Program Search Page</td>
	</tr>
	<?php 
}
foreach($_SESSION['session_data'] as $session){
	$count++;
	?>
		<tr style="text-align: center">
			<td><?php echo $count;?></td>
			<td id="details"><?php echo $session['course']['details'];?></td>
			<td id="pgmIntake"><?php echo $session['course']['pgmIntake'];?></td>
			<td id="subPgm"><?php echo $session['course']['subPgm'];?></td>
			<td id="pgmFees"><?php echo $session['course']['pgmFees'];?></td>
			<td id="inst"><?php echo $session['institution']['inst'];?></td>
			<td>
				<a href="javascript:void(0);" onclick="return proceedToRegistration(this);">Proceed</a>
			</td>
		</tr>
<?php }
?>

</table>
<form action="student_add.php" method="post" id="this_form">
	<input type="hidden" name="e-cart-session_data" id="e-cart-session_data" value=""/>
</form>
</div>
<br/>
<form action ="" method="post">
	<input style="float:right;" class="button" type="submit" name="clearEcart" value="Clear e-Cart" />
</form>
</div>
</div>
<?php include ("../include/footer.php"); ?>