<html>
<head>
    <title>FileVault - Asset</title>
    <link rel="stylesheet" type="text/css" href="view/css/header.css">
    <link rel="stylesheet" type="text/css" href="view/css/fileList.css">
    <link rel="stylesheet" type="text/css" href="view/css/asset.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
</head>
<body>
<?php include "Header.php"; ?>
<div class="homeHeader">
    <span id="greeting">Hello, <i><?php echo $data["user"]["username"]; ?>!</i></span>

    <div class="notClickable width5vw"></div>
    <div class="homeHeaderButton" onclick="window.location = '/home'">
        <button class="nakedButton" id="uploadButton">
            <i class="fa fa-chevron-left myBlue"></i> Back
        </button>
    </div>
</div>
<div class="container">
    <div class="hidden" id="message"><?php echo $data["message"]; ?></div>
    <div class="fileDiv" id="fileDiv">
        <table>
            <tr>
                <td><i class="fa fa-file assetFileIcon"></i></td>
                <td>
                    <label class="assetText" id="assetName"><b>Name:</b> <?php echo $data["file"]["title"] . $data["file"]["extension"] ?></label>
                    <label class="assetText" id="assetSize"><b>Size:</b> <?php echo $data["file"]["size"] ?></label>
                    <label class="assetText" id="assetSize"><b>Upload time:</b> <?php echo date("M jS, Y - H:i", strtotime($data["file"]["upload_time"])) ?></label>
                    <label class="assetText" id="assetId"><b>ID:</b> <span id="fileId"><?php echo $data["file"]["uuid"] ?></span></label>
                </td>
            </tr>


            <tr>
                <td></td>
                <td><button class="blueButton round right" id="downloadButton">Download</button></td>
            </tr>

        </table>
    </div>

</div>

<div class="errorDiv" id="errorDiv">
    <table>
        <tr>
            <td><i class="fa fa-lock assetFileIcon"></i></td>
            <td>
                <label class="assetText" id="errorMessage"></label>
            </td>
        </tr>

        <tr>
            <td></td>
            <td><button class="blueButton round right" id="signInButton">Sign In</button></td>
        </tr>

    </table>
</div>


<form method="POST" style="display: none">
    <input type="hidden" name="action" value="download">
    <input type="hidden" name="fileId" id="downloadFileId">
    <input type="submit" value="Download" name="download" id="downloadFileSubmit">
</form>

<script src="/view/js/assetLogic.js"></script>
</body>
</html>

