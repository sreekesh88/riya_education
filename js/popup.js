$.noConflict();
jQuery(function ($) {
	var title = "";
	var type = "";
	var id = "";
	var contact = {
		message: null,
		init: function () {
			$('#fullWidth a.changepass').click(function (e) {
				e.preventDefault();

				// load the contact form using ajax
				type = "index";
				title = "Edit Personal Info";
				$.get("popup.php?type="+type+"&id="+id, function(data){
					// create a modal dialog with the data
					$(data).modal({ 
						closeHTML: "<a href='#' title='Close' class='modal-close'>x</a>",
						position: ["20%"],
						overlayId: 'contact-overlay',
						containerId: 'contact-container',
						onOpen: contact.open,
						onShow: contact.show,
						onClose: contact.close
					});
				});
			});
			
		},
		open: function (dialog) {
			// add padding to the buttons in firefox/mozilla
			if ($.browser.mozilla) {
				$('#contact-container .contact-button').css({
					'padding-bottom': '2px'
				});
			}
			// input field font size
			if ($.browser.safari) {
				$('#contact-container .contact-input').css({
					'font-size': '.9em'
				});
			}

			// dynamically determine height
			var h = 200;
			if ($('#btn').length) {
				h += 90;
			}
			if ($('#contact-qualification').length) {
				h += 30;
			}
			if ($('#contact-email').length) {
				h += 60;
			}

			var title = $('#contact-container .contact-title').html();
			$('#contact-container .contact-title').html('Loading...');
			dialog.overlay.fadeIn(100, function () {
				dialog.container.fadeIn(100, function () {
					dialog.data.fadeIn(100, function () {
						$('#contact-container .contact-content').animate({
							height: h
						}, function () {
							$('#contact-container .contact-title').html(title);
							$('#contact-container form').fadeIn(100, function () {
								$('#contact-container #contact-name').focus();

								$('#contact-container .contact-cc').click(function () {
									var cc = $('#contact-container #contact-cc');
									cc.is(':checked') ? cc.attr('checked', '') : cc.attr('checked', 'checked');
								});

								// fix png's for IE 6
								if ($.browser.msie && $.browser.version < 7) {
									$('#contact-container .contact-button').each(function () {
										if ($(this).css('backgroundImage').match(/^url[("']+(.*\.png)[)"']+$/i)) {
											var src = RegExp.$1;
											$(this).css({
												backgroundImage: 'none',
												filter: 'progid:DXImageTransform.Microsoft.AlphaImageLoader(src="' +  src + '", sizingMethod="crop")'
											});
										}
									});
								}
							});
						});
					});
				});
			});
		},
		show: function (dialog) {
			$('#contact-container .contact-send').click(function (e) {
				e.preventDefault();
				// validate form
				if (contact.validate()) {
					var msg = $('#contact-container .contact-message');
					msg.fadeOut(function () {
						msg.removeClass('contact-error').empty();
					});
					$('#contact-container .contact-title').html('Changing...');
					$('#contact-container form').fadeOut(100);
					$('#contact-container .contact-content').animate({
						height: '80px'
					}, function () {
						$('#contact-container .contact-loading').fadeIn(100, function () {
							$.ajax({
								url: 'popup.php',
								data: $('#contact-container form').serialize() + '&action=send&type='+ type +"&id="+id,
								type: 'post',
								cache: false,
								dataType: 'html',
								success: function (data) {
									$('#contact-container .contact-loading').fadeOut(100, function () {
										$('#contact-container .contact-title').html(title);
										msg.html(data).fadeIn(100);
									});
								},
								error: contact.error
							});
						});
					});
				}
				else {
					if ($('#contact-container .contact-message:visible').length > 0) {
						var msg = $('#contact-container .contact-message div');
						msg.fadeOut(100, function () {
							msg.empty();
							contact.showError();
							msg.fadeIn(100);
						});
					}
					else {
						$('#contact-container .contact-message').animate({
							height: '30px'
						}, contact.showError);
					}
					
				}
			});
		},
		close: function (dialog) {
			$('#contact-container .contact-message').fadeOut();
			$('#contact-container .contact-title').html('Closing...');
			$('#contact-container form').fadeOut(100);
			$('#contact-container .contact-content').animate({
				height: 40
			}, function () {
				dialog.data.fadeOut(100, function () {
					dialog.container.fadeOut(100, function () {
						dialog.overlay.fadeOut(100, function () {
							$.modal.close();
							//location.reload();
						});
					});
				});
			});
		},
		error: function (xhr) {
			alert(xhr.statusText);
		},
		validate: function () {
			contact.message = '';
			/*if (!$('#contact-container #contact-current').val()) {
				contact.message += 'Please enter Current Password. <br>';
			}
			if (!$('#contact-container #contact-new').val()) {
				contact.message += 'Please enter New Password. <br>';
			}
			*/
			if(type == "profile") {
				if (!$('#contact-container #contact-fname').val()) {
					contact.message += 'First Name is required. ';
				}
				
				if (!$('#contact-container #contact-lname').val()) {
					contact.message += 'Last Name is required. ';
				}
				
				if (!$('#contact-container #contact-dob').val()) {
					contact.message += 'Date of Birth is required. ';
				}
			}
			
			if(type == "contact") {	
				var email = $('#contact-container #contact-email').val();
				if (!email) {
					contact.message += 'Email is required. ';
				}
				else {
					if (!contact.validateEmail(email)) {
						contact.message += 'Email is invalid. ';
					}
				}
			}
			/*
			if (!$('#contact-container #contact-message').val()) {
				contact.message += 'Message is required.';
			}
			*/
			if (contact.message.length > 0) {
				return false;
			}
			else {
				return true;
			}
		},
		validateEmail: function (email) {
			var at = email.lastIndexOf("@");

			// Make sure the at (@) sybmol exists and  
			// it is not the first or last character
			if (at < 1 || (at + 1) === email.length)
				return false;

			// Make sure there aren't multiple periods together
			if (/(\.{2,})/.test(email))
				return false;

			// Break up the local and domain portions
			var local = email.substring(0, at);
			var domain = email.substring(at + 1);

			// Check lengths
			if (local.length < 1 || local.length > 64 || domain.length < 4 || domain.length > 255)
				return false;

			// Make sure local and domain don't start with or end with a period
			if (/(^\.|\.$)/.test(local) || /(^\.|\.$)/.test(domain))
				return false;

			// Check for quoted-string addresses
			// Since almost anything is allowed in a quoted-string address,
			// we're just going to let them go through
			if (!/^"(.+)"$/.test(local)) {
				// It's a dot-string address...check for valid characters
				if (!/^[-a-zA-Z0-9!#$%*\/?|^{}`~&'+=_\.]*$/.test(local))
					return false;
			}

			// Make sure domain contains only valid characters and at least one period
			if (!/^[-a-zA-Z0-9\.]*$/.test(domain) || domain.indexOf(".") === -1)
				return false;	

			return true;
		},
		showError: function () {
			$('#contact-container .contact-message')
				.html($('<div class="contact-error"></div>').append(contact.message))
				.fadeIn(200);
		}
	};

	contact.init();

});