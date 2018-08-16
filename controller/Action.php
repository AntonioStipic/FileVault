<?php

class Controller_Action extends Lib_Controller {

    protected $actions = ["logout", "upload", "download", "delete", "rename", "sort", "search", "shareRecommed", "share", "fileInfo"];

    function __construct() {
        parent::__construct();

        $this->checkRequest();

    }

    function checkRequest() {
//        print_r($_POST);
        if (isset($_POST["action"]) && in_array($_POST["action"], $this->actions)) {
            $this->doAction($_POST["action"]);
        } else {
            echo "401: Denied";
        }
    }

    function doAction($action) {
        if ($action == "logout") {
            session_destroy();
            header("Location: /");
        } else if ($action == "delete") {
            $this->deleteFile($_POST["fileId"]);
        } else if ($action == "rename") {
            $this->renameFile($_POST["fileId"], $_POST["fileName"]);
        } else if ($action == "sort") {
            $this->sort($_POST["sortBy"], $_POST["direction"]);
        } else if ($action == "search") {
//            header("Location: /home?search=" . $_POST["phrase"]);
            $this->search($_POST["phrase"]);
        } else if ($action == "shareRecommed") {
            $this->findUser($_POST["name"]);
        } else if ($action == "share") {
            $this->shareFile($_POST["fileId"], $_POST["users"]);
        } else if ($action = "fileInfo") {
            $this->fileInfo($_POST["fileId"]);
        }

    }

    function fileInfo($fileId) {
        $file = new Model_File($fileId);

        $uuid = $file->uuid;
        $name = $file->title . $file->extension;
        $download = $file->download;
        $size = $file->size;
        $owner = $file->owner;
        $uploadTime = $file->uploadTime;

        $uploadTime = date("M jS, Y - H:i", strtotime($uploadTime));


        $db = new DB_Connection();
        $conn = $db->conn;

        $stmt = $conn->prepare("SELECT uuid, username FROM relations INNER JOIN users ON relations.user_id=users.uuid WHERE file_id=?");
        $stmt->execute([$fileId]);

        $users = $stmt->fetchAll();

        $users = json_encode($users);

        echo "{\"uuid\": \"$uuid\", \"name\": \"$name\", \"download\": \"$download\", \"size\": \"$size\", \"owner\": \"$owner\", \"upload_time\": \"$uploadTime\", \"sharedTo\": $users}";

    }


    function sort($sortBy, $direction) {
        $files = Model_Home::getFiles($sortBy, $direction);
        $this->data["files"] = $files;

        $this->echoFiles();
    }

    function findUser($name) {
        $user = new Model_User("");

        $users = $user->findUser($name);

        $users = json_encode($users);

        print_r($users);
    }

    function shareFile($fileId, $users) {
        echo $fileId;

//        print_r($users);

        $users = str_replace("<b>", "", $users);
        $users = str_replace("</b>", "", $users);

        $usernames = explode(", ", $users);

        $file = new Model_File("");

        if ($file->shareFile($fileId, $usernames)) {
            echo "Yes";
        } else {
            echo "No";
        }
    }

    function renameFile($fileId, $fileName) {
        $file = new Model_File($fileId);

        if (isset($_GET["sortBy"])) {
            $sortBy = $_POST["sortBy"];
        } else {
            $sortBy = "title";
        }

        if ($file->renameFile($fileName)) {
            $files = Model_Home::getFiles($sortBy);
            $this->data["files"] = $files;

            $this->echoFiles();
        }
    }

    function search($phrase) {

        if (isset($_POST["sortBy"])) {
            $sortBy = $_POST["sortBy"];
        } else {
            $sortBy = "title";
        }

        $files = Model_Home::searchFiles($phrase, $sortBy);
        $this->data["files"] = $files;

        $this->echoFiles();
    }

    function deleteFile($fileId) {
        $file = new Model_File($fileId);

//        unlink

        $path = $file->path;
        if (unlink($path)) {


            if ($file->deleteFile($fileId)) {
                $data = '{"success": true}';
                echo $data;
            } else {
                $data = '{"success": false}';
                echo $data;
            }
        }
    }


    function echoFiles() {
        for ($i = 0; $i < count($this->data["files"]); $i++) {
            $userInfo = new Model_UserInfo($this->data["files"][$i]["owner"]);
            echo '<tr class="asset right-click">
                        <td style="display: none" class="id">' . $this->data["files"][$i]["uuid"] . '</td>
                        <td class="fileListHeaderName"><i class="fa fa-file"></i>&nbsp;&nbsp; ' . $this->data["files"][$i]["title"] . $this->data["files"][$i]["extension"] . '</td>
                        <td class="fileListHeaderOwner">| ' . $userInfo->username . '</td>
                        <td class="fileListHeaderUploadTime">| ' . date("M jS, Y - H:i", strtotime($this->data["files"][$i]["upload_time"])) . '</td>
                        <td class="fileListHeaderDownload" id="' . $this->data["files"][$i]["uuid"] . 'Download">| ' . $this->data["files"][$i]["download"] . (($this->data["files"][$i]["download"] == 1)?" time":" times") . '</td>
                        <td class="fileListHeaderSize">| ' . Model_File::formatSizeUnits($this->data["files"][$i]["size"]) . '</td>
                    </tr>';
        }
    }
}