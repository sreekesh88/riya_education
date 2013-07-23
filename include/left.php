<!--<script type="text/javascript" src="<?php echo ROOT."/js/jquery.js"; ?>"></script>-->
<script type="text/javascript" src="<?php echo ROOT."/js/ddaccordion.js"; ?>"></script>

<script type="text/javascript">

<?php if(!empty($_SESSION["session_data"])){ ?>
$(function () {
	count = <?php echo count($_SESSION["session_data"]);?>;
	$('#basketCount').html('('+count+')');
});
<?php }?>
ddaccordion.init({ //top level headers initialization
	headerclass: "expandable", //Shared CSS class name of headers group that are expandable
	contentclass: "categoryitems", //Shared CSS class name of contents group
	revealtype: "click", //Reveal content when user clicks or onmouseover the header? Valid value: "click" or "mouseover
	collapseprev: true, //Collapse previous content (so only one open at any time)? true/false 
	defaultexpanded: [], //index of content(s) open by default [index1, index2, etc]. [] denotes no content
	onemustopen: false, //Specify whether at least one header should be open always (so never all headers closed)
	animatedefault: false, //Should contents open by default be animated into view?
	persiststate: true, //persist state of opened contents within browser session?
	toggleclass: ["", "openheader"], //Two CSS classes to be applied to the header when it's collapsed and expanded, respectively ["class1", "class2"]
	togglehtml: ["prefix", "", ""], //Additional HTML added to the header when it's collapsed and expanded, respectively  ["position", "html1", "html2"] (see docs)
	animatespeed: "normal", //speed of animation: "fast", "normal", or "slow"
	oninit:function(headers, expandedindices){ //custom code to run when headers have initalized
		//do nothing
	},
	onopenclose:function(header, index, state, isuseractivated){ //custom code to run whenever a header is opened or closed
		//do nothing
	}
})

ddaccordion.init({ //2nd level headers initialization
	headerclass: "subexpandable", //Shared CSS class name of sub headers group that are expandable
	contentclass: "subcategoryitems", //Shared CSS class name of sub contents group
	revealtype: "click", //Reveal content when user clicks or onmouseover the header? Valid value: "click" or "mouseover
	collapseprev: true, //Collapse previous content (so only one open at any time)? true/false 
	defaultexpanded: [], //index of content(s) open by default [index1, index2, etc]. [] denotes no content
	onemustopen: false, //Specify whether at least one header should be open always (so never all headers closed)
	animatedefault: false, //Should contents open by default be animated into view?
	persiststate: true, //persist state of opened contents within browser session?
	toggleclass: ["opensubheader", "closedsubheader"], //Two CSS classes to be applied to the header when it's collapsed and expanded, respectively ["class1", "class2"]
	togglehtml: ["none", "", ""], //Additional HTML added to the header when it's collapsed and expanded, respectively  ["position", "html1", "html2"] (see docs)
	animatespeed: "normal", //speed of animation: "fast", "normal", or "slow"
	oninit:function(headers, expandedindices){ //custom code to run when headers have initalized
		//do nothing
	},
	onopenclose:function(header, index, state, isuseractivated){ //custom code to run whenever a header is opened or closed
		//do nothing
	}
})


</script>

<style type="text/css">

.arrowlistmenu .menuheader{ /*CSS class for menu headers in general (expanding or not!)*/
	font: Arial;
	font-size: 100%;
	color: white;
	background-color: #1882A8; 
	margin-bottom: 2px; /*bottom spacing between header and rest of content*/
	padding: 4px 0 4px 10px; /*header text is indented 10px*/
	cursor: hand;
	cursor: pointer;
}

.arrowlistmenu .menuheader:hover{ /*hover state CSS*/
	background-color: #D8A039;
	color: #FFFFFF;
}

.arrowlistmenu .openheader{ /*CSS class to apply to expandable header when it's expanded*/
/*	background-image: url(<?php echo ROOT."/images/titlebar-active.png"; ?>); */
	background-color: #D8A039;
	color: #FFFFFF;
	font-weight:bold;
}

.arrowlistmenu ul{ /*CSS for UL of each sub menu*/
	list-style-type: none;
	margin: 0;
	padding: 0;
	margin-bottom: 8px; /*bottom spacing between each UL and rest of content*/
}

.arrowlistmenu ul li{
	padding-bottom: 2px; /*bottom spacing between menu items*/
}

.arrowlistmenu ul li a{
	color: #666;
/*	background: url(<?php echo ROOT."/images/arrow-light.png"; ?>) no-repeat center left; /*custom bullet list image*/
	background-image: url(../images/arrow-bright.png);
	background-repeat: no-repeat;
	background-position: 5px center;
	display: block;
	padding: 5px 0;
	padding-left: 19px; /*link text is indented 19px*/
	text-decoration: none;
	border-bottom: 1px dotted #ccc;
	font-size: 100%;
/*	font-weight: bold; */
}

.arrowlistmenu ul li a:visited{
	color: #333;
}

.arrowlistmenu ul li a:hover{ /*hover state CSS*/
	background-color: #eee;
/*	background-color: #206FAA;
	color: #FFFFFF;
*/
}

.arrowlistmenu ul li.selected a{
	background-color: #C33;
	color: #FFF;
	border-style: none;
	font-weight:bold;
}

