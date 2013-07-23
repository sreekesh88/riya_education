<?php 
include ("../include/header.php");  
?>
<style>
input, input:active, input:focus{
    outline: 0;
    outline-style:none;
    outline-width:0;
}

button::-moz-focus-inner,
input[type="reset"]::-moz-focus-inner,
input[type="button"]::-moz-focus-inner,
input[type="submit"]::-moz-focus-inner,
input[type="file"] > input[type="button"]::-moz-focus-inner {
    border: none;
}
</style>
<script type="text/javascript">
$(function() {	
	$('#modal').dialog({
		modal: true,
		width: 400,
		height: 200
	});
});

/*$(document).on('click','#seminar',function() {
	var rt = $("#sem").val(); alert(rt);
	window.load('event_request.php?id=0');
});*/

$('#seminar').click(function() {
    window.location.href = 'event_request.php?id=0';
    return false;
});

$(document).on('click','#fair',function() {
	var rt = $("#far").val(); alert(rt);
	location.href = 'event_request.php?id=1';
});
</script>
<div id="modal" title="Event type">
<form action="" method="post" enctype="multipart/form-data" name="form">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr><td colspan="2" height="50">&nbsp;</td></tr>
  <tr>
    <td align="center">
    <input name="seminar" id="seminar" type="submit" class="button width_150" value="Seminar"/>
    <input type="hidden" name="sem" id="sem" value="0" />
    </td>
    <td align="center">
    <input name="fair" id="fair" type="submit" class="button width_150" value="Fair" />
    <input type="hidden" name="far" id="far" value="1" />
    </td>
  </tr>
</table>
</form>
</div>