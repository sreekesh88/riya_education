/************************** Styling FILE UPLOAD Field **************************/
var SITE = SITE || {};        

function checkUpload(domObj){ 
	var fileName = domObj.files[0].name;
		var fileExtension = fileName.substring(fileName.lastIndexOf('.') + 1);
		var size = domObj.files[0].size/1024/1024;		
		var $this = $(domObj),
			 $val = $this.val(),
			 valArray = $val.split('\\'),
			 newVal = valArray[valArray.length-1],
			 $button = $this.siblings('.button'),
			 $fakeFile = $this.siblings('.file-holder');
		if(!((fileExtension == 'jpg') 
		|| (fileExtension == 'jpeg') 
		|| (fileExtension == 'gif')
		|| (fileExtension == 'png'))) {
			$fakeFile = "";
						$this.siblings('.file-holder').html('');
			if($fakeFile.length === 0) {
			  $button.after('<span class="file-holder" style="color:#BE0000;">Please choose another file</span>');
			 }
			alert("Please upload files of jpg,gif or png type. The selected file cannot be uploaded.");
			
		}
		else if(size > 0.244141) //maximum file size = 250kb
		{
			$fakeFile = "";
			$this.siblings('.file-holder').html('');
			alert("Maximum Image size exceeded! The selected file cannot be uploaded.");
			if($fakeFile.length === 0) {
			  $button.after('<span class="file-holder" style="color:#BE0000;">Please choose another file</span>');
			 }
		} else{
			 if(newVal !== '') {
			 $button.text('Change File')
			 if($fakeFile.length === 0) {
				 $this.siblings('.file-holder').html('');
			  $button.after('<span class="file-holder">' + newVal + '</span>');
			 } else {
				 $this.siblings('.file-holder').html('');
			   $fakeFile.text(newVal);
			 }
			 $fakeFile = "";
			}
		}
}
 
$(document).ready(function() {
  //$('.file-wrapper input[type=file]').bind('change focus click', SITE.fileInputs);
});


/************************** Common functions **************************/

var re = /^[0-9a-zA-Z\-\.\_]+@[0-9a-zA-Z\-]+\.[0-9a-zA-Z\-\.]+$/;
function is_filled(input_blank){
    while(input_blank.value.indexOf(" ") == 0)
        input_blank.value = input_blank.value.substring(1,input_blank.value.length);
    if((input_blank.value == "") || (input_blank.value == null)){
        return false;
    }
    else{
        return true;
    }
}


/***------------------------------------------------***/
/***			Validate: upload_file.php			***/
/***				Trainer 						***/
/***------------------------------------------------***/

function check_upload_file() {
	var form = document.upload_file;
	
	if (!is_filled(form.category) || form.category.value == 'NULL') {
		alert("Please Select a Category");
		form.category.focus();
		return false;
    }
	
	if (!is_filled(form.type) || form.type.value == 'NULL') {
		alert("Please Select a Type of Upload");
		form.type.focus();
		return false;
    }
	
	if (!is_filled(form.title) || form.title.value == '') {
		alert("Please Enter a Title for your Upload");
		form.title.focus();
		return false;
    }
	
	if (!is_filled(form.file)) {
		alert("Please Choose a File to Upload");
		form.file.focus();
		return false;
    }
	
	return true;
}

/***------------------------------------------------***/
/***			End of upload_file.php				***/
/***------------------------------------------------***/


/***------------------------------------------------***/
/***			Validate: add_trainer.php			***/
/***------------------------------------------------***/

