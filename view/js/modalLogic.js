let modal = document.getElementById('uploadModal');

// Get the button that opens the modal
let btn = document.getElementById("uploadButton");

// Get the <span> element that closes the modal
let span = document.getElementsByClassName("close")[0];

// When the user clicks on the button, open the modal
btn.onclick = function() {
    modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    clearFile();
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        clearFile();
        modal.style.display = "none";
    }
}

$("#dropArea").click(function() {
    document.getElementById("fileToUpload").value = "";
    $("#fileToUpload").trigger("click");
});

$("#fileToUpload").on("change", function () {
    // alert("Selected file!");

    if (document.getElementById("fileToUpload").value != "") {
        document.getElementById("modalUploadButton").style.display = "block";

        document.getElementById("filePath").innerHTML = document.getElementById("fileToUpload").files[0].name;

        document.getElementById("selectedFileText").style.display = "block";
        document.getElementById("notSelectedFileText").style.display = "none";

    } else {
        clearFile();
    }
});

$("#modalUploadButton").click(function() {
    $("#finalSubmitFile").trigger("click");
});

function clearFile() {
    document.getElementById("modalUploadButton").style.display = "none";

    document.getElementById("selectedFileText").style.display = "none";
    document.getElementById("notSelectedFileText").style.display = "block";
}




var currentlyRightClicked = "";

$(".asset").on("contextmenu", function (event) {

    currentlyRightClicked = $(this).find('.id').html();
    // alert($( parent + "  > .id" ).html());

    // Avoid the real one
    event.preventDefault();

    // Show contextmenu
    $(".custom-menu").finish().toggle(100).

    // In the right position (the mouse)
    css({
        top: event.pageY - 17 + "px",
        left: event.pageX + 15 + "px"
    });
});


// If the document is clicked somewhere
$(document).on("mousedown", function (e) {

    // If the clicked element is not the menu
    if (!$(e.target).parents(".custom-menu").length > 0) {

        // Hide it
        $(".custom-menu").hide(100);
    }
});


// If the menu element is clicked
$(".custom-menu li").click(function(){

    // This is the triggered action name
    switch($(this).attr("data-action")) {

        case "download": downloadFile(); break;
        // A case for each action. Your actions here
        case "first": alert("first"); break;
        case "second": alert("second"); break;
        case "third": alert("third"); break;
    }

    // Hide it AFTER the action was triggered
    $(".custom-menu").hide(100);
});

function downloadFile() {

    document.getElementById("downloadFileId").value = currentlyRightClicked;
    $("#downloadFileSubmit").trigger("click");

}