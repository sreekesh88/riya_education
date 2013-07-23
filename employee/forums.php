<?php 
include ("../include/header.php"); 
include ("../include/validate.php"); 
include ("../include/menu.php"); 
$empID = $info['empID'];
?>

<div id="wrapper_top"></div>
<div id="wrapper">
<?php include("../include/left.php"); ?>
<div class="main_col dotted_border">
<h2>Discussions</h2>
<br />
<div class="fullWidth">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table">
  <tr>
    <th width="7%" align="center">No</th>
    <th width="40%" align="left" class="padding_2">Subject</th>
    <th width="25%" align="center">Date Published</th>
    <th width="15%" class="padding20">Published by</th>
    <th width="13%" align="center">Comments</th>
  </tr>
  <?php
  $counter = 1;
  $forums = mysql_query("SELECT * FROM `forums` WHERE delStatus = '0'");
  while($rows = mysql_fetch_array($forums)) {
  	$subID = $rows['subID'];	
	
	$comments = mysql_query("SELECT subID FROM `forum_comments` WHERE subID = '$subID'");
	$com_count = mysql_num_rows($comments);
	
	$subject = $rows['subject'];
	$publishedOn = date("dS M Y",strtotime($rows['date'])).", ".date("h:i a",strtotime($rows['time']));
	
	$employeeID = $rows['empID'];
  	$employees = mysql_query("SELECT fname,lname FROM `employees` WHERE empID = '$employeeID'");
	while($row = mysql_fetch_array($employees)) {
		$publishedBy = $row['fname']." ".$row['lname'];	
	} 
  ?>
  <tr>
    <td align="center"><?php echo $counter++; ?></td>
    <td align="left"><a href="forum_comments.php?subID=<?php echo $subID; ?>"><?php echo $subject; ?></a></td>
    <td align="center"><label><?php echo $publishedOn; ?></label></td>
    <td align="center"><i><?php echo $publishedBy; ?></i></td>
    <td align="center"><?php echo $com_count; ?></td>
  </tr>
  <?php } ?>
</table>  
</div>

</div>
</div>

<?php include("../include/footer.php"); ?>

</div> <!--end of container-->
</body>
</html>