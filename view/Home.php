<?php

?>

<html>
    <head>
        <title>FileVault - Home</title>
        <link rel="stylesheet" type="text/css" href="view/css/header.css">
        <link rel="stylesheet" type="text/css" href="view/css/fileList.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>

    </head>
    <body>
        <?php include "Header.php"; ?>
        <div class="homeHeader">
            Hello, <?php echo $data["user"]["username"]; ?>!


            <div class="homeHeaderButton width5vw"></div>
            <div class="homeHeaderButton">
                <button class="nakedButton" id="uploadButton">
                    <i class="fa fa-upload"></i> Upload
                </button>
            </div>
        </div>
        <div class="container">




            <p>My files:</p>


            <div class="fileList">

                <table class="fileListHeader slightMargin">
                    <tr>
                        <td class="fileListHeaderName">Name</td>
                        <td class="fileListHeaderOwner">| Owner</td>
                        <td class="fileListHeaderUploadTime">| Upload time</td>
                        <td class="fileListHeaderSize">| Size</td>
                    </tr>
                </table>
                <hr>
                <table class="fileListHeader">
                    <!-- <tr class="asset">
                        <td class="fileListHeaderName"><i class="fa fa-file"></i> Test.txt</td>
                        <td class="fileListHeaderOwner">| astipic</td>
                        <td class="fileListHeaderUploadTime">| Hej</td>
                    </tr>

                    <tr class="asset">
                        <td class="fileListHeaderName"><i class="fa fa-file"></i> Test.txt</td>
                        <td class="fileListHeaderOwner">| astipic</td>
                        <td class="fileListHeaderUploadTime">| Hej</td>
                    </tr> -->

                    <?php

                    for ($i = 0; $i < count($data["files"]); $i++) {
                        $userInfo = new Model_UserInfo($data["files"][$i]["owner"]);
                        echo '<tr class="asset right-click">
                        <td style="display: none" class="id">' . $data["files"][$i]["uuid"] . '</td>
                        <td class="fileListHeaderName"><i class="fa fa-file"></i> ' . $data["files"][$i]["title"] . $data["files"][$i]["extension"] . '</td>
                        <td class="fileListHeaderOwner">| ' . $userInfo->username . '</td>
                        <td class="fileListHeaderUploadTime">| ' . $data["files"][$i]["upload_time"] . '</td>
                        <td class="fileListHeaderSize">| ' . Model_File::formatSizeUnits(filesize($data["files"][$i]["path"])) . '</td>
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
            <li data-action="download">Download</li>
            <li data-action="second">Second thing</li>
            <li data-action="third">Third thing</li>
        </ul>

        <div id="uploadModal" class="modal">

            <div class="modal-content">
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

        <form method="POST" style="display: none">
            <input type="hidden" name="action" value="download">
            <input type="hidden" name="fileId" id="downloadFileId">
            <input type="submit" value="Download" name="download" id="downloadFileSubmit">
        </form>


        <script src="/view/js/modalLogic.js"></script>
    </body>
</html>
