<?php 
include ("../include/validate.php"); 
include("../include/config.php");
$conID = '';
$pgmID = '';

?>
<?php
if(isset($_POST)) {
	$pgmID = $_POST['program'];
	$conID = $_POST['country'];
	$spID = $_POST['subPgm'];
	
	$row1 = mysql_query("SELECT program FROM `programs` WHERE pgmID = '$pgmID'");
	$ary1 = mysql_fetch_array($row1);
	$program = $ary1['program'];
	$row2 = mysql_query("SELECT country FROM `countries` WHERE conID = '$conID'");
	$ary2 = mysql_fetch_array($row2);
	$country = $ary2['country'];
}	
?>
<script type="text/javascript">
	function fnName(id,pgmID,spID) {
		$.ajax({  
		url: "get_instn_details.php?id="+id+"&pid="+pgmID+"&spid="+spID,
		success: function(data){
			$("#dialog").html(data);
		}   
	});
	
	$("#dialog").dialog(
		   {
			bgiframe: true,
			autoOpen: false,
			height: 300,
			width: 500,
			modal: true,
			show: 'fade',
			  close: 'fade'
		   }
	);
		$('#dialog').dialog('open'); 
		$('#ui-id-1').html("<?php echo $program; ?> in  <?php echo $country; ?>");

	}
</script>
<?php

if(isset($_POST)) { ?>
<div id="fullWidth">

<h6>Search results for <b><?php echo $program; ?></b> in <b><?php echo $country; ?></b></h6>
<br>
    
    
    
<div class="ul-li" style="padding-bottom: 50px;">
<ul>
<?php 
$color = 1;
/*$query1 = mysql_query("SELECT insID FROM `pgm-con-ins` WHERE pgmID = '$pgmID' AND conID = '$conID'");
$total_rows = mysql_num_rows($query1);	
if($total_rows > 0) {
	while($row1 = mysql_fetch_array($query1)) {
		$row1['insID']."<br>";
		
	}*/	
$query2 = mysql_query("SELECT * FROM `instn-subpgm` WHERE spID = '$spID'");
while($row2 = mysql_fetch_array($query2)) {
	$instnID = $row2['insID'];
	$spID = $row2['spID'];
	$query3 = mysql_query("SELECT * FROM `institutions` WHERE insID = '$instnID'");
	while($row3 = mysql_fetch_array($query3)) {
		if($color == 1) {
				echo '<li style="background-color:#eee;"><a href="javascript:void(0);" onclick="fnName('.$row3['insID'].','.$pgmID.','.$spID.')">'.$row3['institution'].'</a></li>';
				$color = 2;
			} else {
				echo '<li><a href="javascript:void(0);" onclick="fnName('.$row3['insID'].','.$pgmID.','.$spID.')">'.$row3['institution'].'</a></li>';
				$color = 1;
			}
	}
}
/*} else {
    echo "<span class='alert'>No such results!!!</span>";
}*/
?>
</ul>
</div>
    
    
    
</div>
<div id="dialog"></div>

<?php } ?>
