<?php include ("../include/header.php"); 
include ("../include/validate.php"); 
include ("../include/menu.php"); 
$empCode = $info['empCode'];
$postID = $_GET['postID'];
?>

<?php
$action = isset($_REQUEST['action'])?$_REQUEST['action'] :'';

if($action == 'delete')
{
$query = mysql_query("UPDATE `comments` SET delStatus = '1' WHERE comID ='".$_REQUEST['id']."'");
header("location: comments.php?postID=".$postID);
}
?>

<script type="text/javascript">
function confirm_delete(id)
{
	var pid = <?php echo $postID; ?>;
	var r=confirm("Are you sure to delete this comment?");
	if (r==true)
 	{
	 window.location = "comments.php?postID="+pid+"&id="+id+"&action=delete";
  	}
	else
	{
	 window.location = "comments.php?postID="+pid;
	}
}

function validateForm () {	
	if($('#comment').val().trim().length == 0){ 
        $('#errorComment').html(" Please enter a reply before posting!");
        $('#comment').focus();
        return false;
    }else{ 
        $('#errorComment').html("");
    }
}

var auto_refresh = setInterval(
function()
{
<?php /* ?>$('#data').fadeOut('slow').load('data.php?postID=<?php echo $postID; ?>').fadeIn("slow");<?php */?>
$('#data').load('data.php?postID=<?php echo $postID; ?>');
}, 10000);

</script>

<?php
$qry = mysql_query("SELECT * FROM `posts` WHERE postID = '$postID'");
$ary = mysql_fetch_array($qry);
$title = $ary['title'];
$post = $ary['post'];
$publishedDate=date("dS M Y",strtotime($ary['date'])).", ".date("h:i a",strtotime($ary['time']));

$email = $info['email'];

if(isset($_POST['submit'])) {

$date = date("Y-m-d");
$time = date("H:i:s"); 
$comment = mysql_real_escape_string($_POST['comment']); 

if($comment != '') {
	$qry = mysql_query("INSERT INTO `comments` (`postID`, `comment`, `empCode`, `email`, `date`, `time`) VALUES ('$postID', '$comment', '$empCode', '$email', '$date', '$time')");
	if($qry > 0) {
		header("location:comments.php?postID=$postID");
	}
}
}
?>

<div id="wrapper_top"></div>
<div id="wrapper">
<?php include("../include/left.php"); ?>
<div class="main_col dotted_border">
<h2>Discussion Board</h2>
<br />
<div class="fullWidth" align="center">
  
<form action="" method="post" enctype="multipart/form-data" name="postForm" onSubmit="return validateForm();">
  <table width="90%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td style="padding-bottom:20px;">
      <span style="color:#0FA1E0;">Title of the Post: </span>
      <b style="color:#900;"><?php echo $title; ?></b>
      </td>
    </tr>
    <tr>
      <td style="padding-bottom: 20px;">
      <label style="color:grey;">Published on <?php echo $publishedDate; ?></label>
      <div class="posts"><?php echo $post; ?></div>
      </td>
    </tr>
    <tr>
      <td align="left" style="padding-bottom:20px;">
<div id="data">      
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<?php
$color = 1;
$res = mysql_query("SELECT * FROM `comments` WHERE postID = '$postID' AND delStatus = '0'");
	while($arr = mysql_fetch_array($res)) {
	$comID = $arr['comID'];
	$comment = $arr['comment'];
	$date = date("dS M Y", strtotime($arr['date']));
	$time = date("h:i a",strtotime($arr['time']));
	$employee = $arr['empCode'];

	$qry1 = mysql_query("SELECT fname, lname FROM `employees` WHERE empCode = '$employee'");
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
    <?php if($employee == $empCode) { ?>
    <div class="delete"><a href="#" title="Delete" onclick="return confirm_delete(<?php echo $comID; ?>)"> X </a></div>
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
    <?php if($employee == $empCode) { ?>
    <div class="delete"><a href="#" title="Delete" onclick="return confirm_delete(<?php echo $comID; ?>)"> X </a></div>
    <?php } ?>
    <label><?php echo $comment; ?></label></td>
  </tr>
<?php $color = '1'; } ?>
 
<?php } ?>
</table>
</div>
      </td>
    </tr>
    <tr>
      <td>
      Leave your reply <br>
      <textarea name="comment" id="comment" class="textarea_dotted width_440"></textarea>
      <label id="errorComment" class="alert"></label></td>
    </tr>
    <tr>
      <td height="50">
      <input name="submit" value="Post your Reply" type="submit" class="button">
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <input name="back" value="<<&nbsp;&nbsp;&nbsp;Go Back" type="button" class="button" onclick="history.back()">
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