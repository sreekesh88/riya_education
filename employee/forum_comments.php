<?php 
date_default_timezone_set("Asia/Kolkata");
include ("../include/header.php"); 
include ("../include/validate.php"); 
include ("../include/menu.php"); 
$empID = $info['empID'];
$subID = $_GET['subID'];
?>

<script>
/****** Textchange in onblur ******/
var ids = [];
var blurfocus = function(id){
  document.getElementById(id).onfocus = function(){
    if(!ids[id]){ ids[id] = { id : id, val : this.value, active : false }; }
    if(this.value == ids[id].val){
	  this.value = "";
	}
  };
  document.getElementById(id).onblur = function(){
    if(this.value == ""){
	  this.value = ids[id].val;
	}
  }
}
</script>

<?php
$forums = mysql_query("SELECT * FROM `forums` WHERE subID = '$subID'");
$ary = mysql_fetch_array($forums);
$subject = $ary['subject'];
$publishedDate = date("dS M Y",strtotime($ary['date'])).", ".date("h:i a",strtotime($ary['time']));
$employee = $ary['empID'];
$employees = mysql_query("SELECT fname,lname FROM `employees` WHERE empID = '$employee'");
$res = mysql_fetch_array($employees);
$publishedBy = $res['fname']." ".$res['lname'];
 
$likes = $ary['likes'];
if($likes != '') {
$n = explode(",", $likes);
$totalLikes = count($n);
}

$dislikes = $ary['dislikes'];
if($dislikes != '') {
$m = explode(",", $dislikes);
$totalDislikes = count($m);
}

$anonym = $ary['anonymous'];

if(isset($_POST['submit'])) {
	$comment = mysql_real_escape_string($_POST['comment']);
	$email = $info['email'];
	$date = date("Y-m-d");
	$time = date("H:i:s");
	$anonymous = $_POST['anonymous']; 
	$interest = $_POST['interest'];
		
	if($interest == '1') {
		if($likes != '') {
			$array1 = array($likes);
			if(!(in_array($empID,$n))) { 
				$array2 = array($empID); 
				$result = array_merge($array1, $array2);
				$likes = implode(",",$result);
			}
			
			$forum = mysql_query("UPDATE `forums` SET `likes` = '$likes' WHERE subID = '$subID'");
		} else {
			$likes = $empID;
			$forum = mysql_query("UPDATE `forums` SET `likes` = '$likes' WHERE subID = '$subID'");
		}
	} else if($interest == '2') { 
		if($dislikes != '') {
			$array1 = array($dislikes);
			if(!(in_array($empID,$m))) { 
				$array2 = array($empID); 
				$result = array_merge($array1, $array2);
				$dislikes = implode(",",$result);
			}
			
			$forum = mysql_query("UPDATE `forums` SET `dislikes` = '$dislikes' WHERE subID = '$subID'");
		} else {
			$dislikes = $empID;
			$forum = mysql_query("UPDATE `forums` SET `dislikes` = '$dislikes' WHERE subID = '$subID'");
		}
		
	}
	
	if($comment != '') {
	//echo "INSERT INTO `forum_comments` (`subID`, `comment`, `empID`, `email`, `date`, `time`, `anonymous`) VALUES ('$subID', '$comment', '$empID', '$email', '$date', '$time', '$anonymous')";
		$forumComment = mysql_query("INSERT INTO `forum_comments` (`subID`, `comment`, `empID`, `email`, `date`, `time`, `anonymous`) VALUES ('$subID', '$comment', '$empID', '$email', '$date', '$time', '$anonymous')");
		
		if($forumComment > 0) {
			$success = "Posted your comment succesfully";
			?>    
			<script language='javascript'>
			//setTimeout("$('#success').fadeOut('slow')", 3000);
			</script>
			<?php
		}
	}
	echo '<META HTTP-EQUIV=Refresh CONTENT="0; URL=forum_comments.php?subID='.$subID.'">';
}

?>


