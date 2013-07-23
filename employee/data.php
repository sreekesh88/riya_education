<?php
include("../include/config.php");
$postID = $_GET['postID'];

if(isset($_COOKIE[COOKIE_NAME]))
{
	$username = $_COOKIE[COOKIE_NAME];
	$pass = $_COOKIE[COOKIE_PASS];
	$check = mysql_query("SELECT * FROM `employees` WHERE username = '$username'");
	while($info = mysql_fetch_array( $check ))
	{
		$empID = $info['empID'];
	}
}

?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<?php
$color = 1;
$res = mysql_query("SELECT * FROM `comments` WHERE postID = '$postID' AND delStatus = '0'");
	while($arr = mysql_fetch_array($res)) {
	$comID = $arr['comID'];
	$comment = $arr['comment'];
	$date = date("dS M Y", strtotime($arr['date']));
	$time = date("h:i a",strtotime($arr['time']));
	$employee = $arr['empID'];

	$qry1 = mysql_query("SELECT fname, lname FROM `employees` WHERE empID = '$employee'");
	while($ary1 = mysql_fetch_array($qry1)) {
	$author = $ary1['fname']." ".$ary1['lname'];
	}

?>
<?php if($color == '1') { ?>
  <tr class="comments">
    <td width="25%" valign="top" style="padding:10px;">
	<label><?php echo $date.", ".$time; ?><br /> By </label>
    <span style="color:#f00;font-size:11px;"><i><?php echo $author; ?></i></span>
    </td>
    <td width="75%" valign="top" style="padding:10px;">
    <?php if($employee == $empID) { ?>
    <div class="delete"><a href="" title="Delete" onclick="return confirm_delete(<?php echo $comID; ?>)"> X </a></div>
    <?php } ?>
    <label><?php echo $comment; ?></label></td>
  </tr>
<?php $color = '2'; } else if($color == '2') { ?>
   <tr class="comments-alt">
    <td width="25%" valign="top" style="padding:10px;">
	<label><?php echo $date.", ".$time; ?><br /> By </label>
    <span style="color:#f00;font-size:11px;"><i><?php echo $author; ?></i></span>
    </td>
    <td width="75%" valign="top" style="padding:10px;">
    <?php if($employee == $empID) { ?>
    <div class="delete"><a href="" title="Delete" onclick="return confirm_delete(<?php echo $comID; ?>)"> X </a></div>
    <?php } ?>
    <label><?php echo $comment; ?></label></td>
  </tr>
<?php $color = '1'; } ?>
 
<?php } ?>
</table>