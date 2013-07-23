<?php 

include("../include/config.php");
error_reporting(0);
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

<span class="heading1">Search results for <b><?php echo $program; ?></b> in <b><?php echo $country; ?></b></span>
<br><br>   
    
    
<div class="searchBox" style="padding-bottom: 50px;">
<ul>
<?php 
$color = 1;
$query2 = mysql_query("SELECT * FROM `instn-subpgm` WHERE spID = '$spID'");
while($row2 = mysql_fetch_array($query2)) {
	$instnID = $row2['insID'];
	$spID = $row2['spID'];
	$query3 = mysql_query("SELECT * FROM `institutions` WHERE insID = '$instnID'");
	while($row3 = mysql_fetch_array($query3)) {
		if($color == 1) {
				echo '<li style="background-color:#f6f6f6;"><a href="javascript:void(0);" onclick="fnName('.$row3['insID'].','.$pgmID.','.$spID.')">'.$row3['institution'].'</a></li>';
				$color = 2;
			} else {
				echo '<li><a href="javascript:void(0);" onclick="fnName('.$row3['insID'].','.$pgmID.','.$spID.')">'.$row3['institution'].'</a></li>';
				$color = 1;
			}
	}
}
?>
</ul>
</div>
    
    
    
</div>
<div id="dialog"></div>

<?php } ?>
