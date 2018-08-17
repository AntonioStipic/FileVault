
$(document).ready(function() {
    // showPage();

    showPage();

});


function showPage() {
    let message = document.getElementById("message").innerHTML;


    message = JSON.parse(message);
    if (message["success"] == true) {
        document.getElementById("fileDiv").style.display = "block";
    } else {
        document.getElementById("errorDiv").style.display = "block";
        document.getElementById("errorMessage").innerHTML = message["message"];
    }
}

$("#signInButton").on("click", function () {
    window.location = "/login";
});

$("#downloadButton").on("click", function () {
    let id = document.getElementById("fileId").innerHTML;

    document.getElementById("downloadFileId").value = id;
    $("#downloadFileSubmit").trigger("click");

});