<div id="wrapper_top"></div>
<div id="wrapper">
<?php include("../include/left.php"); ?>
<div class="main_col dotted_border">
<h2>Comments</h2>
<br />
<div class="fullWidth">
<form action="" method="post" enctype="multipart/form-data" name="postForm">
<table width="90%" border="0" cellspacing="0" cellpadding="0">
  <tr>
	<td colspan="2" class="grey">
  	Posted by <label class="blue"><?php echo $publishedBy; ?></label> on <?php echo $publishedDate; ?></td>
    </tr>
  <tr>
    <td align="center" valign="top"><div class="post_head">Topic</div></td>
    <td valign="top"><div class="green posts"><?php echo $subject; ?></div></td>
  </tr>
  <tr>
    <td align="center" valign="top">&nbsp;</td>
    <td height="40"><table width="350" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="110"><input name="anonymous" id="anonymous" type="checkbox" value="1" title="Make it anonymous!" /> If Anonymous</td>
        <td width="20">
        <?php
		if(((in_array($empID,$n)) == '') && ((in_array($empID,$m)) == '')) { ?>
        <input type="radio" name="interest" id="like" value="1" />
        <?php } ?>
        </td>
        <td width="50"><img src="../images/like.png" alt="dislike" width="56" height="20"/></td>
        <td width="50" class="green"><?php if($totalLikes != '') { echo "(".$totalLikes.")"; } ?></td>
        <td width="20">
        <?php
		if(((in_array($empID,$n)) == '') && ((in_array($empID,$m)) == '')) { ?>
        <input type="radio" name="interest" id="dislike" value="2" />
        <?php } ?></td>
        <td width="70"><img src="../images/dislike.png" alt="dislike" width="68" height="20" style="margin-top:3px;"/></td>
        <td width="30" class="red"><?php if($totalDislikes != '') { echo "(".$totalDislikes.")"; } ?></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td style="padding-bottom:20px;">
    <div id="data">      
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="commentTable">
<?php
$color = 1;
$res = mysql_query("SELECT * FROM `forum_comments` WHERE subID = '$subID' AND delStatus = '0'");
	while($arr = mysql_fetch_array($res)) {
	$comID = $arr['comID'];
	$comment = $arr['comment'];
	$date = date("dS M Y", strtotime($arr['date']));
	$time = date("h:i a",strtotime($arr['time']));
	$employee = $arr['empID'];
	$anon = $arr['anonymous'];

	$qry1 = mysql_query("SELECT photo,fname,lname FROM `employees` WHERE empID = '$employee'");
	while($ary1 = mysql_fetch_array($qry1)) {
	$photo = $ary1['photo'];
	$author = $ary1['fname']." ".$ary1['lname'];
	}

?>

  <tr class="comments">
    <td width="12%" valign="top" style="padding:10px;">
    <?php if($anon != '1') { ?> 
    <img src="../admin/photos/<?php echo $photo; ?>" alt="photo" width="40" height="50" title="<?php echo $author; ?>"/>
    <?php } else { ?>
    <img src="../admin/photos/avatar.png" alt="photo" width="40" height="50" />
    <?php } ?>
    </td>
    <td width="88%" valign="top" style="padding:10px;">
    <label class="dateTime"><?php echo $date.", ".$time; ?></label><br /><br />
	<div class="commentDisplay"><?php echo $comment; ?></div></td>
  </tr>
<?php $color = '2'; } else if($color == '2') { ?>
   <tr class="comments-alt">
    <td width="12%" valign="top" style="padding:10px;">
    <?php if($anon != '1') { ?> 
    <img src="../admin/photos/<?php echo $photo; ?>" alt="photo" width="30" height="40" title="<?php echo $author; ?>"/>
    <?php } else { ?>
    <img src="../admin/photos/avatar.png" alt="photo" width="30" height="40" />
    <?php } ?>
    </td>
    <td width="88%" valign="top" style="padding:10px;">
	<label class="grey"><?php echo $date.", ".$time; ?><br /></label>
<label><?php echo $comment; ?></label></td>
  </tr>
<?php $color = '1'; } ?>
 
<?php } ?>
</table>
</div>
    </td>
  </tr>
  <tr>
    <td align="center" valign="top" style="padding-bottom:20px;">
    <img src="../admin/photos/<?php echo $info['photo']; ?>" alt="pic" width="40" height="50" /><br />    </td>
    <td valign="top" style="padding-bottom:20px;">
    <textarea name="comment" id="comment" class="comment_text" placeholder="Leave your comment here..."></textarea>
    </td>
  </tr>
    <tr>
      <td height="50">&nbsp;</td>
      <td height="50"><input name="submit" value="Post" type="submit" class="button width_150" />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input name="back" value="<<&nbsp;&nbsp;&nbsp;Go Back" type="button" class="button" onclick="history.back()" />
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