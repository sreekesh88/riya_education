// Login JS

function writeInputBox(type) {
	var out = '';
	if(type == 'username') {
		if(navigator.appName == "Netscape")
			//out = '<input name="username" id="username" type="text" class="login_textbox" />';
			out = '<input name="username" type="text" class="login_textbox" style="padding-left:6px; color: grey;" onFocus="check(this);" onBlur="check(this);" value="Username" tabindex="1"/>';
		else
			//out = '<p align="left" type="text" class="login_textbox"/>';
			out = '<p align="left" style="color: white; font-weight: bold; padding-left: 70px">Username</p><input name="username" type="text" class="login_textbox" tabindex="1"/>';
	}
	
	if(type == 'password') {
		if(navigator.appName == "Netscape")
			//out = '<input name="password" type="password" class="login_textbox" />';
			out = '<input name="password" type="text" class="login_textbox" style="padding-left:6px; color: grey;" onFocus="check(this);" onBlur="check(this);" value="Password" tabindex="2"/>';
		else
			//out = '<p align="left" type="password" class="login_textbox"/>';
			out = '<p align="left" style="color: white; font-weight: bold; padding-left: 70px">Password</p><input name="password" type="password" class="login_textbox" tabindex="2"/>';
	}
	
	document.write(out);
}

function check(field) {
	  switch(field.name) {
		  	case("username"):
	  			if(field.value == "") {
					field.style.color = "grey";
					field.style.fontWeight = "normal";
	  				field.value = "Username";
					return;
				}
				if(field.value == 'Username') {
					field.style.color = "#333333";
					field.value = '';
					return;
				}
				break;
			case("password"):
				if(field.value == "") {
					field.style.color = "grey";
					field.style.fontWeight = "normal";
					field.type = "text";
	  				field.value = "Password";
					return;
				}
				if(field.value == 'Password') {
					field.style.color = "#333333";
					field.value = '';
					if(navigator.appName != "Netscape")
						field.setAttribute('type', 'password');
					else
						field.type = 'password';
					return;
				}
				break;
	  }
}
