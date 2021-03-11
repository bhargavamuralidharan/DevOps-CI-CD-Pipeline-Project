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


	// Handles submission for updating address
	var updateAddressForm = document.getElementById('updateAddressForm');

	if(updateAddressForm){
		updateAddressForm.addEventListener('submit', function(e){
			
			e.preventDefault();

			var deliver_to = document.getElementById('deliver_to');
			var address = document.getElementById('address');
			var city = document.getElementById('city');
			var province = document.getElementById('state');
			var zip_code = document.getElementById('zip_code');
			var country = document.getElementById('country');
			var address_notification = document.getElementById('address_notification');

			address_notification.innerHTML = "";

			const formData = new FormData();
			formData.append('deliver_to', deliver_to.value);
			formData.append('address', address.value);
			formData.append('city', city.value);
			formData.append('province', province.value);
			formData.append('zip_code', zip_code.value);
			formData.append('country', country.value);

			// Send data to backend
			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function(response) {
				if (this.readyState == 4 && this.status == 200) {
					var res = JSON.parse(this.responseText);
					if (res.response == "require_auth") {
						window.location.href = '/auth?redirect=' + window.location.href;
					} else if(res.response == "success") {
						updateAddressForm.reset();
						address_notification.innerHTML = res.message;
						setTimeout(function(){ location.reload(); }, 2500);
					} else if(res.response == "failed_validations") {
						address_notification.innerHTML = res.message;
					} else if(res.response == "old_password_error") {
						address_notification.innerHTML = res.message;
					}
				}
			};
			xhttp.open("POST", "/dashboard/update_address", true);
			xhttp.send(formData);

		});
	}

};