function validate_employee() {
	
	if($('#fname').val() == 'firstname'){
       $('#errorFname').html(" Please enter the First Name");
       $('#fname').focus();
       return false;
    }else{
       $('#errorFname').html("");
    }
	
	if($('#lname').val() == 'lastname'){
       $('#errorLname').html(" Please enter the Last Name");
       $('#lname').focus();
       return false;
    }else{
       $('#errorLname').html("");
    }
	
	if($('#gender').val() == ''){
       $('#errorGender').html(" Please specify the Gender");
       $('#gender').focus();
       return false;
    }else{
       $('#errorGender').html("");
    }
	
	if($('#desig').val() == ''){
       $('#errorDesig').html(" Please enter the Designation");
       $('#desig').focus();
       return false;
    }else{
       $('#errorDesig').html("");
    }
	
	if($('#branch').val() == ''){
       $('#errorBranch').html(" Please enter the Branch");
       $('#branch').focus();
       return false;
    }else{
       $('#errorBranch').html("");
    }
	
	if($('#empCode').val() == ''){
        $('#errorEmpCode').html(" Please enter the Employee Code");
        $('#empCode').focus();
        return false;
    }else if($('#empCode').val() != ''){        
        var pattern=/^[0-9]+$/;
        if(!pattern.test($('#empCode').val())){ 
            $('#errorEmpCode').html(" Please enter numbers only");
            $('#empCode').focus();
            return false;
        }else{
            $('#errorEmpCode').html("");                                 
        }
    }else{
        $('#errorEmpCode').html("");
    }
	
	if($('#password').val() == ''){
       $('#errorPassword').html(" Please enter the Password");
       $('#password').focus();
       return false;
    }else{
       $('#errorPassword').html("");
    }
	
	if($('#confrim').val() == ''){
       $('#errorConfirm').html(" Please re-enter the Password");
       $('#confrim').focus();
       return false;
    }else{
       $('#errorConfirm').html("");
    }
	
	if($('#dob').val() == ''){
        $('#errorDob').html(" Pleasw enter Date of Birth");
        $('#dob').focus();
        return false;
    }else{
        $('#errorDob').html("");
    }
	
	if($('#email').val() == ''){
        $('#errorEmail').html(" Enter an Email id");
        $('#email').focus();
        return false;
    }else if($('#email').val() != ''){        
        var pattern=/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/;
        if(!pattern.test($('#email').val())){ 
            $('#errorEmail').html(" Enter a valid Email id");
            $('#email').focus();
            return false;
        }else{
            $('#errorEmail').html("");                                 
        }                        
    }else{
        $('#errorEmail').html("");
    }
	
	if($('#mobile').val() == ''){
        $('#errorMobile').html(" Enter Mobile Number");
        $('#mobile').focus();
        return false;
    }else if($('#mobile').val() != ''){        
        var pattern=/^[0-9]+$/;
        if(!pattern.test($('#mobile').val())){ 
            $('#errorMobile').html(" Please enter numbers only");
            $('#mobile').focus();
            return false;
        }else{
            $('#errorMobile').html("");                                 
        }
    }else{
        $('#errorMobile').html("");
    }
	
	if($('#address').val() == ''){
       $('#errorAddress').html(" Enter Address");
       $('#address').focus();
       return false;
    }else{
       $('#errorAddress').html("");
    }
	
	if (!is_filled(form.file)) {
		alert("Please Choose a Photo to Upload");
		form.file.focus();
		return false;
    }
	
	/*
	if (!subject_selected()) {
		alert("Please Select atleast One Category");
		return false;
    } */
	
	return true;
}

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#imgPr1')
                .attr('src', e.target.result)
				.attr('style','border: 5px solid #ccc')
                .width(70)
                .height(90);
        };

        reader.readAsDataURL(input.files[0]);
    }
}


function subject_selected() {
	var subjects = document.getElementsByName('subjects[]');
	var subjectCount = 0;
	for(var i=0; i<subjects.length; i++) {
		if (subjects[i].checked){
			subjectCount++;
		}
	}
	if (subjectCount < 1) {
		return false;
    } else {
		return true;
	}
}

/***------------------------------------------------***/
/***			End of add_trainer.php				***/
/***------------------------------------------------***/


/***------------------------------------------------***/
/***			Validate: student_add.php			***/
/***------------------------------------------------***/


