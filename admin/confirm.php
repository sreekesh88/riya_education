<?php include ("../include/header.php"); ?>
<script type="text/javascript">
$("#dialog").dialog({
    
    autoOpen: true,
    buttons: {
    
        Yes: function() { 
    
            alert("Approve!"); 
            $(this).dialog("close"); 
        },
        No: function() { 
            
            alert("Disapprove!"); 
            $(this).dialog("close"); 

        },
        Maybe: function() { 
            
            alert("Cancel"); 
            $(this).dialog("close"); 
        }
    
    },
    width: "400px"
    
});
</script>

<div id="dialog"><input name="hello" type="button" value="ok"><button name="ss" value="o000000k"></div>
