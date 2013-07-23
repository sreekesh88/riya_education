<?php include ("../include/header.php"); 
include ("../include/validate.php"); 
include ("../include/menu.php"); 
$adID = $_GET['id'];

$query = mysql_query("SELECT * FROM `advertisements` WHERE adID = '$adID'");
while($row = mysql_fetch_array($query)) {
	$location = $row['location'];
	$npID = $row['npID'];
	$qry1 = mysql_query("SELECT * FROM `newspapers` WHERE npID = '$npID'");
	$ary = mysql_fetch_array($qry1);
	$newspaper = $ary['newspaper'];
	
	$subject = $row['subject'];
	$cols = $row['cols'];
	$cms = $row['cms'];
	$date = date("d-m-Y", strtotime($row['date']));
	$rate = $row['rate'];
	$article = $row['article'];
	$matter = $row['matter'];
}
?>

<script type="text/javascript">

function edit_advert(id) {
	var left = (screen.width/2)-(650/2);
	var top = (screen.height/2)-(400/2);
	var pop_win = window.open('edit_advert.php?id='+id, '','left='+left+',top='+top+',toolbar=no,menubar=no,scrollbars=yes,width=700,height=440'); 
}

$(function() {
    $( "#dialog" ).dialog({
      autoOpen: false,
      bgiframe: true,
	  modal: true,
	  height: 500,
	  width: 800,
      show: {
		effect: "blind",
        duration: 1000
      },
      hide: {
        effect: "blind",
        duration: 1000
      }
    });
 
    $( "#opener" ).click(function() {
      $( "#dialog" ).dialog( "open" );
    });
  });
	


</script>

<div id="wrapper_top"></div>
<div id="wrapper">
<?php include("../include/left.php"); ?>
<div class="main_col dotted_border">
<h2>Subject : <?php echo $subject; ?></h2>
<br />

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="30%" height="35">Location</td>
    <td width="2%"><strong>:</strong></td>
    <td width="26%"><strong><?php echo $location; ?></strong></td>
    <td width="42%" rowspan="6" align="center" valign="top">
    <?php if($article != '') { ?>
    <div style="border: 2px solid #ccc; width:200px;">
    <img src="uploads/<?php echo $article; ?>" alt="article" width="200" height="150" />
    <h6>
    <span id="opener" style="cursor:pointer;" class="right_10">View Article</span>
    <span class="links"><a href="download.php?filename=<?php echo $article; ?>">Download</a></span>
    </h6>
    
    </div>
    <span id="dialog" title="Article Preview"><img src="uploads/<?php echo $article; ?>" alt="article" /></span>
    <?php } ?>
    </td>
  </tr>
  <tr>
    <td height="35">Newspaper</td>
    <td><strong>:</strong></td>
    <td><strong><?php echo $newspaper; ?></strong></td>
    </tr>
  <tr>
    <td height="35">Advertisement Size</td>
    <td><strong>:</strong></td>
    <td><strong><?php echo $cols; ?></strong> Cols X <strong><?php echo $cms; ?></strong> Cms</td>
    </tr>
  <tr>
    <td height="35">Date of Ad</td>
    <td><strong>:</strong></td>
    <td><strong><?php echo $date; ?></strong></td>
    </tr>
  <tr>
    <td height="35">Rate</td>
    <td><strong>:</strong></td>
    <td><strong><?php echo $rate; ?></strong> INR</td>
    </tr>
  <tr>
    <td height="35">Matter</td>
    <td><strong>:</strong></td>
    <td><strong><?php echo $matter; ?></strong></td>
    </tr>
  <tr>
    <td height="80">&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">
      <input type="button" onclick="return edit_advert(<?php echo $adID; ?>)" value="Edit Advertisement" class="button" />
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <input type="button" onClick="history.back()" value="<< Back" class="button" /></td>
  </tr>
  <tr>
    <td colspan="4">&nbsp;</td>
    </tr>
</table>


</div> <!--end of main_col-->
</div> <!--end of wrapper-->

<?php include("../include/footer.php"); ?>

</div> <!--end of container-->
</body>
</html>
