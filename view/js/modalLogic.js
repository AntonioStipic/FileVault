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
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
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
        document.getElementById("modalUploadButton").style.display = "none";

        document.getElementById("selectedFileText").style.display = "none";
        document.getElementById("notSelectedFileText").style.display = "block";
    }
});

$("#modalUploadButton").click(function() {
    $("#finalSubmitFile").trigger("click");
});
