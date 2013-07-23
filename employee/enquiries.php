<?php 
include ("../include/header.php"); 
include ("../include/validate.php"); 
include ("../include/menu.php"); 
$empID = $info['empID'];
?>

<script type="text/javascript">
$(function() {
	$('#hidden_value').val($("#searchResult").html());
});
function changeCalendar(type){
	var html = "";
	if(type == 'daily'){
		/*$('#datepicker').css('display','');
		$('#datepicker_startDate').css('display','none');
		$('#datepicker_endDate').css('display','none');*/
		//$('#select_type').html('');
		$("#datepicker").datepicker();
		$("#datepicker_startDate").val("");
		$("#datepicker_endDate").val("");

		$('#datepicker').removeAttr('disabled');
		$("#datepicker_startDate").attr('disabled','disabled');
		$("#datepicker_endDate").attr('disabled','disabled');
	} else {
		$("#datepicker").val("");
		/*$('#datepicker_startDate').css('display','');
		$('#datepicker_endDate').css('display','');
		$('#datepicker').css('display','none');*/
		$("#datepicker_startDate").datepicker();
		$("#datepicker_endDate").datepicker();

		$('#datepicker_startDate').removeAttr('disabled');
		$('#datepicker_endDate').removeAttr('disabled');
		$("#datepicker").attr('disabled','disabled');
	}
}
function enquiry_view(id) {
		$.ajax({  
		url: "enquiry_view.php?id="+id,
		success: function(data){
			$("#dialog").html(data);
		}   
	});
	
	$("#dialog").dialog(
		   {
			bgiframe: true,
			autoOpen: false,
			height: 300,
			width: 600,
			modal: true
		   }
	);
		$('#dialog').dialog('open'); 
		return false;
}

function allocate_enquiry(id) {
	var left = (screen.width/2)-(450/2);
	var top = (screen.height/2)-(350/2);
	pop_win = window.open('allocate_enquiry.php?id='+id, '','left='+left+',top='+top+',toolbar=no,menubar=no,scrollbars=yes,width=400,height=200');
}

function refineSearch(){
	if($('#datepicker_endDate').val() != ""){
		if($('#datepicker_startDate').val() == ""){
			alert("Please fill 'End Date' also for refinig period wise");
			return false;	
		}
	}else if($('#datepicker_startDate').val() != ""){
		if($('#datepicker_endDate').val() == ""){
			alert("Please fill 'Start Date' for refinig period wise");
			return false;	
		}
	}
	$.ajax({  
		url: "enquiry_search_result.php",
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
<h2>General Enquiries</h2>
<br />
<form action="" method="POST" id="form">
<div class="filter_content">
	
	  <div class="filter_table_head" align="center" >Refine Search</div>	  

	    <div class="filter_div">
	  		<label for="daily">Daily Wise</label>	  	
	  	</div>
	  	<div class="filter_div">
	  		<input type="radio" name="day_type" onclick="changeCalendar('daily');" id="daily" value="daily">
	  	</div>
	  	<div class="filter_div">
	  		<input type="text" class="filter_textbox" disabled="true" placeholder="Select Date" id="datepicker" name="datepicker" >
	  	</div>
	  	<div class="filter_div">(OR)</div>
	  	<div class="filter_div">
	  		<label for="custom">Period Wise</label>
	  	</div>
	  	<div class="filter_div">
	  		<input type="radio" name="day_type" onclick="changeCalendar('custom');" id="custom" value="custom">
	  	</div>
	  	<div class="filter_div">
	  		<input type="text" class="filter_textbox"placeholder="Start Date" disabled="true" id="datepicker_startDate" name="datepicker_startDate" >
	  		<input type="text" class="filter_textbox"placeholder="End Date" disabled="true" id="datepicker_endDate" name="datepicker_endDate" >
	  	</div>


	  	<div class="filter_div">
	  		<label> Country</label>
	  	</div>
	  	<div class="filter_div">
	  		<select class="filter_dropdown" id="country" name="country">
    			<option class="padding_2" selected="selected" value="all">All</option>
    			<option class="padding_2" value="1">Australia</option>
    			<option class="padding_2" value="2">Canada</option>
    			<option class="padding_2" value="3">New Zealand</option>
    			<option class="padding_2" value="4">Singapore</option>
    			<option class="padding_2" value="5">Switzerland</option>
    			<option class="padding_2" value="6">United Kingdom</option>
    	    </select>
	  	</div>
	  	
	  	<div class="filter_div">Ref Id:</div>
	  	<div class="filter_div"><input type="text" id="ref_id" name="ref_id" class="filter_textbox" placeholder="Ref. ID:"/></div>
	  	
	  	<div class="filter_div">Name:</div>
	  	<div class="filter_div"><input type="text" id="name" name="name" class="filter_textbox" placeholder="Name"/></div>
	  	
	  	<div class="filter_div">
	    	<input type="submit" class="filter_search button" name="submit" id="submit" onclick="return refineSearch();" value="Search" >
	   </div>

	 </div>
</form>
	 <br />
<div id="searchResult">
<?php include("../employee/enquiry_search_result.php"); ?>
</div>
<div id="dialog" title="Enquiry Details"></div>


<!--
<div align="center" style="margin-top: 20px">
<form action="generate_pdf.php" method="POST">
	<input type ="hidden" name="hidden_value" id="hidden_value"/>
	<input type ="hidden" name="name_of_file" id="hidden_value" value="enquiries"/>
	<input type="submit" class="filter_search button" name="pdf" value="Generate PDF"/>
	<input type="submit" class="filter_search button" name="excel" value="Generate Excel"/>
</form>
</div>
 -->
</div>
</div>

<?php include("../include/footer.php"); ?>

</div> <!--end of container-->
</body>
</html>
