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

            <div class="notClickable width5vw"></div>
            <div class="homeHeaderButton">
                <button class="nakedButton" id="uploadButton">
                    <i class="fa fa-upload"></i> Upload
                </button>
            </div>
        </div>
        <div class="container">

            <input type="text" class="searchBar" id="searchBar" value="<?php echo $data["search"]; ?>"> <button class="searchButton" id="searchButton"><i class="fa fa-search"></i></button><br><br>
            <div class="fileList">

                <table class="fileListHeader slightMargin">
                    <tr>
                        <td class="fileListHeaderName orderBy" onclick="sortBy('title')">Name</td>
                        <td class="fileListHeaderOwner orderBy" onclick="sortBy('owner')">| Owner</td>
                        <td class="fileListHeaderUploadTime orderBy" onclick="sortBy('upload_time')">| Upload time</td>
                        <td class="fileListHeaderSize orderBy" onclick="sortBy('size')">| Size</td>
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

                    /* function cmp($a, $b)
                    {
                        return strcmp($a->title, $b->title);
                    }

                    usort($data["files"], "cmp"); */

//                    $data["files"]->asort();

//                    print_r($data["files"]);
                    /* for ($i = 0; $i < count($data["files"]); $i++) {
                        $data["files"][$i] = (object) $data["files"][$i];
                    } */

//                    $data["files"][0] = (object) $data["files"][0];
//                    echo gettype($object);
//                    ksort($data["files"]);
//                    print_r($object);

                    /* $sortBy = "upload_time";
                    function cmp($a, $b)
                    {

                    } */
                    /* if (!isset($data["sortBy"])) {
                        $sortBy = "title";
                    } else {
                        $sortBy = $data["sortBy"];
                    }
                    usort($data["files"], function ($a, $b) use ($sortBy) {
                        return strcasecmp($a->{$sortBy}, $b->{$sortBy});
                    }); */


                    for ($i = 0; $i < count($data["files"]); $i++) {
                        $userInfo = new Model_UserInfo($data["files"][$i]["owner"]);
                        echo '<tr class="asset right-click">
                        <td style="display: none" class="id">' . $data["files"][$i]["uuid"] . '</td>
                        <td class="fileListHeaderName"><i class="fa fa-file"></i> ' . $data["files"][$i]["title"] . $data["files"][$i]["extension"] . '</td>
                        <td class="fileListHeaderOwner">| ' . $userInfo->username . '</td>
                        <td class="fileListHeaderUploadTime">| ' . $data["files"][$i]["upload_time"] . '</td>
                        <td class="fileListHeaderSize">| ' . Model_File::formatSizeUnits($data["files"][$i]["size"]) . '</td>
                    </tr>';
                    }
//                    Model_File::formatSizeUnits(filesize($data["files"][$i]->path))
//                    date_format(strtotime($data["files"][$i]->upload_time), 'd/m/Y H:i:s')
//

                    /* for ($i = 0; $i < count($data["files"]); $i++) {
                        $userInfo = new Model_UserInfo($data["files"][$i]["owner"]);
                        echo '<tr class="asset right-click">
                        <td style="display: none" class="id">' . $data["files"][$i]["uuid"] . '</td>
                        <td class="fileListHeaderName"><i class="fa fa-file"></i> ' . $data["files"][$i]["title"] . $data["files"][$i]["extension"] . '</td>
                        <td class="fileListHeaderOwner">| ' . $userInfo->username . '</td>
                        <td class="fileListHeaderUploadTime">| ' . $data["files"][$i]["upload_time"] . '</td>
                        <td class="fileListHeaderSize">| ' . Model_File::formatSizeUnits(filesize($data["files"][$i]["path"])) . '</td>
                    </tr>';
                    } */



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
                    <button class="blueButton" onclick="submitRenameFile();">OK</button>
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
