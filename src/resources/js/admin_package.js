window.onload = function() {
	'use strict';

    var tracking_id = document.getElementById("tracking_id").innerHTML;
    var delivered_btn = document.getElementById("delivered");
    var dispatch_btn = document.getElementById("dispatch");
    var in_transit_btn = document.getElementById("in_transit");
    
    const formData = new FormData();
    formData.append('tracking_id', tracking_id);

    function send(endpoint) {

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function(response) {
            if (this.readyState == 4 && this.status == 200) {
                var res = JSON.parse(this.responseText);
                if (res.response == "require_auth") {
                    window.location.href = '/auth?redirect=' + window.location.href;
                } else if(res.response == "success") {
                    location.reload();
                } else if(res.response == "failed_validations") {
                    alert(res.message);
                } else if(res.response == "old_password_error") {
                    alert(res.message);
                }
            }
        };
        xhttp.open("POST", "/admin/update_tracking/" + endpoint, true);
        xhttp.send(formData);
    }

    if(delivered_btn != undefined) {
        delivered_btn.addEventListener('click', function(e){
            e.preventDefault();
            send("delivered");
        });
    }

    if(in_transit_btn != undefined) {
        in_transit_btn.addEventListener('click', function(e){
            e.preventDefault();
            send("in_transit");
        });
    }

    if(dispatch_btn != undefined) {
        dispatch_btn.addEventListener('click', function(e){
            e.preventDefault();
            send("dispatch");
        });
    }

}