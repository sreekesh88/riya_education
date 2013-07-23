<?php 
include ("../include/header.php"); 
include ("../include/validate.php"); 
include ("../include/menu.php"); 
$empCode = $info['empCode'];
$id = $_GET['id'];
$result = mysql_query("SELECT country FROM `countries` WHERE conID = '$id'");
$row = mysql_fetch_array($result);
$country = $row['country'];
?>

<div id="wrapper_top"></div>
<div id="wrapper">

<?php include("../include/left.php"); ?>

<div class="main_col dotted_border">
<h2><?php echo $country; ?></h2>
<br />

<div class="fullWidth">

<div class="ul-li">
<h6>List of Universities and Colleges</h6>
<br />
<ul>
<?php 
$color = 1;
$query = mysql_query("SELECT institution from `institutions` WHERE conID = '$id'");
while($res = mysql_fetch_array($query)) {
	if($color == 1) {
		echo '<li style="background-color:#eee;"><a href="#">'.$res['institution'].'</a></li>';
		$color = 2;
	}
	else {
		echo '<li><a href="#">'.$res['institution'].'</a></li>';
		$color = 1;
	}
}
?>
</ul>
</div>

</div>

</div>
</div>

<?php include("../include/footer.php"); ?>

</div> <!--end of container-->
</body>
</html>