function check_add_student() {

	
	if($('#fname').val() == ''){
       $('#errorFname').html(" Enter First Name");
       $('#fname').focus();
       return false;
    }else{
       $('#errorFname').html("");
    }
	
	if($('#lname').val() == ''){
       $('#errorLname').html(" Enter Last Name");
       $('#lname').focus();
       return false;
    }else{
       $('#errorLname').html("");
    }
	
	if($('#dob').val() == ''){
        $('#errorDob').html(" Enter Date of Birth");
        $('#dob').focus();
        return false;
    }else{
        $('#errorDob').html("");
    }
	
	if($('#father').val() == ''){
       $('#errorFather').html(" Enter Father's Name");
       $('#father').focus();
       return false;
    }else{
       $('#errorFather').html("");
    }
	
	if($('#username').val() == ''){
       $('#errorUsername').html(" Enter a Username");
       $('#username').focus();
       return false;
    }else{
       $('#errorUsername').html("");
    }
	
	if($('#password').val() == ''){
       $('#errorPassword').html(" Enter a Password");
       $('#password').focus();
       return false;
    }else{
       $('#errorPassword').html("");
    }
	
	if($('#mobile').val() == ''){
        $('#errorMobile').html(" Enter Mobile Number");
        $('#mobile').focus();
        return false;
    }else if($('#mobile').val() != ''){        
        var pattern=/^[0-9]+$/;
        if(!pattern.test($('#mobile').val())){ 
            $('#errorMobile').html(" Please enter numbers only");
            $('#mobile').focus();
            return false;
        }else{
            $('#errorMobile').html("");                                 
        }
    }else{
        $('#errorMobile').html("");
    }
	
	if($('#email').val() == ''){
        $('#errorEmail').html(" Enter an Email id");
        $('#email').focus();
        return false;
    }else if($('#email').val() != ''){        
        var pattern=/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/;
        if(!pattern.test($('#email').val())){ 
            $('#errorEmail').html(" Enter a valid Email id");
            $('#email').focus();
            return false;
        }else{
            $('#errorEmail').html("");                                 
        }                        
    }else{
        $('#errorEmail').html("");
    }
		
	if($('#address').val() == ''){
       $('#errorAddress').html(" Enter Address");
       $('#address').focus();
       return false;
    }else{
       $('#errorAddress').html("");
    }
	
	if($('#pincode').val() == ''){
        $('#errorPincode').html(" Enter Pincode");
        $('#pincode').focus();
        return false;
    }else if($('#pincode').val() != ''){        
        var pattern=/^[0-9]+$/;
        if(!pattern.test($('#pincode').val())){ 
            $('#errorPincode').html(" Please enter numbers only");
            $('#pincode').focus();
            return false;
        }else{
            $('#errorPincode').html("");                                 
        }
    }else{
        $('#errorPincode').html("");
    }

	if($('#district').val() == ''){
       $('#errorDistrict').html(" Enter your District");
       $('#district').focus();
       return false;
    }else{
       $('#errorDistrict').html("");
    }
	
	if($('#state').val() == ''){
       $('#errorState').html(" Select a State");
       $('#state').focus();
       return false;
    }else{
       $('#errorState').html("");
    }
	
	/*
	if (!is_filled(form.file)) {
		alert("Please Choose a Photo to Upload");
		form.file.focus();
		return false;
    } */
	
	if($('#courseID').val() == ''){
       $('#errorCourse').html(" Select a Course");
       $('#courseID').focus();
       return false;
    }else{
       $('#errorCourse').html("");
    }
	
	if($('#trainingID').val() == ''){
       $('#errorTraining').html(" Enter Training type");
       $('#trainingID').focus();
       return false;
    }else{
       $('#errorTraining').html("");
    }
	
	if($('#learningID').val() == ''){
       $('#errorLearning').html(" Enter Learning type");
       $('#learningID').focus();
       return false;
    }else{
       $('#errorLearning').html("");
    }
	
	if($('#feetypeID').val() == ''){
       $('#errorFeeType').html(" Select Payment type");
       $('#feetypeID').focus();
       return false;
    }else{
       $('#errorFeeType').html("");
    }
	
	if($('#feeAmt').val() == ''){
       $('#errorFee').html(" Enter Fee Amount");
       $('#feeAmt').focus();
       return false;
    }else{
       $('#errorFee').html("");
    }
	
	return true;
}


