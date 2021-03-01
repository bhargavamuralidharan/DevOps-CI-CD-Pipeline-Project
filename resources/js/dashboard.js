window.onload = function() {
	'use strict';

    // Handles submission for updating password
	var changePasswordForm = document.getElementById('changePasswordForm');

	if(changePasswordForm){
		changePasswordForm.addEventListener('submit', function(e){
			
			e.preventDefault();

			var old_password = document.getElementById('old_password');
			var new_password = document.getElementById('new_password');
			var confirm_password = document.getElementById('confirm_password');
			var pwd_notification = document.getElementById('pwd_notification');

			pwd_notification.innerHTML = "";

			const formData = new FormData();
			formData.append('old_password', old_password.value);
			formData.append('new_password', new_password.value);
			formData.append('confirm_password', confirm_password.value);

			if(new_password.value.length >= 6) {
				if(new_password.value == confirm_password.value) {
					// Send data to backend
					var xhttp = new XMLHttpRequest();
					xhttp.onreadystatechange = function(response) {
						if (this.readyState == 4 && this.status == 200) {
							var res = JSON.parse(this.responseText);
							if (res.response == "require_auth") {
								window.location.href = '/auth?redirect=' + window.location.href;
							} else if(res.response == "success") {
								changePasswordForm.reset();
								pwd_notification.innerHTML = res.message;
							} else if(res.response == "failed_validations") {
								pwd_notification.innerHTML = res.message;
							} else if(res.response == "old_password_error") {
								pwd_notification.innerHTML = res.message;
							}
						}
					};
					xhttp.open("POST", "/dashboard/update_password", true);
					xhttp.send(formData);
				} else {
					// passwords don't match
					pwd_notification.innerHTML = '<div class="alert alert-danger">Your new password needs to match your confirm password value.</div>';
				}
			} else {
				// password too short
				pwd_notification.innerHTML = '<div class="alert alert-danger">Your new password needs to be at least 6 characters long.</div>';
		    }
		});
	}

};