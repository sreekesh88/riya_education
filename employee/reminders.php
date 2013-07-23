<?php 
include ("../include/header.php"); 
include ("../include/validate.php"); 
include ("../include/menu.php"); 
$empID = $info['empID'];
?>
<script type="text/javascript">
function changeCalendar(type){
	var html = "";
	if(type == 'rm_daily'){
		$("#rm_datepicker").datepicker();
		$("#rm_datepicker_startDate").val("");
		$("#rm_datepicker_endDate").val("");

		$('#rm_datepicker').removeAttr('disabled');
		$("#rm_datepicker_startDate").attr('disabled','disabled');
		$("#rm_datepicker_endDate").attr('disabled','disabled');
	} else if(type == 'rm_custom'){
		$("#rm_datepicker_startDate").datepicker();
		$("#rm_datepicker_endDate").datepicker();

		$('#rm_datepicker_startDate').removeAttr('disabled');
		$('#rm_datepicker_endDate').removeAttr('disabled');
		$("#rm_datepicker").attr('disabled','disabled');
	} else if(type == 'dc_daily'){
		$("#dc_datepicker").datepicker();
		$("#dc_datepicker_startDate").val("");
		$("#dc_datepicker_endDate").val("");

		$('#dc_datepicker').removeAttr('disabled');
		$("#dc_datepicker_startDate").attr('disabled','disabled');
		$("#dc_datepicker_endDate").attr('disabled','disabled');
	} else {
		$("#dc_datepicker_startDate").datepicker();
		$("#dc_datepicker_endDate").datepicker();

		$('#dc_datepicker_startDate').removeAttr('disabled');
		$('#dc_datepicker_endDate').removeAttr('disabled');
		$("#dc_datepicker").attr('disabled','disabled');
	}
}
function refineSearch(){
	$.ajax({  
		url: "reminder_search_result.php",
        type: "POST",
        datatype : "json",
		data: $("#form").serialize(),
		success: function(data){
			$("#searchResult").html(data);
		}
    });
    return false;
}
</script>
<div id="wrapper_top"></div>
<div id="wrapper">
<?php include("../include/left.php"); ?>
<div class="main_col dotted_border">
<h2>Reminders</h2>
<br />
<form action="" method="POST" id="form">
<div class="filter_content" style="min-height:160px;">
	
	  <div class="filter_table_head" align="center" >Refine Search</div>	  
	<div class="filter_div" style="font-size: 8px; font-weight: bold; color: maroon; padding: 18px 2px 0px;">Reminder Date :</div>  
	    <div class="filter_div">
	  		<label for="daily">Daily Wise</label>	  	
	  	</div>
	  	<div class="filter_div">
	  		<input type="radio" name="rm_day_type" onclick="changeCalendar('rm_daily');" id="rm_daily" value="rm_daily">
	  	</div>
	  	<div class="filter_div">
	  		<input type="text" class="filter_textbox" disabled="true" placeholder="Select Date" id="rm_datepicker" name="rm_datepicker" >
	  	</div>
	  	<div class="filter_div">(OR)</div>
	  	<div class="filter_div">
	  		<label for="custom">Period Wise</label>
	  	</div>
	  	<div class="filter_div">
	  		<input type="radio" name="rm_day_type" onclick="changeCalendar('rm_custom');" id="rm_custom" value="rm_custom">
	  	</div>
	  	<div class="filter_div">
	  		<input type="text" class="filter_textbox"placeholder="Start Date" disabled="true" id="rm_datepicker_startDate" name="rm_datepicker_startDate" >
	  		<input type="text" class="filter_textbox"placeholder="End Date" disabled="true" id="rm_datepicker_endDate" name="rm_datepicker_endDate" >
	  	</div>

		<div class="filter_div" style="font-size: 8px; font-weight: bold; color: maroon; padding: 18px 6px 0px;">Created Date :</div>
	    <div class="filter_div" style="width:60px;">
	  		<label for="daily">Daily Wise</label>	  	
	  	</div>
	  	<div class="filter_div">
	  		<input type="radio" name="dc_day_type" onclick="changeCalendar('dc_daily');" id="dc_daily" value="dc_daily">
	  	</div>
	  	<div class="filter_div">
	  		<input type="text" class="filter_textbox" disabled="true" placeholder="Select Date" id="dc_datepicker" name="dc_datepicker" >
	  	</div>
	  	<div class="filter_div">(OR)</div>
	  	<div class="filter_div">
	  		<label for="custom">Period Wise</label>
	  	</div>
	  	<div class="filter_div">
	  		<input type="radio" name="dc_day_type" onclick="changeCalendar('dc_custom');" id="dc_custom" value="dc_custom">
	  	</div>
	  	<div class="filter_div">
	  		<input type="text" class="filter_textbox"placeholder="Start Date" disabled="true" id="dc_datepicker_startDate" name="dc_datepicker_startDate" >
	  		<input type="text" class="filter_textbox"placeholder="End Date" disabled="true" id="dc_datepicker_endDate" name="dc_datepicker_endDate" >
	  	</div>

	  	<div class="filter_div" style="width:90px;">
	  		<label> Student's Name</label>
	  	</div>
	  	<div class="filter_div"><input type="text" id="stud_name" name="stud_name" class="filter_textbox" placeholder="Student's Name"/></div>
	  		  	
	  	
	  	<div class="filter_div">
	    	<input type="submit" class="filter_search button" name="submit" id="submit" onclick="return refineSearch();" value="Search" >
	   </div>

	 </div>
</form>
<br/>
<div id="searchResult">
<?php include("../employee/reminder_search_result.php"); ?>

</div>

</div>
</div>

<?php include("../include/footer.php"); ?>

</div> <!--end of container-->
</body>
</html>