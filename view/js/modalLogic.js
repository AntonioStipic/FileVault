let uploadModal = document.getElementById("uploadModal");
let deleteModal = document.getElementById("deleteModal");
let renameModal = document.getElementById("renameModal");
let shareModal = document.getElementById("shareModal");

// Get the button that opens the modal
let btn = document.getElementById("uploadButton");

// Get the <span> element that closes the modal
let uploadSpan = document.getElementsByClassName("close")[0];
let deleteSpan = document.getElementsByClassName("close")[1];
let renameSpan = document.getElementsByClassName("close")[2];
let shareSpan = document.getElementsByClassName("close")[3];

// When the user clicks on the button, open the modal
btn.onclick = function() {
    uploadModal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
uploadSpan.onclick = function() {
    clearFile();
    uploadModal.style.display = "none";
}

deleteSpan.onclick = function() {
    deleteModal.style.display = "none";
}

renameSpan.onclick = function () {
    renameModal.style.display = "none";
}

shareSpan.onclick = function () {
    $("#shareSelected").html("<i>Select username</i>");
    $("#shareSelector").val("");
    shareModal.style.display = "none";
}

$("#searchBar").focus();
let input = document.getElementById("searchBar");
let tmpStr = input.value;
input.value = "";
input.value = tmpStr;

document.getElementById("searchBar").addEventListener("search", function(event) {
    search();
});

$("#shareSelector").keypress(function() {
    document.getElementById("shareSuggestions").innerHTML = "";
    let value = $("#shareSelector").val();

    if ($("#shareSelector").value == "<i>Select username</i>") {
        document.getElementById("shareModalButtonAdd").disabled = true;
    } else {


        document.getElementById("shareModalButtonAdd").disabled = false;
    }

    // document.getElementById("shareModalButtonAdd").disabled = false;
    let data = {"action": "shareRecommed", "name": value};

    let suggestions = document.getElementById("shareSuggestions");
    $.post("/action", data,
        function(data){
            data = JSON.parse(data);
            suggestions.innerHTML = "";

            let shareSelectedValue = $("#shareSelected").html();

            let userUuid = document.getElementById("userUuid").innerHTML;
            for (let i = 0; i < data.length; i++) {

                if (data[i]["uuid"] != userUuid && shareSelectedValue.indexOf("<b>" + data[i]["username"] + "</b>") < 0) {
                    let option = document.createElement("option");
                    // option.value = data[i]["uuid"];
                    // option.label = data[i]["username"];
                    option.value = data[i]["username"];
                    // option.dataValue = data[i]["uuid"];


                    $(option).attr("data-value",data[i]["uuid"]);
                    suggestions.appendChild(option);
                }


            }

            // if (oldHtml != htmlToAdd) document.getElementById("shareSuggestions").innerHTML = htmlToAdd;
        });
});

$("#shareModalButtonAdd").click(function () {

    let tmpUser = $("#shareSelector").val();
    $("#shareSelector").val("");

    let shareSelectedValue = $("#shareSelected").html();

    let dot = "";
    if (shareSelectedValue != "<i>Select username</i>") dot = ", ";
    if (shareSelectedValue.indexOf("<b>" + tmpUser + "</b>") < 0 && tmpUser != "" && tmpUser != document.getElementById("userUsername").innerHTML) {

        if (dot == "") shareSelectedValue = "";

        shareSelectedValue += (dot + "<b>" +  tmpUser + "</b>");

        $("#shareSelected").html(shareSelectedValue);
    }

    let suggestions = document.getElementById("shareSuggestions");
    suggestions.innerHTML = "";

    document.getElementById("shareModalButtonAdd").disabled = true;
});

$("#shareModalButton").click(function () {

    if ($("#shareSelected").html() != "") {
        let data = {"action": "share", "fileId": currentlyRightClicked, "users": $("#shareSelected").html()};


        $.post("/action",data,
            function(data){
                $("#shareSelected").html("<i>Select username</i>");
                $("#shareSelector").val("");
                shareModal.style.display = "none";
            });
    }
});


// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == uploadModal) {
        clearFile();
        uploadModal.style.display = "none";
    } else if (event.target == deleteModal) {
        deleteModal.style.display = "none";
    } else if (event.target == renameModal) {
        renameModal.style.display = "none";
    } else if (event.target == shareModal) {
        $("#shareSelected").html("<i>Select username</i>");
        $("#shareSelector").val("");
        shareModal.style.display = "none";
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
var currentlyRightClickedName = "";

$(".asset").on("contextmenu", function (event) {

    currentlyRightClicked = $(this).find('.id').html();
    currentlyRightClickedName = $(this).find('.fileListHeaderName').html();
    currentlyRightClickedName = currentlyRightClickedName.substring(currentlyRightClickedName.indexOf("</i>") + 5);

    let parser = new DOMParser;

    currentlyRightClickedName = parser.parseFromString(currentlyRightClickedName, "text/html");
    currentlyRightClickedName = currentlyRightClickedName.body.textContent;

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

$("#searchButton").click(function() {
    search();
});

$("#searchBar").keyup(function(event) {
    if (event.keyCode === 13) {
        search();
    }
});

$("#renameModalName").keyup(function(event) {
    if (event.keyCode === 13) {
        submitRenameFile();
    }
});

$("#renameModalButton").click(function () {
    submitRenameFile();
});


// If the menu element is clicked
$(".custom-menu li").click(function(){

    // This is the triggered action name
    switch($(this).attr("data-action")) {

        case "download": downloadFile(); break;
        // A case for each action. Your actions here
        case "delete": deleteFile(); break;
        case "rename": renameFileModal(); break;
        case "share": shareFile(); break;
    }

    // Hide it AFTER the action was triggered
    $(".custom-menu").hide(100);
});

function downloadFile() {

    document.getElementById("downloadFileId").value = currentlyRightClicked;
    $("#downloadFileSubmit").trigger("click");

    // let currentDownloads = document.getElementById(currentlyRightClicked + "Download")
    let currentDownloads = parseInt(document.getElementById(currentlyRightClicked + "Download").innerHTML.match(/\d+/)[0]) + 1;
    let sub = "times";

    if (currentDownloads == 1) sub = "time";
    document.getElementById(currentlyRightClicked + "Download").innerHTML = "| " + currentDownloads + " " + sub;

}

function shareFile() {
    document.getElementById("shareModalButtonAdd").disabled = true;
    shareModal.style.display = "block";
}

function deleteFile() {
    document.getElementById("deleteFileNameSuggestion").innerHTML = currentlyRightClickedName;
    deleteModal.style.display = "block";
}

function submitDeleteFile() {
    let data = {"action": "delete", "fileId": currentlyRightClicked};

    $.post("/action",data,
        function(data){
            data = JSON.parse(data);
            if (data["success"] == true) {
                deleteModal.style.display = "none";
                location.reload();
            }
        });

}

function renameFileModal() {
    document.getElementById("renameModalName").value = decodeURI(currentlyRightClickedName);

    renameModal.style.display = "block";
    document.getElementById("renameModalName").focus();
}

function submitRenameFile() {
    let newName = document.getElementById("renameModalName").value;

    let data = {"action": "rename", "fileId": currentlyRightClicked, "fileName": newName};

    $.post("/action",data,
        function(data){
            data = JSON.parse(data);
            if (data["success"] == true) {
                renameModal.style.display = "none";
                // location.reload();
            }
        });
}

function search() {
    let phrase = document.getElementById("searchBar").value;

    let data = {"action": "search", "phrase": phrase};
    $.post("/action", data,
        function(data){
            // console.log(data);
            document.getElementById("refreshingList").innerHTML = data;
        });

    // window.location.href = "/home?search=" + phrase;
}

function sortBy(what) {
    document.getElementById("sortBy").value = what;

    $("#sortSubmit").trigger("click");
}