/***------------------------------------------------***/
/***			End of student_add.php				***/
/***------------------------------------------------***/



/***------------------------------------------------***/
/***			Validate: add_ec.php				***/
/***					Admin						***/
/***------------------------------------------------***/

function check_add_ec() {
	var form = document.add_ec;
	
	if (!is_filled(form.fname)) {
		alert("Please Enter First Name");
		form.fname.focus();
		return false;
    }
	
	if (!is_filled(form.username)) {
		alert("Please Enter a Username");
		form.username.focus();
		return false;
    }
	
	if (!is_filled(form.password)) {
		alert("Please Enter a Password");
		form.password.focus();
		return false;
    }
	
	if (!is_filled(form.email)) 
	{
		alert("Please Enter Email");
        form.email.focus();
        return false;
    }
	
	if (is_filled(form.email) && !form.email.value.match(re)) {
        alert("Please enter a valid Email");
        form.email.focus();
        return false;	
	}
	
	if (form.district.value == 'Select District') {
		alert("Please Select a District");
		form.district.focus();
		return false;
    }
	
	return true;
}

/***------------------------------------------------***/
/***			End of add_trainer.php				***/
/***------------------------------------------------***/


/***------------------------------------------------***/
/***			Validate: changelogin.php			***/
/***					Trainer						***/
/***------------------------------------------------***/

function check_changelogin() {
	var form = document.changelogin;
	
	if (!is_filled(form.new_username)) {
		alert("Please Enter a Username");
		form.new_username.focus();
		return false;
    }
	
	if (!is_filled(form.new_password)) {
		alert("Please Enter a Password");
		form.new_password.focus();
		return false;
    }
	
	if ((form.gender[0].checked == "") && (form.gender[1].checked == "")) {
		alert("Please Select a Gender");
		//form.gender.focus();
		return false;
    }
	
	return true;
}

/***------------------------------------------------***/
/***			End of changelogin.php				***/
/***------------------------------------------------***/


/***------------------------------------------------***/
/***			Validate: edit_course.php			***/
/***					Admin						***/
/***------------------------------------------------***/

function check_edit_course() {
	if($('#courseName').val() == ''){
        $('#errorCourseName').html(" Enter Course Name");
        $('#courseName').focus();
        return false;
    }else{
        $('#errorCourseName').html("");
    }
	
	if($('#duration').val() == ''){
        $('#errorDuration').html(" Enter Course Duration");
        $('#duration').focus();
        return false;
    }else if($('#duration').val() != ''){        
        var pattern=/^[0-9]+$/;
        if(!pattern.test($('#duration').val())){ 
            $('#errorDuration').html(" Course Duration should contain only numbers");
            $('#duration').focus();
            return false;
        }else{
            $('#errorDuration').html("");                                 
        }                        
    }else{
        $('#errorDuration').html("");
    }
}

/***------------------------------------------------***/
/***			End of edit_course.php				***/
/***------------------------------------------------***/


/***------------------------------------------------***/
/***			Validate: edit_batch.php			***/
/***					Admin						***/
/***------------------------------------------------***/

function check_edit_batch() {
	if($('#batchName').val() == ''){
        $('#errorBatchName').html(" Enter Batch Name");
        $('#batchName').focus();
        return false;
    }else{
        $('#errorBatchName').html("");
    }

	if($('#courseID').val() == ''){
        $('#errorCourseID').html(" Select a Course");
        $('#courseID').focus();
        return false;
    }else{
        $('#errorCourseID').html("");
    }
}

/***------------------------------------------------***/
/***			End of edit_batch.php				***/
/***------------------------------------------------***/

function searchValidate() { 
	if($('#searchName').val() == ''){
		$('#errorSearch').html("Please make your search properly");
		return false;
	}else{
		$('#errorSearch').html("");
	}
	if($('#searchCourse').val() == ''){
		$('#errorSearch').html("Please make your search properly");
		return false;
	}else{
		$('#errorSearch').html("");
	}
	if($('#searchField').val() == ''){
		$('#errorSearch').html("Please make your search properly");
		return false;
	}else{
		$('#errorSearch').html("");
	}
}