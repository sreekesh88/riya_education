<?php include ("../include/header.php"); 
include ("../include/validate.php"); 
include ("../include/menu.php");

$empID = $info['empID'];
?>

<script type="text/javascript">
$(function() {
	$('#hidden_value').val($("#searchResult").html());
});
function refineSearch(){
	$.ajax({  
		url: "student_view_search_result.php",
        type: "POST",
        datatype : "json",
		data: $("#form").serialize(),
		success: function(data){
			$("#searchResult").html(data);
			$('#hidden_value').val(data);
		}
    });
    return false;
}
</script>
<div id="wrapper_top"></div>
<div id="wrapper">
<?php //include("../include/left.php"); ?>
<!-- <div class="main_col dotted_border"> -->
<div class="full_col">
<h2>Student's List</h2>
<br />
<form action="" method="POST" id="form">
<div class="filter_content">
	<table class="filter_content_table" width="100%" cellspacing="0" cellpadding="0" border="0">
	  <caption class="filter_table_head" align="center" >Refine Search</caption>
	  <tr>
	  	<td>Reg. No:</td>
	  	<td height="40"><input type="text" id="reg_no" name="reg_no" class="filter_textbox" placeholder="Reg. No:"/></td>
	  	
	  	<td>Name :</td>
	  	<td><input type="text" id="name" name="name" class="filter_textbox" placeholder="Student's Name"/></td>
	  	
	  	<td width="">Country :</td>
	  	<td colspan="2"width="15%">
	  		<select class="filter_dropdown" id="country" name="country" style="width: 100px;">
    			<option class="padding_2" selected="selected" value="all">All</option>
    			<option class="padding_2" value="1">Australia</option>
    			<option class="padding_2" value="2">Canada</option>
    			<option class="padding_2" value="3">New Zealand</option>
    			<option class="padding_2" value="4">Singapore</option>
    			<option class="padding_2" value="5">Switzerland</option>
    			<option class="padding_2" value="6">United Kingdom</option>
    	    </select>
	  	</td>
	  	
	  	<td align="center" colspan="3">
	    	<input type="submit" class="filter_search button" name="submit" id="submit" onclick="return refineSearch();" value="Search">
	    </td>
	  </tr>
	 </table>
	 </div>
</form>
	 <br />
<div id="searchResult">
	<?php include("../employee/student_view_search_result.php"); ?>
</div>


<div align="center" style="margin-top: 20px">
<form action="generate_pdf.php" method="POST">
	<input type ="hidden" name="hidden_value" id="hidden_value"/>
	<input type ="hidden" name="name_of_file" id="hidden_value" value="student_details"/>
	<input type="submit" class="filter_search button" name="pdf" value="Generate PDF"/>
	<input type="submit" class="filter_search button" name="excel" value="Generate Excel"/>
</form>
</div>
</div>
</div>

<?php include("../include/footer.php"); ?>

</div> <!--end of container-->
</body>
</html>