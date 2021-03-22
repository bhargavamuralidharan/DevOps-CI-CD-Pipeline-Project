window.onload = function() {
	'use strict';

    // Handles submission for getting package status
	var trackingForm = document.getElementById('trackingForm');

    trackingForm.addEventListener('submit', function(e) {
        e.preventDefault();

        var tid = document.getElementById('tracking_id');
        var tres = document.getElementById('tracking_result');

        tres.innerHTML = '';

        const formData = new FormData();
        formData.append('tracking_id', tid.value);

        if(tid.value != null) {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function(response) {
                if (this.readyState == 4 && this.status == 200) {
                    var res = JSON.parse(this.responseText);
                    if(res.response == "success") {
                        //trackingForm.reset();
                        tres.innerHTML = res.out;
                    } else {
                        tres.innerHTML = '<div class="alert alert-danger">An error occured while trying to get your package\'s status. Please try again later.</div>';
                    }
                }
            };
            xhttp.open("POST", "/tracking/track", true);
            xhttp.send(formData);
        }
    });

}