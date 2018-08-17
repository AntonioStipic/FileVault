
$(document).ready(function() {
    let message = document.getElementById("message").innerHTML;

    message = JSON.parse(message);
    if (message["success"] == true) {
        document.getElementById("fileDiv").style.display = "block";
    } else {
        document.getElementById("errorDiv").style.display = "block";
        document.getElementById("errorMessage").innerHTML = message["message"];
    }

});

$("#signInButton").on("click", function () {
    window.location = "/login";
});