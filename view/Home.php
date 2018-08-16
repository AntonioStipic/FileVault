<?php

?>

<html>
    <head>
        <title>FileVault - Home</title>
        <link rel="stylesheet" type="text/css" href="view/css/header.css">
        <link rel="stylesheet" type="text/css" href="view/css/fileList.css">
        <link rel="stylesheet" type="text/css" href="view/css/form.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>

    </head>
    <body>
        <?php include "Header.php"; ?>
        <div hidden id="userUuid"><?php echo $data["user"]["uuid"]; ?></div>
        <div hidden id="userUsername"><?php echo $data["user"]["username"]; ?></div>
        <div class="homeHeader">
            Hello, <?php echo $data["user"]["username"]; ?>!

            <div class="notClickable width5vw"></div>
            <div class="homeHeaderButton">
                <button class="nakedButton" id="uploadButton">
                    <i class="fa fa-upload"></i> Upload
                </button>
            </div>
            <div class="homeHeaderButton width7vw">
                <button class="nakedButton" id="newFolderButton">
                    <i class="fa fa-folder"></i> New Folder
                </button>
            </div>
        </div>
        <div class="container">

            <input type="search" class="searchBar" id="searchBar" value="<?php echo $data["search"]; ?>"> <button class="searchButton" id="searchButton"><i class="fa fa-search"></i></button><br><br>
            <div class="fileList">

                <table class="fileListHeader slightMargin">
                    <tr>
                        <td class="fileListHeaderName orderBy" onclick="sortBy('title')">Name</td>
                        <td class="fileListHeaderOwner orderBy" onclick="sortBy('owner')">| Owner</td>
                        <td class="fileListHeaderUploadTime orderBy" onclick="sortBy('upload_time')">| Upload time</td>
                        <td class="fileListHeaderDownload orderBy" onclick="sortBy('download')">| Download</td>
                        <td class="fileListHeaderSize orderBy" onclick="sortBy('size')">| Size</td>
                    </tr>
                </table>
                <hr>
                <table class="fileListHeader fileTable" id="refreshingList">

                    <?php


                    for ($i = 0; $i < count($data["files"]); $i++) {
                        $userInfo = new Model_UserInfo($data["files"][$i]["owner"]);
                        echo '<tr class="asset right-click">
                        <td style="display: none" class="id">' . $data["files"][$i]["uuid"] . '</td>
                        <td class="fileListHeaderName"><i class="fa fa-file"></i> ' . $data["files"][$i]["title"] . $data["files"][$i]["extension"] . '</td>
                        <td class="fileListHeaderOwner">| ' . $userInfo->username . '</td>
                        <td class="fileListHeaderUploadTime">| ' . date("M jS, Y - H:i", strtotime($data["files"][$i]["upload_time"])) . '</td>
                        <td class="fileListHeaderDownload" id="' . $data["files"][$i]["uuid"] . 'Download">| ' . $data["files"][$i]["download"] . (($data["files"][$i]["download"] == 1)?" time":" times") . '</td>
                        <td class="fileListHeaderSize">| ' . Model_File::formatSizeUnits($data["files"][$i]["size"]) . '</td>
                    </tr>';
                    }


                    ?>


                </table>

                

                <br><br>
                <form method="post" class="uploadButton" enctype="multipart/form-data" style="display: none">
                    <input type="hidden" name="action" value="upload">
                    <input type="file" name="fileToUpload" id="fileToUpload"><br>
                    Public: <input type="checkbox" name="secure"><br>
                    <input type="submit" value="Upload file" id="finalSubmitFile">
                </form>
            </div>




        </div>

        <ul class="custom-menu">
            <li data-action="download"><i class="fa fa-download"></i> Download</li>
            <li data-action="rename"><i class="fa fa-pencil"></i> Rename</li>
            <li data-action="share"><i class="fa fa-share"></i> Share</li>
            <li data-action="info"><i class="fa fa-info-circle"></i>&nbsp; Info</li>
            <hr>
            <li data-action="delete" class="red"><i class="fa fa-trash"></i> Delete</li>

