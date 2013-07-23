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
<h2>Discussion Board</h2>
<br />
<div class="fullWidth">

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table">
  <tr>
    <th width="7%" align="center">No</th>
    <th width="40%" align="left" class="padding_2">Title of the Post</th>
    <th width="25%" align="center">Date Published</th>
    <th width="15%" class="padding20">Published by</th>
    <th width="13%" align="center">Comments</th>
  </tr>
  
<?php
$counter = 1;
$color = 1;
$qry = mysql_query("SELECT * FROM `posts`");
while($ary = mysql_fetch_array($qry)) {
$postID = $ary['postID'];
$employee = $ary['empID'];

$res = mysql_query("SELECT postID FROM `comments` WHERE postID = '$postID'");
$com_count = mysql_num_rows($res);

$title = $ary['title'];
$publishedDate = date("dS M Y",strtotime($ary['date'])).", ".date("h:i a",strtotime($ary['time']));

$qry1 = mysql_query("SELECT fname,lname FROM `employees` WHERE empID = '$employee'");
while($ary1 = mysql_fetch_array($qry1)) {
$author = $ary1['fname']." ".$ary1['lname'];	
} 

?>
<?php if($color == '1') { ?>  
  <tr>
    <td align="center"><?php echo $counter++; ?></td>
    <td><a href="comments.php?postID=<?php echo $postID; ?>"><?php echo $title; ?></a></td>
    <td align="center"><span style="font-size:11px;"><?php echo $publishedDate; ?></span></td>
    <td align="center"><i><?php echo $author; ?></i></td>
    <td class="padding20" align="center"><?php echo $com_count; ?></td>
  </tr>
<?php $color = '2'; } else if($color == '2') { ?>  
  <tr bgcolor="#f5f5f5">
    <td align="center"><?php echo $counter++; ?></td>
    <td><a href="comments.php?postID=<?php echo $postID; ?>"><?php echo $title; ?></a></td>
    <td align="center"><span style="font-size:11px;"><?php echo $publishedDate; ?></span></td>
    <td align="center"><i><?php echo $author; ?></i></td>
    <td class="padding20" align="center"><?php echo $com_count; ?></td>
  </tr>
<?php $color = '1'; } ?>
<?php } ?>  
</table>

</div>

</div>
</div>

<?php include("../include/footer.php"); ?>

</div> <!--end of container-->
</body>
</html>