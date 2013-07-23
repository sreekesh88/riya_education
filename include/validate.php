<?php 
error_reporting(0);
require_once "config.php";
if(COOKIE_TYPE == "admin") $user_table = "admin";
elseif(COOKIE_TYPE == "employee")	$user_table = "employees";

//checks cookies to make sure logged in
if(isset($_COOKIE[COOKIE_NAME]))
{
	$username = $_COOKIE[COOKIE_NAME];
	$pass = $_COOKIE[COOKIE_PASS];
	$check = mysql_query("SELECT * FROM ".$user_table." WHERE username = '$username'");
	while($info = mysql_fetch_array( $check ))
	{
		// If the cookie has the wrong password, redirect to the login page 
		if ($pass != $info['password'])
		{ ?>
			<script type="text/javascript">
				window.location.href = "<?php echo ROOT."/".COOKIE_TYPE."/login.php"; ?>";
			</script>
		<?php }
		// If validated successfully
		else
		{
			break;
		}
	}
}
//if the cookie does not exist, redirect to the login screen
else
{ ?>
	<script type="text/javascript">
		window.location.href = "<?php echo ROOT."/".COOKIE_TYPE."/login.php"; ?>";
	</script>
<?php } ?>