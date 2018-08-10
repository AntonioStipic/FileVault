<?php

?>

<html>
    <head>
        <title>FileVault - Home</title>
        <link rel="stylesheet" type="text/css" href="view/css/header.css">
        <link rel="stylesheet" type="text/css" href="view/css/fileList.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
        <?php include "Header.php"; ?>
        <div class="homeHeader">
            <div class="homeHeaderButton width5vw"></div>
            <div class="homeHeaderButton">
                <button class="nakedButton">
                    <i class="fa fa-upload"></i> Upload
                </button>
            </div>
        </div>
        <div class="container">


            <h3>Hello, <?php echo $data["user"]["username"]; ?>!</h3>

            <p>My files:</p>


            <div class="fileList">

                <table class="fileListHeader">
                    <tr>
                        <td class="fileListHeaderName">Name</td>
                        <td class="fileListHeaderOwner">| Owner</td>
                        <td class="fileListHeaderUploadTime">| Upload time</td>
                    </tr>
                </table>

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
                        echo '<tr class="asset">
                        <td class="fileListHeaderName"><i class="fa fa-file"></i> ' . $data["files"][$i]["title"] . $data["files"][$i]["extension"] . '</td>
                        <td class="fileListHeaderOwner">| ' . $data["files"][$i]["owner"] . '</td>
                        <td class="fileListHeaderUploadTime">| ' . $data["files"][$i]["upload_time"] . '</td>
                    </tr>';
                    }

                    ?>


                </table>

                

                <br><br>
                <form method="post" class="uploadButton" enctype="multipart/form-data">
                    <input type="hidden" name="action" value="upload">
                    <input type="file" name="fileToUpload" id="fileToUpload"><br>
                    Public: <input type="checkbox" name="secure"><br>
                    <input type="submit" value="Upload file">
                </form>





            </div>




        </div>

    </body>
</html>
