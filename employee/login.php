<?php include ("../include/header.php"); ?>

<?php
$error = "";
//Checks if there is a login cookie
if(isset($_COOKIE[COOKIE_NAME]))
//if there is, logs the user in, and directs to the welcome page
{
	$username = $_COOKIE[COOKIE_NAME]; 
	$pass = $_COOKIE[COOKIE_PASS];
	$check = mysql_query("SELECT * FROM `employees` WHERE username = '$username'") or die(mysql_error());
	while($info = mysql_fetch_array( $check )) 
	{
		if ($pass != $info['password']) 
		{
		}
		else
		{		 
		?>
		<script type="text/javascript">
            window.location.href = "index.php";
        </script>
		<?php }
	}
}

//if the login form is submitted
if (isset($_POST['login'])) { // if form has been submitted

	// makes sure its filled in
	if((!$_POST['username'] | !$_POST['password']) or ($_POST['username'] == "Username" | $_POST['password'] == "Password")) {
		//die('You did not fill in a required field.');
		$error = "<div class='success' style='color:#be0000;'>User does not exist in our database.</div>";
	}
	
	// checks it against the database
	$check = mysql_query("SELECT * FROM `employees` WHERE username = '".$_POST['username']."' AND deptID = '".$_POST['department']."';")or die(mysql_error());

	//Gives error if user doesn't exist
	$check2 = mysql_num_rows($check);
	if ($check2 == 0) {
		//die('That user does not exist in our database.'); 
		$error = "<div class='success' style='color:#be0000;'>User does not exist in our database.</div>";
	}

	while($info = mysql_fetch_array( $check )) 
	{
		$_POST['password'] = stripslashes($_POST['password']);
		$info['password'] = stripslashes($info['password']);
		$_POST['password'] = md5($_POST['password']);

		//gives error if the password is wrong
		if ($_POST['password'] != $info['password']) {
			//die('Incorrect password, please try again.');
			$error = "<div class='success' style='color:#be0000;'>Incorrect password, please try again.</div>";
		}

		else 
		{ 
			session_start();
            $_SESSION['logged_in'] = true;
			$username = $_POST['username'];		
			
			$_SESSION['is_user'] = $info['deptID'];	

			$query = mysql_query("SELECT fname,lname FROM `employees` WHERE username = '$username'");
			while($array = mysql_fetch_array($query)) {
			$_SESSION['user'] = $array['fname']." ".$array['lname'];
			}
			
			// if login is ok then, add a cookie 
			$_POST['username'] = stripslashes($_POST['username']);
			$hour = time() + 3600;
			?>
            <script src="../js/cookies.js" type="text/javascript"></script>
            <script type="text/javascript">
				var today = new Date();
				var expiry = new Date(today.getYear(), today.getMonth()+1, today.getDate());
				if(navigator.appName != "Netscape") {
					setCookie("<?php echo COOKIE_NAME; ?>", "<?php echo $_POST['username']; ?>", expiry);
					setCookie("<?php echo COOKIE_PASS; ?>", "<?php echo $_POST['password']; ?>", expiry);
				} else {
					document.cookie = "<?php echo COOKIE_NAME."=".$_POST['username'].";expires=".$hour; ?>";
					document.cookie = "<?php echo COOKIE_PASS."=".$_POST['password'].";expires=".$hour; ?>";
				}
				
				window.location.href = "index.php";
			</script>
            <?php
			setcookie(COOKIE_NAME, $_POST['username'], $hour);
			setcookie(COOKIE_PASS, $_POST['password'], $hour);
		} 
	}
} 
?>

<script language="javascript" type="text/javascript" src="../js/login.js"></script>
<div id="wrapper_top"></div>
<div id="wrapper" align="center" style="padding-top: 50px;">

<div id="emp_login">
<form action="" method="post" enctype="multipart/form-data" name="login_form">
<div class="login_box" style="padding-top:14px;">
<div class="styled">
<select name="department">
<option value="" selected="selected" class="padding_2">Select Department</option>
<?php
$dept = mysql_query("SELECT * FROM `departments` ORDER BY department ASC");
while($row = mysql_fetch_array($dept)) {
	echo '<option value="'.$row['deptID'].'" class="padding_2">'.$row['department'].'</option>';
}
?>
</select>
</div>
<script type="text/javascript">writeInputBox('username');</script>
<script type="text/javascript">writeInputBox('password');</script>
<input name="login" type="submit" class="login_button" value="" />
  <div align="center" style="font-size: 11px; color:#f00; padding-top: -8px; ">
	<?php
        if (isset ($_GET['response']))
        {
			if ($_GET['response']=="1")
			{
			  echo "<div class='success' style='color:#be0000;'>You are successfully logged out!</div>";
			  //echo '<META HTTP-EQUIV=Refresh CONTENT="1; URL=login.php">';
			}
        }
    ?>
	<?php echo $error; ?>    
		<script language='javascript'>
        setTimeout("$('.success').fadeOut('slow')", 1000);
        </script>
  </div>
</div>
</form>
</div>

</div>

<?php include("../include/footer.php"); ?>


</div> <!--end of container-->
</body>
</html>