<!--            <li data-action="third">Third thing</li>-->
        </ul>

        <!-- UPLOAD MODAL -->
        <div id="uploadModal" class="modal">
            <div class="modal-content uploadModal">
                <span class="close">&times;</span>
                <h2>Upload file:</h2>
                <div class="modalContainer">
                    <div class="dropArea" id="dropArea">
                        <!--                            <input type="file" name="fileToUpload" id="fileToUpload" style="display: none">-->
                        <p class="hidden">:)</p>
                        <i class="fa fa-arrow-circle-down bigIcon"></i>
                        <p id="notSelectedFileText"><b>Choose a file</b> or drag it here</p>
                        <p id="selectedFileText"><b>Selected:</b> <label id="filePath">Hej</label></p>
                    </div><br>
                    <button class="blueButton" id="modalUploadButton">Upload</button>
                </div>
            </div>
        </div>

        <!-- DELETE MODAL -->
        <div id="deleteModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <div class="modalContainer">
                    <h3>Are you sure you want to delete this file?</h3>
                    <p><i id="deleteFileNameSuggestion"></i></p>
                    <button class="blueButton redButton" onclick="submitDeleteFile();">Yes</button>
                    <button class="blueButton pointer" onclick="deleteModal.style.display = 'none';">No</button>
                </div>
            </div>
        </div>

        <!-- RENAME MODAL -->
        <div id="renameModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <div class="modalContainer">
                    <h3>Rename file:</h3>
                    <input type="text" id="renameModalName" class="inputHeight" name="renameModalName" spellcheck="false"><br>
                    <button class="blueButton" id="renameModalButton">OK</button>
                </div>
            </div>
        </div>

        <!-- SHARE MODAL -->
        <div id="shareModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <div class="modalContainer">
                    <h3 class="alignLeft">Share to:</h3>
                    <div id="shareSelected" class="inputHeight shareSelected"><i>Select username</i></div>
                    <input type="text" id="shareSelector" class="inputHeight" spellcheck="false" list="shareSuggestions"><br>
                    <datalist id="shareSuggestions">
                    </datalist>
                    <button class="blueButton greenButton" id="shareModalButtonAdd">Add</button>
                    <button class="blueButton" id="shareModalButton">Share</button>
                </div>
            </div>
        </div>

        <!-- INFO MODAL -->
        <div id="infoModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <div class="modalContainer">
                    <h3>File Info:</h3>

                    <div class="form-style-2">
                            <label for="field1"><span>ID</span><input type="text" class="input-field" id="infoID" disabled></label>
                            <label for="field1"><span>Name</span><input type="text" class="input-field" id="infoName" disabled></label>
                            <label for="field2"><span>Owner</span><input type="text" class="input-field" id="infoOwner" disabled></label>
                            <label for="field2"><span>Upload time</span><input type="text" class="input-field" id="infoUpload" disabled></label>
                            <label for="field2"><span>Downloaded</span><input type="text" class="input-field" id="infoDownload" disabled></label>
                            <label for="field2"><span>Size</span><input type="text" class="input-field" id="infoSize" disabled></label>

                            <label for="field5"><span>Shared to</span><textarea name="field5" class="textarea-field" id="infoShared" disabled></textarea></label>

                        <button class="blueButton" id="infoModalButton">OK</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- NEW FOLDER MODAL -->
        <div id="newFolderModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <div class="modalContainer">
                    <h3>New Folder:</h3>
                    <input type="text" id="newFolderModalName" class="inputHeight" name="renameModalName" spellcheck="false"><br>
                    <button class="blueButton" id="renameModalButton">OK</button>
                </div>
            </div>
        </div>


        <!-- Functions -->
        <form method="POST" style="display: none">
            <input type="hidden" name="action" value="download">
            <input type="hidden" name="fileId" id="downloadFileId">
            <input type="submit" value="Download" name="download" id="downloadFileSubmit">
        </form>

        <form method="POST" style="display: none">
            <input type="hidden" name="action" value="sort">
            <input type="hidden" name="sortBy" id="sortBy">
            <input type="submit" value="Sort" name="sort" id="sortSubmit">
        </form>

        <script src="/view/js/modalLogic.js"></script>
    </body>
</html>
