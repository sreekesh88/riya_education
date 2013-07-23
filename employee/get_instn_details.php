<?php
include("../include/config.php");
$insID = $_GET['id'];
$pgmID = $_GET['pid'];    //program id
$spID = $_GET['spid'];

$subPGM = "";
$pgmIntake = "";
$pgmFees = "";
$inst = "";

?>
<script>

function add_to_session(domObj){
	data = {
			course:{
			'details' : $('#ui-id-1').html(),
			'pgmIntake' : $('#pgmIntake').val(),
			'subPgm' : $('#subPGM').val(),
			'pgmFees' : $('#pgmFees').val(),
			},
			institution : {
				'inst' : $('#inst').val(),
			}
	};
	$.ajax({ 
		url: "session_e_cart.php",
		method : "POST",
		data : data,
		success: function(data){
			$('#basketCount').html('('+data+')');
			$('#dialog').dialog('close');
		}   
	});
   
}
</script>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="40" valign="top">Institution</td>
    <td valign="top">:</td>
    <td valign="top" class="blue"><b>
    <?php
		$result = mysql_query("SELECT * from `institutions` WHERE insID = '$insID'");
		$qry = mysql_fetch_array($result);
		$inst = $qry['institution'];
		echo $qry['institution'];
	?></b>
    </td>
  </tr>
  <tr>
    <td height="40" valign="top">Course</td>
    <td valign="top">:</td>
    <td valign="top">
<?php	
$query = mysql_query("SELECT * FROM `instn-subpgm` WHERE insID = '$insID' AND spID = '$spID'");

while($res = mysql_fetch_array($query)) {
	//echo $spID = $res['spID'];
 	$isID = $res['isID']."<br>";
	
	$qry1 = mysql_query("SELECT * FROM `subprograms` WHERE spID = '$spID'");
	while($row1 = mysql_fetch_array($qry1)) {	
		$subPGM = 	$row1['subpgm'];
		echo '<div class="row blue">
	<img src="../images/arrow-bright.png" alt="arrow" /> '.$row1['subpgm'].'<br>';
	$proDetails = mysql_query("SELECT * FROM `prodetails` WHERE isID = '$isID'");
		$pd = mysql_fetch_array($proDetails);
		if($pd['intake'] != '') {
			$pgmIntake = $pd['intake'];
			echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="green">Program Intake : '.$pd['intake'].'</span><br>';
		}
		if($pd['fees'] != '') {
			$pgmFees = $pd['fees'];
			echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="red">Program Fees : '.$pd['fees'].'</span><br><br>';
		}
	echo '</div><br>';
		
	}
	
	/*$qry2 = mysql_query("SELECT * FROM `proDetails` WHERE isID = '$isID'");
	while($row2 = mysql_fetch_array($qry2)) {
		echo $row2['fees'];
	}*/
}
?>
<input type="hidden" name="subPGM" id="subPGM" value="<?php echo $subPGM;?>"/>
<input type="hidden" name="pgmIntake" id="pgmIntake" value="<?php echo $pgmIntake;?>"/>
<input type="hidden" name="pgmFees" id="pgmFees" value="<?php echo $pgmFees;?>"/>
<input type="hidden" name="inst" id="inst" value="<?php echo $inst;?>"/>
	</td>
  </tr>
   <?php if(!strpos($_SERVER['HTTP_REFERER'],'enquiry')){ ?>
  <tr>
  	 <td align="center"colspan="3"><button id="add_to_cart" class="button" align="center" onClick="add_to_session(this)">Add to Riya e-cart</button></td>
  </tr>
  <?php } ?>

</table>



