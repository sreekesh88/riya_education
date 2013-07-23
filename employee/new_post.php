<?php 
include ("../include/header.php"); 
include ("../include/validate.php"); 
include ("../include/menu.php"); 
$empCode = $info['empCode'];
?>

<script type="text/javascript">
function validateForm () {
	if($('#title').val() == ''){
        $('#errorTitle').html(" Please enter the Title");
        $('#title').focus();
        return false;
    }else{
        $('#errorTitle').html("");
    }
	
	if($('#post').val().trim().length == 0){ 
        $('#errorPost').html(" Please enter the Message");
        $('#post').focus();
        return false;
    }else{ 
        $('#errorPost').html("");
    }
}

</script>

<?php
$success = '';
$email = $info['email'];
$date = date("Y-m-d");
$time = date("H:i:s"); 

if(isset($_POST['submit'])) {

$title = $_POST['title'];
$post = mysql_real_escape_string($_POST['post']);

if($title != '') {
	$qry = mysql_query("INSERT INTO `posts` (`title`, `post`, `empCode`, `email`, `date`, `time`) VALUES ('$title', '$post', '$empCode', '$email', '$date', '$time')");
	if($qry > 0) {
		$success = "Your Topic has been posted successfully!";
		header("refresh:1, url=posts.php");
	}
}
}
?>

<div id="wrapper_top"></div>
<div id="wrapper">
<?php include("../include/left.php"); ?>
<div class="main_col dotted_border">
<h2>Creata new post</h2>
<br />
<div class="fullWidth">

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="pad">
<tr>
  <td colspan="4" align="left">
  
  <form action="" method="post" enctype="multipart/form-data" name="postForm" onSubmit="return validateForm();">
  <table width="80%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td>
      Title of the Post <br>
      <input name="title" id="title" type="text" class="textbox width_440">
      <label id="errorTitle" class="error"></label>
      </td>
    </tr>
    <tr>
      <td>
      Content <br>
      <textarea name="post" id="post" class="textarea_dotted width_440"></textarea>
      <label id="errorPost" class="error"></label></td>
    </tr>
    <tr>
      <td>
      <input name="submit" value="Publish your Post" type="submit" class="button" id="click">
      <span style="color:#F00;"><?php echo $success; ?></span>
      </td>
    </tr>
  </table>
  </form>
  
  </td>
</tr>
</table>

</div>

</div>
</div>

<?php include("../include/footer.php"); ?>

</div> <!--end of container-->
</body>
</html>