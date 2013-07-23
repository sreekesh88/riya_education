<?php
session_start();
if(COOKIE_TYPE == "admin")
{
$is_admin = $_SESSION['is_admin'];
if($is_admin == '1') {					// Administrator
echo "
<div id='navigation'>
<div id='cssmenu'>
<ul>
   <li><a href='".ROOT."/admin/index.php'><span>Home</span></a></li>
   <li class='has-sub'><a href='#'><span>Employees</span></a>
     <ul>
		 <li><a href='".ROOT."/admin/add_employee.php'><span>Add Employee</span></a></li>
		 <li><a href='".ROOT."/admin/view_employees.php'><span>View/Edit Employees</span></a></li>
     </ul>
   </li>
   <li class='has-sub'><a href='#'><span>Programs</span></a>
	 <ul>
	     <li><a href='".ROOT."/admin/add_program.php'><span>Add new Program</span></a></li>
	 	 <li><a href='".ROOT."/admin/view_programs.php'><span>View Programs</span></a></li>
	 </ul>
   </li>  
   <li class='has-sub'><a href='#'><span>Institutions</span></a>
	 <ul>
	     <li><a href='".ROOT."/admin/add_institution.php'><span>Add new Institution</span></a></li>
	 	 <li><a href='".ROOT."/admin/view_institutions.php'><span>View Institutions</span></a></li>
	 </ul>
   </li> 
   <li class='has-sub'><a href='#'><span>Countries</span></a>
	 <ul>
	     <li><a href='".ROOT."/admin/add_country.php'><span>Add new Country</span></a></li>
	 	 <li><a href='".ROOT."/admin/view_countries.php'><span>View Countries</span></a></li>
	 </ul>
   </li>	
   <li class='has-sub'><a href='#'><span>Marketing</span></a>
     <ul>
   		 <li><a href='".ROOT."/admin/add_advertisements.php'><span>Advertisements</span></a></li>
     </ul>
   </li>
   <li><a href='".ROOT."/admin/add_branches.php'><span>Branches</span></a></li>
   <li class='has-sub'><a href='#'><span>Reports</span></a>
     <ul>
	 	 <li><a href='".ROOT."/admin/report_seminar.php'><span>Seminars</span></a></li>
		 <li><a href='".ROOT."/admin/report_advert.php'><span>Advertisements</span></a></li>
	 </ul>
   </li>	 	 
</ul>
</div>
</div>";
} else if($is_admin == '2') {			// Super User
echo "
<div id='navigation'>
<div id='cssmenu'>
<ul>
   <li><a href='".ROOT."/admin/index.php'><span>Home</span></a></li>
   <li class='has-sub'><a href='#'><span>Employees</span></a>
     <ul>
		 <li><a href='".ROOT."/admin/add_employee.php'><span>Add Employee</span></a></li>
		 <li><a href='".ROOT."/admin/view_employees.php'><span>View/Edit Employees</span></a></li>
     </ul>
   </li>
   <li class='has-sub'><a href='#'><span>Programs</span></a>
	 <ul>
	     <li><a href='".ROOT."/admin/add_program.php'><span>Add new Program</span></a></li>
	 	 <li><a href='".ROOT."/admin/view_programs.php'><span>View Programs</span></a></li>
	 </ul>
   </li>  
   <li class='has-sub'><a href='#'><span>Institutions</span></a>
	 <ul>
	     <li><a href='".ROOT."/admin/add_institution.php'><span>Add new Institution</span></a></li>
	 	 <li><a href='".ROOT."/admin/view_institutions.php'><span>View Institutions</span></a></li>
	 </ul>
   </li> 
   <li class='has-sub'><a href='#'><span>Countries</span></a>
	 <ul>
	     <li><a href='".ROOT."/admin/add_country.php'><span>Add new Country</span></a></li>
	 	 <li><a href='".ROOT."/admin/view_countries.php'><span>View Countries</span></a></li>
	 </ul>
   </li>	
   <li class='has-sub'><a href='#'><span>Marketing</span></a>
     <ul>
   		 <li><a href='".ROOT."/admin/add_advertisements.php'><span>Advertisements</span></a></li>
     </ul>
   </li>
   <li><a href='".ROOT."/admin/add_branches.php'><span>Branches</span></a></li>
   <li class='has-sub'><a href='#'><span>Reports</span></a>
     <ul>
	 	 <li><a href='".ROOT."/admin/report_seminar.php'><span>Seminars</span></a></li>
		 <li><a href='".ROOT."/admin/report_advert.php'><span>Advertisements</span></a></li>
	 </ul>
   </li>	 	 
</ul>
</div>
</div>";
}
}
else if(COOKIE_TYPE == "employee")
{
$deptID = $_SESSION['is_user'];
if($deptID == '1') {					// Counselling Department
echo "
<div id='nav'>
<div id='cssmenu'>
<ul>
   <li><a href='".ROOT."/employee/index.php'><span>Home</span></a></li>
   <li class='has-sub'><a href='".ROOT."/employee/enquiries.php'><span>Enquiries</span></a>
     <ul>
		 <li><a href='".ROOT."/employee/enquiry.php'><span>General Enquiry</span></a></li>
		 <li><a href='".ROOT."/employee/search_program.php'><span>Direct Enquiry</span></a></li>
		 <li><a href='".ROOT."/employee/enquiries.php'><span>View Enquiries</span></a></li>
     </ul>
   </li>
   <li class='has-sub'><a href='#'><span>Registration</span></a>
     <ul>
		 <li><a href='".ROOT."/employee/student_add.php'><span>Register Student</span></a></li>
		 <li><a href='".ROOT."/employee/students_view.php'><span>View Registrations</span></a></li>
     </ul>
   </li>
   <li><a href='".ROOT."/employee/posts.php'><span>Discussion Board</span></a></li>
   <li><a href='#'><span>Offer Letters</span></a></li>   
   <li><a href='".ROOT."/employee/reminders.php'><span>Reminders</span></a></li>
   <li class='has-sub'><a href='#'><span>Events</span></a>
     <ul>
	   <li><a href='".ROOT."/employee/event_request.php'><span>Request an Event</span></a></li>
	   <li><a href='".ROOT."/employee/event_display.php'><span>Display Events</span></a></li>
	   <li><a href='".ROOT."/employee/event_feedback_display.php'><span>Display Feedbacks</span></a></li>
	 </ul>  
   </li>
   <li class='has-sub'><a href='#'><span>Forums</span></a>
     <ul>
		 <li><a href='".ROOT."/employee/forum_new.php'><span>New Subject</span></a></li>
		 <li><a href='".ROOT."/employee/forums.php'><span>View Forum</span></a></li>
     </ul>
   </li>
   
</ul>
</div>
</div> ";
} else if($deptID == '2') {				// Documentation Department	
echo "
<div id='nav'>
<div id='cssmenu'>
<ul>
   <li><a href='".ROOT."/employee/index.php'><span>Home</span></a></li>
   <li class='has-sub'><a href='".ROOT."/employee/enquiries.php'><span>Enquiries</span></a>
     <ul>
		 <li><a href='".ROOT."/employee/enquiry.php'><span>General Enquiry</span></a></li>
		 <li><a href='".ROOT."/employee/search_program.php'><span>Direct Enquiry</span></a></li>
		 <li><a href='".ROOT."/employee/enquiries.php'><span>View Enquiries</span></a></li>
     </ul>
   </li>
   <li><a href='".ROOT."/employee/dd_students_view.php'><span>Documents</span></a></li>
   <li><a href='".ROOT."/employee/posts.php'><span>Discussion Board</span></a></li>   
   <li><a href='".ROOT."/employee/reminders.php'><span>Reminders</span></a></li>
   <li class='has-sub'><a href='#'><span>Forums</span></a>
     <ul>
		 <li><a href='".ROOT."/employee/forum_new.php'><span>New Subject</span></a></li>
		 <li><a href='".ROOT."/employee/forums.php'><span>View Forum</span></a></li>
     </ul>
   </li>
   
</ul>
</div>
</div> ";
} else if($deptID == '3') {				// Sales Department
echo "
<div id='nav'>
<div id='cssmenu'>
<ul>
   <li><a href='".ROOT."/employee/index.php'><span>Home</span></a></li>
   <li class='has-sub'><a href='".ROOT."/employee/enquiries.php'><span>Enquiries</span></a>
     <ul>
		 <li><a href='".ROOT."/employee/enquiry.php'><span>General Enquiry</span></a></li>
		 <li><a href='".ROOT."/employee/search_program.php'><span>Direct Enquiry</span></a></li>
		 <li><a href='".ROOT."/employee/enquiries.php'><span>View Enquiries</span></a></li>
     </ul>
   </li>
   <li class='has-sub'><a href='#'><span>Registration</span></a>
     <ul>
		 <li><a href='".ROOT."/employee/student_add.php'><span>Register Student</span></a></li>
		 <li><a href='".ROOT."/employee/students_view.php'><span>View Registrations</span></a></li>
     </ul>
   </li>
   <li class='has-sub'><a href='#'><span>Forums</span></a>
     <ul>
		 <li><a href='".ROOT."/employee/forum_new.php'><span>New Subject</span></a></li>
		 <li><a href='".ROOT."/employee/forums.php'><span>View Forum</span></a></li>
     </ul>
   </li>
   <li><a href='".ROOT."/employee/posts.php'><span>Discussion Board</span></a></li>   
   <li><a href='".ROOT."/employee/reminders.php'><span>Reminders</span></a></li>  
</ul>
</div>
</div> ";
} else if($deptID == '4') {				// Visa Department	
echo "
<div id='nav'>
<div id='cssmenu'>
<ul>
   <li><a href='".ROOT."/employee/index.php'><span>Home</span></a></li>
   <li class='has-sub'><a href='".ROOT."/employee/enquiries.php'><span>Enquiries</span></a>
     <ul>
		 <li><a href='".ROOT."/employee/enquiry.php'><span>General Enquiry</span></a></li>
		 <li><a href='".ROOT."/employee/search_program.php'><span>Direct Enquiry</span></a></li>
		 <li><a href='".ROOT."/employee/enquiries.php'><span>View Enquiries</span></a></li>
     </ul>
   </li>
   <li><a href='".ROOT."/employee/vd_students_view.php'><span>Documents</span></a></li>
   <li><a href='".ROOT."/employee/posts.php'><span>Discussion Board</span></a></li>   
   <li><a href='".ROOT."/employee/reminders.php'><span>Reminders</span></a></li>
   <li class='has-sub'><a href='#'><span>Forums</span></a>
     <ul>
		 <li><a href='".ROOT."/employee/forum_new.php'><span>New Subject</span></a></li>
		 <li><a href='".ROOT."/employee/forums.php'><span>View Forum</span></a></li>
     </ul>
   </li>
   
</ul>
</div>
</div> ";
}
}
//<li><a href='".ROOT."/employee/popup_event.php'><span>Request an Event</span></a></li>
?>



