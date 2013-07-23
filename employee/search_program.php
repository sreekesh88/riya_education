<?php include ("../include/header.php"); 
include ("../include/menu.php"); 
$conID = '';
$pgmID = '';

?>
<?php
if(isset($_POST['search'])) {
	$pgmID = $_POST['program'];
	$conID = $_POST['country'];
	$spID = $_POST['subPgm'];
	
	$row1 = mysql_query("SELECT program FROM `programs` WHERE pgmID = '$pgmID'");
	$ary1 = mysql_fetch_array($row1);
	$program = $ary1['program'];
	$row2 = mysql_query("SELECT country FROM `countries` WHERE conID = '$conID'");
	$ary2 = mysql_fetch_array($row2);
	$country = $ary2['country'];
}		
?>

<script>
function getSubPgm(id) {
	$.ajax({ 
		url: "get_subPgms.php?id="+id,
		success: function(data){
			$("#subpgms").html(data);
		}   
	});
} 

function formSubmit(){
	$.ajax({ 
		url: "search_program_ajax_view.php",
		method : "POST",
		data : $('#searchForm').serialize(),
		success: function(data){
			$('#searchResult').html(data);
		}   
	});
	return false;
}
</script>

<body>

<div id="wrapper_top"></div>
<div id="wrapper">

<?php include("../include/left.php"); ?>

<div class="main_col dotted_border">

<div id="searchArea">
<div style="padding-bottom: 5px;"><img src="../images/search.png" alt="img" width="184" height="26"></div>
<div id="searchBox">
<form  method="post"  enctype="multipart/form-data" name="searchForm" id="searchForm">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="29%" height="40">Select your Country</td>
    <td width="3%" align="center">:</td>
    <td width="68%">
    <select name="country" id="country" class="dropdown">
    <option value="0" selected="selected" class="padding_2">Select</option>
    <?php
	$res1 = mysql_query("SELECT * FROM `countries` WHERE delStatus = '0'");
	while($arr1 = mysql_fetch_array($res1)) {
	echo '<option value="'.$arr1['conID'].'" class="padding_2"';
	if($arr1['conID'] == $conID)
	echo 'selected="selected"';
	echo '>'.$arr1['country'].'</option>';
	}
    ?>
    </select>    </td>
  </tr>
  <tr>
    <td height="40">Select your Program</td>
    <td align="center">:</td>
    <td>
    <select name="program" id="program" class="dropdown" onChange="return getSubPgm(this.value);">
    <option value="" selected="selected" class="padding_2">Select</option>
    <?php
    $qry = mysql_query("SELECT * FROM `programs` WHERE delStatus = '0' ORDER BY program ASC");
	while($arr = mysql_fetch_array($qry)) {
	echo '<option value="'.$arr['pgmID'].'" class="padding_2"';
	if($arr['pgmID'] == $pgmID)
	echo 'selected="selected"';
	echo '>'.$arr['program'].'</option>';
	}
	?></select>    </td>
  </tr>
  <tr>
    <td height="40">Select Sub-Program</td>
    <td align="center">:</td>
    <td><div id="subpgms">
    <select name="subPgm" id="subPgm" class="dropdown">
    <option value="" selected="selected" class="padding_2">Select</option>
    </select></div>
    </td>
  </tr>
  <tr>
    <td height="40">&nbsp;</td>
    <td>&nbsp;</td>
    <td><input type="submit" name="search" onClick="return formSubmit();" value="Search" class="button"></td>
  </tr>
</table>
</form>
</div>
</div>
<br>


<div id="searchResult">
</div>
</div>
</div>
<?php include("../include/footer.php"); ?>


 <!--end of container-->
</body>
</html>