</style>
<?php 
$deptID = $_SESSION['is_user']; 
$enqList = mysql_query("SELECT * FROM `enquiries` WHERE allocatedStaff = '$empID' AND delStatus = '0'");
$studDocRejectList = mysql_query("SELECT sd.*,CONCAT(s.fname,' ',s.lname) AS studName,dl.document FROM `stud_docs` sd
										LEFT JOIN students s ON (s.studID=sd.studID)
										LEFT JOIN document_list dl ON dl.docID = sd.docID
										WHERE sd.uploads != '' AND sd.verify = '2' AND sd.empID='$empID' AND sd.delStatus = '0'");
$studVisaDocRejectList = mysql_query("SELECT svd.*,sv.studID, vc.document,CONCAT(s.fname,' ',s.lname) as studName FROM `stud_visa_docs` svd
												LEFT JOIN stud_visa sv ON svd.svID = sv.svID
												LEFT JOIN students s ON s.studID=sv.studID
												LEFT JOIN visa_checklist vc ON vc.chkID = svd.chkID
												WHERE svd.attachment != '' AND svd.verify = '2' AND sv.assignedBy = $empID");
$studVisaAssigned = mysql_query("SELECT sv.*,CONCAT(s.fname,' ',s.lname) AS studName FROM `stud_visa` sv
												LEFT JOIN students s ON s.studID=sv.studID
													WHERE sv.assignedTo = $empID");
$seminarApprovalList = mysql_query("SELECT * FROM `events` WHERE acceptStatus = 1");

$invoiceList = mysql_query("SELECT i.*, i.id as invId,CONCAT(s.fname,' ',s.lname) AS studName, sp.subpgm, spa.passNum FROM `invoice` i
												LEFT JOIN students s ON (s.studID = i.studID)
												LEFT JOIN subprograms sp ON (sp.spID = s.subProgram)
												LEFT JOIN stud_passport spa ON spa.studID=s.studID
												WHERE printed = 0");

$inboxCount = 0;
if($deptID == "1"){
$inboxCount = mysql_num_rows($enqList) + 
	   mysql_num_rows($studDocRejectList) +
	   mysql_num_rows($studVisaDocRejectList) +
	   mysql_num_rows($seminarApprovalList);
} else if($deptID == "4"){
	$inboxCount = mysql_num_rows($studVisaAssigned) +
					mysql_num_rows($invoiceList);
}
$_SESSION["emp_inbox_count"] = '('.$inboxCount.')';
?>
<?php
if(COOKIE_TYPE == "employee")
{
?>
<div class="side_col">
    <div class="arrowlistmenu">
        <p class="menuheader expandable">Countries
        <img src="../images/country.png" width="18" height="18" style="padding:1px 5px 0px 2px;float:left;"/>
        </p>
        <ul id="MenuBar1" class="categoryitems" style="width:auto">
        <?php 
        $query = mysql_query("SELECT * FROM `countries` WHERE delStatus = '0'");
        while($ary = mysql_fetch_array($query)) {
            echo '<li><a href="'.ROOT."/employee/country.php?id=".$ary['conID'].'">'.$ary['country'].'</a></li>';
        }
        ?>
        
        </ul>
    </div>

    <div class="arrowlistmenu">
        <p class="menuheader expandable">Quick Links
        <img src="../images/quicklink.png" width="18" height="18" style="padding:1px 5px 0px 2px;float:left;"/>
        </p>
        <ul id="MenuBar1" class="categoryitems" style="width:auto">
        <li><a href="<?php echo ROOT."/employee/student_add.php"; ?>">Add a Student</a></li>
        <li><a href="<?php echo ROOT."/employee/students_view.php"; ?>">View Students</a></li>
        <li><a href="<?php echo ROOT."/employee/add_reminders.php"; ?>">Add Reminders</a></li>
        <li><a href="<?php echo ROOT."/employee/new_post.php"; ?>">New Discussion</a></li>
        <li><a href="<?php echo ROOT."/employee/shoppingcart.php"; ?>">Basket</a></li>
        </ul>
    </div>
	<?php if($deptID == "1"){?>
	<div class="arrowlistmenu">
        <a href="shoppingcart.php">
        	<p class="menuheader">Basket
        		<img src="../images/basket.png" width="18" height="18" style="padding:1px 5px 0px 2px;float:left;"/>
        		<span id="basketCount" class="basketCart"></span>
        	</p>
        </a>
    </div>
    <?php  } ?>
    <div class="arrowlistmenu">
        <a href="emp_inbox.php">
        	<p class="menuheader">Inbox
        		<img src="../images/mailbox.png" width="17" height="15" style="padding:2px 4px 0px 5px;float:left;"/>
        		<span id="inboxCount" class="basketCart"><?php echo $_SESSION["emp_inbox_count"];?></span>
        	</p>
        </a>
    </div>
</div>

<?php } else if(COOKIE_TYPE == "admin") { ?>
<div class="side_col">
    <div class="arrowlistmenu">
        <p class="menuheader expandable">Quick Links</p>
        <ul id="MenuBar1" class="categoryitems" style="width:auto">
        <li><a href="<?php echo ROOT."/admin/add_employee.php"; ?>">Add an Employee</a></li>
        <li><a href="<?php echo ROOT."/admin/view_employees.php"; ?>">View/Edit Employees</a></li>
        <li><a href="<?php echo ROOT."/admin/add_institution.php"; ?>">Add an Institution</a></li>
        <li><a href="<?php echo ROOT."/admin/add_program.php"; ?>">Add a Program</a></li>
        <li><a href="<?php echo ROOT."/admin/add_country.php"; ?>">Add a Country</a></li>
        </ul>
    </div>
</div>
<?php } ?>