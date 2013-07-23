<html>
 <head>
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.5/jquery-ui.min.js"></script>
  <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.5/themes/humanity/jquery-ui.css" type="text/css" />
 </head>
 <body>
  <script type="text/javascript">
	
	$(document).ready(function(){
	$.ajax({
		url: "1.php",
		success: function(data){
			$("#dialog").html(data);
		}   
	});
	
	$("#dialog").dialog(
		   {
			bgiframe: true,
			autoOpen: false,
			height: 100,
			modal: true
		   }
	);
	});
  </script>
  <a href="#" onclick="jQuery('#dialog').dialog('open'); return false">Click to view</a>
  <div id="dialog" title="Title Box">
   
  </div>
 </body>
</html>